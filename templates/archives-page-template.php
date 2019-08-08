<?php
/*
Template Name: Archive Template
*/
?>

<?php get_header(); ?>

      <main class="content-area">
        <?php
          while( have_posts() ): the_post();

            get_template_part( 'includes/post/content',  'page' );

            if ( comments_open() || get_comments_number() ) :
      				comments_template();
      			endif;

          endwhile;
        ?>
        <div class="archives-group">
          <section class="categories-archives">
            <h3><?php esc_html_e( 'Categories', 'eliza' ); ?></h3>

            <ul>
            <?php wp_list_categories( array(
              'show_count'  =>  true,
              'title_li'    =>  '',
            ) ); ?>
          </ul>
          </section>

          <section class="monthly-archives">
            <h3><?php esc_html_e( 'Archives', 'eliza' ); ?></h3>

            <?php wp_get_archives( array(
              'type'            =>  'monthly',
              'format'          =>  'html',
              'show_post_count' =>  true,
            ) ); ?>
          </section>
        </div>
      </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
