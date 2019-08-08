<?php
/*
  # The Index Template
    The most generic template file. It puts together the home page of the site and every other page that hasn't an template attached to it.
*/
get_header(); ?>

      <main class="content-area">

        <?php if( have_posts() ) : ?>
          <header class="page-header">
    				<?php
    					the_archive_title( '<h1 class="page-title">', '</h1>' );
    					the_archive_description( '<div class="archive-description">', '</div>' );
    				?>
    			</header><!-- .page-header -->

          <div class="posts">
            <?php while( have_posts() ): the_post();

              get_template_part( 'includes/post/content', get_post_format() );

            endwhile; ?>
          </div>

          <?php the_posts_navigation(); ?>

        <?php else:

           # If there isn't any posts, we will just show a message.
           get_template_part( 'includes/post/content', 'none' );

        endif; ?>
      </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
