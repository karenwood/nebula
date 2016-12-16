<?php

/**
 * Blog main page template
 *
 * @package 		Nebula
 * @author 			Karen Wood
 * @link 			http://www.karenwood.co
 * @copyright 		Copyright (c) 2016, Karen Wood
 * @license			GPL-2.0+
 */



add_action( 'genesis_meta', 'nebula_blog_page_setup' );
/**
 * Set up the homepage layout by conditionally loading sections when widgets are active.
 *
 * @since 1.0.0
 */
function nebula_blog_page_setup() {

	$blog_sidebars = array(
		'blog_search'		=> is_active_sidebar( 'blog-search' ),
			
	);

	// Return early if no sidebars are active.
	if ( ! in_array( true, $blog_sidebars ) ) {
		return;
	}

	// Add full width image area if "Full Image" widget area is active.
	if ( $blog_sidebars['blog_search'] ) {
		add_action( 'genesis_before_content', 'nebula_add_blog_header' );
		add_action( 'genesis_before_content', 'nebula_add_blog_title');
		add_action( 'genesis_before_content', 'nebula_add_blog_search' );
	}

/**
	 * Display content for the "Blog Title" section
	 *
	 * @since 1.0.0
	 */
function nebula_add_blog_title() {

		genesis_widget_area( 'blog-title',
			array(
				'before' => '<div class="blog-title"><div class="wrap">',
				'after' => '</div></div>'
			)
		);
	}

/**
	 * Display content for the "Blog Search" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_blog_search() {

		genesis_widget_area( 'blog-search',
			array(
				'before' => '<div class="blog-search"><div class="wrap">',
				'after' => '</div></div>'
			)
		);
	}

	/**
	 * Display content for the "Blog Header" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_blog_header() {

		genesis_widget_area( 'blog-header',
			array(
				'before' => '<div class="full-image"><div class="wrap">',
				'after' => '</div></div>'
			)
		);
	}




// Unregister secondary sidebar.
//dynamic_sidebar('sidebar');

//do_action( 'genesis_sidebar_alt' );
//add_filter( 'genesis_before_entry', 'genesis_sidebar_alt' );


//* Show page content above posts

//* Remove the post meta function for front page only
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );

//* Remove sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );


//* Add new image sizes
add_image_size('grid-thumbnail', 300, 300, TRUE);

//* Add support for Genesis Grid Loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_grid_loop_helper' );
function child_grid_loop_helper() {
  if ( function_exists( 'genesis_grid_loop' ) ) {
		genesis_grid_loop( array(
			'features' => 1,
			'feature_image_size' => 'featured-image',
			'feature_image_class' => 'featured-image',
			'feature_content_limit' => 200,
			'grid_image_size' => 'grid-thumbnail',
			'grid_image_class' => 'post-image',
			'grid_content_limit' => 110,
			'more' => __( 'Read more', 'nebula' ),
		) );
	} else {
		genesis_standard_loop();
	}
}
}

genesis();