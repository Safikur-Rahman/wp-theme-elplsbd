<?php
/*
Template Name: About Us Page
*/
get_header(); ?>
<main>
    <!-- About Section -->
    <section id="about" class="services-section" style="background: var(--bg-color);">
        <div class="container">
            <h2 class="section-title">ABOUT US</h2>
            <p style="text-align: center; font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 2rem;">We are ELPIS, your Ultimate Software Partner.</p>
            
            <div style="background: var(--white); padding: 3rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); margin-bottom: 4rem;">
                <h3 style="color: var(--secondary-color); margin-bottom: 1rem;">Who we are:</h3>
                <p style="margin-bottom: 1rem;">ELPIS, a trusted partner for software development and testing services, is a sister concern of SSA International. With a team of skilled developers, we build powerful web, desktop, and mobile applications personalized as per our clients’ needs. We work as a customized technological support system for our partners.</p>
                <p>Since the very beginning, we’ve worked alongside startups, growing businesses, and established enterprises all over Bangladesh, helping them achieve real operational improvements and long-term success.</p>
            </div>
            
            <h3 style="text-align: center; font-size: 2rem; margin-bottom: 3rem;">Messages from our Leaders</h3>
            <div style="display: flex; gap: 2rem; flex-wrap: wrap; justify-content: center; margin-bottom: 4rem;">
                <!-- Leader 1 -->
                <div class="service-card" style="flex: 1; min-width: 300px; max-width: 500px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('leader_1_image', 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80')); ?>" alt="<?php echo esc_attr(get_theme_mod('leader_1_name', 'Md. Omar Faruk Bhuiyan')); ?>" class="service-image leader-img" style="object-fit: cover; border-radius: 50%; margin: 0 auto 1.5rem;">
                    <h3 class="service-title" style="margin-bottom: 0.5rem;"><?php echo esc_html(get_theme_mod('leader_1_title', 'Chairman')); ?></h3>
                    <h4 style="font-size: 1.25rem; color: var(--primary-color);"><?php echo esc_html(get_theme_mod('leader_1_name', 'Md. Omar Faruk Bhuiyan')); ?></h4>
                    <p style="color: var(--secondary-color); font-weight: 600; margin-bottom: 1.5rem;"><?php echo nl2br(esc_html(get_theme_mod('leader_1_subtitle', "Owner & Founder\nSSA International"))); ?></p>
                    <p style="font-style: italic;"><?php echo esc_html(get_theme_mod('leader_1_quote', '“At ELPIS, we focus on innovation and delivering top-notch technology solutions. Our goal is to create value for clients while fostering a culture of collaboration and growth.”')); ?></p>
                </div>
                <!-- Leader 2 -->
                <div class="service-card" style="flex: 1; min-width: 300px; max-width: 500px; text-align: center;">
                    <img src="<?php echo esc_url(get_theme_mod('leader_2_image', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80')); ?>" alt="<?php echo esc_attr(get_theme_mod('leader_2_name', 'Safoan Bin Rashid')); ?>" class="service-image leader-img" style="object-fit: cover; border-radius: 50%; margin: 0 auto 1.5rem;">
                    <h3 class="service-title" style="margin-bottom: 0.5rem;"><?php echo esc_html(get_theme_mod('leader_2_title', 'Managing Director')); ?></h3>
                    <h4 style="font-size: 1.25rem; color: var(--primary-color);"><?php echo esc_html(get_theme_mod('leader_2_name', 'Safoan Bin Rashid')); ?></h4>
                    <p style="font-style: italic; margin-top: 1.5rem;"><?php echo esc_html(get_theme_mod('leader_2_quote', '“We turn ideas into impactful software solutions. By combining smart strategies with cutting-edge technology, we enlighten the path forward of our business partners so that they can overcome challenges and achieve their goals. Together, we are committed to driving innovation and building lasting relationships with our clients.”')); ?></p>
                </div>
            </div>

            <!-- Benefits -->
            <div style="background: linear-gradient(135deg, var(--primary-color), #1e293b); color: var(--white); padding: 3rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.2);">
                <h3 style="text-align: center; color: var(--white); font-size: 2rem; margin-bottom: 2rem;">Benefits of Working with ELPIS</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    <div>
                        <h4 style="color: var(--accent-color); margin-bottom: 0.5rem; font-size: 1.1rem;">Start Right Away:</h4>
                        <p style="color: #cbd5e1; font-size: 0.95rem;">ELPIS quickly scales up teams and manage them independently to deliver on agreed plans.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--accent-color); margin-bottom: 0.5rem; font-size: 1.1rem;">Qualified Developers:</h4>
                        <p style="color: #cbd5e1; font-size: 0.95rem;">Our ongoing hiring process ensures you always have access to the best IT talent.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--accent-color); margin-bottom: 0.5rem; font-size: 1.1rem;">Comprehensive Management:</h4>
                        <p style="color: #cbd5e1; font-size: 0.95rem;">From start to finish, we handle your project and team management, ensuring a high-quality outcome.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--accent-color); margin-bottom: 0.5rem; font-size: 1.1rem;">Operational Supremacy:</h4>
                        <p style="color: #cbd5e1; font-size: 0.95rem;">Our cost-effective services help you stay competitive by cutting costs without sacrificing quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
