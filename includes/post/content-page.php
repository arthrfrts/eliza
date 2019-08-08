<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">

    <?php if( has_post_thumbnail() ): ?>
      <div class="post-thumbnail">
        <?php eliza_post_thumbnail(); ?>
      </div>
    <?php endif;?>

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header>

  <div class="entry-content">
    <?php the_content(); ?>

    <?php wp_link_pages( array(
      'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eliza' ),
      'after'  => '</div>',
    ) ); ?>
  </div>
</article>
