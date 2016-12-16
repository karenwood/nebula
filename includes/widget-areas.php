<?php

/**
 * Register widget areas
 *
 * @package 		Nebula
 * @author 			Karen Wood
 * @link 			http://www.karenwood.co
 * @copyright 		Copyright (c) 2016, Karen Wood
 * @license			GPL-2.0+
 */

		//* Register front page widget areas
		
		genesis_register_sidebar( array(
			'id'            => 'home-welcome',
			'name'          => __( 'Home Welcome', 'nebula' ),
			'description'   => __( 'This is a home widget area that will show on the front page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'            => 'main-services',
			'name'          => __( 'Main Services', 'nebula' ),
			'description'   => __( 'This is a main services list widget area that will show on the front page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'            => 'portfolio-samples',
			'name'          => __( 'Portfolio Samples', 'nebula' ),
			'description'   => __( 'This is a sample of portfolio items widget area that will show on the front page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'            => 'call-to-action',
			'name'          => __( 'Call to Action', 'nebula' ),
			'description'   => __( 'This is a call to action widget area that will show on the front page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
    		'id' 			=> 'full-image',
		    'name' 			=> __( 'Full Image', 'nebula' ),
		    'description'	=> __( 'This is a full width widget area that will show on the front page.', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'		=> 'blog-title',
			'name'		=> __( 'Blog Title', 'nebula' ),
			'description'	=> __( 'This is the widget area for a search title and subtitle on the blog page', 'nebula' ),
		) );	

		genesis_register_sidebar( array(
			'id'		=> 'blog-search',
			'name'		=> __( 'Blog Search', 'nebula' ),
			'description'	=> __( 'This is the widget area for a search field on the blog page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'		=> 'blog-header',
			'name'		=> __( 'Blog Header', 'nebula' ),
			'description'	=> __( 'This is the widget area for a header image on the blog page', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'            => 'instagram-feed',
			'name'          => __( 'Instagram Feed', 'nebula' ),
			'description'   => __( 'Full width widget area above footer for Instagram feed', 'nebula' ),
		) );

		genesis_register_sidebar( array(
			'id'            => 'portfolio-feed',
			'name'          => __( 'Portfolio Feed', 'nebula' ),
			'description'   => __( 'Full width widget area above footer for Portfolio feed', 'nebula' ),
		) );

		// Register blog sidebar
		//genesis_register_sidebar( array(
		//	'id' => 'blog-sidebar',
		//	'name' => 'Blog Sidebar',
		//	'description' => 'This is the sidebar for blog pages.',
		//) );
		