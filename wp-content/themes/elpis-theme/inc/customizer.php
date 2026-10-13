<?php
// customizer.php
function elpis_bd_customize_register($wp_customize) {
    // 0. Brand Colors Section
    $wp_customize->add_section('brand_colors_section', array(
        'title' => 'Brand Colors',
        'priority' => 20,
        'description' => 'Customize the primary brand accent color used across the entire website.'
    ));
    $wp_customize->add_setting('theme_brand_color', array(
        'default' => '#b8860b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_brand_color', array(
        'label' => 'Primary Brand Color (Gold/Accent)',
        'section' => 'brand_colors_section',
        'description' => 'Updates all buttons, links, active menu items, and accents across the site.'
    )));

    // 0.1 Header Logo Section
    $wp_customize->add_section('header_logo_section', array(
        'title' => 'Header Logo',
        'priority' => 25,
        'description' => 'Upload or change the site logo displayed in the header.'
    ));
    $wp_customize->add_setting('site_logo_image', array(
        'default' => get_template_directory_uri() . '/assets/images/elpis-logo.png'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo_image', array(
        'label' => 'Header Logo Image',
        'section' => 'header_logo_section',
        'description' => 'Upload or select an image to change the header logo.'
    )));
    $wp_customize->add_setting('header_logo_height', array('default' => '46'));
    $wp_customize->add_control('header_logo_height', array(
        'label' => 'Logo Height (px)',
        'section' => 'header_logo_section',
        'type' => 'number'
    ));

    // 1. Hero Section
    $wp_customize->add_section('hero_section', array('title' => 'Hero Section', 'priority' => 30));
    $wp_customize->add_setting('hero_headline', array('default' => 'Lighting the path forward'));
    $wp_customize->add_control('hero_headline', array('label' => 'Headline', 'section' => 'hero_section', 'type' => 'text'));
    $wp_customize->add_setting('hero_subheadline', array('default' => 'One-stop solution for all type IT related issues including Software Development and Digital Marketing which facilitates business leaders to secure sustainable growth.'));
    $wp_customize->add_control('hero_subheadline', array('label' => 'Subheadline', 'section' => 'hero_section', 'type' => 'textarea'));
    $wp_customize->add_setting('hero_image', array('default' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_developer_p3e5.svg'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array('label' => 'Hero Image', 'section' => 'hero_section')));
    $wp_customize->add_setting('hero_bg_color', array(
        'default' => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_bg_color', array(
        'label' => 'Hero Background Color',
        'section' => 'hero_section',
        'description' => 'Customize the background color for the Hero section.'
    )));

    // 1.1 Services & Offers Background Colors Section
    $wp_customize->add_section('services_offers_bg_section', array(
        'title' => 'Services & Offers Backgrounds',
        'priority' => 31,
        'description' => 'Customize background colors and Full Width vs Boxed layouts for Our Services and What We Offer.'
    ));

    // --- OUR SERVICES: HEADER ---
    $wp_customize->add_setting('services_header_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('services_header_layout', array(
        'label' => 'Our Services Header Layout',
        'section' => 'services_offers_bg_section',
        'type' => 'select',
        'choices' => array(
            'boxed' => 'Boxed / Contained (as in photo)',
            'fullwidth' => 'Full Width (Edge-to-Edge)',
        ),
        'description' => 'Choose between Full Width or Boxed layout for the title area.'
    ));

    $wp_customize->add_setting('services_header_bg', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'services_header_bg', array(
        'label' => 'Our Services: Header Background Color',
        'section' => 'services_offers_bg_section',
    )));

    // --- OUR SERVICES: ITEMS ---
    $wp_customize->add_setting('services_items_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('services_items_layout', array(
        'label' => 'Our Services Items Layout',
        'section' => 'services_offers_bg_section',
        'type' => 'select',
        'choices' => array(
            'boxed' => 'Boxed Cards (as in photo)',
            'fullwidth' => 'Full Width Rows (Edge-to-Edge)',
        ),
        'description' => 'Choose between Full Width rows or Boxed cards for service items.'
    ));

    // Service 1 to 5 Individual Backgrounds
    for ($s = 1; $s <= 5; $s++) {
        $default_s_bg = ($s % 2 === 0) ? '#f8fafc' : '#ffffff';
        $wp_customize->add_setting("service_{$s}_bg", array(
            'default' => $default_s_bg,
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "service_{$s}_bg", array(
            'label' => "Service {$s} Background Color",
            'section' => 'services_offers_bg_section',
        )));
    }

    // --- WHAT WE OFFER: HEADER ---
    $wp_customize->add_setting('offer_header_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('offer_header_layout', array(
        'label' => 'What We Offer Header Layout',
        'section' => 'services_offers_bg_section',
        'type' => 'select',
        'choices' => array(
            'boxed' => 'Boxed / Contained (as in photo)',
            'fullwidth' => 'Full Width (Edge-to-Edge)',
        ),
        'description' => 'Choose between Full Width or Boxed layout for the title area.'
    ));

    $wp_customize->add_setting('offer_header_bg', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'offer_header_bg', array(
        'label' => 'What We Offer: Header Background Color',
        'section' => 'services_offers_bg_section',
    )));

    // --- WHAT WE OFFER: ITEMS ---
    $wp_customize->add_setting('offer_items_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('offer_items_layout', array(
        'label' => 'What We Offer Items Layout',
        'section' => 'services_offers_bg_section',
        'type' => 'select',
        'choices' => array(
            'boxed' => 'Boxed Cards (as in photo)',
            'fullwidth' => 'Full Width Rows (Edge-to-Edge)',
        ),
        'description' => 'Choose between Full Width rows or Boxed cards for offer items.'
    ));

    // Offer 1 to 4 Individual Backgrounds
    for ($o = 1; $o <= 4; $o++) {
        $default_o_bg = ($o % 2 === 0) ? '#f8fafc' : '#ffffff';
        $wp_customize->add_setting("offer_{$o}_bg", array(
            'default' => $default_o_bg,
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "offer_{$o}_bg", array(
            'label' => "Offer {$o} Background Color",
            'section' => 'services_offers_bg_section',
        )));
    }

    // 2. Images Section (For all service and offer SVGs)
    $wp_customize->add_section('images_section', array('title' => 'Service & Offer Images', 'priority' => 32));
    
    $default_imgs = [
        'service_1_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/programming_2svr.svg',
        'service_2_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/web_devices_xw3m.svg',
        'service_3_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/mobile_development_8ygq.svg',
        'service_4_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/social_media_marketing_twnp.svg',
        'service_5_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/quality_assurance_7fny.svg',
        'offer_1_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/code_typing_7jnv.svg',
        'offer_2_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/team_collaboration_re_ow29.svg',
        'offer_3_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/work_together_re_5y58.svg',
        'offer_4_img' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/project_completed_re_jr7u.svg'
    ];

    foreach($default_imgs as $id => $url) {
        $wp_customize->add_setting($id, array('default' => $url));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $id, array('label' => str_replace('_', ' ', strtoupper($id)), 'section' => 'images_section')));
    }

    // 3. Careers Section
    $wp_customize->add_section('careers_section', array('title' => 'Careers Section', 'priority' => 32));
    $wp_customize->add_setting('careers_image', array('default' => 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/interview_re_e5jn.svg'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'careers_image', array('label' => 'Careers Image', 'section' => 'careers_section')));
    $wp_customize->add_setting('careers_email', array('default' => 'careers@elpis.bd'));
    $wp_customize->add_control('careers_email', array('label' => 'CV Drop Email', 'section' => 'careers_section', 'type' => 'text'));

    // 5. Leaders Section
    $wp_customize->add_section('leaders_section', array('title' => 'Leaders Section', 'priority' => 33));
    
    $wp_customize->add_setting('leader_1_name', array('default' => 'Md. Omar Faruk Bhuiyan'));
    $wp_customize->add_control('leader_1_name', array('label' => 'Leader 1 Name', 'section' => 'leaders_section', 'type' => 'text'));
    $wp_customize->add_setting('leader_1_title', array('default' => 'Chairman'));
    $wp_customize->add_control('leader_1_title', array('label' => 'Leader 1 Title', 'section' => 'leaders_section', 'type' => 'text'));
    $wp_customize->add_setting('leader_1_subtitle', array('default' => "Owner & Founder\nSSA International"));
    $wp_customize->add_control('leader_1_subtitle', array('label' => 'Leader 1 Subtitle', 'section' => 'leaders_section', 'type' => 'textarea'));
    $wp_customize->add_setting('leader_1_quote', array('default' => '“At ELPIS, we focus on innovation and delivering top-notch technology solutions. Our goal is to create value for clients while fostering a culture of collaboration and growth.”'));
    $wp_customize->add_control('leader_1_quote', array('label' => 'Leader 1 Quote', 'section' => 'leaders_section', 'type' => 'textarea'));
    $wp_customize->add_setting('leader_1_image', array('default' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leader_1_image', array('label' => 'Leader 1 Image', 'section' => 'leaders_section')));

    $wp_customize->add_setting('leader_2_name', array('default' => 'Safoan Bin Rashid'));
    $wp_customize->add_control('leader_2_name', array('label' => 'Leader 2 Name', 'section' => 'leaders_section', 'type' => 'text'));
    $wp_customize->add_setting('leader_2_title', array('default' => 'Managing Director'));
    $wp_customize->add_control('leader_2_title', array('label' => 'Leader 2 Title', 'section' => 'leaders_section', 'type' => 'text'));
    $wp_customize->add_setting('leader_2_quote', array('default' => '“We turn ideas into impactful software solutions. By combining smart strategies with cutting-edge technology, we enlighten the path forward of our business partners so that they can overcome challenges and achieve their goals. Together, we are committed to driving innovation and building lasting relationships with our clients.”'));
    $wp_customize->add_control('leader_2_quote', array('label' => 'Leader 2 Quote', 'section' => 'leaders_section', 'type' => 'textarea'));
    $wp_customize->add_setting('leader_2_image', array('default' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leader_2_image', array('label' => 'Leader 2 Image', 'section' => 'leaders_section')));

    // 6. Contact Section
    $wp_customize->add_section('contact_section', array('title' => 'Contact Section', 'priority' => 35));
    $wp_customize->add_setting('contact_phone', array('default' => '[Add Phone Number]'));
    $wp_customize->add_control('contact_phone', array('label' => 'Phone', 'section' => 'contact_section', 'type' => 'text'));
    $wp_customize->add_setting('contact_email', array('default' => '[Add Email Address]'));
    $wp_customize->add_control('contact_email', array('label' => 'Email', 'section' => 'contact_section', 'type' => 'text'));
    $wp_customize->add_setting('contact_address', array('default' => '[Add Your Address]'));
    $wp_customize->add_control('contact_address', array('label' => 'Address', 'section' => 'contact_section', 'type' => 'textarea'));

    // 6.1 Footer Settings Section
    $wp_customize->add_section('footer_settings_section', array(
        'title' => 'Footer Settings',
        'priority' => 38,
        'description' => 'Customize footer content, contact information, and copyright notice.'
    ));
    $wp_customize->add_setting('footer_desc', array(
        'default' => 'Empowering organizations with cutting-edge enterprise software, cloud infrastructure, and modern digital transformation solutions.'
    ));
    $wp_customize->add_control('footer_desc', array(
        'label' => 'Company Description (Column 1)',
        'section' => 'footer_settings_section',
        'type' => 'textarea'
    ));
    $wp_customize->add_setting('footer_col2_title', array('default' => 'IT Solutions & Links'));
    $wp_customize->add_control('footer_col2_title', array(
        'label' => 'Column 2 Heading',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_col3_title', array('default' => 'Get in Touch'));
    $wp_customize->add_control('footer_col3_title', array(
        'label' => 'Column 3 Heading',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    // Head Office
    $wp_customize->add_setting('footer_address', array('default' => 'Dhaka, Bangladesh'));
    $wp_customize->add_control('footer_address', array(
        'label' => 'Head Office Address',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_address_icon', array('default' => ''));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_address_icon', array(
        'label' => 'Head Office Custom Icon (Upload Image/SVG)',
        'section' => 'footer_settings_section',
        'description' => 'Leave empty to use modern default vector icon.'
    )));

    // Email
    $wp_customize->add_setting('footer_email', array('default' => 'info@elpisbd.com'));
    $wp_customize->add_control('footer_email', array(
        'label' => 'Official Email',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_email_icon', array('default' => ''));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_email_icon', array(
        'label' => 'Email Custom Icon (Upload Image/SVG)',
        'section' => 'footer_settings_section',
        'description' => 'Leave empty to use modern default vector icon.'
    )));

    // Phone
    $wp_customize->add_setting('footer_phone', array('default' => '+880 1XXX-XXXXXX'));
    $wp_customize->add_control('footer_phone', array(
        'label' => 'Support Hotline Phone',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_phone_icon', array('default' => ''));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_phone_icon', array(
        'label' => 'Phone Custom Icon (Upload Image/SVG)',
        'section' => 'footer_settings_section',
        'description' => 'Leave empty to use modern default vector icon.'
    )));

    // Hours
    $wp_customize->add_setting('footer_hours', array('default' => 'Sun - Thu: 10:00 AM - 6:00 PM'));
    $wp_customize->add_control('footer_hours', array(
        'label' => 'Working Hours',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_hours_icon', array('default' => ''));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_hours_icon', array(
        'label' => 'Working Hours Custom Icon (Upload Image/SVG)',
        'section' => 'footer_settings_section',
        'description' => 'Leave empty to use modern default vector icon.'
    )));

    $wp_customize->add_setting('footer_copyright_title', array('default' => 'ELPIS BD'));
    $wp_customize->add_control('footer_copyright_title', array(
        'label' => 'Copyright Company Name',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    $wp_customize->add_setting('footer_copyright_text', array('default' => 'All rights reserved.'));
    $wp_customize->add_control('footer_copyright_text', array(
        'label' => 'Copyright Subtext',
        'section' => 'footer_settings_section',
        'type' => 'text'
    ));
    // 7. Global Image Sizes
    $wp_customize->add_section('image_sizes_section', array('title' => 'Image Sizes (Width & Height)', 'priority' => 40));
    
    // Hero Image Size
    $wp_customize->add_setting('hero_img_max_width', array('default' => '500'));
    $wp_customize->add_control('hero_img_max_width', array('label' => 'Hero Image Max Width (px)', 'section' => 'image_sizes_section', 'type' => 'number'));
    $wp_customize->add_setting('hero_img_height', array('default' => 'auto'));
    $wp_customize->add_control('hero_img_height', array('label' => 'Hero Image Max Height (px or auto)', 'section' => 'image_sizes_section', 'type' => 'text'));
    
    // Service Images Size
    $wp_customize->add_setting('service_img_max_width', array('default' => '500'));
    $wp_customize->add_control('service_img_max_width', array('label' => 'Service Images Max Width (px)', 'section' => 'image_sizes_section', 'type' => 'number'));
    $wp_customize->add_setting('service_img_height', array('default' => 'auto'));
    $wp_customize->add_control('service_img_height', array('label' => 'Service Images Height (px or auto)', 'section' => 'image_sizes_section', 'type' => 'text'));

    // Offer Images Size
    $wp_customize->add_setting('offer_img_max_width', array('default' => '100'));
    $wp_customize->add_control('offer_img_max_width', array('label' => 'Offer Images Max Width (%)', 'section' => 'image_sizes_section', 'type' => 'number'));
    $wp_customize->add_setting('offer_img_height', array('default' => 'auto'));
    $wp_customize->add_control('offer_img_height', array('label' => 'Offer Images Height (px or auto)', 'section' => 'image_sizes_section', 'type' => 'text'));

    // Leader Images Size
    $wp_customize->add_setting('leader_img_width', array('default' => '200'));
    $wp_customize->add_control('leader_img_width', array('label' => 'Leader Image Width (px)', 'section' => 'image_sizes_section', 'type' => 'number'));
    $wp_customize->add_setting('leader_img_height', array('default' => '300'));
    $wp_customize->add_control('leader_img_height', array('label' => 'Leader Image Height (px)', 'section' => 'image_sizes_section', 'type' => 'number'));
    
    // Careers Image Size
    $wp_customize->add_setting('careers_img_max_width', array('default' => '900'));
    $wp_customize->add_control('careers_img_max_width', array('label' => 'Careers Image Max Width (px)', 'section' => 'image_sizes_section', 'type' => 'number'));
    $wp_customize->add_setting('careers_img_height', array('default' => 'auto'));
    $wp_customize->add_control('careers_img_height', array('label' => 'Careers Image Height (px or auto)', 'section' => 'image_sizes_section', 'type' => 'text'));
}
add_action('customize_register', 'elpis_bd_customize_register');
