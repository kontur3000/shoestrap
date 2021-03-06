<?php

if ( !function_exists( 'shoestrap_user_css' ) ) :
/*
 * echo any custom CSS the user has written to the <head> of the page
 */
function shoestrap_user_css() {
  $header_scripts = shoestrap_getVariable( 'user_css' );
  
  if ( trim( $header_scripts ) != '' )
    wp_add_inline_style( 'shoestrap_css', $header_scripts );
}
endif;
add_action( 'wp_enqueue_scripts', 'shoestrap_user_css', 101 );


if ( !function_exists( 'shoestrap_user_js' ) ) :
/*
 * echo any custom JS the user has written to the footer of the page
 */
function shoestrap_user_js() {
  $footer_scripts = shoestrap_getVariable( 'user_js' );

  if ( trim( $footer_scripts ) != '' )
    echo '<script id="core.advanced-user-js">' . $footer_scripts . '</script>';
}
endif;
add_action( 'wp_footer', 'shoestrap_user_js', 200 );


if ( !function_exists( 'shoestrap_change_upload_folder' ) ) :
/*
 * change upload folder to /media
 * NOTICE: by that any media in 'wp-content/uploads' won't be accessible
 */
function shoestrap_change_upload_folder() {
  $option_name    = 'upload_path';
  $default_value  = 'wp-content/uploads';

  if ( shoestrap_getVariable( 'upload_folder' ) == 1 ) {
    update_option( 'uploads_use_yearmonth_folders', 0 );
    $new_value = 'media';
    
    if ( ( get_option( $option_name ) !== false ) && ( !is_multisite() ) )
      update_option( $option_name, $new_value );

  } else {
    update_option( $option_name, $default_value );
  }
}
endif;
add_action( 'wp', 'shoestrap_change_upload_folder' );


// Show or hide the adminbar
if ( shoestrap_getVariable( 'advanced_wordpress_disable_admin_bar_toggle' ) == 0 )
  show_admin_bar( false );
else
  show_admin_bar( true );


if ( !function_exists( 'shoestrap_excerpt_more' ) ) :
function shoestrap_excerpt_more( $more ) {
  $continue_text = shoestrap_getVariable( 'post_excerpt_link_text' );
  return ' &hellip; <a href="' . get_permalink() . '">' . $continue_text . '</a>';
}
endif;
add_filter('excerpt_more', 'shoestrap_excerpt_more');
