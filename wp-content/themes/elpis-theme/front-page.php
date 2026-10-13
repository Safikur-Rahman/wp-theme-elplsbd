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
    <!-- Hero Section (Side-by-Side: Text Left, Image Right) -->
    <section class="hero-section <?php echo $hero_is_dark ? 'hero-is-dark' : 'hero-is-light'; ?>" style="background-color: <?php echo esc_attr($hero_bg_color); ?>;">
        <div class="container">
            <div class="hero-content-wrap">
                <!-- Left Column: Headline + Subheadline -->
                <div class="hero-text-col">
                    <h1 class="hero-title"><?php echo esc_html(get_theme_mod('hero_headline', 'Lighting the path forward')); ?></h1>
                    <p class="hero-desc"><?php echo esc_html(get_theme_mod('hero_subheadline', 'One-stop solution for all type IT related issues including Software Development and Digital Marketing which facilitates business leaders to secure sustainable growth.')); ?></p>
                </div>
                <!-- Right Column: Hero Image -->
                <div class="hero-image-col">
                    <img src="<?php echo esc_url(get_theme_mod('hero_image', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_developer_p3e5.svg')); ?>" alt="ELPIS BD Hero" class="hero-image" style="background: rgba(255,255,255,0.06); padding: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Hero Section Side-by-Side Layout */
    .hero-section {
        padding: 90px 0 !important;
        text-align: left !important;
        transition: background 0.3s ease;
        overflow: hidden;
    }
    .hero-content-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 4rem;
    }
    .hero-text-col {
        flex: 1.1;
        min-width: 320px;
        text-align: left;
    }
    .hero-title {
        font-size: 3.25rem;
        line-height: 1.18;
        margin-bottom: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    .hero-desc {
        font-size: 1.18rem;
        line-height: 1.75;
        margin-bottom: 0;
    }
    .hero-image-col {
        flex: 0.9;
        min-width: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .hero-image-col .hero-image {
        width: 100%;
        margin-top: 0 !important;
        border-radius: 16px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.3);
        object-fit: contain;
    }

    .hero-is-dark .hero-title {
        color: #ffffff !important;
    }
    .hero-is-dark .hero-desc {
        color: #cbd5e1 !important;
    }
    .hero-is-light .hero-title {
        color: var(--primary-color, #0f172a) !important;
    }
    .hero-is-light .hero-desc {
        color: #475569 !important;
    }
    .hero-is-light .hero-image-col .hero-image {
        background: rgba(0, 0, 0, 0.03) !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
    }

    @media screen and (max-width: 992px) {
        .hero-section {
            padding: 60px 0 !important;
        }
        .hero-content-wrap {
            flex-direction: column;
            text-align: center;
            gap: 2.5rem;
        }
        .hero-text-col {
            text-align: center;
        }
        .hero-title {
            font-size: 2.4rem;
        }
        .hero-desc {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.08rem;
        }
    }
    @media screen and (max-width: 640px) {
        .hero-title {
            font-size: 2rem;
        }
        .hero-desc {
            font-size: 1rem;
        }
    }

    /* Fullwidth & Boxed Layout Styles for Services & Offers */
    .section-header-row.layout-fullwidth,
    .service-row.layout-fullwidth,
    .offer-row.layout-fullwidth {
        width: 100%;
        background-color: var(--row-bg);
        padding: 4rem 0;
        transition: background 0.3s ease;
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
        padding: 1.25rem 0;
    }
    .section-header-row.layout-boxed .section-header-inner {
        background-color: var(--row-bg);
        padding: 2.75rem 2rem;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: background 0.3s ease;
    }
    .service-row.layout-boxed .service-row-inner,
    .offer-row.layout-boxed .offer-row-inner {
        background-color: var(--row-bg);
        padding: 3.5rem 3rem;
        border-radius: 20px;
        box-shadow: 0 4px 25px -2px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: background 0.3s ease;
    }

    /* Common Typography & Alignment */
    .section-header-inner {
        text-align: center;
    }
    .section-header-inner .section-title {
        margin-bottom: 1rem;
    }
    .section-header-inner p {
        max-width: 850px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.7;
    }

    /* Automatic Smart Contrast for Dark & Light Backgrounds */
    .is-dark .section-title,
    .is-dark h3 {
        color: #ffffff !important;
    }
    .is-dark p {
        color: #cbd5e1 !important;
    }
    .is-light .section-title,
    .is-light h3 {
        color: var(--primary-color);
    }
    .is-light .section-header-inner p {
        color: var(--light-text);
    }
    .is-light .service-row-inner p,
    .is-light .offer-row-inner p {
        color: var(--text-color);
    }

    @media screen and (max-width: 768px) {
        .section-header-row.layout-fullwidth,
        .service-row.layout-fullwidth,
        .offer-row.layout-fullwidth {
            padding: 2.5rem 0;
        }
        .section-header-row.layout-boxed .section-header-inner {
            padding: 2rem 1.25rem;
            border-radius: 12px;
        }
        .service-row.layout-boxed .service-row-inner,
        .offer-row.layout-boxed .offer-row-inner {
            padding: 2rem 1.25rem;
            border-radius: 14px;
        }
    }
    </style>

    <!-- Our Services (Short) -->
    <section id="services" class="services-section-area" style="padding: 40px 0 20px;">
        <!-- Services Header (Title + Paragraph) with Full Width or Boxed option -->
        <div class="section-header-row <?php echo ($services_header_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($services_header_bg); ?>;">
            <div class="container">
                <div class="section-header-inner <?php echo elpis_is_dark_color($services_header_bg) ? 'is-dark' : 'is-light'; ?>">
                    <h2 class="section-title">Our Services</h2>
                    <p>We assign our software development teams to our clients as per their requirements from starting to the end. We offer front-end, backend, database and server solutions for mobile, web and desktop applications. Our mission is to provide expert advice and deliver essential software that drives our clients’ success.</p>
                </div>
            </div>
        </div>
        
        <!-- Service 1 to End Area with Individual Background Colors & Layout option -->
        <div class="services-items-wrap">
            <!-- Service 1 -->
            <div class="service-row <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_1_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_1_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('service_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/programming_2svr.svg')); ?>" alt="Personalized Software Development" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">1. Personalized Software Development</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">ELPIS partners with you to develop a wide range of customized and complicated software solutions to meet your unique business needs. We listen carefully to your ideas and build personalized software from scratch specifically for your goals. With ELPIS, you can expect top-notch results and reliable service every step of the way.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="service-row <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_2_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_2_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('service_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_devices_xw3m.svg')); ?>" alt="Web Application Development" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">2. Web Application Development</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">ELPIS goes beyond traditional approaches to build unique web products. Our Skilled and experienced web development team recognizes your goals and uses the power of modern web technologies to deliver web applications that bring real value to your business.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="service-row <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_3_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_3_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('service_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/mobile_development_8ygq.svg')); ?>" alt="Mobile Application Development" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">3. Mobile Application Development</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">Our custom mobile app development service helps our clients to deliver multi-functional features directly to their users’ fingertips. We create high-performance apps that run smoothly on a wide range of devices and operating systems. For native app development, we specialize in Swift and Objective-C for iOS, and Java and Kotlin for Android. When it comes to cross-platform and hybrid solutions, we work with technologies like Ionic, Xamarin, and React Native.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="service-row <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_4_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_4_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('service_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/social_media_marketing_twnp.svg')); ?>" alt="Digital Marketing" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">4. Digital Marketing</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">ELPIS provides a wide range of technology-driven marketing solutions to help businesses grow their online presence, attract customers, and increase revenue. Our services include Website Design, Landing Pages, SEO, SEM, Social Media Marketing, Content Creation, Email Marketing, CRM integration, Analytics, Reporting, Branding, Creatives, App Marketing etc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="service-row <?php echo ($services_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($service_5_bg); ?>;">
                <div class="container">
                    <div class="service-row-inner <?php echo elpis_is_dark_color($service_5_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('service_5_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/quality_assurance_7fny.svg')); ?>" alt="Quality Assurance & Testing" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">5. Quality Assurance & Testing</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">At ELPIS, we blend Agile development and Rational Unified Process practices to make sure our clients get the highest-quality software. In our testing process, our dedicated team members carefully check every part of the product, so it runs smoothly and stays free from bugs or glitches.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What we Offer Section -->
    <section class="offer-section-area" style="padding: 40px 0 20px;">
        <!-- What We Offer Header (Title + Paragraph) with Full Width or Boxed option -->
        <div class="section-header-row <?php echo ($offer_header_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_header_bg); ?>;">
            <div class="container">
                <div class="section-header-inner <?php echo elpis_is_dark_color($offer_header_bg) ? 'is-dark' : 'is-light'; ?>">
                    <h2 class="section-title">What we Offer</h2>
                    <p>ELPIS becomes a true part of your development and testing team, working side by side with you to overcome your business challenges and utilize your budget. What sets us apart is the time we invest in understanding your unique needs, demands and difficulties.</p>
                </div>
            </div>
        </div>

        <!-- Offer 1 to End Area with Individual Background Colors & Layout option -->
        <div class="offer-items-wrap">
            <!-- Offer 1 -->
            <div class="offer-row <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_1_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_1_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('offer_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/code_typing_7jnv.svg')); ?>" alt="Qualified Developers" class="offer-image" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">1. Qualified Developers</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">ELPIS has expert software developers, and we’re committed to staying at the top of our industry by bringing in talent from leading universities. Our energetic team ensures customer satisfaction through a wide range of technology stacks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 2 -->
            <div class="offer-row <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_2_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_2_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('offer_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/team_collaboration_re_ow29.svg')); ?>" alt="Working as a Team" class="offer-image" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">2. Working as a Team</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">Our team becomes yours once you are working with us. We will be your partner to achieve ultimate goal and we’ll face the challenges of software development together and guide you through.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 3 -->
            <div class="offer-row <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_3_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_3_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('offer_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/work_together_re_5y58.svg')); ?>" alt="Collaborative Approach" class="offer-image" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">3. Collaborative Approach</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">ELPIS is not just a vendor, we become a part of your team. Together, we will follow a collaborative approach to bring your product vision to life, staying in close touch with you at every step of the journey.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer 4 -->
            <div class="offer-row <?php echo ($offer_items_layout === 'fullwidth') ? 'layout-fullwidth' : 'layout-boxed'; ?>" style="--row-bg: <?php echo esc_attr($offer_4_bg); ?>;">
                <div class="container">
                    <div class="offer-row-inner <?php echo elpis_is_dark_color($offer_4_bg) ? 'is-dark' : 'is-light'; ?>">
                        <div class="service-detail" style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                            <div style="flex: 1; min-width: 300px; text-align: center;">
                                <img src="<?php echo esc_url(get_theme_mod('offer_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/project_completed_re_jr7u.svg')); ?>" alt="Continuous Monitoring" class="offer-image" style="width: 100%; max-width: 500px; height: auto;">
                            </div>
                            <div style="flex: 1; min-width: 300px;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">4. Continuous Monitoring</h3>
                                <p style="font-size: 1.1rem; line-height: 1.7;">A project manager will be with you throughout the entire project, helping plan, organize, and monitor everything to make sure key milestones and deliverables are met. They will also work on improving processes along the way to keep things running smoothly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
