<?php
/*
  # Theme Tweak
    Custom functions that act independently of the theme templates.
*/

// Shows home link on main menu.
function eliza_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'eliza_page_menu_args' );

// Adds custom body classes.
function eliza_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
  	if ( ! is_singular() ) {
  		$classes[] = 'hfeed';
  	}

    return $classes;
}
add_filter( 'body_class', 'eliza_body_classes' );

// Adds pingback URL.
function eliza_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '" />';
	}
}
add_action( 'wp_head', 'eliza_pingback_header' );

// Calls the next and prev image links in a gallery and appends the content section ID.
function eliza_enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
        return $url;

    $image = get_post( $id );
    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#content-container';

    return $url;
}
add_filter( 'attachment_link', 'eliza_enhanced_image_navigation', 10, 2 );

// Creates a new class for the first post from a loop.
function eliza_mark_first_post( $classes ) {
  remove_filter( current_filter(), __FUNCTION__ );
  $classes[] = 'first-post';
  return $classes;
}
add_filter( 'post_class', 'eliza_mark_first_post' );

// Verifies if attachment is a certain media type.
function eliza_is_media( $media_type, $post_id ) {
  $mime_type = get_post_mime_type( $post_id );

  if( strpos($mime_type, $media_type) !== false ):
    return true;
  else:
    return false;
  endif;
}
