<?php
/*
    The Eliza Theme Functions.
*/
if( ! function_exists( 'eliza_setup' ) ) :
  // Sets theme defaults and register features supported by it.
  function eliza_setup() {
    // i18n
    load_theme_textdomain( 'eliza', get_template_directory() . '/languages' );

    // Adds support for feed links.
    add_theme_support( 'automatic-feed-links' );

    // Adds support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

    // Adds support for featured images.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 860, 400, true );

    // Adds support for custom logo
    add_theme_support( 'custom-logo', array(
			'height'      => 150,
      'width'       => 600,
			'flex-width'  => true,
			'flex-height' => false,
      'header-text' => array( 'site-title', 'site-description' ),
		) );

    // Registers the navigation menu.
    register_nav_menus( array(
      'main-menu' =>  esc_html__( 'Main Menu', 'eliza' ),
      'footer-menu' =>  esc_html__( 'Footer Menu', 'eliza' ),
    ) );

    // Adds support for enhanced, modern markup in the following template sections.
    add_theme_support( 'html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    // Adds support for WordPress-generated `<title>` tag.
    add_theme_support( 'title-tag' );

    // Adds initial support for Gutenberg.
    add_theme_support( 'gutenberg', array(
   		'colors' => array(
				'#1A1A1A',
				'#AD5B5B',
				'#F0F0F0',
				'#D1D1D1',
			),
		) );

    // Custom theme tags.
    require( get_template_directory() . '/includes/functions/template-tags.php' );

    // Extra functionalities.
    require( get_template_directory() . '/includes/functions/tweaks.php' );
  }
endif;
add_action( 'after_setup_theme', 'eliza_setup' );

// Sets the content width.
function eliza_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'eliza_content_width',  860);
}
add_action( 'after_setup_theme', 'eliza_content_width', 0 );

// Registers sidebars
function eliza_widgets_init() {
  require get_template_directory() . '/includes/functions/widgets.php';
  register_widget( 'eliza_in_this_section_widget' );
  register_widget( 'eliza_category_widget' );

  register_sidebar( array(
    'name'          =>  esc_html__( 'Sidebar', 'eliza' ),
    'id'            =>  'main-sidebar',
    'description'   =>  esc_html__( 'The main sidebar for the theme, shown in the side of every page.', 'eliza' ),
    'before_widget' =>  '<section class="widget %2$s" id="%1$s">',
    'after_widget'  =>  '</section>',
    'before_title'  =>  '<h1 class="widget-title">',
    'after_title'   =>  '</h1>'
  ) );

  register_sidebar( array(
    'name'          =>  esc_html__( 'Post Widget', 'eliza' ),
    'id'            =>  'after-post',
    'description'   =>  esc_html__( 'A widget area shown after the posts, if the comments are disabled. It\'s a great place to add a contact link!', 'eliza' ),
    'before_widget' =>  '<section class="widget %2$s" id="%1$s">',
    'after_widget'  =>  '</section>',
    'before_title'  =>  '<h1 class="widget-title">',
    'after_title'  =>  '</h1>'
  ) );
}
add_action( 'widgets_init', 'eliza_widgets_init' );

// Enqueue the theme's scripts and styles.
function eliza_scripts() {
  // `style.css`, essential.
	wp_enqueue_style( 'eliza-style', get_stylesheet_uri() );

  // Menu toggle.
  wp_enqueue_script( 'eliza-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20180102', true );
  wp_enqueue_script( 'eliza-responsive-embeds', get_template_directory_uri() . '/assets/js/embeds.js', array(), '20180409', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eliza_scripts' );
