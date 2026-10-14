<?php
/*
Template Name: Services Page
*/
get_header();

// Services Page Customizer Settings
$sp_header_layout   = get_theme_mod('services_page_header_layout', 'boxed');
$sp_header_bg       = get_theme_mod('services_page_header_bg', '#ffffff');
$sp_items_layout    = get_theme_mod('services_page_items_layout', 'boxed');

if (!function_exists('elpis_resolve_sp_layout')) {
    function elpis_resolve_sp_layout($item_layout, $default_layout) {
        if (empty($item_layout) || $item_layout === 'global') {
            return $default_layout;
        }
        return $item_layout;
    }
}

$s1_layout = elpis_resolve_sp_layout(get_theme_mod('services_page_service_1_layout', 'global'), $sp_items_layout);
$s1_bg     = get_theme_mod('services_page_service_1_bg', '#ffffff');
$s1_img    = get_theme_mod('services_page_service_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/programming_2svr.svg');

$s2_layout = elpis_resolve_sp_layout(get_theme_mod('services_page_service_2_layout', 'global'), $sp_items_layout);
$s2_bg     = get_theme_mod('services_page_service_2_bg', '#f8fafc');
$s2_img    = get_theme_mod('services_page_service_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_devices_xw3m.svg');

$s3_layout = elpis_resolve_sp_layout(get_theme_mod('services_page_service_3_layout', 'global'), $sp_items_layout);
$s3_bg     = get_theme_mod('services_page_service_3_bg', '#ffffff');
$s3_img    = get_theme_mod('services_page_service_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/mobile_development_8ygq.svg');

$s4_layout = elpis_resolve_sp_layout(get_theme_mod('services_page_service_4_layout', 'global'), $sp_items_layout);
$s4_bg     = get_theme_mod('services_page_service_4_bg', '#f8fafc');
$s4_img    = get_theme_mod('services_page_service_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/social_media_marketing_twnp.svg');

$s5_layout = elpis_resolve_sp_layout(get_theme_mod('services_page_service_5_layout', 'global'), $sp_items_layout);
$s5_bg     = get_theme_mod('services_page_service_5_bg', '#ffffff');
$s5_img    = get_theme_mod('services_page_service_5_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/quality_assurance_7fny.svg');
?>
<main>
    <style>
    /* Enterprise Services Page Styling & Micro-Animations */
    .services-page-area {
        position: relative;
        padding: 40px 0 80px;
        overflow: hidden;
    }

    /* Ambient Decorative Glow Orbs */
    .sp-ambient-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.45;
    }
    .sp-ambient-orb.orb-1 {
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.18) 0%, rgba(184, 134, 11, 0) 70%);
        top: 3%;
        right: -8%;
        animation: spPulseGlow 10s ease-in-out infinite alternate;
    }
    .sp-ambient-orb.orb-2 {
        width: 520px;
        height: 520px;
        background: radial-gradient(circle, rgba(15, 23, 42, 0.12) 0%, rgba(15, 23, 42, 0) 70%);
        bottom: 8%;
        left: -8%;
        animation: spPulseGlow 12s ease-in-out infinite alternate-reverse;
    }

    @keyframes spPulseGlow {
        0% { transform: scale(0.9) translate(0, 0); opacity: 0.35; }
        100% { transform: scale(1.15) translate(30px, -20px); opacity: 0.55; }
    }

    /* Header Section Layouts */
    .sp-header-row.layout-fullwidth {
        width: 100%;
        background-color: var(--row-bg);
        padding: 4.5rem 0 3.5rem;
        transition: background 0.3s ease;
        position: relative;
        z-index: 1;
    }
    .sp-header-row.layout-fullwidth .sp-header-inner {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }

    .sp-header-row.layout-boxed {
        width: 100%;
        background: transparent;
        padding: 1.5rem 0 2rem;
        position: relative;
        z-index: 1;
    }
    .sp-header-row.layout-boxed .sp-header-inner {
        background-color: var(--row-bg);
        padding: 2.75rem 2rem;
        border-radius: 24px;
        text-align: center;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: background 0.3s ease, transform 0.3s ease;
    }

    /* Modern Enterprise Badge & Header Title */
    .sp-header-inner {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .sp-badge-wrap {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(184, 134, 11, 0.08);
        border: 1px solid rgba(184, 134, 11, 0.28);
        padding: 8px 24px;
        border-radius: 9999px;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 15px -3px rgba(184, 134, 11, 0.12);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .sp-badge-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px -3px rgba(184, 134, 11, 0.22);
        background: rgba(184, 134, 11, 0.12);
    }
    .sp-pulse-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background-color: #b8860b;
        position: relative;
        display: inline-block;
    }
    .sp-pulse-dot::after {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border-radius: 50%;
        background: rgba(184, 134, 11, 0.45);
        animation: spPulseDot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes spPulseDot {
        0%, 100% { transform: scale(1); opacity: 0.85; }
        50% { transform: scale(2.2); opacity: 0; }
    }
    .sp-badge-wrap .section-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #b8860b;
        text-transform: uppercase;
        font-family: 'Outfit', sans-serif;
    }

    /* Service Rows & Cards Layout */
    .sp-service-row.layout-fullwidth {
        width: 100%;
        background-color: var(--row-bg);
        padding: 5rem 0;
        transition: background 0.3s ease;
        position: relative;
        z-index: 1;
    }
    .sp-service-row.layout-fullwidth .sp-service-inner {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }

    .sp-service-row.layout-boxed {
        width: 100%;
        background: transparent;
        padding: 1.75rem 0;
        position: relative;
        z-index: 1;
    }
    .sp-service-row.layout-boxed .sp-service-inner {
        background-color: var(--row-bg);
        padding: 4.25rem 3.5rem;
        border-radius: 28px;
        box-shadow: 0 15px 40px -15px rgba(0, 0, 0, 0.05), 0 0 1px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, background 0.3s ease;
    }
    .sp-service-row.layout-boxed:hover .sp-service-inner {
        transform: translateY(-4px);
        box-shadow: 0 25px 50px -20px rgba(0, 0, 0, 0.1), 0 0 1px rgba(0, 0, 0, 0.12);
    }

    /* Enterprise Grid */
    .service-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 4rem;
        align-items: center;
    }
    .service-detail.row-reverse {
        flex-direction: row-reverse;
    }

    .sp-visual-col {
        flex: 1;
        min-width: 320px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .sp-image-card {
        position: relative;
        width: 100%;
        max-width: 500px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .sp-image-halo {
        position: absolute;
        width: 85%;
        height: 85%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.14) 0%, rgba(15, 23, 42, 0) 70%);
        filter: blur(40px);
        z-index: 0;
        pointer-events: none;
        transition: opacity 0.4s ease;
    }
    .service-detail img {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 460px;
        height: auto;
        object-fit: contain;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.08));
        animation: spFloating 6s ease-in-out infinite;
    }
    .service-detail.row-reverse img {
        animation-delay: -3s;
    }
    .sp-image-card:hover img {
        transform: translateY(-8px) scale(1.03);
    }

    @keyframes spFloating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* Content Column */
    .sp-info-col {
        flex: 1.2;
        min-width: 320px;
    }
    .sp-service-title {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.85rem, 2.5vw, 2.35rem);
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 1.25rem;
        letter-spacing: -0.02em;
        position: relative;
    }
    .sp-service-desc {
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 1.75rem;
    }
    .sp-service-subtitle {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .sp-service-subtitle::before {
        content: '';
        display: inline-block;
        width: 14px;
        height: 3px;
        background: var(--secondary-color, #b8860b);
        border-radius: 2px;
    }

    /* Enterprise Feature List */
    .sp-feature-list {
        list-style: none;
        padding-left: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }
    .sp-feature-list li {
        position: relative;
        padding-left: 1.85rem;
        line-height: 1.7;
        font-size: 0.98rem;
        transition: transform 0.25s ease, color 0.25s ease;
    }
    .sp-feature-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.55rem;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #b8860b;
        box-shadow: 0 0 0 3px rgba(184, 134, 11, 0.2);
        transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    }
    .sp-feature-list li:hover {
        transform: translateX(4px);
    }
    .sp-feature-list li:hover::before {
        transform: scale(1.3);
        background: var(--secondary-color, #b8860b);
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.35);
    }

    /* Smart Contrast Engine for Dynamic Light/Dark Customizer Colors */
    .is-dark .sp-service-title {
        color: #ffffff !important;
    }
    .is-dark .sp-service-subtitle {
        color: #fbbf24 !important;
    }
    .is-dark .sp-service-desc {
        color: #cbd5e1 !important;
    }
    .is-dark .sp-feature-list li {
        color: #cbd5e1 !important;
    }
    .is-dark .sp-feature-list li strong {
        color: #ffffff !important;
    }
    .is-dark .sp-image-card {
        background: rgba(255, 255, 255, 0.03);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }
    .is-dark.sp-service-inner {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }

    .is-light .sp-service-title {
        color: var(--primary-color, #0f172a) !important;
    }
    .is-light .sp-service-subtitle {
        color: var(--secondary-color, #b8860b) !important;
    }
    .is-light .sp-service-desc {
        color: var(--text-color, #334155) !important;
    }
    .is-light .sp-feature-list li {
        color: #334155 !important;
    }
    .is-light .sp-feature-list li strong {
        color: var(--primary-color, #0f172a) !important;
    }
    .is-light .sp-image-card {
        background: transparent;
        padding: 1rem;
    }

    /* Scroll Reveal Animation Styles */
    .sp-scroll-reveal {
        opacity: 0;
        transform: translateY(35px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }
    .sp-scroll-reveal.sp-revealed {
        opacity: 1;
        transform: translateY(0);
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .sp-ambient-orb,
        .service-detail img,
        .sp-scroll-reveal {
            animation: none !important;
            transition: none !important;
            transform: none !important;
            opacity: 1 !important;
        }
    }

    /* Tablet & Mobile Layout: Order -> Title, then Image, then Content */
    @media screen and (max-width: 991px) {
        .service-detail {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            align-items: stretch;
        }
        .service-detail.row-reverse {
            flex-direction: column;
        }
        .sp-info-col {
            display: contents;
        }
        .sp-service-title {
            order: 1;
            width: 100%;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .sp-visual-col {
            order: 2;
            width: 100%;
            min-width: auto;
            margin: 0.5rem 0 1.25rem;
            display: flex;
            justify-content: center;
        }
        .sp-content-body {
            order: 3;
            width: 100%;
        }
        .sp-service-row.layout-boxed .sp-service-inner {
            padding: 3rem 2rem;
            border-radius: 20px;
        }
    }

    @media screen and (max-width: 768px) {
        .services-page-area {
            padding: 30px 0 50px;
        }
        .sp-header-row.layout-fullwidth,
        .sp-service-row.layout-fullwidth {
            padding: 3rem 0;
        }
        .sp-header-row.layout-boxed .sp-header-inner {
            padding: 2.25rem 1.25rem;
            border-radius: 16px;
        }
        .sp-service-row.layout-boxed .sp-service-inner {
            padding: 2.25rem 1.25rem;
            border-radius: 18px;
        }
        .service-detail {
            gap: 1.5rem !important;
        }
        .sp-visual-col {
            margin: 0.25rem 0 1rem;
        }
        .service-detail img {
            max-width: 100%;
        }
    }
    </style>

    <!-- Detailed Services Section Area -->
    <section id="services-detailed" class="services-page-area">
        <!-- Ambient Decorative Glow Background Orbs -->
        <div class="sp-ambient-orb orb-1"></div>
        <div class="sp-ambient-orb orb-2"></div>

        <!-- Services Page Header with Boxed or Full Width layout -->
        <div class="sp-header-row <?php echo ($sp_header_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($sp_header_bg); ?>;">
            <div class="container">
                <div class="sp-header-inner <?php echo elpis_is_dark_color($sp_header_bg) ? 'is-dark' : 'is-light'; ?>">
                    <div class="sp-badge-wrap">
                        <span class="sp-pulse-dot"></span>
                        <h2 class="section-title">SERVICES</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-page-items-wrap">
            <!-- Service 1 -->
            <div class="sp-service-row sp-scroll-reveal <?php echo ($s1_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($s1_bg); ?>;">
                <div class="container">
                    <div class="sp-service-inner <?php echo elpis_is_dark_color($s1_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="sp-visual-col">
                                <div class="sp-image-card">
                                    <div class="sp-image-halo"></div>
                                    <img src="<?php echo esc_url($s1_img); ?>" alt="Personalized Software Development">
                                </div>
                            </div>
                            <div class="sp-info-col">
                                <h3 class="sp-service-title">1. Personalized Software Development</h3>
                                <div class="sp-content-body">
                                    <p class="sp-service-desc">ELPIS partners with you to develop a wide range of customized and complicated software solutions to meet your unique business needs. We listen carefully to your ideas and build personalized software from scratch specifically for your goals. With ELPIS, you can expect top-notch results and reliable service every step of the way.</p>
                                    <h4 class="sp-service-subtitle">Why?</h4>
                                    <ul class="sp-feature-list">
                                        <li><strong>Experienced Team:</strong> with our experienced team, we’re dedicated to delivering value and helping our clients thrive in the market.</li>
                                        <li><strong>End-to-End Development Services:</strong> We partner with you through the entire software development journey, from ideation to maintenance and upgrades.</li>
                                        <li><strong>Agile Methodology:</strong> We ensure your product runs seamlessly at all stages with active involvement through an agile process.</li>
                                        <li><strong>Transparent Workflow:</strong> We maintain open communication and complete clarity, enabling you to track progress and reach your objectives.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="sp-service-row sp-scroll-reveal <?php echo ($s2_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($s2_bg); ?>;">
                <div class="container">
                    <div class="sp-service-inner <?php echo elpis_is_dark_color($s2_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail row-reverse">
                            <div class="sp-visual-col">
                                <div class="sp-image-card">
                                    <div class="sp-image-halo"></div>
                                    <img src="<?php echo esc_url($s2_img); ?>" alt="Web Application Development">
                                </div>
                            </div>
                            <div class="sp-info-col">
                                <h3 class="sp-service-title">2. Web Application Development</h3>
                                <div class="sp-content-body">
                                    <p class="sp-service-desc">ELPIS goes beyond traditional approaches to build unique web products. Our skilled and experienced web development team recognizes your goals and uses the power of modern web technologies to deliver web applications that bring real value to your business.</p>
                                    <h4 class="sp-service-subtitle">Why?</h4>
                                    <ul class="sp-feature-list">
                                        <li><strong>Custom Web App Development:</strong> With our expert team, we provide customized web app development solutions that effectively serve multiple industries.</li>
                                        <li><strong>Upgrade Existing Apps:</strong> We modernize outdated, old web interfaces to match evolving user needs and current technologies and make them user-friendly.</li>
                                        <li><strong>External System Integrations:</strong> ELPIS developers can integrate your product with diverse external applications and services.</li>
                                        <li><strong>Enterprise Portal Development:</strong> ELPIS works to ensure the success of your niche online business across sectors like hospitality, healthcare, technology, real estate, and e-commerce etc.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="sp-service-row sp-scroll-reveal <?php echo ($s3_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($s3_bg); ?>;">
                <div class="container">
                    <div class="sp-service-inner <?php echo elpis_is_dark_color($s3_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="sp-visual-col">
                                <div class="sp-image-card">
                                    <div class="sp-image-halo"></div>
                                    <img src="<?php echo esc_url($s3_img); ?>" alt="Mobile Application Development">
                                </div>
                            </div>
                            <div class="sp-info-col">
                                <h3 class="sp-service-title">3. Mobile Application Development</h3>
                                <div class="sp-content-body">
                                    <p class="sp-service-desc">Our custom mobile app development service helps our clients to deliver multi-functional features directly to their users’ fingertips. We create high-performance apps that run smoothly in various devices and operating systems. For native app development, we specialize in Swift and Objective-C for iOS, and Java and Kotlin for Android. When it comes to cross-platform and hybrid solutions, we work with technologies like Ionic, Xamarin, and React Native.</p>
                                    <h4 class="sp-service-subtitle">App Development Process Work Flow:</h4>
                                    <ul class="sp-feature-list">
                                        <li><strong>Understanding Requirements:</strong> Understanding your needs and planning development are key steps in our mobile app program.</li>
                                        <li><strong>Prototype:</strong> After a detailed analysis, we create your app prototype and share it for your review and feedback.</li>
                                        <li><strong>App Development:</strong> Development begins on your chosen platforms with full transparency.</li>
                                        <li><strong>Quality Assurance:</strong> Continuous testing during each sprint ensures a 100% bug-free app.</li>
                                        <li><strong>Deployment:</strong> The app is launched on the online store.</li>
                                        <li><strong>Support & Maintenance:</strong> ELPIS offers ongoing support and maintenance as needed.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="sp-service-row sp-scroll-reveal <?php echo ($s4_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($s4_bg); ?>;">
                <div class="container">
                    <div class="sp-service-inner <?php echo elpis_is_dark_color($s4_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail row-reverse">
                            <div class="sp-visual-col">
                                <div class="sp-image-card">
                                    <div class="sp-image-halo"></div>
                                    <img src="<?php echo esc_url($s4_img); ?>" alt="Digital Marketing">
                                </div>
                            </div>
                            <div class="sp-info-col">
                                <h3 class="sp-service-title">4. Digital Marketing</h3>
                                <div class="sp-content-body">
                                    <p class="sp-service-desc">ELPIS provides a wide range of technology-driven marketing solutions to help businesses grow their online presence, attract customers, and increase revenue. Our services include Website Design, Landing Pages, SEO, SEM, Social Media Marketing, Content Creation, Email Marketing, CRM integration, Analytics, Reporting, Branding, Creatives, App Marketing etc.</p>
                                    <ul class="sp-feature-list">
                                        <li><strong>Website & SEO</strong> – First step is building a strong site and optimizing it for search engines.</li>
                                        <li><strong>Content & Social Media</strong> – ELPIS helps you to attract clients by sharing valuable blogs, case studies, and updates.</li>
                                        <li><strong>Paid Ads</strong> – Running targeted campaigns helps you to generate leads.</li>
                                        <li><strong>Email & Reviews</strong> – Also nurturing leads and building credibility with testimonials is the key to successful Digital Marketing.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="sp-service-row sp-scroll-reveal <?php echo ($s5_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($s5_bg); ?>;">
                <div class="container">
                    <div class="sp-service-inner <?php echo elpis_is_dark_color($s5_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="sp-visual-col">
                                <div class="sp-image-card">
                                    <div class="sp-image-halo"></div>
                                    <img src="<?php echo esc_url($s5_img); ?>" alt="Quality Assurance & Testing">
                                </div>
                            </div>
                            <div class="sp-info-col">
                                <h3 class="sp-service-title">5. Quality Assurance & Testing</h3>
                                <div class="sp-content-body">
                                    <p class="sp-service-desc">At ELPIS, we blend Agile Development and Rational Unified Process practices to make sure our clients get the highest-quality software. In our testing process, our dedicated team members carefully check every part of the product, so it runs smoothly and stays free from bugs or glitches.</p>
                                    <h4 class="sp-service-subtitle">Our QA & Testing Expertise</h4>
                                    <ul class="sp-feature-list">
                                        <li><strong>Independent QA:</strong> ELPIS provides dedicated testing to ensure quality and compliance.</li>
                                        <li><strong>Integrated Testing:</strong> Every project undergoes thorough testing before release to ensure proper execution.</li>
                                        <li><strong>QA Consulting:</strong> We analyze projects and give recommendations to improve the overall process.</li>
                                        <li><strong>Full-Cycle Testing:</strong> QA is integrated throughout the automated or manual development lifecycle.</li>
                                        <li><strong>Custom Testing:</strong> We test web, desktop, and mobile apps for top-notch performance.</li>
                                        <li><strong>Test Automation:</strong> We select the right tools to meet automation goals of our clients.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var revealElements = document.querySelectorAll('.sp-scroll-reveal');
    if (!revealElements.length) return;

    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('sp-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            threshold: 0.12,
            rootMargin: '0px 0px -30px 0px'
        });

        revealElements.forEach(function(el) {
            revealObserver.observe(el);
        });
    } else {
        revealElements.forEach(function(el) {
            el.classList.add('sp-revealed');
        });
    }
});
</script>

<?php get_footer(); ?>
