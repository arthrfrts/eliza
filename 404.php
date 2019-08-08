<?php
/*
    The Not Found Page Template
*/
?>

<?php get_header(); ?>

    <main class="content-area">
      <article id="post-0" class="post error404 not-found">
        <header class="entry-header">
          <h1 class="entry-title">
            <?php esc_html_e( 'Not Found.', 'eliza' ); ?>
        </header>
        <div class="entry-content">
          <p><?php esc_html_e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'eliza' ); ?></p>

          <?php get_search_form(); ?>
        </div>
      </article>
    </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
