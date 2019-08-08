<section class="sidebar widget-area">
  <?php if(  !dynamic_sidebar( 'main-sidebar' ) ): ?>
    <?php get_template_part( 'includes/sidebar/default-widgets' ); ?>
  <?php endif; ?>
</section>
