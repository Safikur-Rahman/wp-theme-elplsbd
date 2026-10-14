<?php
// front-page.php
get_header(); 

// Services Settings
$services_header_layout = get_theme_mod('services_header_layout', 'boxed');
$services_header_bg     = get_theme_mod('services_header_bg', '#ffffff');
$services_items_layout  = get_theme_mod('services_items_layout', 'boxed');
$service_1_bg           = get_theme_mod('service_1_bg', '#ffffff');
$service_2_bg           = get_theme_mod('service_2_bg', '#f8fafc');
$service_3_bg           = get_theme_mod('service_3_bg', '#ffffff');
$service_4_bg           = get_theme_mod('service_4_bg', '#f8fafc');
$service_5_bg           = get_theme_mod('service_5_bg', '#ffffff');

// What We Offer Settings
$offer_header_layout    = get_theme_mod('offer_header_layout', 'boxed');
$offer_header_bg        = get_theme_mod('offer_header_bg', '#ffffff');
$offer_items_layout     = get_theme_mod('offer_items_layout', 'boxed');
$offer_1_bg             = get_theme_mod('offer_1_bg', '#ffffff');
$offer_2_bg             = get_theme_mod('offer_2_bg', '#f8fafc');
$offer_3_bg             = get_theme_mod('offer_3_bg', '#ffffff');
$offer_4_bg             = get_theme_mod('offer_4_bg', '#f8fafc');

// Hero Section Settings
$hero_bg_color          = get_theme_mod('hero_bg_color', '#0f172a');
$hero_is_dark           = elpis_is_dark_color($hero_bg_color);
?>
<main>
    <style>
    /* Modern Enterprise Front Page Typography & Micro-Animations */
    
    /* Hero Section */
    .hero-section {
        position: relative;
        padding: 105px 0 115px !important;
        text-align: left !important;
        transition: background 0.3s ease;
        overflow: hidden;
        z-index: 1;
    }
    .fp-hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.45;
    }
    .fp-hero-orb.orb-1 {
        width: 520px;
        height: 520px;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.25) 0%, rgba(184, 134, 11, 0) 70%);
        top: -12%;
        right: -6%;
        animation: fpHeroOrbPulse 11s ease-in-out infinite alternate;
    }
    .fp-hero-orb.orb-2 {
        width: 560px;
        height: 560px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.16) 0%, rgba(56, 189, 248, 0) 70%);
        bottom: -15%;
        left: -8%;
        animation: fpHeroOrbPulse 13s ease-in-out infinite alternate-reverse;
    }
    @keyframes fpHeroOrbPulse {
        0% { transform: scale(0.9) translate(0, 0); opacity: 0.35; }
        100% { transform: scale(1.15) translate(30px, -20px); opacity: 0.6; }
    }

    .hero-content-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 4.5rem;
        position: relative;
        z-index: 1;
    }
    .hero-text-col {
        flex: 1.15;
        min-width: 320px;
        text-align: left;
    }
    
    /* Modern Enterprise Hero Typography */
    .hero-title {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2.6rem, 4.2vw, 3.6rem);
        line-height: 1.15;
        margin-bottom: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        position: relative;
    }
    .hero-is-dark .hero-title {
        background: linear-gradient(135deg, #ffffff 30%, #f1f5f9 70%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 30px rgba(255, 255, 255, 0.1);
    }
    .hero-is-light .hero-title {
        color: var(--primary-color, #0f172a);
    }

    /* Hero Description Narrative Pod */
    .hero-desc-pod {
        border-left: 3.5px solid #b8860b;
        padding-left: 1.5rem;
        margin-top: 1.5rem;
        position: relative;
    }
    .hero-desc {
        font-size: 1.16rem;
        line-height: 1.85;
        margin-bottom: 0;
        max-width: 620px;
        font-weight: 400;
        letter-spacing: -0.01em;
    }
    .hero-is-dark .hero-desc {
        color: #cbd5e1 !important;
    }
    .hero-is-light .hero-desc {
        color: #475569 !important;
    }

    .hero-image-col {
        flex: 0.95;
        min-width: 320px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .fp-hero-halo {
        position: absolute;
        width: 85%;
        height: 85%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.18) 0%, rgba(15, 23, 42, 0) 70%);
        filter: blur(40px);
        z-index: 0;
        pointer-events: none;
    }
    .hero-image-col .hero-image {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 490px;
        margin-top: 0 !important;
        border-radius: 20px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.35);
        object-fit: contain;
        animation: fpHeroFloat 6.5s ease-in-out infinite;
        transition: transform 0.4s ease;
    }
    .hero-image-col:hover .hero-image {
        transform: translateY(-8px) scale(1.02);
    }
    @keyframes fpHeroFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    .hero-is-light .hero-image-col .hero-image {
        background: rgba(0, 0, 0, 0.02) !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
    }

    /* Enterprise Section Badges & Header Titles */
    .fp-badge-wrap {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(184, 134, 11, 0.08);
        border: 1px solid rgba(184, 134, 11, 0.28);
        padding: 8px 24px;
        border-radius: 9999px;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 15px -3px rgba(184, 134, 11, 0.12);
        margin-bottom: 1.25rem;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .fp-badge-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px -3px rgba(184, 134, 11, 0.22);
        background: rgba(184, 134, 11, 0.12);
    }
    .fp-pulse-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background-color: #b8860b;
        position: relative;
        display: inline-block;
    }
    .fp-pulse-dot::after {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border-radius: 50%;
        background: rgba(184, 134, 11, 0.45);
        animation: fpPulseDot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes fpPulseDot {
        0%, 100% { transform: scale(1); opacity: 0.85; }
        50% { transform: scale(2.2); opacity: 0; }
    }
    .fp-badge-wrap .section-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #b8860b;
        text-transform: uppercase;
        font-family: 'Outfit', sans-serif;
    }

    /* Section Area Spacing */
    .services-section-area,
    .offer-section-area {
        position: relative;
        padding: 50px 0 30px;
    }

    /* Fullwidth & Boxed Layout Styles for Services & Offers */
    .section-header-row.layout-fullwidth,
    .service-row.layout-fullwidth,
    .offer-row.layout-fullwidth {
        width: 100%;
        background-color: var(--row-bg);
        padding: 4.5rem 0;
        transition: background 0.3s ease;
        position: relative;
        z-index: 1;
    }
    .section-header-row.layout-fullwidth .section-header-inner,
    .service-row.layout-fullwidth .service-row-inner,
    .offer-row.layout-fullwidth .offer-row-inner {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }

    .section-header-row.layout-boxed,
    .service-row.layout-boxed,
    .offer-row.layout-boxed {
        width: 100%;
        background: transparent;
        padding: 1.5rem 0;
        position: relative;
        z-index: 1;
    }
    .section-header-row.layout-boxed .section-header-inner {
        background-color: var(--row-bg);
        padding: 3rem 2.5rem;
        border-radius: 24px;
        text-align: center;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: background 0.3s ease, transform 0.3s ease;
    }
    .service-row.layout-boxed .service-row-inner,
    .offer-row.layout-boxed .offer-row-inner {
        background-color: var(--row-bg);
        padding: 4.25rem 3.5rem;
        border-radius: 28px;
        box-shadow: 0 15px 40px -15px rgba(0, 0, 0, 0.05), 0 0 1px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, background 0.3s ease;
    }
    .service-row.layout-boxed:hover .service-row-inner,
    .offer-row.layout-boxed:hover .offer-row-inner {
        transform: translateY(-4px);
        box-shadow: 0 25px 50px -20px rgba(0, 0, 0, 0.1), 0 0 1px rgba(0, 0, 0, 0.12);
    }

    /* Common Typography & Alignment */
    .section-header-inner {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .section-header-inner p {
        max-width: 860px;
        margin: 0 auto;
        font-size: 1.15rem;
        line-height: 1.85;
        letter-spacing: -0.01em;
    }

    /* Enterprise Grid & Card Elements */
    .service-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 4rem;
        align-items: center;
    }
    .fp-visual-col {
        flex: 1;
        min-width: 320px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .fp-image-card {
        position: relative;
        width: 100%;
        max-width: 500px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .fp-image-halo {
        position: absolute;
        width: 85%;
        height: 85%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.14) 0%, rgba(15, 23, 42, 0) 70%);
        filter: blur(40px);
        z-index: 0;
        pointer-events: none;
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
        animation: fpCardFloat 6s ease-in-out infinite;
    }
    .service-detail.row-reverse img,
    .service-detail[style*="row-reverse"] img {
        animation-delay: -3s;
    }
    .fp-image-card:hover img {
        transform: translateY(-8px) scale(1.03);
    }
    @keyframes fpCardFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* Content Column & Modern Enterprise Text Design */
    .fp-info-col {
        flex: 1.2;
        min-width: 320px;
    }
    
    /* Modern Enterprise Heading Design */
    .fp-info-col h3 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.9rem, 2.7vw, 2.45rem);
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 1.25rem;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    /* Elegant Title Accent Indicator */
    .fp-info-col h3::after {
        content: '';
        display: block;
        width: 42px;
        height: 3.5px;
        background: linear-gradient(90deg, #b8860b, rgba(184, 134, 11, 0.25));
        border-radius: 4px;
        margin-top: 10px;
        transition: width 0.4s cubic-bezier(0.16, 1, 0.3, 1), background 0.4s ease;
    }
    .service-row:hover .fp-info-col h3::after,
    .offer-row:hover .fp-info-col h3::after {
        width: 85px;
        background: linear-gradient(90deg, #b8860b, #10b981);
    }
    .service-row:hover .fp-info-col h3,
    .offer-row:hover .fp-info-col h3 {
        transform: translateX(6px);
    }

    /* Modern Narrative Pod for Description Paragraphs */
    .fp-desc-pod {
        padding: 1.5rem 1.85rem;
        border-radius: 16px;
        border-left: 3.5px solid #b8860b;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }
    .fp-desc-pod p {
        margin: 0;
        font-size: 1.1rem;
        line-height: 1.85;
        letter-spacing: -0.01em;
        font-weight: 400;
    }
    .service-row:hover .fp-desc-pod,
    .offer-row:hover .fp-desc-pod {
        border-left-color: #10b981;
        transform: translateX(4px);
    }

    /* Automatic Smart Contrast for Dark & Light Backgrounds */
    .is-dark .section-title {
        color: #b8860b !important;
    }
    .is-dark .fp-info-col h3 {
        color: #ffffff !important;
    }
    .is-dark .section-header-inner p {
        color: #cbd5e1 !important;
    }
    .is-dark .fp-desc-pod {
        background: rgba(255, 255, 255, 0.03);
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        border-right: 1px solid rgba(255, 255, 255, 0.07);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        border-left: 3.5px solid #b8860b;
        backdrop-filter: blur(8px);
    }
    .is-dark .fp-desc-pod p {
        color: #cbd5e1 !important;
    }
    .is-dark .service-row:hover .fp-desc-pod,
    .is-dark .offer-row:hover .fp-desc-pod {
        background: rgba(255, 255, 255, 0.05);
        border-left-color: #10b981;
    }
    .is-dark .fp-image-card {
        background: rgba(255, 255, 255, 0.03);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }
    .is-dark.service-row-inner,
    .is-dark.offer-row-inner {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }

    .is-light .section-title {
        color: #b8860b !important;
    }
    .is-light .fp-info-col h3 {
        color: var(--primary-color, #0f172a) !important;
    }
    .is-light .section-header-inner p {
        color: var(--light-text, #64748b) !important;
    }
    .is-light .fp-desc-pod {
        background: rgba(15, 23, 42, 0.02);
        border-top: 1px solid rgba(15, 23, 42, 0.05);
        border-right: 1px solid rgba(15, 23, 42, 0.05);
        border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        border-left: 3.5px solid #b8860b;
    }
    .is-light .fp-desc-pod p {
        color: var(--text-color, #334155) !important;
    }
    .is-light .service-row:hover .fp-desc-pod,
    .is-light .offer-row:hover .fp-desc-pod {
        background: rgba(15, 23, 42, 0.035);
        border-left-color: #10b981;
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.05);
    }
    .is-light .fp-image-card {
        background: transparent;
        padding: 1rem;
    }

    /* Scroll Reveal Animation Styles */
    .fp-scroll-reveal {
        opacity: 0;
        transform: translateY(35px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }
    .fp-scroll-reveal.fp-revealed {
        opacity: 1;
        transform: translateY(0);
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .fp-hero-orb,
        .hero-image-col .hero-image,
        .service-detail img,
        .fp-scroll-reveal,
        .fp-info-col h3,
        .fp-desc-pod {
            animation: none !important;
            transition: none !important;
            transform: none !important;
            opacity: 1 !important;
        }
    }

    @media screen and (max-width: 992px) {
        .hero-section {
            padding: 75px 0 !important;
        }
        .hero-content-wrap {
            flex-direction: column;
            text-align: center;
            gap: 3rem;
        }
        .hero-text-col {
            text-align: center;
        }
        .hero-desc-pod {
            border-left: none;
            padding-left: 0;
            border-top: 2px solid #b8860b;
            padding-top: 1rem;
            margin: 1.5rem auto 0;
            max-width: 650px;
        }
        .hero-title {
            font-size: 2.7rem;
        }
        .hero-desc {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }
        .service-detail {
            gap: 2.5rem;
        }
        .service-detail[style*="row-reverse"] {
            flex-direction: row !important;
        }
        .service-row.layout-boxed .service-row-inner,
        .offer-row.layout-boxed .offer-row-inner {
            padding: 3rem 2rem;
            border-radius: 20px;
        }
    }
    @media screen and (max-width: 768px) {
        .section-header-row.layout-fullwidth,
        .service-row.layout-fullwidth,
        .offer-row.layout-fullwidth {
            padding: 3rem 0;
        }
        .section-header-row.layout-boxed .section-header-inner {
            padding: 2.25rem 1.25rem;
            border-radius: 16px;
        }
        .service-row.layout-boxed .service-row-inner,
        .offer-row.layout-boxed .offer-row-inner {
            padding: 2.25rem 1.25rem;
            border-radius: 18px;
        }
        .service-detail {
            gap: 2rem !important;
        }
        .service-detail img {
            max-width: 100%;
        }
        .fp-desc-pod {
            padding: 1.25rem 1.4rem;
        }
    }
    @media screen and (max-width: 640px) {
        .hero-title {
            font-size: 2.15rem;
        }
        .hero-desc {
            font-size: 1.04rem;
        }
    }
    </style>

    <!-- Hero Section (Side-by-Side: Text Left, Image Right) -->
    <section class="hero-section <?php echo $hero_is_dark ? 'hero-is-dark' : 'hero-is-light'; ?>" style="background-color: <?php echo esc_attr($hero_bg_color); ?>;">
        <!-- Ambient Decorative Glow Background Orbs -->
        <div class="fp-hero-orb orb-1"></div>
        <div class="fp-hero-orb orb-2"></div>

        <div class="container">
            <div class="hero-content-wrap">
                <!-- Left Column: Headline + Subheadline -->
                <div class="hero-text-col fp-scroll-reveal fp-revealed">
                    <h1 class="hero-title"><?php echo esc_html(get_theme_mod('hero_headline', 'Lighting the path forward')); ?></h1>
                    <div class="hero-desc-pod">
                        <p class="hero-desc"><?php echo esc_html(get_theme_mod('hero_subheadline', 'One-stop solution for all type IT related issues including Software Development and Digital Marketing which facilitates business leaders to secure sustainable growth.')); ?></p>
                    </div>
                </div>
                <!-- Right Column: Hero Image -->
                <div class="hero-image-col fp-scroll-reveal fp-revealed">
                    <div class="fp-hero-halo"></div>
                    <img src="<?php echo esc_url(get_theme_mod('hero_image', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_developer_p3e5.svg')); ?>" alt="ELPIS BD Hero" class="hero-image" style="background: rgba(255,255,255,0.06); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services (Short) -->
    <section id="services" class="services-section-area">
        <!-- Services Header (Title + Paragraph) with Full Width or Boxed option -->
        <div class="section-header-row fp-scroll-reveal <?php echo ($services_header_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($services_header_bg); ?>;">
            <div class="container">
                <div class="section-header-inner <?php echo elpis_is_dark_color($services_header_bg) ? 'is-dark' : 'is-light'; ?>">
                    <div class="fp-badge-wrap">
                        <span class="fp-pulse-dot"></span>
                        <h2 class="section-title">Our Services</h2>
                    </div>
                    <p>We assign our software development teams to our clients as per their requirements from starting to the end. We offer front-end, backend, database and server solutions for mobile, web and desktop applications. Our mission is to provide expert advice and deliver essential software that drives our clients’ success.</p>
                </div>
            </div>
        </div>
        
        <!-- Service 1 to End Area with Individual Background Colors & Layout option -->
        <div class="services-items-wrap">
            <!-- Service 1 -->
            <div class="service-row fp-scroll-reveal <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_1_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_1_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('service_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/programming_2svr.svg')); ?>" alt="Personalized Software Development">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>1. Personalized Software Development</h3>
                                <div class="fp-desc-pod">
                                    <p>ELPIS partners with you to develop a wide range of customized and complicated software solutions to meet your unique business needs. We listen carefully to your ideas and build personalized software from scratch specifically for your goals. With ELPIS, you can expect top-notch results and reliable service every step of the way.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="service-row fp-scroll-reveal <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_2_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_2_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="flex-direction: row-reverse;">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('service_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_devices_xw3m.svg')); ?>" alt="Web Application Development">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>2. Web Application Development</h3>
                                <div class="fp-desc-pod">
                                    <p>ELPIS goes beyond traditional approaches to build unique web products. Our Skilled and experienced web development team recognizes your goals and uses the power of modern web technologies to deliver web applications that bring real value to your business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="service-row fp-scroll-reveal <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_3_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_3_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('service_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/mobile_development_8ygq.svg')); ?>" alt="Mobile Application Development">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>3. Mobile Application Development</h3>
                                <div class="fp-desc-pod">
                                    <p>Our custom mobile app development service helps our clients to deliver multi-functional features directly to their users’ fingertips. We create high-performance apps that run smoothly on a wide range of devices and operating systems. For native app development, we specialize in Swift and Objective-C for iOS, and Java and Kotlin for Android. When it comes to cross-platform and hybrid solutions, we work with technologies like Ionic, Xamarin, and React Native.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="service-row fp-scroll-reveal <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_4_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_4_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="flex-direction: row-reverse;">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('service_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/social_media_marketing_twnp.svg')); ?>" alt="Digital Marketing">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>4. Digital Marketing</h3>
                                <div class="fp-desc-pod">
                                    <p>ELPIS provides a wide range of technology-driven marketing solutions to help businesses grow their online presence, attract customers, and increase revenue. Our services include Website Design, Landing Pages, SEO, SEM, Social Media Marketing, Content Creation, Email Marketing, CRM integration, Analytics, Reporting, Branding, Creatives, App Marketing etc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="service-row fp-scroll-reveal <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_5_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_5_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('service_5_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/quality_assurance_7fny.svg')); ?>" alt="Quality Assurance & Testing">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>5. Quality Assurance & Testing</h3>
                                <div class="fp-desc-pod">
                                    <p>At ELPIS, we blend Agile development and Rational Unified Process practices to make sure our clients get the highest-quality software. In our testing process, our dedicated team members carefully check every part of the product, so it runs smoothly and stays free from bugs or glitches.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What we Offer Section -->
    <section class="offer-section-area">
        <!-- What We Offer Header (Title + Paragraph) with Full Width or Boxed option -->
        <div class="section-header-row fp-scroll-reveal <?php echo ($offer_header_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_header_bg); ?>;">
            <div class="container">
                <div class="section-header-inner <?php echo elpis_is_dark_color($offer_header_bg) ? 'is-dark' : 'is-light'; ?>">
                    <div class="fp-badge-wrap">
                        <span class="fp-pulse-dot"></span>
                        <h2 class="section-title">What we Offer</h2>
                    </div>
                    <p>ELPIS becomes a true part of your development and testing team, working side by side with you to overcome your business challenges and utilize your budget. What sets us apart is the time we invest in understanding your unique needs, demands and difficulties.</p>
                </div>
            </div>
        </div>

        <!-- Offer 1 to End Area with Individual Background Colors & Layout option -->
        <div class="offer-items-wrap">
            <!-- Offer 1 -->
            <div class="offer-row fp-scroll-reveal <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_1_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_1_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('offer_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/code_typing_7jnv.svg')); ?>" alt="Qualified Developers" class="offer-image">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>1. Qualified Developers</h3>
                                <div class="fp-desc-pod">
                                    <p>ELPIS has expert software developers, and we’re committed to staying at the top of our industry by bringing in talent from leading universities. Our energetic team ensures customer satisfaction through a wide range of technology stacks.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 2 -->
            <div class="offer-row fp-scroll-reveal <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_2_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_2_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="flex-direction: row-reverse;">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('offer_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/team_collaboration_re_ow29.svg')); ?>" alt="Working as a Team" class="offer-image">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>2. Working as a Team</h3>
                                <div class="fp-desc-pod">
                                    <p>Our team becomes yours once you are working with us. We will be your partner to achieve ultimate goal and we’ll face the challenges of software development together and guide you through.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 3 -->
            <div class="offer-row fp-scroll-reveal <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_3_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_3_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('offer_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/work_together_re_5y58.svg')); ?>" alt="Collaborative Approach" class="offer-image">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>3. Collaborative Approach</h3>
                                <div class="fp-desc-pod">
                                    <p>ELPIS is not just a vendor, we become a part of your team. Together, we will follow a collaborative approach to bring your product vision to life, staying in close touch with you at every step of the journey.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 4 -->
            <div class="offer-row fp-scroll-reveal <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_4_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_4_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="flex-direction: row-reverse;">
                            <div class="fp-visual-col">
                                <div class="fp-image-card">
                                    <div class="fp-image-halo"></div>
                                    <img src="<?php echo esc_url(get_theme_mod('offer_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/project_completed_re_jr7u.svg')); ?>" alt="Continuous Monitoring" class="offer-image">
                                </div>
                            </div>
                            <div class="fp-info-col">
                                <h3>4. Continuous Monitoring</h3>
                                <div class="fp-desc-pod">
                                    <p>A project manager will be with you throughout the entire project, helping plan, organize, and monitor everything to make sure key milestones and deliverables are met. They will also work on improving processes along the way to keep things running smoothly.</p>
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
    var revealElements = document.querySelectorAll('.fp-scroll-reveal');
    if (!revealElements.length) return;

    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fp-revealed');
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
            el.classList.add('fp-revealed');
        });
    }
});
</script>

<?php get_footer(); ?>
