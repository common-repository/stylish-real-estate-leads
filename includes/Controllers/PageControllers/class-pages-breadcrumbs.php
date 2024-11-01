<?php

namespace SREL_Calculator_Lib\Controllers\PageControllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * * Main class for all pages, the page classes inherit this class
 * todo: here must be enqueue most of the js and css
 */

class PagesBreadcrumbs {
	public $is_premium_version_active = false;
	public function __construct() {
			$this->is_premium_version_active = defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' );
		if ( is_admin() ) {
			wp_register_style( 'srel-bootstrap-css', SREL_MORTGAGE_CALCULATOR_URL . '/assets/lib/bootstrap/bootstrap.min.css' );
			wp_enqueue_style( 'srel-bootstrap-css' );
			wp_register_style( 'srel-icons-css', SREL_MORTGAGE_CALCULATOR_URL . '/assets/css/icons.min.css' );
			wp_enqueue_style( 'srel-icons-css' );
			wp_register_style( 'srel-style-css', SREL_MORTGAGE_CALCULATOR_URL . '/backend/src/css/backend.css' );
			wp_enqueue_style( 'srel-style-css' );
			wp_register_script( 'srel-bootstrap-js', SREL_MORTGAGE_CALCULATOR_URL . '/assets/lib/bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), '4.5.2', true );
			wp_register_script( 'srel-swal-js', SREL_MORTGAGE_CALCULATOR_URL . '/assets/lib/sweet-alert/sweetalert2.all.min.js', array(), '11.4.37', true );
			// Enqueue the color picker scripts
			wp_enqueue_script( 'wp-color-picker' );
			// Enqueue the color picker styles
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_media();
			wp_register_script( 'srel-backend-js', ( $this->is_premium_version_active ? SREL_MORTGAGE_CALCULATOR_PREMIUM_URL : SREL_MORTGAGE_CALCULATOR_URL ) . '/backend/src/js/backend.js', array( 'jquery' ), '4.5.2', true );
			wp_enqueue_script( 'srel-bootstrap-js' );
			wp_enqueue_script( 'srel-backend-js' );
			wp_enqueue_script( 'srel-swal-js' );
		}
	}
}
