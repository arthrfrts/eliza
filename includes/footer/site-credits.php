<div class="site-info" role="contentinfo">
  <p>
    <?php
      $wordpress_link = '<a href="' .  esc_url( 'https://wordpress.org/' ) . '" title="' . esc_attr__( 'Semantic Tool for Personal Publication', 'eliza' ) . '">' . esc_html__( 'WordPress', 'eliza' ) . '</a>';

      echo sprintf( esc_html__( 'Powered by %1$s.', 'eliza' ), $wordpress_link );
    ?>

    <?php
      $designer_svg = '<a href="' . esc_url( 'https://arthr.me/' ) . '" title="' . esc_attr__( 'Front-end developer and WordPress consultant', 'eliza' ) . '">Arthur Freitas</a>';

      echo sprintf( esc_html__( 'Made by %1$s.', 'eliza' ), $designer_svg);
    ?>
  </p>
</div>
