<?php
/*
    Eliza's Custom Theme Functions
*/

// Return an Genericon SVG markup.
function eliza_get_genericon($icon_id, $icon_title = '', $icon_desc = '') {
  $svg_tag = '<svg class="genericons-neue genericons-neue-' . $icon_id . '">';
  if( $icon_title ) :
    $svg_tag .= '<title>' . $icon_title . '</title>';
  endif;
  if( $icon_desc ) :
    $svg_tag .= '<desc>' . $icon_desc . '</desc>';
  endif;
  $svg_tag .= '<use xmlns:xlink="http://www.23.org/1999/xlink" xlink:href="' . get_template_directory_uri() . '/assets/graphics/genericons-neue.svg#' . $icon_id . '" /></svg>';

  return $svg_tag;
}

// Echoes an Genericon SVG markup.
function eliza_genericon($icon, $icon_title = '', $icon_desc = '') {
  $genericon = eliza_get_genericon( $icon, $icon_title, $icon_desc );

  echo $genericon;
}

// Shows the post publication date information.
if( !function_exists( 'eliza_posted_on' ) ):
  function eliza_posted_on() {
    $time_string = '<time datetime="%1$s" class="entry-date published updated">%2$s</time>';

    // If the post was updated, shows both times:
    if( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ):
      $time_string = '<time datetime="%1$s" class="entry-date published">%2$s</time><time datetime="%3$s" class="updated">%4$s</time>';
    endif;

    $time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

    $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

    echo $posted_on;
  }
endif;

// Shows the post author name and archive link for their posts.
if( !function_exists( 'eliza_byline' ) ):
  function eliza_byline() {
    $author_link = '<span class="entry-author" rel="author"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

    $byline = sprintf( esc_html_x( 'by %s', 'post author', 'eliza' ), $author_link );

    $posted_by = '<span class="bypostauthor">' . $byline . '</span>';

    echo $posted_by;
  }
endif;

// Shows the post meta information.
if( !function_exists( 'eliza_post_meta' ) ):
  function eliza_post_meta() {

    // Only shows category and tag links for posts, not pages.
    if( 'post' == get_post_type() ):
      $categories_list = get_the_category_list( _x( ', ', 'Used as list item separator. There is an space after the comma.', 'eliza' ) );

      $tags_list = get_the_tag_list( '', _x( ', ', 'Used as list item separator. There is an space after the comma.', 'eliza' ) );

      if( $categories_list && $tags_list ):
        printf(
          '<span class="entry-meta">' . esc_html_x( 'Posted in %1$s and tagged with %2$s.', 'Categories (1) and tags (2) assigned to the current post.', 'eliza' ) . '</span>',
          '<span class="categories-links">' . $categories_list . '</span>',
          '<span class="tags-links">' . $tags_list . '</span>'
        );
      else:
         if( !$categories_list && $tags_list ):
           printf(
             '<span class="entry-meta">' . esc_html_x( 'Tagged with %1$s.', 'Tags assigned to the current post.', 'eliza' ) . '</span>',
             '<span class="tags-links">' . $tags_list . '</span>'
           );
         else:

           printf(
             '<span class="entry-meta">' . esc_html_x( 'Posted in %1$s.', 'Categories assigned to the current post.', 'eliza' ) . '</span>',
             '<span class="tags-links">' . $categories_list . '</span>'
           );
         endif;
      endif;
    endif;

    // Shows comment link and counter, but only if it's possible to actually see the post.
    if( !is_singular() && !post_password_required() && ( comments_open() || get_comments_number() ) ):
      echo '<span class="comments-link">';
      comments_popup_link(
        sprintf(
          wp_kses(
            __( 'Leave a comment <span class="assistive-text">on %s</span>', 'eliza' ), array(
              'span'  =>  array(
                'class' =>  array(),
              ),
            )
          ),
          get_the_title()
        )
      );
      echo '</span>';
    endif;

    // Shows edit link
    edit_post_link( esc_html__( '(Edit Post)', 'eliza' ), '<span class="edit-link">', '</span>' );
  }
endif;

if( !function_exists( 'eliza_post_thumbnail' ) ):
  function eliza_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
  		return;
  	}

    if( is_singular() ): ?>
        <?php the_post_thumbnail( 'large' ); ?>
    <?php else: ?>
      <a href="<?php the_permalink(); ?>" aria-hidden="true">
    		<?php
    			the_post_thumbnail(
            'post-thumbnail',
            array(
              'alt' => the_title_attribute( array(
                'echo' => false,
              ) ),
          ) );
        ?>
    	</a>
    <?php endif;
  }
endif;

// Verify if it's the first post of the loop.
function eliza_is_first_post()
{
    static $called = FALSE;

    if ( ! $called )
    {
        $called = TRUE;
        return TRUE;
    }

    return FALSE;
}
