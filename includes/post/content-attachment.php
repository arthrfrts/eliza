<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <figure>
    <?php if( wp_attachment_is_image() ): ?>
    <?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>

    <?php if( has_excerpt() ): ?>
      <figcaption>
        <?php the_excerpt(); ?>
      </figcaption>
    <?php endif; ?>
  <?php endif; ?>
  </figure>

<footer class="entry-footer">
	<?php
		$metadata = wp_get_attachment_metadata();

    printf(
      esc_html_x( 'This image was posted on %1$s at &ldquo;%2$s&rdquo;. The full image is %3$s.', '1: post date, 2: post title, 3: image original dimensions', 'eliza' ),
      '<time class="entry-date" datetime="'. get_the_date( 'c' ).'">' . get_the_date() . '</time>',
      '<a href="' . esc_url( get_permalink( $post->post_parent ) ) . '" rel="gallery">' . strip_tags( get_the_title( $post->post_parent ) ) . '</a>',
      $metadata['width'] . ' &times; ' . $metadata['height']
    ); ?>
</footer>
</div>
