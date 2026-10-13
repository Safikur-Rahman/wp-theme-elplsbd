<?php
require('D:/xampp/htdocs/eleplsbd/wp-load.php');
$pages = [
    ['title' => 'About Us', 'slug' => 'about-us', 'template' => 'template-about.php'],
    ['title' => 'Services', 'slug' => 'services', 'template' => 'template-services.php'],
    ['title' => 'Careers', 'slug' => 'careers', 'template' => 'template-careers.php'],
    ['title' => 'Contact Us', 'slug' => 'contact-us', 'template' => 'template-contact.php']
];
foreach($pages as $p) {
    $page_check = get_page_by_path($p['slug']);
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post([
            'post_type' => 'page',
            'post_title' => $p['title'],
            'post_name' => $p['slug'],
            'post_status' => 'publish',
        ]);
        update_post_meta($new_page_id, '_wp_page_template', $p['template']);
        echo 'Created ' . $p['title'] . "\n";
    } else {
        update_post_meta($page_check->ID, '_wp_page_template', $p['template']);
        echo 'Updated ' . $p['title'] . "\n";
    }
}
?>
