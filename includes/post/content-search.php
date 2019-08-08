<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">

    <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

    <?php if( 'post' === get_post_type() ): ?>
      <?php eliza_posted_on(); ?>
      <?php eliza_byline(); ?>
    <?php endif; ?>
  </header>

  <div class="entry-content">
    <?php the_excerpt(); ?>
  </div>

  <?php if( 'post' === get_post_type() ): ?>
  <footer class="entry-footer">
    <?php
      # The meta information will be printed in the HTML, but we will hide it with CSS.
      eliza_post_meta();
    ?>
  </footer>
  <?php endif; ?>
</article>
