<?php

namespace SREL_Calculator_Lib\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once dirname( __DIR__ ) . '/Controllers/CalculatorsController.php';

class AjaxCallbacks {
	/**Saves the settings */
	public static function srel_save_settings() {
		check_ajax_referer( 'settings-page', 'nonce' );
		$postdata    = self::parse_and_sanitize_settings_input($_POST);
		$settings    = $postdata['data'];
		$emails      = array( 'to', 'cc', 'bcc' );
		$cta_button  = array( 'cta_button_one', 'cta_button_two', 'cta_button_three' );
		$html_fields = array( 'realtor_footer_message', 'email_body' );
		$new_data    = array();
		$id          = sanitize_text_field( $postdata['calcId'] );
		foreach ( $settings as $key => $value ) {
			if ( ! in_array( $key, $emails ) ) {
				$new_data[ $key ] = sanitize_text_field( $value );
			} else {
				$new_data[ $key ] = $value;
			}
			if ( in_array( $key, $cta_button ) ) {
				$new_data[ $key ] = srel_sanitize_text_or_array_field( $value );
			}
			if ( in_array( $key, $html_fields ) ) {
				$new_data[ $key ] = wp_unslash( wp_kses( $value, SREL_ALLOWTAGS ) );
			}
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'df_srel_calculators';
		$data       = array(
			'settings' => wp_json_encode( $new_data ),
		);
		$where      = array( 'id' => $id );
		$wpdb->update( $table_name, $data, $where );
		if ( $wpdb->rows_affected ) {
			wp_send_json_success( 'Settings saved.' );
		} else {
			wp_send_json_error( 'Settings not saved.' );
		}
	}
	/** Input sanitizer for multi dimentional array  */
	private static function parse_and_sanitize_settings_input( $input_array ) {
		if (is_array($input_array)) {
			// Loop through the array
			foreach ($input_array as $key => &$value) {
				// If the value is an array, recurse
				if (is_array($value)) {
					$value = self::parse_and_sanitize_settings_input($value);
				} else {
					// Sanitize the value. You can adjust the sanitization method based on the expected data type.
					// In this example, we're assuming a string
					$value = sanitize_text_field($value);
				}
			}
		}
		return $input_array;
	}
	/** Programatically creating a post/page to embed the calculator  */
	public static function srel_create_new_page_with_embed() {
		check_ajax_referer( 'srel-create-new-page', 'nonce' );
		$post_type = sanitize_text_field( $_POST['post_type'] );
		$args = array(
			'post_title'   => wp_strip_all_tags( $_POST['title'] ),
			'post_content' => sanitize_text_field( $_POST['shortcode'] ),
			'post_status'  => 'draft',
			'post_author'  => get_current_user_id(),
			'post_type'    => $post_type ? $post_type : 'page',
		);

		$post_id = wp_insert_post( $args );

		if ( $post_id ) {
			wp_send_json_success( 'Post created successfully.' );
		} else {
			wp_send_json_error( 'Post not created.' );
		}

	}
}
