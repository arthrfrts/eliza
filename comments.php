<?php
/*
  # The Comments Template.
    There's a lot going on here.
*/

// First, if the content is password protected, let's *not* load comments.
if( post_password_required() ):
  return;
endif;

// Now, if there are comments to display, and/or if the comments are open for this content, we'll show the comment list and/or the new comment form.
if( have_comments() || comments_open() ): ?>
<section id="comments" class="comments-area">

<?php
  // But first let's get the comments count. It will help us ahead.
  $comments_count = get_comments_number();

  // And _now_ we'll show the comments.
  if( have_comments() ): ?>

      <h2 class="comments-title"><?php esc_html_e( 'Comments', 'eliza' ); ?></h2>

      <ol class="comments-list">
        <?php
  				wp_list_comments( array(
  					'style'      => 'ol',
  					'short_ping' => true,
  				) );
  			?>
      </ol>

      <?php the_comments_navigation(); ?>
  <?php
    // If comments aren't open anymore, show a note.
    if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'eliza' ); ?></p>
    <?php
    endif;
  endif;
  comment_form();
  ?>

</section>
<?php endif;
