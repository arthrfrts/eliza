<?php
/*
    The Main Menu.
*/
?>
<nav class="main-menu" id="main-menu-container">
  <?php if( has_nav_menu( 'main-menu' ) ): ?>
    <button class="menu-toggle" aria-controls="main-menu" aria-expanded="false"><?php eliza_genericon( 'menu' ); ?><?php esc_html_e( 'Menu', 'eliza' ); ?></button>

    <?php wp_nav_menu( array(
      'theme_location'  => 'main-menu',
      'menu_id'        => 'main-menu'
    ) ); ?>
  <?php endif; ?>
</nav>
