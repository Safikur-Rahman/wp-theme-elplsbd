<?php
// header.php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELPIS BD - Enterprise Software Solutions</title>
    <?php wp_head(); ?>
    <style>
        <?php 
            // Helper function to handle px vs auto
            function elpis_size($val) {
                return (is_numeric($val) && $val != '0') ? $val . 'px' : $val;
            }
            $brand_color = get_theme_mod('theme_brand_color', '#b8860b');
        ?>
        :root {
            --brand-color: <?php echo esc_attr($brand_color); ?>;
            --secondary-color: <?php echo esc_attr($brand_color); ?>;
        }
        a { color: var(--secondary-color); }
        .hero-image { max-width: <?php echo esc_attr(elpis_size(get_theme_mod('hero_img_max_width', '500'))); ?> !important; max-height: <?php echo esc_attr(elpis_size(get_theme_mod('hero_img_height', 'auto'))); ?> !important; }
        .service-detail img { max-width: <?php echo esc_attr(elpis_size(get_theme_mod('service_img_max_width', '500'))); ?> !important; height: <?php echo esc_attr(elpis_size(get_theme_mod('service_img_height', 'auto'))); ?> !important; }
        .offer-image { max-width: <?php echo esc_attr(get_theme_mod('offer_img_max_width', '100')) . '%'; ?> !important; height: <?php echo esc_attr(elpis_size(get_theme_mod('offer_img_height', 'auto'))); ?> !important; }
        .service-image.leader-img { width: <?php echo esc_attr(elpis_size(get_theme_mod('leader_img_width', '200'))); ?> !important; height: <?php echo esc_attr(elpis_size(get_theme_mod('leader_img_height', '300'))); ?> !important; }
        #careers .hero-image { max-width: <?php echo esc_attr(elpis_size(get_theme_mod('careers_img_max_width', '900'))); ?> !important; max-height: <?php echo esc_attr(elpis_size(get_theme_mod('careers_img_height', 'auto'))); ?> !important; }
    </style>
</head>
<body <?php body_class(); ?>>
<?php
$custom_logo_id = get_theme_mod('custom_logo');
$customizer_logo = get_theme_mod('site_logo_image');
$default_logo = get_template_directory_uri() . '/assets/images/elpis-logo.png';

$logo_url = '';
if (!empty($customizer_logo)) {
    $logo_url = $customizer_logo;
} elseif (!empty($custom_logo_id)) {
    $img_data = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($img_data) {
        $logo_url = $img_data[0];
    }
} else {
    $logo_url = $default_logo;
}
$logo_height = get_theme_mod('header_logo_height', '46');
?>
<header class="site-header">
    <div class="container header-container">
        <style>
            /* Modern Gorgeous IT Header */
            .site-header {
                background: rgba(9, 14, 26, 0.96) !important;
                backdrop-filter: blur(14px) !important;
                -webkit-backdrop-filter: blur(14px) !important;
                position: sticky;
                top: 0;
                z-index: 1000;
                border-top: none !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5) !important;
                padding: 0.75rem 0 !important;
                transition: all 0.3s ease;
            }

            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* Brand Logo */
            .brand-link {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                transition: transform 0.25s ease, opacity 0.25s ease;
            }

            .brand-link:hover {
                transform: scale(1.02);
                opacity: 0.95;
            }

            .site-header-logo {
                height: <?php echo esc_attr(is_numeric($logo_height) ? $logo_height . 'px' : $logo_height); ?>;
                max-height: 65px;
                width: auto;
                object-fit: contain;
                display: block;
                transition: height 0.3s ease;
            }

            .brand-text {
                font-size: 1.55rem;
                font-weight: 800;
                letter-spacing: 0.5px;
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .brand-elpis {
                color: var(--brand-color);
                text-shadow: 0 0 20px rgba(184, 134, 11, 0.3);
            }

            .brand-bd {
                color: #e2e8f0;
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            }

            /* Nav Wrap */
            .header-nav-wrap {
                display: flex;
                align-items: center;
                gap: 1.8rem;
            }

            /* Navigation Links */
            .main-navigation ul {
                display: flex;
                align-items: center;
                gap: 2rem;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .main-navigation a {
                color: #e2e8f0 !important;
                font-weight: 500;
                font-size: 0.98rem;
                text-decoration: none;
                position: relative;
                padding: 6px 2px;
                transition: color 0.25s ease;
                display: inline-block;
            }

            .main-navigation a::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--brand-color);
                border-radius: 2px;
                transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .main-navigation a:hover {
                color: var(--brand-color) !important;
            }

            .main-navigation a:hover::after {
                width: 100%;
            }

            .main-navigation .current-menu-item > a,
            .main-navigation .current_page_item > a {
                color: var(--brand-color) !important;
                font-weight: 600;
            }

            .main-navigation .current-menu-item > a::after,
            .main-navigation .current_page_item > a::after {
                width: 100%;
            }

            /* Mobile Toggle */
            .menu-toggle {
                background: none;
                border: none;
                cursor: pointer;
                padding: 6px;
                z-index: 1001;
            }

            .menu-toggle .bar {
                background-color: #ffffff !important;
                width: 24px;
                height: 2px;
                margin: 5px auto;
                border-radius: 2px;
                transition: all 0.3s ease;
            }

            .close-menu {
                color: #ffffff !important;
                font-size: 2rem;
            }

            @media screen and (max-width: 1024px) {
                .main-navigation {
                    background: #090e1a !important;
                    border-left: 1px solid rgba(255, 255, 255, 0.08);
                    box-shadow: -10px 0 30px rgba(0, 0, 0, 0.7) !important;
                }
                .main-navigation ul {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1.5rem;
                }
                .main-navigation a {
                    font-size: 1.15rem;
                }
            }
        </style>

        <div class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link" rel="home">
                <?php if (!empty($logo_url)) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="site-header-logo">
                <?php else : ?>
                    <span class="brand-text">
                        <span class="brand-elpis">ELPIS</span> <span class="brand-bd">BD</span>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        
        <div class="header-nav-wrap">
            <nav class="main-navigation">
                <button class="close-menu" aria-label="Close Menu">&times;</button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => function() {
                        ?>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about-us' ) ) ); ?>">About Us</a></li>
                            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'services' ) ) ); ?>">Services</a></li>
                            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'careers' ) ) ); ?>">Careers</a></li>
                            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact-us' ) ) ); ?>">Contact</a></li>
                        </ul>
                        <?php
                    }
                ));
                ?>
            </nav>

            <button class="menu-toggle" aria-label="Toggle Menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
        <div class="mobile-menu-overlay"></div>
    </div>
</header>
