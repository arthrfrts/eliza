<?php
/*
    The Header Template.
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <a class="skip-link assistive-text" href="#content-container"><?php esc_html_e( 'Skip to content', 'eliza' ); ?></a>

    <header class="site-header">
      <div class="access">
        <div class="wrapper">
          <?php get_template_part( 'includes/header/navigation', 'main-menu' ); ?>

          <?php get_search_form(); ?>
        </div>
      </div>

      <?php get_template_part( 'includes/header/branding' ); ?>
    </header>

    <div class="site-content" id="#content-container">
      <div class="wrapper">
