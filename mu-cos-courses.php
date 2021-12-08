<?php
/**
 * MU COS Courses
 *
 * College of Science Course Listing Plugin
 *
 * @package  MU COS Courses
 *
 * Plugin Name:  MU COS Courses
 * Plugin URI: https://www.marshall.edu
 * Description: College of Science Course Listing Plugin
 * Version: 2.0
 * Author: Nick Slate and Christopher McComas
 */

/**
 * Shortcode to display course listings for COS.
 *
 * @param array $atts The array of attributes included with the shortcode.
 * @return string
 */
function mu_cos_courses_shortcode( $atts ) {
	$data = shortcode_atts(
		array(
			'dept' => 'a-z',
		),
		$atts
	);

	$dept_param = trim( strtoupper( $data['dept'] ) );

	$api_url = 'https://netapps.marshall.edu/cosweb/courses/descriptions.php?dept=' . esc_attr( $data['dept'] );

	$request = wp_remote_get( esc_url( $api_url ) );

	if ( is_wp_error( $request ) ) {
		return $request->get_error_message();
	}

	$body         = wp_remote_retrieve_body( $request );
	$courses_json = json_decode( $body );

	$html = '<ul class="cos_courses divide-y divide-gray-200 divide-dotted mt-4">';
	foreach ( $courses_json as $course ) {
		$html .= '<li class="' . esc_attr( $course->Class ) . ' block py-4">';
		$html .= '<div class="title font-semibold">' . esc_attr( $course->subject ) . ' ' . esc_attr( $course->Course ) . ' - ' . esc_attr( $course->Title ) . '</div>';
		$html .= '<div class="mt-1 pl-4">' . esc_attr( $course->Description ) . '</div>';
		$html .= '</li>';
	}
	$html .= '</ul>';
	return $html;
}
add_shortcode( 'mu_cos_courses_new', 'mu_cos_courses_shortcode' );

/**
 * Proper way to enqueue scripts and styles
 */
function mu_cos_courses_scripts() {
	wp_enqueue_style( 'mu-cos-courses', plugin_dir_url( __FILE__ ) . 'css/mu-cos-courses.css', '', true );
	wp_enqueue_style( 'mu-cos-courses-original', plugin_dir_url( __FILE__ ) . 'css/styles.css', '', true );
	wp_enqueue_script( 'mu-cos-courses-js', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array( 'jquery' ), true, true );
}
add_action( 'wp_enqueue_scripts', 'mu_cos_courses_scripts' );
