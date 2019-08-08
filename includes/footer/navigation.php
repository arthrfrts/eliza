<?php
/*
    The Meta Menu.
*/
?>
<?php if( has_nav_menu( 'footer-menu' ) ): ?>
  <nav class="footer-menu" id="footer-menu-container">
    <?php wp_nav_menu( array(
      'theme_location'  => 'footer-menu',
      'menu_id'        => 'footer-menu'
    ) ); ?>
  </nav>
<?php endif; ?>
