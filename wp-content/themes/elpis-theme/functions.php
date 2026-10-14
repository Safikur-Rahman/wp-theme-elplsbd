<?php
function elpis_bd_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'elpis_bd_setup');

function elpis_bd_scripts() {
    wp_enqueue_style('elpis-bd-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'elpis_bd_scripts');

require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/contact-system.php';
require_once get_template_directory() . '/inc/careers-system.php';

if (!function_exists('elpis_is_dark_color')) {
    function elpis_is_dark_color($hex) {
        if (empty($hex) || $hex === 'transparent') return false;
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (strlen($hex) != 6) return false;
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $lum = ($r * 299 + $g * 587 + $b * 114) / 1000;
        return $lum < 140;
    }
}

