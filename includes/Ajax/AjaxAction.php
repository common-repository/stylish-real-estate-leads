<?php

namespace SREL_Calculator_Lib\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AjaxAction {
	public function __construct() {
		if ( self::is_premium_active() ) {
			return;
		}
		$this->frontend();
		$this->backend();
	}

	public static function add_action( $tag, $function_to_add, $nonpriv = false, $priority = 10, $accepted_args = 1 ) {
		add_action( 'wp_ajax_' . $tag, $function_to_add, $priority = 10, $accepted_args = 1 );
		if ( $nonpriv ) {
			add_action( 'wp_ajax_nopriv_' . $tag, $function_to_add );
		}
		return true;
	}

	public static function frontend() {
		// AjaxAction::addAction('df-srl-email-results-to-user', [AjaxCallbacks::class , 'email_result'], true);
		// AjaxAction::addAction('df-srl-send-data-to-webhook', [AjaxCallbacks::class , 'send_data_to_webhook'], true);
	}
	public static function is_premium_active() {
		return defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' );
	}
	public static function backend() {
		if ( current_user_can( 'manage_options' ) ) {
			AjaxAction::add_action( 'srel_save_settings', array( AjaxCallbacks::class, 'srel_save_settings' ), true );
			AjaxAction::add_action( 'srel_delete_quote', array( AjaxCallbacks::class, 'srel_delete_quote' ), true );
		}

	}
}
