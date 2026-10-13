<?php
/*
Template Name: Careers Page
*/
get_header(); ?>
<main>
    <!-- Careers Section -->
    <section id="careers" style="background: var(--bg-color); padding: 80px 0; text-align: center;">
        <div class="container">
            <h2 class="section-title">CAREERS</h2>
            <h3 style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 2rem;">JOIN US</h3>
            <img src="<?php echo esc_url(get_theme_mod('careers_image', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/interview_re_e5jn.svg')); ?>" alt="Join Us" class="hero-image" style="width: 100%; max-width: 900px; height: auto; margin: 0 auto 3rem; display: block;">
            <p style="max-width: 800px; margin: 0 auto 2rem; font-size: 1.1rem; color: var(--text-color);">At ELPIS, we encourage innovation and creativity to drive growth and add value. We love what we do and believe in open communication and transparency, where every idea and suggestion matters. We invest in our people by offering continuous learning and development opportunities. Be a part of our visionary team and grow with us.</p>
            <p style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Drop your CV here-</p>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('careers_email', 'careers@elpis.bd')); ?>" style="display: inline-block; padding: 1rem 2.5rem; background: var(--secondary-color); color: var(--white); border-radius: 8px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s ease;">Send Resume</a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
