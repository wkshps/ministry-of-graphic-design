<?php

function fikra_assets() {
  $fikra_version = '1.93';
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

add_action('init', 'fikra_register_post_types', 9);
function fikra_register_post_types() {
  register_post_type('fikra_projects', array(
    'labels' => array(
      'name' => __('Projects'),
      'singular_name' => __('Project'),
      'all_items' => __('All Projects'),
      'add_new_item' => __('Add New Project'),
      'search_items' => __('Search Projects'),
      'not_found' => __('No projects found'),
      'not_found_in_trash' => __('No projects found in Trash')
    ),
    'capability_type' => 'page',
    'hierarchical' => true,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-art',
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'rewrite' => array('slug' => 'projects')
  ));

  register_post_type('fikra_participants', array(
    'labels' => array(
      'name' => __('Participants'),
      'singular_name' => __('Participant'),
      'all_items' => __('All Participants'),
      'add_new_item' => __('Add New Participants'),
      'search_items' => __('Search Participants'),
      'not_found' => __('No participants found'),
      'not_found_in_trash' => __('No participants found in Trash')
    ),
    'capability_type' => 'page',
    'hierarchical' => true,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-art',
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'rewrite' => array('slug' => 'participants')
  ));
}

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










// ACF Bidirectional relationships
// https://www.advancedcustomfields.com/resources/bidirectional-relationships/

function bidirectional_acf_update_value( $value, $post_id, $field  ) {

  // vars
  $field_name = $field['name'];
  $field_key = $field['key'];
  $global_name = 'is_updating_' . $field_name;


  // bail early if this filter was triggered from the update_field() function called within the loop below
  // - this prevents an inifinte loop
  if( !empty($GLOBALS[ $global_name ]) ) return $value;


  // set global variable to avoid inifite loop
  // - could also remove_filter() then add_filter() again, but this is simpler
  $GLOBALS[ $global_name ] = 1;


  // loop over selected posts and add this $post_id
  if( is_array($value) ) {

    foreach( $value as $post_id2 ) {

      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);


      // allow for selected posts to not contain a value
      if( empty($value2) ) {

        $value2 = array();

      }


      // bail early if the current $post_id is already found in selected post's $value2
      if( in_array($post_id, $value2) ) continue;


      // append the current $post_id to the selected post's 'related_posts' value
      $value2[] = $post_id;


      // update the selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);

    }

  }


  // find posts which have been removed
  $old_value = get_field($field_name, $post_id, false);

  if( is_array($old_value) ) {

    foreach( $old_value as $post_id2 ) {

      // bail early if this value has not been removed
      if( is_array($value) && in_array($post_id2, $value) ) continue;


      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);


      // bail early if no value
      if( empty($value2) ) continue;


      // find the position of $post_id within $value2 so we can remove it
      $pos = array_search($post_id, $value2);


      // remove
      unset( $value2[ $pos] );


      // update the un-selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);

    }

  }


  // reset global varibale to allow this filter to function as per normal
  $GLOBALS[ $global_name ] = 0;


  // return
    return $value;

}

add_filter('acf/update_value/name=relationships', 'bidirectional_acf_update_value', 10, 3);


?>
