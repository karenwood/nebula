<?php
/**
 *
 * @package Nebula
 * @author  Karen Wood
 * @license GPL-2.0+
 * @link    http://www.karenwood.co/nebula
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );

/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.0
 */



function genesis_404() {

	echo "<div class='content-wrap' style='padding-top:40px;'><div class='front-font'>Oh dear.</div><div class='home-page-subtitle'>This isn't the droid you're looking for.</div><div class='underline' style='margin-top:20px;'></div><p class='center'><a href='http://karenwood.co'>Head back to the homepage</a></p></div>";

		

}

genesis();
