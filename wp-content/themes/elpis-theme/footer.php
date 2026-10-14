<?php
// footer.php
$custom_logo_id = get_theme_mod('custom_logo');
$customizer_logo = get_theme_mod('site_logo_image');
$default_logo = get_template_directory_uri() . '/assets/images/elpis-logo.png';

$footer_logo_url = '';
if (!empty($customizer_logo)) {
    $footer_logo_url = $customizer_logo;
} elseif (!empty($custom_logo_id)) {
    $img_data = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($img_data) {
        $footer_logo_url = $img_data[0];
    }
} else {
    $footer_logo_url = $default_logo;
}

$footer_desc = get_theme_mod('footer_desc', 'Empowering organizations with cutting-edge enterprise software, cloud infrastructure, and modern digital transformation solutions.');
$footer_col2_title = get_theme_mod('footer_col2_title', 'IT Solutions & Links');
$footer_col3_title = get_theme_mod('footer_col3_title', 'Get in Touch');
$footer_address = get_theme_mod('footer_address', 'Dhaka, Bangladesh');
$footer_email = get_theme_mod('footer_email', 'info@elpisbd.com');
$footer_phone = get_theme_mod('footer_phone', '+880 1XXX-XXXXXX');
$footer_hours = get_theme_mod('footer_hours', 'Sun - Thu: 10:00 AM - 6:00 PM');
$footer_address_icon = get_theme_mod('footer_address_icon', '');
$footer_email_icon = get_theme_mod('footer_email_icon', '');
$footer_phone_icon = get_theme_mod('footer_phone_icon', '');
$footer_hours_icon = get_theme_mod('footer_hours_icon', '');
$footer_copyright_title = get_theme_mod('footer_copyright_title', 'ELPIS BD');
$footer_copyright_text = get_theme_mod('footer_copyright_text', 'All rights reserved.');
$logo_height = get_theme_mod('header_logo_height', '46');
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Column 1: Company Profile & Logo -->
            <div class="footer-col footer-col-about">
                <div class="footer-brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php if (!empty($footer_logo_url)) : ?>
                            <img src="<?php echo esc_url($footer_logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="site-footer-logo">
                        <?php else : ?>
                            <span class="brand-elpis">ELPIS</span> <span class="brand-bd">BD</span>
                        <?php endif; ?>
                    </a>
                </div>
                <?php if (!empty($footer_desc)) : ?>
                <p class="footer-desc">
                    <?php echo nl2br(esc_html($footer_desc)); ?>
                </p>
                <?php endif; ?>
            </div>

            <!-- Column 2: Quick Links & IT Solutions -->
            <div class="footer-col footer-col-links">
                <h4 class="footer-heading"><?php echo esc_html($footer_col2_title); ?></h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="chevron">&rsaquo;</span> Home</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about-us' ) ) ); ?>"><span class="chevron">&rsaquo;</span> About Us</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'services' ) ) ); ?>"><span class="chevron">&rsaquo;</span> Enterprise Services</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'careers' ) ) ); ?>"><span class="chevron">&rsaquo;</span> Career Opportunities</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact-us' ) ) ); ?>"><span class="chevron">&rsaquo;</span> Contact & Support</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact & Office Info -->
            <div class="footer-col footer-col-contact">
                <h4 class="footer-heading"><?php echo esc_html($footer_col3_title); ?></h4>
                <ul class="footer-contact-info">
                    <?php if (!empty($footer_address)) : ?>
                    <li>
                        <span class="contact-icon" aria-hidden="true">
                            <?php if (!empty($footer_address_icon)) : ?>
                                <img src="<?php echo esc_url($footer_address_icon); ?>" alt="Address Icon">
                            <?php else : ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            <?php endif; ?>
                        </span>
                        <div class="contact-text">
                            <strong>Head Office:</strong>
                            <span><?php echo esc_html($footer_address); ?></span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if (!empty($footer_email)) : ?>
                    <li>
                        <span class="contact-icon" aria-hidden="true">
                            <?php if (!empty($footer_email_icon)) : ?>
                                <img src="<?php echo esc_url($footer_email_icon); ?>" alt="Email Icon">
                            <?php else : ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            <?php endif; ?>
                        </span>
                        <div class="contact-text">
                            <strong>Email:</strong>
                            <a href="mailto:<?php echo esc_attr($footer_email); ?>"><?php echo esc_html($footer_email); ?></a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if (!empty($footer_phone)) : ?>
                    <li>
                        <span class="contact-icon" aria-hidden="true">
                            <?php if (!empty($footer_phone_icon)) : ?>
                                <img src="<?php echo esc_url($footer_phone_icon); ?>" alt="Phone Icon">
                            <?php else : ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            <?php endif; ?>
                        </span>
                        <div class="contact-text">
                            <strong>Support Hotline:</strong>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $footer_phone)); ?>"><?php echo esc_html($footer_phone); ?></a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if (!empty($footer_hours)) : ?>
                    <li>
                        <span class="contact-icon" aria-hidden="true">
                            <?php if (!empty($footer_hours_icon)) : ?>
                                <img src="<?php echo esc_url($footer_hours_icon); ?>" alt="Hours Icon">
                            <?php else : ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            <?php endif; ?>
                        </span>
                        <div class="contact-text">
                            <strong>Working Hours:</strong>
                            <span><?php echo esc_html($footer_hours); ?></span>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date('Y'); ?> <strong class="footer-brand-highlight"><?php echo esc_html($footer_copyright_title); ?></strong>. <?php echo esc_html($footer_copyright_text); ?></p>
            </div>
        </div>
    </div>
</footer>

<style>
/* Modern Dynamic IT Footer Styles */
.site-footer {
    background: #090e1a;
    color: #94a3b8;
    padding: 3rem 0 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    font-size: 0.95rem;
}

.site-footer a {
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.25s ease;
}

.site-footer a:hover {
    color: var(--brand-color, #b8860b);
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.3fr 1fr 1.2fr;
    gap: 2.5rem;
    margin-bottom: 2rem;
    text-align: left;
}

/* Col 1 Brand Logo */
.footer-brand a {
    text-decoration: none;
    display: inline-block;
    margin-bottom: 0.9rem;
    transition: opacity 0.25s ease;
}

.footer-brand a:hover {
    opacity: 0.92;
}

.site-footer-logo {
    height: <?php echo esc_attr(is_numeric($logo_height) ? $logo_height . 'px' : '45px'); ?>;
    max-height: 55px;
    width: auto;
    object-fit: contain;
    display: block;
}

.brand-elpis {
    color: var(--brand-color, #b8860b);
    font-size: 1.75rem;
    font-weight: 800;
    letter-spacing: 0.5px;
}

.brand-bd {
    color: #e2e8f0;
    font-size: 1.75rem;
    font-weight: 800;
}

.footer-desc {
    color: #94a3b8;
    line-height: 1.6;
    margin-bottom: 1.2rem;
    font-size: 0.92rem;
}

/* Headings */
.footer-heading {
    color: #ffffff;
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    padding-bottom: 0.5rem;
    letter-spacing: 0.3px;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 35px;
    height: 3px;
    background: var(--brand-color, #b8860b);
    border-radius: 2px;
}

/* Links List */
.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-list li {
    margin-bottom: 0.55rem;
}

.footer-links-list a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #94a3b8;
    transition: transform 0.2s ease, color 0.2s ease;
}

.footer-links-list a .chevron {
    color: var(--brand-color, #b8860b);
    font-size: 1.3rem;
    line-height: 1;
    transition: transform 0.2s ease;
}

.footer-links-list a:hover {
    color: var(--brand-color, #b8860b);
    transform: translateX(5px);
}

.footer-links-list a:hover .chevron {
    transform: translateX(3px);
}

/* Contact List */
.footer-contact-info {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-contact-info li {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 0.85rem;
    line-height: 1.45;
}

.contact-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    min-width: 32px;
    background: rgba(184, 134, 11, 0.12);
    border: 1px solid rgba(184, 134, 11, 0.28);
    border-radius: 8px;
    color: var(--brand-color, #b8860b);
    flex-shrink: 0;
    transition: all 0.25s ease;
}

.footer-contact-info li:hover .contact-icon {
    background: rgba(184, 134, 11, 0.22);
    border-color: var(--brand-color, #b8860b);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(184, 134, 11, 0.25);
}

.contact-icon svg {
    width: 16px;
    height: 16px;
    stroke: var(--brand-color, #b8860b);
    display: block;
}

.contact-icon img {
    width: 18px;
    height: 18px;
    object-fit: contain;
    display: block;
}

.contact-text strong {
    display: block;
    color: #cbd5e1;
    font-size: 0.82rem;
    font-weight: 600;
    margin-bottom: 1px;
}

.contact-text span,
.contact-text a {
    color: #94a3b8;
    font-size: 0.9rem;
}

.contact-text a:hover {
    color: var(--brand-color, #b8860b);
}

/* Bottom Bar */
.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 1.25rem;
    margin-top: 0.5rem;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
    font-size: 0.88rem;
    color: #64748b;
}

.footer-bottom-content strong,
.footer-brand-highlight {
    color: var(--brand-color, #b8860b) !important;
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* Responsive */
@media screen and (max-width: 992px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    .footer-col-about {
        grid-column: span 2;
    }
}

@media screen and (max-width: 640px) {
    .site-footer {
        padding: 2.25rem 0 1.25rem;
    }
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 1.75rem;
        margin-bottom: 1.5rem;
    }
    .footer-col-about {
        grid-column: span 1;
    }
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?php wp_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const closeMenu = document.querySelector('.close-menu');
    const mainNavigation = document.querySelector('.main-navigation');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const menuLinks = document.querySelectorAll('.main-navigation a');

    function toggleMenu() {
        mainNavigation.classList.toggle('active');
        overlay.classList.toggle('active');
        // Prevent body scrolling when menu is open
        document.body.style.overflow = mainNavigation.classList.contains('active') ? 'hidden' : '';
    }

    if(menuToggle) menuToggle.addEventListener('click', toggleMenu);
    if(closeMenu) closeMenu.addEventListener('click', toggleMenu);
    if(overlay) overlay.addEventListener('click', toggleMenu);
    
    // Close menu when a link is clicked
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (mainNavigation.classList.contains('active')) {
                toggleMenu();
            }
        });
    });
});
</script>
</body>
</html>
