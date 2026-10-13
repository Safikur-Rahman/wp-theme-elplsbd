<?php
/*
Template Name: Services Page
*/
get_header(); ?>
<main>
    <!-- Detailed Services Section -->
    <section id="services-detailed" style="background: var(--white); padding: 80px 0;">
        <div class="container">
            <h2 class="section-title">SERVICES</h2>
            <!-- Service 1 -->
            <div class="service-detail" style="margin-bottom: 5rem; display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('service_1_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/programming_2svr.svg')); ?>" alt="Personalized Software Development" style="width: 100%; max-width: 500px; height: auto;">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">1. Personalized Software Development</h3>
                    <p style="margin-bottom: 1.5rem;">ELPIS partners with you to develop a wide range of customized and complicated software solutions to meet your unique business needs. We listen carefully to your ideas and build personalized software from scratch specifically for your goals. With ELPIS, you can expect top-notch results and reliable service every step of the way.</p>
                    <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem; font-size: 1.25rem;">Why?</h4>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-color);">
                        <li style="margin-bottom: 0.5rem;"><strong>Experienced Team:</strong> with our experienced team, we’re dedicated to delivering value and helping our clients thrive in the market.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>End-to-End Development Services:</strong> We partner with you through the entire software development journey, from ideation to maintenance and upgrades.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Agile Methodology:</strong> We ensure your product runs seamlessly at all stages with active involvement through an agile process.</li>
                        <li><strong>Transparent Workflow:</strong> We maintain open communication and complete clarity, enabling you to track progress and reach your objectives.</li>
                    </ul>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="service-detail" style="margin-bottom: 5rem; display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('service_2_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_devices_xw3m.svg')); ?>" alt="Web Application Development" style="width: 100%; max-width: 500px; height: auto;">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">2. Web Application Development</h3>
                    <p style="margin-bottom: 1.5rem;">ELPIS goes beyond traditional approaches to build unique web products. Our skilled and experienced web development team recognizes your goals and uses the power of modern web technologies to deliver web applications that bring real value to your business.</p>
                    <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem; font-size: 1.25rem;">Why?</h4>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-color);">
                        <li style="margin-bottom: 0.5rem;"><strong>Custom Web App Development:</strong> With our expert team, we provide customized web app development solutions that effectively serve multiple industries.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Upgrade Existing Apps:</strong> We modernize outdated, old web interfaces to match evolving user needs and current technologies and make them user-friendly.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>External System Integrations:</strong> ELPIS developers can integrate your product with diverse external applications and services.</li>
                        <li><strong>Enterprise Portal Development:</strong> ELPIS works to ensure the success of your niche online business across sectors like hospitality, healthcare, technology, real estate, and e-commerce etc.</li>
                    </ul>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="service-detail" style="margin-bottom: 5rem; display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('service_3_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/mobile_development_8ygq.svg')); ?>" alt="Mobile Application Development" style="width: 100%; max-width: 500px; height: auto;">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">3. Mobile Application Development</h3>
                    <p style="margin-bottom: 1.5rem;">Our custom mobile app development service helps our clients to deliver multi-functional features directly to their users’ fingertips. We create high-performance apps that run smoothly in various devices and operating systems. For native app development, we specialize in Swift and Objective-C for iOS, and Java and Kotlin for Android. When it comes to cross-platform and hybrid solutions, we work with technologies like Ionic, Xamarin, and React Native.</p>
                    <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem; font-size: 1.25rem;">App Development Process Work Flow:</h4>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-color);">
                        <li style="margin-bottom: 0.5rem;"><strong>Understanding Requirements:</strong> Understanding your needs and planning development are key steps in our mobile app program.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Prototype:</strong> After a detailed analysis, we create your app prototype and share it for your review and feedback.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>App Development:</strong> Development begins on your chosen platforms with full transparency.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Quality Assurance:</strong> Continuous testing during each sprint ensures a 100% bug-free app.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Deployment:</strong> The app is launched on the online store.</li>
                        <li><strong>Support & Maintenance:</strong> ELPIS offers ongoing support and maintenance as needed.</li>
                    </ul>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="service-detail" style="margin-bottom: 5rem; display: flex; flex-wrap: wrap; gap: 3rem; align-items: center; flex-direction: row-reverse;">
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('service_4_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/social_media_marketing_twnp.svg')); ?>" alt="Digital Marketing" style="width: 100%; max-width: 500px; height: auto;">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">4. Digital Marketing</h3>
                    <p style="margin-bottom: 1.5rem;">ELPIS provides a wide range of technology-driven marketing solutions to help businesses grow their online presence, attract customers, and increase revenue. Our services include Website Design, Landing Pages, SEO, SEM, Social Media Marketing, Content Creation, Email Marketing, CRM integration, Analytics, Reporting, Branding, Creatives, App Marketing etc.</p>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-color);">
                        <li style="margin-bottom: 0.5rem;"><strong>Website & SEO</strong> – First step is building a strong site and optimizing it for search engines.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Content & Social Media</strong> – ELPIS helps you to attract clients by sharing valuable blogs, case studies, and updates.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Paid Ads</strong> – Running targeted campaigns helps you to generate leads.</li>
                        <li><strong>Email & Reviews</strong> – Also nurturing leads and building credibility with testimonials is the key to successful Digital Marketing.</li>
                    </ul>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="service-detail" style="margin-bottom: 5rem; display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('service_5_img', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/quality_assurance_7fny.svg')); ?>" alt="Quality Assurance & Testing" style="width: 100%; max-width: 500px; height: auto;">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">5. Quality Assurance & Testing</h3>
                    <p style="margin-bottom: 1.5rem;">At ELPIS, we blend Agile Development and Rational Unified Process practices to make sure our clients get the highest-quality software. In our testing process, our dedicated team members carefully check every part of the product, so it runs smoothly and stays free from bugs or glitches.</p>
                    <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem; font-size: 1.25rem;">Our QA & Testing Expertise</h4>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-color);">
                        <li style="margin-bottom: 0.5rem;"><strong>Independent QA:</strong> ELPIS provides dedicated testing to ensure quality and compliance.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Integrated Testing:</strong> Every project undergoes thorough testing before release to ensure proper execution.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>QA Consulting:</strong> We analyze projects and give recommendations to improve the overall process.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Full-Cycle Testing:</strong> QA is integrated throughout the automated or manual development lifecycle.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Custom Testing:</strong> We test web, desktop, and mobile apps for top-notch performance.</li>
                        <li><strong>Test Automation:</strong> We select the right tools to meet automation goals of our clients.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
