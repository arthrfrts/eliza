<?php
class eliza_in_this_section_widget extends WP_Widget {

  # Constructor
  public function __construct() {
    parent::__construct(
      'eliza_in_this_section_widget',
      esc_html__( 'In This Section', 'eliza' ),
      array(
        'classname'                   =>  'eliza_in_this_section_widget',
        'description'                 =>  esc_html__( 'Display a list of subcategories in the Category archive pages.', 'eliza' ),
        'customize_selective_refresh' =>  true,
      )
    );
  }

  # Outputs the widget
  public function widget( $args, $instance ) {
    if( is_category() ):
      $current_category = get_category( $GLOBALS['cat'] );

      $cat_children = get_terms( 'category', array(
        'parent'    => $current_category->cat_ID,
        'hide_empty' => true,
      ) );

      if( $current_category->category_parent ) :
        $current_category = wp_list_categories( 'orderby=id&show_count=0&title_li=&use_desc_for_title=1&child_of=' . $current_category->category_parent . "&echo=0" );
      else:
        $current_category = wp_list_categories( 'orderby=id&depth=1&show_count=0&title_li=&use_desc_for_title=1&child_of=' . $current_category->cat_ID . "&echo=0" );
      endif;

      if( $cat_children ):
          echo $args['before_widget'];

          if( !empty($instance['title']) ):

            $category_link = esc_url( get_category_link( $category ) );
            $title = '<a class="category-link" href="' . $category_link . '">' . apply_filters( 'widget_title', $instance['title'] ) . '</a>';

            echo $args['before_title'] . $title . $args['after_title'];

          endif; ?>

          <ul>
            <?php echo $current_category; ?>
          </ul>

          <?php echo $args['after_widget'];
        endif;
    endif;
  }

  # Deals with the changing of any settings of the widget.
  function update( $new_instance, $instance ) {
    $instance['title']  = sanitize_text_field( $new_instance['title'] );

		return $instance;
  }

  # Creates the form for this widget in the Dashboard/Customizer.
  function form( $instance ) {
    $title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php esc_html_e('Title:', 'eliza'); ?>
      </label>

      <input
        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
        class="widefat"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
        value="<?php echo esc_attr( $title ); ?>" />
    </p>
   <?php
  }
}

class eliza_category_widget extends WP_Widget {

  # Constructor
  public function __construct() {
    parent::__construct(
      'eliza_category_widget',
      esc_html__( 'Posts from Category', 'eliza' ),
      array(
        'classname'                   =>  'eliza_category_widget',
        'description'                 =>  esc_html__( 'Use this widget to show an specific number of posts from a category.', 'eliza' ),
        'customize_selective_refresh' =>  true,
      )
    );
  }

  # Returns an array of category IDs.
  private function categories_list() {
    $categories = array();
    $categories_array = get_categories();

    foreach( $categories_array as $category ) {
      $categories[] = $category->cat_ID;
    }

    return $categories;
  }

  # Outputs the widget
  public function widget( $args, $instance ) {
    $categories = $this->categories_list();
    $category = isset( $instance['category'] ) && in_array( $instance['category'], $categories ) ? $instance['category'] : get_option( 'default_category' );

    if( get_option( 'eliza_remove_category_from_loop' ) !== $instance['category'] ) {
      update_option( 'eliza_remove_category_from_loop', $instance['category'], 'no' );
    }

    $number = empty( $instance['number'] ) ? 3 : absint( $instance['number'] );
		$title  = apply_filters( 'widget_title', $instance['title'] );

    $category_widget = new WP_Query(
      array(
        'order'           =>  'DESC',
        'posts_per_page'  =>  $number,
        'no_found_rows'   =>  true,
        'post_status'     =>  'publish',
        'tax_query'       =>  array(
          array(
            'taxonomy'  =>  'category',
            'field'     =>  'term_id',
            'terms'     =>  $category,
            'operator'  =>  'IN'
          ),
        ),
      )
    );

    if( $category_widget->have_posts() ):

      echo $args['before_widget'];

      if( !empty($instance['title']) ):

        $category_link = esc_url( get_category_link( $category ) );
        $title = '<a class="category-link" href="' . $category_link . '">' . apply_filters( 'widget_title', $instance['title'] ) . '</a>';

        echo $args['before_title'] . $title . $args['after_title'];
      endif;

      while( $category_widget->have_posts() ):
        $category_widget->the_post(); ?>
        <section <?php post_class(); ?>>
          <a class="entry-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
            <?php if( has_post_thumbnail() ):
              the_post_thumbnail( 'medium' );
            endif; ?>
          </a>
          <?php
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
          printf(
            '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span></span>',
            esc_url( get_permalink() ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
          );
          ?>
        </section>
      <?php endwhile; ?>

      <a class="category-archive-link" href="<?php echo esc_url( get_category_link( $category ) ); ?>">
				<?php
					printf( esc_html__( 'More on %s', 'eliza' ), '<span class="cat_name">' . get_cat_name( $category ) . '</span>' );
				?>
			</a>

      <?php
      echo $args['after_widget'];
      wp_reset_postdata();
    endif;
  }

  # Deals with the changing of any settings of the widget.
  function update( $new_instance, $instance ) {
    $categories = $this->categories_list();
    $instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = empty( $new_instance['number'] ) ? 3 : absint( $new_instance['number'] );

		if ( in_array( $new_instance['category'], $categories ) ) {
			$instance['category'] = $new_instance['category'];
		}

		return $instance;
  }

  # Creates the form for this widget in the Dashboard/Customizer.
  function form( $instance ) {
    $categories = $this->categories_list();
    $title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
    $number = empty( $instance['number'] ) ? 3 : absint( $instance['number'] );
    $category = isset( $instance['category'] ) && in_array( $instance['category'], $categories ) ? $instance['category'] : get_option( 'default_category' ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php esc_html_e('Title:', 'eliza'); ?>
      </label>

      <input
        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
        class="widefat"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
        value="<?php echo esc_attr( $title ); ?>" />
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
        <?php esc_html_e( 'Number of posts to show:', 'eliza' ); ?>
      </label>

      <input
        id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
        type="text" value="<?php echo esc_attr( $number ); ?>"
        size="3" />
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
        <?php esc_html_e( 'Category to show:', 'eliza' ); ?>
      </label>

      <select
        id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"
        class="widefat"
        name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
				<?php foreach( get_categories() as $term ): ?>
          <option value="<?php echo $term->term_id; ?>"<?php selected( $category, $term->term_id ); ?>>
            <?php echo esc_html( $term->name ); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </p>
   <?php
  }
}
