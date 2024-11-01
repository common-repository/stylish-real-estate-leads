<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'df_srel_get_file_version' ) ) {
	/**
	 * Get the version of a file
	 *
	 * @param string $file_path
	 *
	 * @return string
	 */
	function df_srel_get_file_version( $file_path ) {
		$version = SREL_MORTGAGE_CALCULATOR_VERSION;
		if ( file_exists( $file_path ) && SREL_MORTGAGE_CALCULATOR_BETA === true ) {
			$version = $version . '.' . filemtime( $file_path );
		}
		return $version;
	}
}

/**
 * Recursive sanitation for text or array
 * from https://wordpress.stackexchange.com/questions/24736/wordpress-sanitize-array
 *
 * @param $array_or_string (array|string)
 * @since  0.1
 * @return mixed
 */
if ( ! function_exists( 'srel_sanitize_text_or_array_field' ) ) {
	function srel_sanitize_text_or_array_field( $array_or_string ) {
		if ( is_string( $array_or_string ) ) {
			$array_or_string = sanitize_text_field( $array_or_string );
		} elseif ( is_array( $array_or_string ) ) {
			foreach ( $array_or_string as $key => &$value ) {
				if ( is_array( $value ) ) {
					$value = srel_sanitize_text_or_array_field( $value );
				} else {
					$value = sanitize_text_field( $value );
				}
			}
		}

		return $array_or_string;
	}
}
