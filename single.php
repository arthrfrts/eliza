<?php
/*
    # Hello, posts!
*/
?>

<?php get_header(); ?>

      <main class="content-area">
        <?php
          while( have_posts() ): the_post();

            # The Index use an specific content-index.php
            get_template_part( 'includes/post/content', get_post_format() );

            the_post_navigation();

            if ( comments_open() || get_comments_number() ):
      				comments_template();
      			else:
              get_sidebar( 'after-post' );
            endif;

          endwhile;
        ?>
      </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
