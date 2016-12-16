<?php

/**
 * Front page template
 *
 * @package 		Nebula
 * @author 			Karen Wood
 * @link 			http://www.karenwood.co
 * @copyright 		Copyright (c) 2016, Karen Wood
 * @license			GPL-2.0+
 */

add_action( 'genesis_meta', 'nebula_home_page_setup' );
/**
 * Set up the homepage layout by conditionally loading sections when widgets are active.
 *
 * @since 1.0.0
 */
function nebula_home_page_setup() {

	$home_sidebars = array(
		'full_image'		=> is_active_sidebar( 'full-image' ),
		'home_welcome'		=> is_active_sidebar( 'home-welcome' ),
		'main_services'		=> is_active_sidebar( 'main-services' ),
		'portfolio_samples'	=> is_active_sidebar( 'portfolio-samples' ),
		'call_to_action'	=> is_active_sidebar( 'call-to-action' ),
		
	);

	// Return early if no sidebars are active.
	if ( ! in_array( true, $home_sidebars ) ) {
		return;
	}

	// Add full width image area if "Full Image" widget area is active.
	if ( $home_sidebars['full_image'] ) {
		add_action( 'genesis_after_header', 'nebula_add_full_image' );
	}

	// Add home welcome area if "Home Welcome" widget area is active.
	if ( $home_sidebars['home_welcome'] ) {
		add_action( 'genesis_after_header', 'nebula_add_home_welcome' );
	}

	// Add main services area if "Main Services" widget area is active.
	if ( $home_sidebars['main_services'] ) {
		add_action( 'genesis_after_header', 'nebula_add_main_services' );
	}

	// Add portfolio samples area if "Portfolio Samples" widget area is active.
	if ( $home_sidebars['portfolio_samples'] ) {
		add_action( 'genesis_after_header', 'nebula_add_portfolio_samples' );
	}

	// Add call to action area if "Call to Action" widget area is active.
	if ( $home_sidebars['call_to_action'] ) {
		add_action( 'genesis_after_header', 'nebula_add_call_to_action' );
	}

	

	// Force full-width-content layout setting.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remove posts.
	remove_action( 'genesis_loop', 'genesis_do_loop' );

}



	/**
	 * Display content for the "Home Welcome" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_home_welcome() {

		genesis_widget_area( 'home-welcome',
			array(
				'before' => '<div class="home-welcome"><div class="wrap">',
				'after' => '</div></div>'
			)
		);
	}

	/**
	 * Display content for the "Main Services" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_main_services() {

			genesis_widget_area( 'main-services',
				array(
					'before' => '<div class="main-services"><div class="wrap">',
					'after' => '</div></div>'
				)
			);
		}


	/**
	 * Display content for the "Main Services" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_portfolio_samples() {

			genesis_widget_area( 'portfolio-samples',
				array(
					'before' => '<div class="portfolio-samples"><div class="wrap">',
					'after' => '</div></div>'
				)
			);
		}	


	/**
	 * Display content for the "Call to Action" section
	 *
	 * @since 1.0.0
	 */
	function nebula_add_call_to_action() {

		genesis_widget_area( 'call-to-action',
			array(
				'before' => '<div class="call-to-action"><div class="wrap">',
				'after' => '</div></div>'
			)
		);
	}

	/**
	 * Display content for the "Full Image" section
	 *
	 * @since 1.0.0
	 */

	function nebula_add_full_image() {
	
	genesis_widget_area( 'full-image', array(
	        'before' => '<div class="full-image widget-area">',
			'after'  => '</div>',
	) );
}
	

genesis();