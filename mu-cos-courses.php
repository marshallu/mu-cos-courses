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

	$transient_name = 'mu-cos-courses-' . esc_attr( $dept_param );

	if ( false === get_transient( $transient_name ) ) {

		$api_url = 'https://netapps.marshall.edu/cosweb/courses/descriptions.php?dept=' . esc_attr( $data['dept'] );

		$request = wp_remote_get( esc_url( $api_url ) );

		if ( is_wp_error( $request ) ) {
			return $request->get_error_message();
		}

		$body         = wp_remote_retrieve_body( $request );
		$courses_json = json_decode( $body );
		set_transient( $transient_name, $courses_json, 3600 );
	} else {
		$courses_json = get_transient( $transient_name );
	}

	$html = '<div role="list" class="cos_courses divide-y divide-gray-200 divide-dotted mt-4 list-none">';
	foreach ( $courses_json as $course ) {
		if ( 'current' === $course->Class ) {
			$html .= '<div role="listitem" class="' . esc_attr( $course->Class ) . ' block py-4 px-4">';
			$html .= '<div class="title font-semibold">' . esc_attr( $course->Subject ) . ' ' . esc_attr( $course->Course ) . ' - ' . esc_attr( $course->Title ) . '</div>';
			$html .= '<div class="mt-1 pl-4">' . esc_attr( $course->Description ) . '</div>';
			$html .= '</div>';
		} else {
			$html .= '<div role="listitem" class=" bg-gray-100 ' . esc_attr( $course->Class ) . ' block py-4 px-4 hidden">';
			$html .= '<div class="title font-semibold">' . esc_attr( $course->Subject ) . ' ' . esc_attr( $course->Course ) . ' - ' . esc_attr( $course->Title );
			$html .= '<span class="ml-2 inline bg-gray-800 text-gray-200 font-bold px-2 py-1 rounded uppercase text-xs mt-4">Archived</span>';
			$html .= '</div>';
			$html .= '<div class="mt-1 pl-4">' . esc_attr( $course->Description ) . '</div>';
			$html .= '</div>';
		}
	}
	$html .= '</div>';
	return $html;
}
add_shortcode( 'mu_cos_courses', 'mu_cos_courses_shortcode' );

/**
 * Proper way to enqueue scripts and styles
 */
function mu_cos_courses_scripts() {
	wp_enqueue_style( 'mu-cos-courses', plugin_dir_url( __FILE__ ) . 'css/mu-cos-courses.css', array(), filemtime( plugin_dir_path( __FILE__ ) . 'css/mu-cos-courses.css' ), 'all' );
	wp_enqueue_style( 'mu-cos-courses-original', plugin_dir_url( __FILE__ ) . 'css/styles.css', array(), filemtime( plugin_dir_path( __FILE__ ) . 'css/styles.css' ), 'all' );
	wp_enqueue_script( 'mu-cos-courses-js', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array( 'jquery' ), true, true );
}
add_action( 'wp_enqueue_scripts', 'mu_cos_courses_scripts' );
