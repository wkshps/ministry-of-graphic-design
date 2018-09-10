<?php

function workac_assets() {
  $workac_version = '1.2.3';
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", null, null, false);
    wp_enqueue_script('jquery');
  }
  wp_enqueue_style('workac-style', get_stylesheet_uri(), null, $workac_version);
  wp_enqueue_script('workac-scripts-body', get_template_directory_uri() . '/js/workac.min.js', null, $workac_version, false);
}
add_action('wp_enqueue_scripts', 'workac_assets');

add_action('init', 'workac_register_post_types');
function workac_register_post_types() {
  register_post_type('workac_work', array(
    'labels' => array(
      'name' => __('Work'),
      'singular_name' => __('Project'),
      'all_items' => __('All Work'),
      'add_new_item' => __('Add New Project'),
      'search_items' => __('Search Work'),
      'not_found' => __('No work found'),
      'not_found_in_trash' => __('No work found in Trash')
    ),
    'capability_type' => 'page',
    'hierarchical' => true,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-art',
    'taxonomies' => array('category', 'post_tag'),
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'rewrite' => array('slug' => 'work')
  ));
}

add_theme_support('post-thumbnails');

add_image_size('workac_small', 800, 800, false);
add_image_size('workac_full', 2200, 1600, false);
add_image_size('workac_fragment', 1600, 1600, true);
add_image_size('workac_fragment_bw', 1500, 1500, true);
if (function_exists('set_image_size_quality')) {
  set_image_size_quality('workac_small', 55);
  set_image_size_quality('workac_full', 55);
  set_image_size_quality('workac_fragment', 50);
  set_image_size_quality('workac_fragment_bw', 50);
}

add_filter('wp_calculate_image_srcset', '__return_false');

function workac_remove_menus() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'workac_remove_menus');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

function workac_pre_get_posts($query){
  if (is_post_type_archive('workac_work') || $query->is_category() || $query->is_tag() && $query->is_main_query()) {
    if (! is_admin() && is_post_type_archive('workac_work')) {
      $query->set('post_type', array('workac_work'));
      $query->set('meta_key', 'year');
      $query->set('orderby', array('meta_value_num' => 'DESC', 'menu_order' => 'ASC'));
      $query->set('post_status', 'publish');
    } elseif (! is_admin()) {
      $query->set('post_type', array('workac_work'));
      $query->set('meta_key', 'year');
      $query->set('orderby', array('meta_value_num' => 'DESC', 'menu_order' => 'ASC'));
      $query->set('post_status', 'publish');
    }
  }
}
add_action('pre_get_posts', 'workac_pre_get_posts');




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














































function generate_grayscale_image( $meta ) {

  $time = substr( $meta['file'], 0, 7); // Extract the date in form "2015/04"
  $upload_dir = wp_upload_dir( $time ); // Get the "proper" upload dir

  $filename = $meta['sizes']['workac_fragment_bw']['file'];
  $meta['sizes']['workac_fragment_bw']['file'] = grayscale_image( $filename, $upload_dir );

  return $meta;

}

add_filter( 'wp_generate_attachment_metadata', 'generate_grayscale_image' );

function grayscale_image( $filename, $upload_dir ) {

  $original_image_path = trailingslashit( $upload_dir['path'] ) . $filename;

  $image_resource = new Imagick( $original_image_path );
  $image_resource->modulateImage( 150, 0, 100 );
  $image_resource->contrastImage( 20 );

  return save_grayscale_image( $image_resource, $original_image_path );

}

function save_grayscale_image( $image_resource, $original_image_path ) {

  $image_data = pathinfo( $original_image_path );

  $new_filename = $image_data['filename'] . '-grayscale.' . $image_data['extension'];

  $grayscale_image_path = str_replace($image_data['basename'], $new_filename, $original_image_path);

  if ( ! $image_resource->writeImage( $grayscale_image_path ) )
    return $image_data['basename'];

  unlink( $original_image_path ); // Because that file isn't referred to anymore

  return $new_filename;

}


?>
