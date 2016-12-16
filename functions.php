<?php

/**
 * Theme customizations
 *
 * @package 		Nebula
 * @author 			Karen Wood
 * @link 			http://www.karenwood.co
 * @copyright 		Copyright (c) 2016, Karen Wood
 * @license			GPL-2.0+
 */

// Load child theme textdomain
load_child_theme_textdomain( 'nebula' );

add_action( 'genesis_setup', 'nebula_setup', 15 );
/**
 * Theme setup
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below in this setup function.
 *
 * @since 1.0.0
 */


function nebula_setup() {

	// Define theme constants.
	define( 'CHILD_THEME_NAME', 'Nebula' );
	define( 'CHILD_THEME_URL', 'http://www.karenwood.co/nebula' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );

	// Add HTML5 markup constants.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );
		
	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );
		
	// Add theme support for accessibility.
	add_theme_support( 'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	) );
	
	// Add theme support for footer widgets.
	add_theme_support( 'genesis-footer-widgets', 1 );

	// Unregister layouts that use secondary sidebar.
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Unregister secondary sidebar.
	unregister_sidebar( 'sidebar-alt');

	// Add theme widget areas.
	include_once( get_stylesheet_directory() . '/includes/widget-areas.php' );


	//* Remove the site description
	remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


	//Custom credits
	function wpb_footer_creds_text () {
 	$copyright = '<div class="creds"><p>Copyright &copy; ' . date('Y') . ' <a href="https://www.karenwood.co/">Karen Wood</a> | All Rights Reserved | <a href="/privacy-policy">Privacy Policy</a> | <a href="/nebula">Nebula</a> is coded with <i class="fa fa-heart" aria-hidden="true"></i> using Genesis</p></div>';
	return $copyright;
 	}

 	add_filter( 'genesis_footer_creds_text', 'wpb_footer_creds_text' );

	//* Remove the edit link
	add_filter ( 'genesis_edit_post_link' , '__return_false' );


	//* Add clickable logo to header	
		add_action( 'genesis_header', 'nebula_site_image', 5 );
			function nebula_site_image() {
			$header_image = '<img src="http://karenwood.co/assets/karen-wood-logo-duo.png" alt="Karen Wood logo" />';
			printf( '<a href="http://www.karenwood.co"><div class="site-image">%s</div></a>', $header_image );
		}

	
	//* Add Instagram feed to About page

	add_action( 'genesis_after_content_sidebar_wrap', 'nebula_instagram_feed' );

	function nebula_instagram_feed() {
		if ( is_page('about')) {
			genesis_widget_area( 'instagram-feed', array(
				'before' => '<div class="instagram-feed">',
				'after' => '</div>',
			) );
		}
	}

	//* Add portfolio feed to portfolio single page

	add_action( 'genesis_after_content_sidebar_wrap', 'nebula_portfolio_feed' );

	function nebula_portfolio_feed() {
		if ( is_page( array( 'friends-of-the-earth', 'pierce-services-solutions', 'vegan-food-magazine', 'swirl-brand' ) )  ){
			genesis_widget_area( 'portfolio-feed', array(
				'before' => '<div class="portfolio-feed">',
				'after' => '</div>',
			) );
		}
	}

/** Add featured image as header for page or post

	/** Add the featured image section */
	add_action( 'genesis_after_header', 'full_featured_image' );
	function full_featured_image() {
		if ( is_singular( array( 'post', 'page' ) ) && has_post_thumbnail() ){
			echo '<div id="full-image">';
			echo get_the_post_thumbnail($thumbnail->ID, 'header');
			echo '</div>';
		}
	}

	/** Add parallax full-width image to page or post */
	/*add_action( 'genesis_after_header', 'parallax_design' );
	function parallax_design() {
		if ( is_page( 'design' ) ){
			echo '<div class="parallax-window" data-parallax="scroll" data-image-src="/assets/blog-header-2.jpg">';
			echo '</div>';
		}
	}*/

	/** Add parallax full-width image to top of any page or post using Custom Fields */
	add_action( 'genesis_after_header', 'nebula_parallax_header' );
	function nebula_parallax_header() {
		if ( is_singular( array('post', 'page')) ) {
		$url = get_post_meta( get_the_ID(), 'nebula_parallax_header', true );
			if($url) {
			echo '<div class="parallax-window" data-parallax="scroll" data-image-src="' . $url . '"></div>';
			    }
		  }
	}


	/** Add new image sizes */
	//add_image_size( 'header', 1600, 9999, TRUE );

	// Add custom opening div for first post title on blog page
		add_action( 'genesis_entry_header', 'nebula_do_post_title_before', 7 );
		function nebula_do_post_title_before() {
			if ( is_home() ) {
				echo '<div class="custom-title">';
			}
		}

	// Add custom closing div for first post title on blog page
		add_action( 'genesis_entry_header', 'nebula_do_post_title_after' );
		function nebula_do_post_title_after() {
			if ( is_home() ) {
				echo '</div>';
			}
		}

	//* Customize search form input box text
		add_filter( 'genesis_search_text', 'nebula_search_text' );
		function nebula_search_text( $text ) {
			return esc_attr( 'What are you looking for?' );
		}


	//* COMMENTS **//

	//* Modify comments title text in comments
	add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
	function sp_genesis_title_comments() {
		$title = '<h3>Discussion</h3>';
		return $title;
	}

	/* Show date on comments without time or link */
	add_filter( 'genesis_show_comment_date', 'nebula_show_comment_date_only' );
	function nebula_show_comment_date_only( $comment_date ) {
		printf('<p %s><time %s>%s</time></p>',
			genesis_attr( 'comment-meta' ),
			genesis_attr( 'comment-time' ),
			esc_html( get_comment_date() )
		);
		// Return false so that the parent function doesn't output the comment date, time and link
		return false;
	}

	


	/* Add jQuery */
	if (!is_admin()) add_action("wp_enqueue_scripts", "nebula_jquery_enqueue", 11);
		function nebula_jquery_enqueue() {
		   wp_deregister_script('jquery');
		   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", false, null);
		   wp_enqueue_script('jquery');
	}


	/* Add Parallax.js */
	add_action( 'wp_enqueue_scripts', 'nebula_register_load_script' );
	function nebula_register_load_script() {
		wp_register_script( 'parallax-script', get_stylesheet_directory_uri() . '/js/parallax.js-1.4.2/parallax.js' );
		wp_enqueue_script( 'parallax-script' );

	}

	// Add smooth scrolling for anchor links
	add_action( 'wp_enqueue_scripts', 'nebula_enqueue_script' );
	function nebula_enqueue_script() {
		wp_register_script( 'scrolling', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );
	    wp_enqueue_script( 'scrolling' );
	}

	// Enqueue Scripts/Styles for our Lightbox
 	add_action( 'wp_enqueue_scripts', 'nebula_add_lightbox' );
	function nebula_add_lightbox() {
	    wp_enqueue_script( 'fancybox', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.fancybox.pack.js', array( 'jquery' ), false, true );
	    wp_enqueue_script( 'lightbox', get_bloginfo( 'stylesheet_directory' ) . '/js/lightbox.js', array( 'fancybox' ), false, true );
	    wp_enqueue_style( 'lightbox-style', get_bloginfo( 'stylesheet_directory' ) . '/css/jquery.fancybox.css' );
	}
	 



// Add Google Font, Font Awesome stylesheet
add_action( 'wp_enqueue_scripts', 'nebula_enqueue_styles' );
function nebula_enqueue_styles() {
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,700|Roboto+Slab|Oxygen|Trocchi' );	
}
}