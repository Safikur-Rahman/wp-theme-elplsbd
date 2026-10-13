<?php
/*
Template Name: Contact Us Page
*/
get_header(); ?>
<main>
    <!-- Contact Us Section -->
    <section id="contact" style="background: var(--white); padding: 80px 0;">
        <div class="container">
            <h2 class="section-title">CONTACT US</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 3rem; justify-content: center;">
                <div style="flex: 1; min-width: 300px; max-width: 400px;">
                    <div style="background: var(--bg-color); padding: 2rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); height: 100%;">
                        <h3 style="color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.75rem;">Get in Touch</h3>
                        <p style="margin-bottom: 1rem; font-size: 1.1rem;"><strong>Call Us:</strong> <br><a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '')); ?>" style="color: var(--secondary-color);"><?php echo esc_html(get_theme_mod('contact_phone', '[Add Phone Number]')); ?></a></p>
                        <p style="margin-bottom: 1rem; font-size: 1.1rem;"><strong>Email Us:</strong> <br><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', '')); ?>" style="color: var(--secondary-color);"><?php echo esc_html(get_theme_mod('contact_email', '[Add Email Address]')); ?></a></p>
                        <p style="font-size: 1.1rem;"><strong>Our Address:</strong><br><?php echo nl2br(esc_html(get_theme_mod('contact_address', '[Add Your Address]'))); ?></p>
                    </div>
                </div>
                <div style="flex: 1; min-width: 300px; max-width: 600px;">
                    <form style="background: var(--bg-color); padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); display: flex; flex-direction: column; gap: 1rem;">
                        <input type="text" placeholder="Type Name" style="padding: 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 1rem; width: 100%;">
                        <input type="text" placeholder="Company Name" style="padding: 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 1rem; width: 100%;">
                        <input type="tel" placeholder="Phone Number" style="padding: 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 1rem; width: 100%;">
                        <textarea placeholder="Your message" rows="4" style="padding: 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 1rem; width: 100%; resize: vertical;"></textarea>
                        <button type="submit" style="padding: 1rem; background: var(--secondary-color); color: var(--white); border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: background 0.3s ease;">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
