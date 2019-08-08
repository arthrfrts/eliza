<?php
/*
    The Search Form
*/
$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<?php eliza_genericon( 'search', esc_attr__( 'Search', 'eliza' ) ); ?>
	</label>
	<input
    type="search"
    id="<?php echo $unique_id; ?>"
    class="search-field"
    placeholder="<?php esc_attr_e( 'Type and hit enter', 'eliza' ); ?>"
    value="<?php echo get_search_query(); ?>"
    name="s" />
</form>
