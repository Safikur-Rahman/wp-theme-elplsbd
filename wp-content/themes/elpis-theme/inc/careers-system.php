<?php
/**
 * ELPIS BD Careers CV Drop System
 * Handles:
 * 1. Database Table for CV / Resume Submissions
 * 2. Secure File Upload & AJAX Submission
 * 3. WP Admin: View Applicants, Download CVs & Send Reply via SMTP
 */

if (!defined('ABSPATH')) {
    exit;
}

// -------------------------------------------------------------
// 1. Database Table Creation & Verification
// -------------------------------------------------------------
function elpis_get_cv_table_name() {
    global $wpdb;
    return $wpdb->prefix . 'elpis_cv_submissions';
}

function elpis_init_cv_database() {
    global $wpdb;
    $table_name = elpis_get_cv_table_name();
    $charset_collate = $wpdb->get_charset_collate();

    $installed_ver = get_option('elpis_cv_db_version', '0');
    $current_ver   = '1.0';

    if ($installed_ver !== $current_ver || $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(100) DEFAULT '',
            position varchar(255) DEFAULT '',
            message text DEFAULT '',
            file_name varchar(255) NOT NULL,
            file_url varchar(500) NOT NULL,
            file_path varchar(500) NOT NULL,
            file_size varchar(50) DEFAULT '',
            status varchar(50) DEFAULT 'unread',
            reply_subject varchar(255) DEFAULT '',
            reply_message text DEFAULT '',
            replied_at datetime DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) {$charset_collate};";

        dbDelta($sql);
        update_option('elpis_cv_db_version', $current_ver);
    }
}
add_action('after_setup_theme', 'elpis_init_cv_database');
add_action('admin_init', 'elpis_init_cv_database');

// -------------------------------------------------------------
// 2. AJAX & POST CV Upload Handler
// -------------------------------------------------------------
function elpis_handle_cv_submission() {
    // Check security nonce
    if (isset($_POST['elpis_cv_nonce']) && !wp_verify_nonce($_POST['elpis_cv_nonce'], 'elpis_cv_action')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh the page and try again.'));
    }

    $name     = isset($_POST['applicant_name']) ? sanitize_text_field(trim($_POST['applicant_name'])) : '';
    $email    = isset($_POST['applicant_email']) ? sanitize_email(trim($_POST['applicant_email'])) : '';
    $phone    = isset($_POST['applicant_phone']) ? sanitize_text_field(trim($_POST['applicant_phone'])) : '';
    $position = isset($_POST['applicant_position']) ? sanitize_text_field(trim($_POST['applicant_position'])) : '';
    $message  = isset($_POST['applicant_message']) ? sanitize_textarea_field(trim($_POST['applicant_message'])) : '';

    if (empty($name) || empty($email)) {
        wp_send_json_error(array('message' => 'Please provide your Full Name and a valid Email Address.'));
    }

    // Check file upload
    if (empty($_FILES['cv_file']) || empty($_FILES['cv_file']['name'])) {
        wp_send_json_error(array('message' => 'Please select or drop your CV file before submitting.'));
    }

    $file = $_FILES['cv_file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error(array('message' => 'File upload error code: ' . $file['error']));
    }

    // Check file size (max 10MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        wp_send_json_error(array('message' => 'File size exceeds maximum allowed limit of 10 MB.'));
    }

    // Validate extension & MIME type
    $allowed_extensions = array('pdf', 'doc', 'docx');
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_extensions)) {
        wp_send_json_error(array('message' => 'Invalid file format. Please upload a PDF, DOC, or DOCX document.'));
    }

    // Upload directory inside uploads/elpis-cvs
    $upload_dir = wp_upload_dir();
    $target_dir = $upload_dir['basedir'] . '/elpis-cvs';
    $target_url = $upload_dir['baseurl'] . '/elpis-cvs';

    if (!file_exists($target_dir)) {
        wp_mkdir_p($target_dir);
        // Create an .htaccess and index.php in upload directory for security
        @file_put_contents($target_dir . '/index.php', '<?php // Silence is golden');
    }

    $original_name = sanitize_file_name($file['name']);
    $safe_name     = time() . '_' . wp_generate_password(6, false) . '_' . $original_name;
    $target_file   = $target_dir . '/' . $safe_name;
    $file_url      = $target_url . '/' . $safe_name;

    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        wp_send_json_error(array('message' => 'Could not save uploaded CV file to server.'));
    }

    // Format file size string (e.g. "1.8 MB" or "450 KB")
    $file_size_str = size_format($file['size'], 1);

    global $wpdb;
    $table_name = elpis_get_cv_table_name();

    $inserted = $wpdb->insert(
        $table_name,
        array(
            'name'       => $name,
            'email'      => $email,
            'phone'      => $phone,
            'position'   => $position,
            'message'    => $message,
            'file_name'  => $original_name,
            'file_url'   => $file_url,
            'file_path'  => $target_file,
            'file_size'  => $file_size_str,
            'status'     => 'unread',
            'created_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if ($inserted === false) {
        wp_send_json_error(array('message' => 'Database error: Could not record CV submission.'));
    }

    // Notify HR / Admin Email
    $hr_email = get_theme_mod('careers_email', get_option('admin_email'));
    if (!empty($hr_email)) {
        $site_name = get_bloginfo('name');
        $subject = "[{$site_name}] New CV Dropped by {$name}" . (!empty($position) ? " for {$position}" : "");
        $body  = "A new candidate has submitted their CV on {$site_name}:\n\n";
        $body .= "Applicant Name: {$name}\n";
        $body .= "Email: {$email}\n";
        $body .= "Phone: {$phone}\n";
        if (!empty($position)) $body .= "Position: {$position}\n";
        if (!empty($message))  $body .= "\nCover Note:\n{$message}\n";
        $body .= "\nAttached CV: {$original_name} ({$file_size_str})\n";
        $body .= "Direct Download Link: {$file_url}\n\n";
        $body .= "---\nView and manage applications in WP Admin > CV Submissions.";

        $headers = array('Content-Type: text/plain; charset=UTF-8');
        if (!empty($email)) {
            $headers[] = "Reply-To: {$name} <{$email}>";
        }
        @wp_mail($hr_email, $subject, $body, $headers);
    }

    wp_send_json_success(array(
        'message' => 'Thank you! Your CV has been submitted successfully. Our HR team will review your application.'
    ));
}
add_action('wp_ajax_elpis_submit_cv', 'elpis_handle_cv_submission');
add_action('wp_ajax_nopriv_elpis_submit_cv', 'elpis_handle_cv_submission');

// -------------------------------------------------------------
// 3. Admin Menu Registration for CV Submissions
// -------------------------------------------------------------
function elpis_register_cv_admin_menus() {
    global $wpdb;
    $table_name = elpis_get_cv_table_name();
    $unread_count = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") == $table_name) {
        $unread_count = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'unread'");
    }

    $menu_title = 'CV Submissions';
    if ($unread_count > 0) {
        $menu_title .= sprintf(' <span class="awaiting-mod update-plugins count-%1$d"><span class="pending-count">%1$d</span></span>', $unread_count);
    }

    // Top-level menu: CV Submissions
    add_menu_page(
        'CV Submissions',
        $menu_title,
        'manage_options',
        'elpis-cv-submissions',
        'elpis_render_admin_cv_page',
        'dashicons-id-alt',
        26
    );

    // Also add submenu under Contact Messages for seamless navigation
    add_submenu_page(
        'elpis-messages',
        'CV Submissions',
        $menu_title,
        'manage_options',
        'elpis-cv-submissions',
        'elpis_render_admin_cv_page'
    );
}
add_action('admin_menu', 'elpis_register_cv_admin_menus');

// -------------------------------------------------------------
// 4. Admin Page: CV Submissions List, Detail & Download
// -------------------------------------------------------------
function elpis_render_admin_cv_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    global $wpdb;
    $table_name = elpis_get_cv_table_name();

    // Handle Delete Action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        check_admin_referer('elpis_delete_cv_' . $_GET['id']);
        $id = intval($_GET['id']);
        $row = $wpdb->get_row($wpdb->prepare("SELECT file_path FROM {$table_name} WHERE id = %d", $id));
        if ($row && !empty($row->file_path) && file_exists($row->file_path)) {
            @unlink($row->file_path);
        }
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo '<div class="notice notice-success is-dismissible"><p>Application and CV deleted successfully.</p></div>';
    }

    // Handle Reply Form Submission
    if (isset($_POST['elpis_send_cv_reply']) && check_admin_referer('elpis_cv_reply_nonce')) {
        $app_id        = intval($_POST['app_id']);
        $recipient     = sanitize_email($_POST['reply_to_email']);
        $recipient_name= sanitize_text_field($_POST['reply_to_name']);
        $reply_subject = sanitize_text_field($_POST['reply_subject']);
        $reply_body    = wp_kses_post($_POST['reply_message']);

        if (empty($recipient)) {
            echo '<div class="notice notice-error is-dismissible"><p>Cannot send reply: Recipient does not have a valid email address.</p></div>';
        } elseif (empty($reply_body)) {
            echo '<div class="notice notice-error is-dismissible"><p>Please enter a reply message before sending.</p></div>';
        } else {
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
                    array('id' => $app_id),
                    array('%s', '%s', '%s', '%s'),
                    array('%d')
                );
                echo '<div class="notice notice-success is-dismissible"><p><strong>Reply sent successfully via SMTP!</strong> Application status has been updated to "Replied".</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Failed to send email. Please check your SMTP settings under <strong>Contact Messages > SMTP Settings</strong>.</p></div>';
            }
        }
    }

    // Single Application View / Detail Screen
    if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $app = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $id));

        if (!$app) {
            echo '<div class="wrap"><div class="notice notice-error"><p>Application not found.</p></div><p><a href="?page=elpis-cv-submissions" class="button">Back to List</a></p></div>';
            return;
        }

        // Mark as reviewed / read if unread
        if ($app->status === 'unread') {
            $wpdb->update($table_name, array('status' => 'reviewed'), array('id' => $id));
            $app->status = 'reviewed';
        }
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">Candidate Application: <?php echo esc_html($app->name); ?></h1>
            <a href="?page=elpis-cv-submissions" class="button" style="margin-left: 10px;">&larr; Back to All Applications</a>
            <hr class="wp-header-end">

            <div style="display: flex; gap: 24px; margin-top: 20px; flex-wrap: wrap;">
                <!-- Left: Candidate Details Card -->
                <div style="flex: 1; min-width: 320px; max-width: 480px;">
                    <div class="postbox" style="padding: 22px;">
                        <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #eee;">Candidate Profile</h2>
                        
                        <table class="form-table" style="margin-top: 0;">
                            <tr>
                                <th style="width: 110px; padding: 10px 0;"><strong>Name:</strong></th>
                                <td style="padding: 10px 0; font-size: 16px; font-weight: 700; color: #0f172a;"><?php echo esc_html($app->name); ?></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Position:</strong></th>
                                <td style="padding: 10px 0;">
                                    <span style="background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 6px; font-weight: 600; font-size: 13px;">
                                        <?php echo !empty($app->position) ? esc_html($app->position) : 'General Application'; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Email:</strong></th>
                                <td style="padding: 10px 0;"><a href="mailto:<?php echo esc_attr($app->email); ?>"><?php echo esc_html($app->email); ?></a></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Phone:</strong></th>
                                <td style="padding: 10px 0;">
                                    <?php if (!empty($app->phone)): ?>
                                        <a href="tel:<?php echo esc_attr($app->phone); ?>"><?php echo esc_html($app->phone); ?></a>
                                    <?php else: ?>
                                        <span style="color: #94a3b8;">Not provided</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Submitted:</strong></th>
                                <td style="padding: 10px 0; color: #64748b;"><?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($app->created_at))); ?></td>
                            </tr>
                            <tr>
                                <th style="padding: 10px 0;"><strong>Status:</strong></th>
                                <td style="padding: 10px 0;">
                                    <?php if ($app->status === 'replied'): ?>
                                        <span style="background: #10b981; color: #fff; padding: 3px 10px; border-radius: 999px; font-weight: 600; font-size: 12px;">Replied</span>
                                    <?php else: ?>
                                        <span style="background: #3b82f6; color: #fff; padding: 3px 10px; border-radius: 999px; font-weight: 600; font-size: 12px;">Reviewed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>

                        <!-- CV File Actions Box -->
                        <div style="margin-top: 20px; padding: 18px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; text-align: center;">
                            <div style="font-size: 30px; margin-bottom: 6px;">&#128196;</div>
                            <h4 style="margin: 0 0 4px 0; font-size: 15px; color: #1e293b;"><?php echo esc_html($app->file_name); ?></h4>
                            <p style="margin: 0 0 14px 0; color: #64748b; font-size: 12px;">File Size: <?php echo esc_html($app->file_size); ?></p>
                            <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                <a href="<?php echo esc_url($app->file_url); ?>" target="_blank" class="button button-secondary" style="font-size: 13px;">
                                    &#128065; View in New Tab
                                </a>
                                <a href="<?php echo esc_url($app->file_url); ?>" download="<?php echo esc_attr($app->file_name); ?>" class="button button-primary" style="background: #b8860b; border-color: #996515; font-size: 13px;">
                                    &#x2B73; Download CV
                                </a>
                            </div>
                            <p style="color: #10b981; font-size: 12px; margin: 10px 0 0 0; font-weight: 600;">
                                &darr; Live embedded preview displayed below
                            </p>
                        </div>

                        <?php if (!empty($app->message)): ?>
                            <h3 style="margin-top: 24px; padding-top: 15px; border-top: 1px solid #eee;">Cover Note / Message:</h3>
                            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; font-size: 14px; line-height: 1.6; color: #334155; white-space: pre-wrap;">
<?php echo esc_html($app->message); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: Reply to Candidate via Email / SMTP -->
                <div style="flex: 1.3; min-width: 360px;">
                    <?php if ($app->status === 'replied' && !empty($app->reply_message)): ?>
                        <div class="postbox" style="padding: 20px; border-left: 4px solid #10b981;">
                            <h2 style="margin-top: 0; color: #10b981;">&check; Previous Email Sent to Candidate</h2>
                            <p style="color: #64748b; font-size: 13px;">Sent at: <?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($app->replied_at))); ?></p>
                            <p><strong>Subject:</strong> <?php echo esc_html($app->reply_subject); ?></p>
                            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px; font-size: 14px; line-height: 1.6; color: #166534; white-space: pre-wrap;">
<?php echo esc_html($app->reply_message); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="postbox" style="padding: 20px;">
                        <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                            Contact / Reply to Candidate via SMTP
                        </h2>

                        <form method="post" action="">
                            <?php wp_nonce_field('elpis_cv_reply_nonce'); ?>
                            <input type="hidden" name="app_id" value="<?php echo esc_attr($app->id); ?>">
                            <input type="hidden" name="reply_to_email" value="<?php echo esc_attr($app->email); ?>">
                            <input type="hidden" name="reply_to_name" value="<?php echo esc_attr($app->name); ?>">

                            <table class="form-table">
                                <tr>
                                    <th scope="row"><label for="reply_to_display">Candidate:</label></th>
                                    <td>
                                        <input type="text" id="reply_to_display" value="<?php echo esc_attr($app->name . ' <' . $app->email . '>'); ?>" class="regular-text" readonly style="background: #f1f5f9; width: 100%;">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="reply_subject">Subject:</label></th>
                                    <td>
                                        <input type="text" name="reply_subject" id="reply_subject" value="<?php echo esc_attr('Regarding your job application at ' . get_bloginfo('name')); ?>" class="regular-text" required style="width: 100%;">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="reply_message">Email Message:</label></th>
                                    <td>
                                        <textarea name="reply_message" id="reply_message" rows="8" class="large-text" required style="width: 100%; font-family: inherit; font-size: 14px; padding: 10px;" placeholder="Dear <?php echo esc_attr($app->name); ?>, Thank you for your application..."></textarea>
                                    </td>
                                </tr>
                            </table>

                            <p class="submit" style="margin-top: 15px;">
                                <button type="submit" name="elpis_send_cv_reply" class="button button-primary button-large" style="background: #b8860b; border-color: #996515; font-size: 14px; height: auto; padding: 8px 24px;">
                                    &rarr; Send Email to Candidate
                                </button>
                                <?php if (!empty(get_option('elpis_smtp_settings')['enabled'])): ?>
                                    <span style="color: #10b981; margin-left: 10px; font-size: 13px;">&check; SMTP Active</span>
                                <?php endif; ?>
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Embedded CV Document Preview Box -->
            <?php
            $file_ext = strtolower(pathinfo($app->file_name, PATHINFO_EXTENSION));
            ?>
            <div class="postbox" style="margin-top: 24px; padding: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; padding-bottom: 14px; border-bottom: 1px solid #eee;">
                    <div>
                        <h2 style="margin: 0 0 4px 0; font-size: 18px; color: #0f172a;">
                            &#128196; CV / Resume Document Preview
                        </h2>
                        <span style="color: #64748b; font-size: 13px;">
                            <strong><?php echo esc_html($app->file_name); ?></strong> 
                            <span style="background: #e2e8f0; color: #334155; padding: 2px 7px; border-radius: 4px; font-size: 11px; margin-left: 6px;"><?php echo strtoupper($file_ext); ?></span>
                            <span style="margin-left: 6px;">(<?php echo esc_html($app->file_size); ?>)</span>
                        </span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?php echo esc_url($app->file_url); ?>" target="_blank" class="button button-secondary" style="font-size: 13px; height: 34px; line-height: 32px;">
                            &#128065; Open in New Tab
                        </a>
                        <a href="<?php echo esc_url($app->file_url); ?>" download="<?php echo esc_attr($app->file_name); ?>" class="button button-primary" style="background: #b8860b; border-color: #996515; font-size: 13px; height: 34px; line-height: 32px;">
                            &#x2B73; Download CV File
                        </a>
                    </div>
                </div>

                <!-- Live Document Viewer Frame -->
                <div style="width: 100%; border-radius: 12px; overflow: hidden; border: 1px solid #cbd5e1; background: #f8fafc; min-height: 750px;">
                    <?php if ($file_ext === 'pdf'): ?>
                        <iframe src="<?php echo esc_url($app->file_url); ?>#toolbar=1" width="100%" height="800px" style="display: block; border: none; background: #525659;">
                            <p>Your browser does not support inline PDF viewing. Please <a href="<?php echo esc_url($app->file_url); ?>" target="_blank">click here to open the PDF</a> or <a href="<?php echo esc_url($app->file_url); ?>" download>download it</a>.</p>
                        </iframe>
                    <?php else: ?>
                        <!-- Word Document (DOC/DOCX) Viewer -->
                        <div style="padding: 20px; text-align: center;">
                            <div style="margin-bottom: 15px;">
                                <iframe src="https://docs.google.com/viewer?url=<?php echo urlencode($app->file_url); ?>&embedded=true" width="100%" height="650px" style="border: 1px solid #e2e8f0; border-radius: 8px;"></iframe>
                            </div>
                            <p style="color: #64748b; font-size: 13px; margin: 10px 0;">
                                Note: If previewing on localhost without a public domain, Word files (.docx) can be viewed by clicking 
                                <a href="<?php echo esc_url($app->file_url); ?>" target="_blank" class="button">Open in New Tab</a> or 
                                <a href="<?php echo esc_url($app->file_url); ?>" download="<?php echo esc_attr($app->file_name); ?>" class="button button-primary" style="background: #b8860b; border-color: #996515;">Download CV</a>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        return;
    }

    // Default: List All CV Submissions View
    $status_filter = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $search_query  = isset($_GET['s']) ? sanitize_text_field(trim($_GET['s'])) : '';

    $where = 'WHERE 1=1';
    if ($status_filter === 'unread') {
        $where .= " AND status = 'unread'";
    } elseif ($status_filter === 'replied') {
        $where .= " AND status = 'replied'";
    } elseif ($status_filter === 'reviewed') {
        $where .= " AND status = 'reviewed'";
    }

    if (!empty($search_query)) {
        $like = '%' . $wpdb->esc_like($search_query) . '%';
        $where .= $wpdb->prepare(" AND (name LIKE %s OR email LIKE %s OR phone LIKE %s OR position LIKE %s OR file_name LIKE %s)", $like, $like, $like, $like, $like);
    }

    $all_count      = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name}");
    $unread_count   = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'unread'");
    $reviewed_count = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'reviewed'");
    $replied_count  = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE status = 'replied'");

    $apps = $wpdb->get_results("SELECT * FROM {$table_name} {$where} ORDER BY created_at DESC LIMIT 100");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Job Applications & CV Submissions</h1>
        <hr class="wp-header-end">

        <!-- Navigation Tabs -->
        <ul class="subsubsub" style="margin-bottom: 15px;">
            <li><a href="?page=elpis-cv-submissions" class="<?php echo empty($status_filter) ? 'current' : ''; ?>">All <span class="count">(<?php echo $all_count; ?>)</span></a> |</li>
            <li><a href="?page=elpis-cv-submissions&status=unread" class="<?php echo ($status_filter === 'unread') ? 'current' : ''; ?>">Unread <span class="count">(<?php echo $unread_count; ?>)</span></a> |</li>
            <li><a href="?page=elpis-cv-submissions&status=reviewed" class="<?php echo ($status_filter === 'reviewed') ? 'current' : ''; ?>">Reviewed <span class="count">(<?php echo $reviewed_count; ?>)</span></a> |</li>
            <li><a href="?page=elpis-cv-submissions&status=replied" class="<?php echo ($status_filter === 'replied') ? 'current' : ''; ?>">Replied <span class="count">(<?php echo $replied_count; ?>)</span></a></li>
        </ul>

        <!-- Search Box -->
        <form method="get" action="" style="float: right; margin-bottom: 12px;">
            <input type="hidden" name="page" value="elpis-cv-submissions">
            <?php if (!empty($status_filter)): ?><input type="hidden" name="status" value="<?php echo esc_attr($status_filter); ?>"><?php endif; ?>
            <input type="search" name="s" value="<?php echo esc_attr($search_query); ?>" placeholder="Search candidate or position...">
            <button type="submit" class="button">Search</button>
        </form>

        <!-- Applications Table -->
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 150px;">Candidate Name</th>
                    <th style="width: 140px;">Position</th>
                    <th style="width: 160px;">Email</th>
                    <th style="width: 120px;">Phone</th>
                    <th>Attached CV</th>
                    <th style="width: 130px;">Date</th>
                    <th style="width: 170px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $a): ?>
                        <tr style="<?php echo ($a->status === 'unread') ? 'font-weight: 600; background: #fffbeb;' : ''; ?>">
                            <td>
                                <?php if ($a->status === 'unread'): ?>
                                    <span style="background: #ef4444; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">New</span>
                                <?php elseif ($a->status === 'replied'): ?>
                                    <span style="background: #10b981; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">Replied</span>
                                <?php else: ?>
                                    <span style="background: #3b82f6; color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 11px;">Reviewed</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo esc_html($a->name); ?></strong></td>
                            <td>
                                <span style="background: #f1f5f9; color: #334155; padding: 2px 6px; border-radius: 4px; font-size: 12px;">
                                    <?php echo !empty($a->position) ? esc_html($a->position) : 'General'; ?>
                                </span>
                            </td>
                            <td><a href="mailto:<?php echo esc_attr($a->email); ?>"><?php echo esc_html($a->email); ?></a></td>
                            <td><?php echo esc_html($a->phone ?: '—'); ?></td>
                            <td>
                                <a href="<?php echo esc_url($a->file_url); ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 4px; text-decoration: none; font-weight: 600; color: #0284c7;" title="Click to view file in browser">
                                    <span>&#128196;</span>
                                    <span><?php echo esc_html($a->file_name); ?></span>
                                    <span style="font-size: 11px; color: #64748b; font-weight: normal;">(<?php echo esc_html($a->file_size); ?>)</span>
                                </a>
                            </td>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html(date_i18n('M j, Y - g:i A', strtotime($a->created_at))); ?>
                            </td>
                            <td style="text-align: right;">
                                <a href="<?php echo esc_url($a->file_url); ?>" target="_blank" download class="button button-small" title="Direct Download">&#x2B73; Download</a>
                                <a href="?page=elpis-cv-submissions&action=view&id=<?php echo esc_attr($a->id); ?>" class="button button-small button-primary">View</a>
                                <a href="<?php echo esc_url(wp_nonce_url('?page=elpis-cv-submissions&action=delete&id=' . $a->id, 'elpis_delete_cv_' . $a->id)); ?>" class="button button-small" onclick="return confirm('Delete this candidate application permanently?');" style="color: #ef4444;">&times;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #64748b;">
                            No CV submissions found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
