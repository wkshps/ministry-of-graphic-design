<?php

function fikra_assets() {
  $fikra_version = '1.8';
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", null, null, false);
    wp_enqueue_script('jquery');
  }
  wp_enqueue_style('fikra-style', get_stylesheet_uri(), null, $fikra_version);
  wp_enqueue_script('fikra-scripts-body', get_template_directory_uri() . '/js/fikra.min.js', null, $fikra_version, false);
}
add_action('wp_enqueue_scripts', 'fikra_assets');

add_theme_support('post-thumbnails');

function fikra_register_menu() {
  register_nav_menu('main-menu',__('Main Menu'));
  register_nav_menu('main-menu-arabic',__('Main Menu (Arabic)'));
}
add_action('init', 'fikra_register_menu');

add_image_size('fikra_small', 800, 800, false);
add_image_size('fikra_full', 2200, 1600, false);
add_image_size('fikra_fragment', 1600, 1600, true);
if (function_exists('set_image_size_quality')) {
  set_image_size_quality('fikra_small', 55);
  set_image_size_quality('fikra_full', 55);
  set_image_size_quality('fikra_fragment', 50);
}

add_filter('wp_calculate_image_srcset', '__return_false');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

?>
