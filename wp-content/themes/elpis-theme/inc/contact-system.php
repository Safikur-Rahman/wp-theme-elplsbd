<?php
/**
 * ELPIS BD Contact System & SMTP Manager
 * Handles:
 * 1. Contact Messages Database Table
 * 2. Contact Form Submission (AJAX & POST)
 * 3. WP Admin: View Messages, Unread Badges & Reply via Email
 * 4. WP Admin: Full SMTP Configuration & Test Email
 */

if (!defined('ABSPATH')) {
    exit;
}

// -------------------------------------------------------------
// 1. Database Table Creation & Verification
// -------------------------------------------------------------
function elpis_get_contact_table_name() {
    global $wpdb;
    return $wpdb->prefix . 'elpis_contact_messages';
}

function elpis_init_contact_database() {
    global $wpdb;
    $table_name = elpis_get_contact_table_name();
    $charset_collate = $wpdb->get_charset_collate();

    $installed_ver = get_option('elpis_contact_db_version', '0');
    $current_ver   = '1.1';

    if ($installed_ver !== $current_ver || $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            company varchar(255) DEFAULT '',
            phone varchar(100) DEFAULT '',
            email varchar(255) DEFAULT '',
            message text NOT NULL,
            status varchar(50) DEFAULT 'unread',
            reply_subject varchar(255) DEFAULT '',
            reply_message text DEFAULT '',
            replied_at datetime DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) {$charset_collate};";

        dbDelta($sql);
        update_option('elpis_contact_db_version', $current_ver);
    }
}
add_action('after_setup_theme', 'elpis_init_contact_database');
add_action('admin_init', 'elpis_init_contact_database');

// -------------------------------------------------------------
// 2. SMTP Hook for WordPress wp_mail()
// -------------------------------------------------------------
function elpis_configure_phpmailer_smtp($phpmailer) {
    $smtp = get_option('elpis_smtp_settings', array());
    if (!empty($smtp['enabled'])) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = !empty($smtp['host']) ? trim($smtp['host']) : 'localhost';
        $phpmailer->SMTPAuth   = !empty($smtp['auth']) && $smtp['auth'] === 'yes';
        $phpmailer->Port       = !empty($smtp['port']) ? intval($smtp['port']) : 587;
        $phpmailer->Username   = !empty($smtp['username']) ? trim($smtp['username']) : '';
        $phpmailer->Password   = !empty($smtp['password']) ? $smtp['password'] : '';
        
        $encryption            = !empty($smtp['encryption']) ? strtolower(trim($smtp['encryption'])) : 'tls';
        if ($encryption === 'none') {
            $phpmailer->SMTPSecure   = '';
            $phpmailer->SMTPAutoTLS  = false;
        } else {
            $phpmailer->SMTPSecure   = $encryption;
            $phpmailer->SMTPAutoTLS  = true;
        }

        $from_email            = !empty($smtp['from_email']) ? trim($smtp['from_email']) : (!empty($smtp['username']) ? trim($smtp['username']) : get_option('admin_email'));
        $from_name             = !empty($smtp['from_name']) ? trim($smtp['from_name']) : get_bloginfo('name');
        
        $phpmailer->setFrom($from_email, $from_name, false);
    }
}
// Filter wp_mail_from to override localhost default before PHPMailer validates it
function elpis_filter_wp_mail_from($from_email) {
    $smtp = get_option('elpis_smtp_settings', array());
    if (!empty($smtp['enabled']) && $smtp['enabled'] === 'yes') {
        if (!empty($smtp['from_email'])) {
            return trim($smtp['from_email']);
        } elseif (!empty($smtp['username'])) {
            return trim($smtp['username']);
        }
    }
    return $from_email;
}
add_filter('wp_mail_from', 'elpis_filter_wp_mail_from', 99);

// Filter wp_mail_from_name to set custom sender display name
function elpis_filter_wp_mail_from_name($from_name) {
    $smtp = get_option('elpis_smtp_settings', array());
    if (!empty($smtp['enabled']) && $smtp['enabled'] === 'yes') {
        if (!empty($smtp['from_name'])) {
            return trim($smtp['from_name']);
        }
    }
    return $from_name;
}
add_filter('wp_mail_from_name', 'elpis_filter_wp_mail_from_name', 99);

add_action('phpmailer_init', 'elpis_configure_phpmailer_smtp', 99);

// -------------------------------------------------------------
// 3. Contact Form Submission Handler (AJAX & Normal POST)
// -------------------------------------------------------------
function elpis_handle_contact_form_submission() {
    // Verify nonce if present
    if (isset($_POST['elpis_contact_nonce']) && !wp_verify_nonce($_POST['elpis_contact_nonce'], 'elpis_contact_action')) {
        $msg = 'Security check failed. Please refresh the page and try again.';
        if (wp_doing_ajax()) {
            wp_send_json_error(array('message' => $msg));
        } else {
            wp_die($msg);
        }
    }

    $name    = isset($_POST['contact_name']) ? sanitize_text_field(trim($_POST['contact_name'])) : '';
    $company = isset($_POST['contact_company']) ? sanitize_text_field(trim($_POST['contact_company'])) : '';
    $phone   = isset($_POST['contact_phone']) ? sanitize_text_field(trim($_POST['contact_phone'])) : '';
    $email   = isset($_POST['contact_email']) ? sanitize_email(trim($_POST['contact_email'])) : '';
    $message = isset($_POST['contact_message']) ? sanitize_textarea_field(trim($_POST['contact_message'])) : '';

    if (empty($name) || empty($message)) {
        $err = 'Please provide both your name and message.';
        if (wp_doing_ajax()) {
            wp_send_json_error(array('message' => $err));
        } else {
            wp_die($err);
        }
    }

    global $wpdb;
    $table_name = elpis_get_contact_table_name();

    $inserted = $wpdb->insert(
        $table_name,
        array(
            'name'       => $name,
            'company'    => $company,
            'phone'      => $phone,
            'email'      => $email,
            'message'    => $message,
            'status'     => 'unread',
            'created_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if ($inserted === false) {
        $err = 'Database error: Could not save message. Please try again.';
        if (wp_doing_ajax()) {
            wp_send_json_error(array('message' => $err));
        } else {
            wp_die($err);
        }
    }

    // Optional: Send alert to admin email
    $admin_email = get_theme_mod('contact_email', get_option('admin_email'));
    if (!empty($admin_email)) {
        $site_name = get_bloginfo('name');
        $subject = "[{$site_name}] New Contact Inquiry from {$name}";
        $body  = "You have received a new contact message on {$site_name}:\n\n";
        $body .= "Name: {$name}\n";
        if (!empty($company)) $body .= "Company: {$company}\n";
        if (!empty($phone))   $body .= "Phone: {$phone}\n";
        if (!empty($email))   $body .= "Email: {$email}\n";
        $body .= "\nMessage:\n{$message}\n\n";
        $body .= "---\nView and reply to this message directly in WP Admin > Contact Messages.";
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        if (!empty($email)) {
            $headers[] = "Reply-To: {$name} <{$email}>";
        }
        @wp_mail($admin_email, $subject, $body, $headers);
    }

    $success_msg = 'Thank you! Your message has been sent successfully. Our team will contact you shortly.';
    if (wp_doing_ajax()) {
        wp_send_json_success(array('message' => $success_msg));
    } else {
        $redirect = wp_get_referer() ? add_query_arg('contact_status', 'success', wp_get_referer()) : home_url('/contact-us/?contact_status=success');
        wp_safe_redirect($redirect);
        exit;
    }
}
add_action('wp_ajax_elpis_contact_submit', 'elpis_handle_contact_form_submission');
add_action('wp_ajax_nopriv_elpis_contact_submit', 'elpis_handle_contact_form_submission');
add_action('admin_post_elpis_contact_submit', 'elpis_handle_contact_form_submission');
add_action('admin_post_nopriv_elpis_contact_submit', 'elpis_handle_contact_form_submission');

// -------------------------------------------------------------
// 4. Admin Menu Registration (Messages & SMTP Settings)
// -------------------------------------------------------------
function elpis_register_contact_admin_menus() {
    global $wpdb;
    $table_name = elpis_get_contact_table_name();
    $unread_count = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") == $table_name) {
        $unread_count = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'unread'");
    }

    $menu_title = 'Contact Messages';
    if ($unread_count > 0) {
        $menu_title .= sprintf(' <span class="awaiting-mod update-plugins count-%1$d"><span class="pending-count">%1$d</span></span>', $unread_count);
    }

    // Top-level menu: Messages
    add_menu_page(
        'Contact Messages',
        $menu_title,
        'manage_options',
        'elpis-messages',
        'elpis_render_admin_messages_page',
        'dashicons-email-alt',
        25
    );

    // Submenu: All Messages
    add_submenu_page(
        'elpis-messages',
        'All Messages',
        'All Messages',
        'manage_options',
        'elpis-messages',
        'elpis_render_admin_messages_page'
    );

    // Submenu: SMTP Settings
    add_submenu_page(
        'elpis-messages',
        'SMTP Settings',
        'SMTP Settings',
        'manage_options',
        'elpis-smtp-settings',
        'elpis_render_admin_smtp_page'
    );
}
add_action('admin_menu', 'elpis_register_contact_admin_menus');

// -------------------------------------------------------------
// 5. Admin Page: Messages List & Detail / Reply Modal
// -------------------------------------------------------------
function elpis_render_admin_messages_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    global $wpdb;
    $table_name = elpis_get_contact_table_name();

    // Handle Delete Action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        check_admin_referer('elpis_delete_msg_' . $_GET['id']);
        $wpdb->delete($table_name, array('id' => intval($_GET['id'])), array('%d'));
        echo '<div class="notice notice-success is-dismissible"><p>Message deleted successfully.</p></div>';
    }

    // Handle Reply Form Submission
    if (isset($_POST['elpis_send_reply']) && check_admin_referer('elpis_reply_nonce')) {
        $msg_id        = intval($_POST['message_id']);
        $recipient     = sanitize_email($_POST['reply_to_email']);
        $recipient_name= sanitize_text_field($_POST['reply_to_name']);
        $reply_subject = sanitize_text_field($_POST['reply_subject']);
        $reply_body    = wp_kses_post($_POST['reply_message']);

        if (empty($recipient)) {
            echo '<div class="notice notice-error is-dismissible"><p>Cannot send reply: Recipient does not have a valid email address.</p></div>';
        } elseif (empty($reply_body)) {
            echo '<div class="notice notice-error is-dismissible"><p>Please enter a reply message before sending.</p></div>';
        } else {
            // Send email
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $html_content = nl2br(esc_html($reply_body));
            $mail_sent = wp_mail($recipient, $reply_subject, $html_content, $headers);

            if ($mail_sent) {
                $wpdb->update(
                    $table_name,
                    array(
                        'status'        => 'replied',
                        'reply_subject' => $reply_subject,
                        'reply_message' => $reply_body,
                        'replied_at'    => current_time('mysql'),
                    ),
                    array('id' => $msg_id),
                    array('%s', '%s', '%s', '%s'),
                    array('%d')
                );
                echo '<div class="notice notice-success is-dismissible"><p><strong>Reply sent successfully via SMTP!</strong> The message status has been updated to "Replied".</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Failed to send email. Please check your SMTP settings under <strong>Contact Messages > SMTP Settings</strong>.</p></div>';
            }
        }
    }

    // View Single Message Detail / Reply View
    if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $msg = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $id));

        if (!$msg) {
            echo '<div class="wrap"><div class="notice notice-error"><p>Message not found.</p></div><p><a href="?page=elpis-messages" class="button">Back to List</a></p></div>';
            return;
        }

        // Mark as read if was unread
        if ($msg->status === 'unread') {
            $wpdb->update($table_name, array('status' => 'read'), array('id' => $id));
            $msg->status = 'read';
        }
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">View & Reply Message #<?php echo esc_html($msg->id); ?></h1>
            <a href="?page=elpis-messages" class="button" style="margin-left: 10px;">&larr; Back to All Messages</a>
            <hr class="wp-header-end">

            <div style="display: flex; gap: 24px; margin-top: 20px; flex-wrap: wrap;">
                <!-- Left: Message Details Card -->
                <div style="flex: 1; min-width: 320px; max-width: 450px;">
                    <div class="postbox" style="padding: 20px;">
                        <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #eee;">Sender Information</h2>
                        <table class="form-table" style="margin-top: 0;">
                            <tr>
                                <th style="width: 100px; padding: 10px 0;"><strong>Name:</strong></th>
                                <td style="padding: 10px 0; font-size: 15px; font-weight: 600; color: #0f172a;"><?php echo esc_html($msg->name); ?></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Email:</strong></th>
                                <td style="padding: 10px 0;">
                                    <?php if (!empty($msg->email)): ?>
                                        <a href="mailto:<?php echo esc_attr($msg->email); ?>"><?php echo esc_html($msg->email); ?></a>
                                    <?php else: ?>
                                        <span style="color: #94a3b8;">Not provided</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Phone:</strong></th>
                                <td style="padding: 10px 0;">
                                    <?php if (!empty($msg->phone)): ?>
                                        <a href="tel:<?php echo esc_attr($msg->phone); ?>"><?php echo esc_html($msg->phone); ?></a>
                                    <?php else: ?>
                                        <span style="color: #94a3b8;">Not provided</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Company:</strong></th>
                                <td style="padding: 10px 0;"><?php echo !empty($msg->company) ? esc_html($msg->company) : '<span style="color:#94a3b8;">Not provided</span>'; ?></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Received:</strong></th>
                                <td style="padding: 10px 0;"><?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($msg->created_at))); ?></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Status:</strong></th>
                                <td style="padding: 10px 0;">
                                    <?php if ($msg->status === 'replied'): ?>
                                        <span style="background: #10b981; color: #fff; padding: 3px 10px; border-radius: 999px; font-weight: 600; font-size: 12px;">Replied</span>
                                    <?php else: ?>
                                        <span style="background: #3b82f6; color: #fff; padding: 3px 10px; border-radius: 999px; font-weight: 600; font-size: 12px;">Read</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>

                        <h3 style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">Client's Message:</h3>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; font-size: 14px; line-height: 1.6; color: #1e293b; white-space: pre-wrap;">
<?php echo esc_html($msg->message); ?>
                        </div>
                    </div>
                </div>

                <!-- Right: Reply via Email / SMTP Card -->
                <div style="flex: 1.3; min-width: 360px;">
                    <?php if ($msg->status === 'replied' && !empty($msg->reply_message)): ?>
                        <div class="postbox" style="padding: 20px; border-left: 4px solid #10b981;">
                            <h2 style="margin-top: 0; color: #10b981;">&check; Previous Reply Sent</h2>
                            <p style="color: #64748b; font-size: 13px;">Sent at: <?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($msg->replied_at))); ?></p>
                            <p><strong>Subject:</strong> <?php echo esc_html($msg->reply_subject); ?></p>
                            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 15px; font-size: 14px; line-height: 1.6; color: #166534; white-space: pre-wrap;">
<?php echo esc_html($msg->reply_message); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="postbox" style="padding: 20px;">
                        <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                            <?php echo ($msg->status === 'replied') ? 'Send Another Reply via SMTP' : 'Send Reply via SMTP'; ?>
                        </h2>
                        
                        <?php if (empty($msg->email)): ?>
                            <div class="notice notice-warning inline" style="margin: 0 0 15px 0;">
                                <p><strong>Notice:</strong> This inquiry did not provide an email address. You may reach out to them via phone at <strong><?php echo esc_html($msg->phone); ?></strong>.</p>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="">
                            <?php wp_nonce_field('elpis_reply_nonce'); ?>
                            <input type="hidden" name="message_id" value="<?php echo esc_attr($msg->id); ?>">
                            <input type="hidden" name="reply_to_email" value="<?php echo esc_attr($msg->email); ?>">
                            <input type="hidden" name="reply_to_name" value="<?php echo esc_attr($msg->name); ?>">

                            <table class="form-table">
                                <tr>
                                    <th scope="row"><label for="reply_to_display">To:</label></th>
                                    <td>
                                        <input type="text" id="reply_to_display" value="<?php echo esc_attr($msg->name . ' <' . ($msg->email ?: 'No Email') . '>'); ?>" class="regular-text" readonly style="background: #f1f5f9;">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="reply_subject">Subject:</label></th>
                                    <td>
                                        <input type="text" name="reply_subject" id="reply_subject" value="<?php echo esc_attr('Re: Your inquiry at ' . get_bloginfo('name')); ?>" class="regular-text" required style="width: 100%;">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="reply_message">Reply Message:</label></th>
                                    <td>
                                        <textarea name="reply_message" id="reply_message" rows="8" class="large-text" required style="width: 100%; font-family: inherit; font-size: 14px; padding: 10px;" placeholder="Type your reply message here..."></textarea>
                                    </td>
                                </tr>
                            </table>

                            <p class="submit" style="margin-top: 15px;">
                                <button type="submit" name="elpis_send_reply" class="button button-primary button-large" <?php echo empty($msg->email) ? 'disabled' : ''; ?> style="background: #b8860b; border-color: #996515; font-size: 14px; height: auto; padding: 8px 24px;">
                                    &rarr; Send Reply via SMTP
                                </button>
                                <?php if (!empty(get_option('elpis_smtp_settings')['enabled'])): ?>
                                    <span style="color: #10b981; margin-left: 10px; font-size: 13px;">&check; SMTP Active</span>
                                <?php else: ?>
                                    <span style="color: #f59e0b; margin-left: 10px; font-size: 13px;">&#9888; SMTP not yet configured (<a href="?page=elpis-smtp-settings">Setup SMTP</a>)</span>
                                <?php endif; ?>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return;
    }

    // Default: List All Messages View
    $status_filter = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $search_query  = isset($_GET['s']) ? sanitize_text_field(trim($_GET['s'])) : '';

    $where = 'WHERE 1=1';
    if ($status_filter === 'unread') {
        $where .= " AND status = 'unread'";
    } elseif ($status_filter === 'replied') {
        $where .= " AND status = 'replied'";
    } elseif ($status_filter === 'read') {
        $where .= " AND status = 'read'";
    }

    if (!empty($search_query)) {
        $like = '%' . $wpdb->esc_like($search_query) . '%';
        $where .= $wpdb->prepare(" AND (name LIKE %s OR email LIKE %s OR company LIKE %s OR phone LIKE %s OR message LIKE %s)", $like, $like, $like, $like, $like);
    }

    $all_count     = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name}");
    $unread_count  = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'unread'");
    $replied_count = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'replied'");

    $messages = $wpdb->get_results("SELECT * FROM {$table_name} {$where} ORDER BY created_at DESC LIMIT 100");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Contact Inquiries & Messages</h1>
        <hr class="wp-header-end">

        <!-- Filters & Navigation -->
        <ul class="subsubsub" style="margin-bottom: 15px;">
            <li><a href="?page=elpis-messages" class="<?php echo empty($status_filter) ? 'current' : ''; ?>">All <span class="count">(<?php echo $all_count; ?>)</span></a> |</li>
            <li><a href="?page=elpis-messages&status=unread" class="<?php echo ($status_filter === 'unread') ? 'current' : ''; ?>">Unread <span class="count">(<?php echo $unread_count; ?>)</span></a> |</li>
            <li><a href="?page=elpis-messages&status=replied" class="<?php echo ($status_filter === 'replied') ? 'current' : ''; ?>">Replied <span class="count">(<?php echo $replied_count; ?>)</span></a></li>
        </ul>

        <!-- Search Box -->
        <form method="get" action="" style="float: right; margin-bottom: 12px;">
            <input type="hidden" name="page" value="elpis-messages">
            <?php if (!empty($status_filter)): ?><input type="hidden" name="status" value="<?php echo esc_attr($status_filter); ?>"><?php endif; ?>
            <input type="search" name="s" value="<?php echo esc_attr($search_query); ?>" placeholder="Search messages...">
            <button type="submit" class="button">Search</button>
        </form>

        <!-- Messages Table -->
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 140px;">Name</th>
                    <th style="width: 130px;">Company</th>
                    <th style="width: 120px;">Phone</th>
                    <th style="width: 160px;">Email</th>
                    <th>Message Preview</th>
                    <th style="width: 140px;">Date</th>
                    <th style="width: 130px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $m): ?>
                        <tr style="<?php echo ($m->status === 'unread') ? 'font-weight: 600; background: #fffbeb;' : ''; ?>">
                            <td>
                                <?php if ($m->status === 'unread'): ?>
                                    <span style="background: #ef4444; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">Unread</span>
                                <?php elseif ($m->status === 'replied'): ?>
                                    <span style="background: #10b981; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">Replied</span>
                                <?php else: ?>
                                    <span style="background: #94a3b8; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">Read</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo esc_html($m->name); ?></strong></td>
                            <td><?php echo esc_html($m->company ?: '—'); ?></td>
                            <td><?php echo esc_html($m->phone ?: '—'); ?></td>
                            <td>
                                <?php if (!empty($m->email)): ?>
                                    <a href="mailto:<?php echo esc_attr($m->email); ?>"><?php echo esc_html($m->email); ?></a>
                                <?php else: ?>
                                    <span style="color:#94a3b8;">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo esc_html(wp_trim_words($m->message, 14, '...')); ?>
                            </td>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($m->created_at))); ?>
                            </td>
                            <td style="text-align: right;">
                                <a href="?page=elpis-messages&action=view&id=<?php echo esc_attr($m->id); ?>" class="button button-small button-primary">View / Reply</a>
                                <a href="<?php echo esc_url(wp_nonce_url('?page=elpis-messages&action=delete&id=' . $m->id, 'elpis_delete_msg_' . $m->id)); ?>" class="button button-small" onclick="return confirm('Delete this message permanently?');" style="color: #ef4444;">&times;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #64748b;">
                            No messages found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// -------------------------------------------------------------
// 6. Admin Page: SMTP Settings & Live Connection Test
// -------------------------------------------------------------
function elpis_render_admin_smtp_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    $smtp = get_option('elpis_smtp_settings', array(
        'enabled'    => 'no',
        'host'       => 'smtp.gmail.com',
        'port'       => '587',
        'encryption' => 'tls',
        'auth'       => 'yes',
        'username'   => '',
        'password'   => '',
        'from_email' => '',
        'from_name'  => get_bloginfo('name'),
    ));

    // Handle Saving Settings
    if (isset($_POST['elpis_save_smtp']) && check_admin_referer('elpis_smtp_save_nonce')) {
        $smtp['enabled']    = isset($_POST['smtp_enabled']) ? 'yes' : 'no';
        $smtp['host']       = sanitize_text_field(trim($_POST['smtp_host']));
        $smtp['port']       = sanitize_text_field(trim($_POST['smtp_port']));
        $smtp['encryption'] = sanitize_text_field($_POST['smtp_encryption']);
        $smtp['auth']       = isset($_POST['smtp_auth']) ? 'yes' : 'no';
        $smtp['username']   = sanitize_text_field(trim($_POST['smtp_username']));
        
        // Only update password if a new one is typed
        if (!empty($_POST['smtp_password'])) {
            $smtp['password'] = $_POST['smtp_password'];
        }

        $smtp['from_email'] = sanitize_email(trim($_POST['smtp_from_email']));
        $smtp['from_name']  = sanitize_text_field(trim($_POST['smtp_from_name']));

        update_option('elpis_smtp_settings', $smtp);
        echo '<div class="notice notice-success is-dismissible"><p><strong>SMTP settings saved successfully!</strong></p></div>';
    }

    // Handle Test Email
    $test_result = null;
    if (isset($_POST['elpis_send_test_email']) && check_admin_referer('elpis_smtp_test_nonce')) {
        $test_to = sanitize_email($_POST['test_recipient']);
        if (empty($test_to)) {
            echo '<div class="notice notice-error is-dismissible"><p>Please enter a valid recipient email for testing.</p></div>';
        } else {
            $subject = 'ELPIS BD SMTP Test Connection';
            $message = "Hello!\n\nThis is a test email sent from your website: " . get_bloginfo('name') . " (" . home_url() . ").\nYour SMTP configuration is active and working perfectly!\n\nTime: " . current_time('mysql');
            $headers = array('Content-Type: text/plain; charset=UTF-8');

            // Temporarily capture mail error if any
            $mail_error = '';
            add_action('wp_mail_failed', function($wp_error) use (&$mail_error) {
                $mail_error = $wp_error->get_error_message();
            });

            $sent = wp_mail($test_to, $subject, $message, $headers);

            if ($sent) {
                echo '<div class="notice notice-success is-dismissible"><p><strong>Success!</strong> Test email was sent successfully to <strong>' . esc_html($test_to) . '</strong>. Please check your inbox/spam folder.</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p><strong>Failed to send test email.</strong> Error details: ' . esc_html($mail_error ?: 'Check your SMTP credentials, host, or port.') . '</p></div>';
            }
        }
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">SMTP Settings & Configuration</h1>
        <hr class="wp-header-end">
        <p style="color: #64748b; font-size: 14px;">Configure SMTP credentials to reliably send emails and replies directly from your WordPress site without external plugins.</p>

        <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-top: 20px;">
            <!-- Left: Settings Form -->
            <div style="flex: 2; min-width: 360px;">
                <div class="postbox" style="padding: 20px;">
                    <form method="post" action="">
                        <?php wp_nonce_field('elpis_smtp_save_nonce'); ?>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">Enable Custom SMTP</th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="smtp_enabled" value="yes" <?php checked($smtp['enabled'], 'yes'); ?>>
                                        <strong>Enable SMTP for sending all outgoing emails and replies</strong>
                                    </label>
                                    <p class="description">When checked, all emails sent from the theme will use these SMTP settings.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_host">SMTP Host</label></th>
                                <td>
                                    <input type="text" name="smtp_host" id="smtp_host" value="<?php echo esc_attr($smtp['host']); ?>" class="regular-text" placeholder="e.g. smtp.gmail.com or mail.yourdomain.com">
                                    <p class="description">For Gmail: <code>smtp.gmail.com</code> | For cPanel/Webmail: <code>mail.yourdomain.com</code></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_port">SMTP Port</label></th>
                                <td>
                                    <input type="number" name="smtp_port" id="smtp_port" value="<?php echo esc_attr($smtp['port']); ?>" class="small-text" placeholder="587">
                                    <p class="description">Common ports: <code>587</code> (TLS) or <code>465</code> (SSL) or <code>25</code> (Non-secure)</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_encryption">Encryption</label></th>
                                <td>
                                    <select name="smtp_encryption" id="smtp_encryption">
                                        <option value="tls" <?php selected($smtp['encryption'], 'tls'); ?>>TLS (Recommended)</option>
                                        <option value="ssl" <?php selected($smtp['encryption'], 'ssl'); ?>>SSL</option>
                                        <option value="none" <?php selected($smtp['encryption'], 'none'); ?>>None</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">SMTP Authentication</th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="smtp_auth" value="yes" <?php checked($smtp['auth'], 'yes'); ?>>
                                        Requires authentication (Username & Password)
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_username">SMTP Username</label></th>
                                <td>
                                    <input type="text" name="smtp_username" id="smtp_username" value="<?php echo esc_attr($smtp['username']); ?>" class="regular-text" placeholder="e.g. info@elpisbd.com">
                                    <p class="description">Usually your full email address.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_password">SMTP Password</label></th>
                                <td>
                                    <input type="password" name="smtp_password" id="smtp_password" value="" class="regular-text" placeholder="<?php echo !empty($smtp['password']) ? '•••••••••••• (Leave blank to keep existing)' : 'Enter SMTP password'; ?>">
                                    <p class="description">For Gmail, use a 16-character Google <em>App Password</em>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_from_email">From Email Address</label></th>
                                <td>
                                    <input type="email" name="smtp_from_email" id="smtp_from_email" value="<?php echo esc_attr($smtp['from_email']); ?>" class="regular-text" placeholder="e.g. info@elpisbd.com">
                                    <p class="description">The email address that recipients will see as the sender.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="smtp_from_name">From Name</label></th>
                                <td>
                                    <input type="text" name="smtp_from_name" id="smtp_from_name" value="<?php echo esc_attr($smtp['from_name']); ?>" class="regular-text" placeholder="ELPIS BD">
                                    <p class="description">The display name appearing in the recipient's inbox.</p>
                                </td>
                            </tr>
                        </table>

                        <p class="submit">
                            <button type="submit" name="elpis_save_smtp" class="button button-primary button-large" style="background: #b8860b; border-color: #996515; padding: 6px 22px;">
                                Save SMTP Settings
                            </button>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Right: Test Email Connection Pod -->
            <div style="flex: 1; min-width: 300px; max-width: 420px;">
                <div class="postbox" style="padding: 20px;">
                    <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #eee;">Send a Test Email</h2>
                    <p style="color: #64748b; font-size: 13px;">Test whether your SMTP configuration works properly by sending an instant test message to any email address.</p>
                    
                    <form method="post" action="">
                        <?php wp_nonce_field('elpis_smtp_test_nonce'); ?>
                        <p>
                            <label for="test_recipient" style="display: block; font-weight: 600; margin-bottom: 6px;">Send Test To:</label>
                            <input type="email" name="test_recipient" id="test_recipient" value="<?php echo esc_attr(get_option('admin_email')); ?>" class="regular-text" style="width: 100%;" required>
                        </p>
                        <p>
                            <button type="submit" name="elpis_send_test_email" class="button button-secondary button-large" style="width: 100%; text-align: center;">
                                &rarr; Send Test Email Now
                            </button>
                        </p>
                    </form>

                    <div style="margin-top: 25px; padding: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 12px; line-height: 1.5; color: #475569;">
                        <strong>Quick Tip for Gmail:</strong><br>
                        1. Enable 2-Step Verification in your Google Account.<br>
                        2. Go to <em>Security &gt; App Passwords</em>.<br>
                        3. Create a password for "Mail" and paste that 16-character password into the <strong>SMTP Password</strong> field above.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
