<?php
/*
Template Name: Contact Us Page
*/
get_header(); 
$contact_phone   = get_theme_mod('contact_phone', '[Add Phone Number]');
$contact_email   = get_theme_mod('contact_email', '[Add Email Address]');
$contact_address = get_theme_mod('contact_address', '[Add Your Address]');
?>
<main>
    <section id="contact" class="contact-section-enterprise">
        <!-- Ambient Decorative Glow Background Orbs & Grid -->
        <div class="contact-ambient-orb orb-1"></div>
        <div class="contact-ambient-orb orb-2"></div>
        <div class="contact-grid-pattern"></div>

        <div class="container contact-main-container">
            <!-- Header Area -->
            <div class="contact-header-area">
                <div class="contact-badge-wrap">
                    <span class="contact-pulse-dot"></span>
                    <h2 class="section-title contact-badge-title">CONTACT US</h2>
                </div>
            </div>

            <!-- 2-Column Split: Info Card (Left) & Modern Form Card (Right) -->
            <div class="contact-content-grid">
                <!-- Left Column: Contact Channels & Office Info -->
                <div class="contact-info-col">
                    <div class="contact-card contact-info-card">
                        <div class="contact-card-accent-bar"></div>
                        <h3 class="contact-info-title">Get in Touch</h3>
                        
                        <div class="contact-channels-list">
                            <!-- Call Us -->
                            <div class="contact-channel-item">
                                <div class="channel-icon-wrap">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <div class="channel-text-wrap">
                                    <p class="channel-label"><strong>Call Us:</strong></p>
                                    <p class="channel-value"><a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '')); ?>"><?php echo esc_html($contact_phone); ?></a></p>
                                </div>
                            </div>

                            <!-- Email Us -->
                            <div class="contact-channel-item">
                                <div class="channel-icon-wrap">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </div>
                                <div class="channel-text-wrap">
                                    <p class="channel-label"><strong>Email Us:</strong></p>
                                    <p class="channel-value"><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', '')); ?>"><?php echo esc_html($contact_email); ?></a></p>
                                </div>
                            </div>

                            <!-- Our Address -->
                            <div class="contact-channel-item">
                                <div class="channel-icon-wrap">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="channel-text-wrap">
                                    <p class="channel-label"><strong>Our Address:</strong></p>
                                    <p class="channel-value address-val"><?php echo nl2br(esc_html($contact_address)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Form Card (Photo Design) -->
                <div class="contact-form-col">
                    <div class="contact-card contact-form-card">
                        <!-- Submission Notification Box -->
                        <div id="contact-alert-box" class="contact-alert-banner" style="display: none;"></div>

                        <?php if (isset($_GET['contact_status']) && $_GET['contact_status'] === 'success'): ?>
                            <div class="contact-alert-banner is-success">
                                &check; Thank you! Your message has been sent successfully.
                            </div>
                        <?php endif; ?>

                        <form id="elpis-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="contact-enterprise-form">
                            <input type="hidden" name="action" value="elpis_contact_submit">
                            <?php wp_nonce_field('elpis_contact_action', 'elpis_contact_nonce'); ?>

                            <!-- Type Name -->
                            <div class="form-input-group">
                                <input type="text" name="contact_name" placeholder="Type Name" required class="contact-form-input">
                            </div>

                            <!-- Company Name -->
                            <div class="form-input-group">
                                <input type="text" name="contact_company" placeholder="Company Name" class="contact-form-input">
                            </div>

                            <!-- Phone Number -->
                            <div class="form-input-group">
                                <input type="tel" name="contact_phone" placeholder="Phone Number" class="contact-form-input">
                            </div>

                            <!-- Email Address (Essential for direct reply via SMTP) -->
                            <div class="form-input-group">
                                <input type="email" name="contact_email" placeholder="Email Address" required class="contact-form-input">
                            </div>

                            <!-- Your message -->
                            <div class="form-input-group">
                                <textarea name="contact_message" placeholder="Your message" rows="4" required class="contact-form-textarea"></textarea>
                            </div>

                            <!-- Send Button -->
                            <button type="submit" id="contact-submit-btn" class="contact-send-btn">
                                <span class="btn-text">Send</span>
                                <span class="btn-loader" style="display: none;">
                                    <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                                        <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Modern Enterprise Contact Page Styling & Animations */
    .contact-section-enterprise {
        position: relative;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
        padding: 80px 0 110px;
        overflow: hidden;
        min-height: calc(100vh - 200px);
    }

    /* Ambient Lighting Mesh */
    .contact-ambient-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(95px);
        pointer-events: none;
        z-index: 1;
        opacity: 0.45;
        animation: orbFloat 10s ease-in-out infinite alternate;
    }
    .orb-1 {
        width: 480px;
        height: 480px;
        top: -80px;
        left: -100px;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.28) 0%, rgba(184, 134, 11, 0) 70%);
    }
    .orb-2 {
        width: 520px;
        height: 520px;
        bottom: -120px;
        right: -100px;
        background: radial-gradient(circle, rgba(15, 23, 42, 0.18) 0%, rgba(15, 23, 42, 0) 70%);
        animation-delay: -5s;
    }
    .contact-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(15, 23, 42, 0.06) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 1;
        opacity: 0.6;
    }

    .contact-main-container {
        position: relative;
        z-index: 2;
        width: 100%;
    }

    /* Header Area */
    .contact-header-area {
        text-align: center;
        margin-bottom: 3.5rem;
        animation: contactFadeInUp 0.8s ease-out both;
    }
    .contact-badge-wrap {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.45rem 1.4rem;
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(184, 134, 11, 0.25);
        border-radius: 9999px;
        box-shadow: 0 4px 15px -2px rgba(184, 134, 11, 0.12);
        backdrop-filter: blur(8px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .contact-badge-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -2px rgba(184, 134, 11, 0.2);
    }
    .contact-pulse-dot {
        width: 8px;
        height: 8px;
        background: var(--secondary-color, #b8860b);
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(184, 134, 11, 0.7);
        animation: pulseDot 2s infinite;
    }
    .contact-badge-title {
        font-size: 1rem !important;
        font-weight: 700 !important;
        letter-spacing: 2px !important;
        color: var(--secondary-color, #b8860b) !important;
        margin: 0 !important;
        text-transform: uppercase;
        border: none !important;
    }

    /* 2-Column Split Content Grid */
    .contact-content-grid {
        display: flex;
        align-items: stretch;
        justify-content: center;
        gap: 3.5rem;
        max-width: 1100px;
        margin: 0 auto;
    }
    .contact-info-col {
        flex: 1;
        min-width: 320px;
        max-width: 440px;
        animation: contactFadeInUp 0.9s 0.15s ease-out both;
    }
    .contact-form-col {
        flex: 1.25;
        min-width: 320px;
        max-width: 580px;
        animation: contactFadeInUp 0.9s 0.3s ease-out both;
    }

    /* Common Card Styling */
    .contact-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.03);
        height: 100%;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.35s ease;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 28px 55px -12px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(184, 134, 11, 0.2);
        border-color: rgba(184, 134, 11, 0.25);
    }

    /* Left Column Info Card */
    .contact-info-card {
        position: relative;
        padding: 3rem 2.5rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .contact-card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, var(--secondary-color, #b8860b) 0%, rgba(184, 134, 11, 0.3) 100%);
    }
    .contact-info-title {
        font-size: 2.15rem;
        font-weight: 800;
        color: var(--primary-color, #0f172a);
        margin: 0 0 2rem 0;
        letter-spacing: -0.5px;
    }
    .contact-channels-list {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }
    .contact-channel-item {
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
    }
    .channel-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(184, 134, 11, 0.12);
        color: var(--secondary-color, #b8860b);
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(184, 134, 11, 0.1);
        transition: transform 0.3s ease;
    }
    .contact-channel-item:hover .channel-icon-wrap {
        transform: scale(1.08) rotate(3deg);
    }
    .channel-text-wrap {
        flex: 1;
    }
    .channel-label {
        font-size: 1.05rem;
        color: var(--primary-color, #0f172a);
        margin: 0 0 0.25rem 0;
    }
    .channel-value {
        font-size: 1.08rem;
        color: var(--secondary-color, #b8860b);
        margin: 0;
        line-height: 1.6;
    }
    .channel-value a {
        color: var(--secondary-color, #b8860b);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .channel-value a:hover {
        color: #996515;
        text-decoration: underline;
    }
    .address-val {
        color: #475569 !important;
    }

    /* Right Column: Form Card Matching Image */
    .contact-form-card {
        padding: 3rem 2.75rem;
    }
    .contact-enterprise-form {
        display: flex;
        flex-direction: column;
        gap: 1.15rem;
    }
    .form-input-group {
        width: 100%;
    }
    .contact-form-input,
    .contact-form-textarea {
        width: 100%;
        padding: 1.05rem 1.25rem;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        font-family: inherit;
        font-size: 1.05rem;
        color: #1e293b;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
    }
    .contact-form-input::placeholder,
    .contact-form-textarea::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    .contact-form-input:focus,
    .contact-form-textarea:focus {
        outline: none;
        border-color: var(--secondary-color, #b8860b);
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.15);
        background: #ffffff;
    }
    .contact-form-textarea {
        resize: vertical;
        min-height: 125px;
    }

    /* Send Button */
    .contact-send-btn {
        position: relative;
        width: 100%;
        padding: 1.05rem 2rem;
        background: linear-gradient(135deg, var(--secondary-color, #b8860b) 0%, #996515 100%);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-family: inherit;
        font-size: 1.15rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        box-shadow: 0 8px 20px -4px rgba(184, 134, 11, 0.45);
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .contact-send-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }
    .contact-send-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px -4px rgba(184, 134, 11, 0.55);
    }
    .contact-send-btn:hover::before {
        left: 100%;
    }
    .contact-send-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Notification Alerts */
    .contact-alert-banner {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        font-size: 0.98rem;
        line-height: 1.5;
        margin-bottom: 1.25rem;
        animation: contactFadeInUp 0.4s ease-out both;
    }
    .contact-alert-banner.is-success {
        background: #f0fdf4;
        border: 1px solid #86efac;
        color: #166534;
    }
    .contact-alert-banner.is-error {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }

    /* Keyframe Animations */
    @keyframes contactFadeInUp {
        0% {
            opacity: 0;
            transform: translateY(24px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes orbFloat {
        0% {
            transform: translate(0, 0) scale(1);
        }
        100% {
            transform: translate(-30px, 30px) scale(1.08);
        }
    }
    @keyframes pulseDot {
        0% {
            box-shadow: 0 0 0 0 rgba(184, 134, 11, 0.7);
        }
        70% {
            box-shadow: 0 0 0 8px rgba(184, 134, 11, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(184, 134, 11, 0);
        }
    }
    .spinner {
        animation: rotateSpinner 1s linear infinite;
    }
    @keyframes rotateSpinner {
        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive */
    @media screen and (max-width: 900px) {
        .contact-content-grid {
            flex-direction: column;
            gap: 2.5rem;
        }
        .contact-info-col,
        .contact-form-col {
            max-width: 100%;
        }
        .contact-info-card,
        .contact-form-card {
            padding: 2.25rem 1.75rem;
        }
    }
    </style>

    <!-- AJAX Submission Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('elpis-contact-form');
        const submitBtn = document.getElementById('contact-submit-btn');
        const alertBox = document.getElementById('contact-alert-box');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoader = submitBtn.querySelector('.btn-loader');

        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear alerts
                alertBox.style.display = 'none';
                alertBox.className = 'contact-alert-banner';

                // Loading state
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline-block';

                const formData = new FormData(form);
                formData.set('action', 'elpis_contact_submit');

                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline-block';
                    btnLoader.style.display = 'none';

                    if (data.success) {
                        alertBox.className = 'contact-alert-banner is-success';
                        alertBox.innerHTML = '&check; ' + (data.data.message || 'Message sent successfully!');
                        alertBox.style.display = 'block';
                        form.reset();
                    } else {
                        alertBox.className = 'contact-alert-banner is-error';
                        alertBox.innerHTML = '&#9888; ' + (data.data.message || 'Something went wrong. Please try again.');
                        alertBox.style.display = 'block';
                    }
                })
                .catch(err => {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline-block';
                    btnLoader.style.display = 'none';

                    alertBox.className = 'contact-alert-banner is-error';
                    alertBox.innerHTML = '&#9888; Network error. Please try again later.';
                    alertBox.style.display = 'block';
                });
            });
        }
    });
    </script>
</main>
<?php get_footer(); ?>
