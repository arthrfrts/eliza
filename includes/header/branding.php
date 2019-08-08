<?php
/*
    Site title and logo.
*/
?>
<div class="site-branding wrapper">
  <?php the_custom_logo(); ?>
  <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

  <?php
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) : ?>
      <span class="site-description"><?php echo $description; ?></span>
  <?php endif; ?>
</div>
