<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">

    <?php if( is_sticky() ): ?>
      <a href="<?php the_permalink(); ?>" rel="bookmark" class="sticky-star">
        <?php echo eliza_get_genericon( 'star', esc_html__( 'Featured', 'eliza' ) ); ?>
      </a>
    <?php endif; ?>

    <?php if( has_post_thumbnail() ): ?>
      <div class="post-thumbnail">
        <?php eliza_post_thumbnail(); ?>
      </div>
    <?php endif;?>

    <?php if( is_singular() ): ?>
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    <?php else: ?>
      <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
    <?php endif; ?>

    <?php eliza_posted_on(); ?>

    <?php eliza_byline(); ?>
  </header>

  <div class="entry-content">
    <?php if( is_singular() ): ?>
      <?php the_content( esc_html__( 'Continue reading&hellip;', 'eliza' ) ); ?>

      <?php wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eliza' ),
        'after'  => '</div>',
      ) ); ?>
    <?php else: ?>
      <?php the_excerpt(); ?>
    <?php endif; ?>
  </div>

    <footer class="entry-footer <?php if( !is_singular() ): ?>hide<?php endif; ?>">
      <?php eliza_post_meta(); ?>
    </footer>
</article>
