<?php
/*
    # Hello, attachments!
*/
?>

<?php get_header(); ?>

      <main class="content-area">
        <?php
          while( have_posts() ): the_post();

            # The Index use an specific content-index.php
            get_template_part( 'includes/post/content', 'attachment' );

            if ( comments_open() || get_comments_number() ) :
      				comments_template();
      			endif;

          endwhile;
        ?>
      </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
