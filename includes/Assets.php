<?php
namespace SREL_Calculator_Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Scripts and Styles Class
 */
class Assets {

	function __construct() {

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'register' ), 5 );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'register' ), 5 );
		}
	}

	/**
	 * Define the constants
	 *
	 * @return void
	 */
	public function define_constants() {
	}

	/**
	 * Register our app scripts and styles
	 *
	 * @return void
	 */
	public function register() {
		$this->register_scripts( $this->get_scripts() );
		$this->register_styles( $this->get_styles() );
	}

	/**
	 * Register scripts
	 *
	 * @param  array $scripts
	 *
	 * @return void
	 */
	private function register_scripts( $scripts ) {
		foreach ( $scripts as $handle => $script ) {
			$deps          = isset( $script['deps'] ) ? $script['deps'] : false;
			$in_footer     = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
			$version       = isset( $script['version'] ) ? $script['version'] : SREL_MORTGAGE_CALCULATOR_VERSION;
			$inline_script = isset( $script['inline'] ) ? $script['inline'] : false;

			wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );

			if ( $inline_script ) {
				wp_add_inline_script( $handle, $inline_script, 'before' );
			}
		}
	}

	/**
	 * Register styles
	 *
	 * @param  array $styles
	 *
	 * @return void
	 */
	public function register_styles( $styles ) {
		foreach ( $styles as $handle => $style ) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;

			wp_register_style( $handle, $style['src'], $deps, $style['version'] );
		}
	}

	/**
	 * Get all registered scripts
	 *
	 * @return array
	 */
	public static function get_scripts() {
		$scripts = array(
			'srel-mortage-calc-front-comma-number' =>
				array(
					'src'       => SREL_MORTGAGE_CALCULATOR_URL . '/frontend/src/js/comma-number.js',
					'version'   => SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_PATH . '/frontend/src/js/comma-number.js' ) : SREL_MORTGAGE_CALCULATOR_VERSION,
					'in_footer' => true,
				),
			'srel-mortage-calc-front-sweetalert2'  => array(
				'src'       => SREL_MORTGAGE_CALCULATOR_URL . '/assets/lib/sweet-alert/sweetalert2.all.min.js',
				'version'   => SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_PATH . '/assets/lib/sweet-alert/sweetalert2.all.min.js' ) : SREL_MORTGAGE_CALCULATOR_VERSION,
				'in_footer' => true,
			),
			'srel-mortage-calc-front'              => array(
				'src'       => SREL_MORTGAGE_CALCULATOR_URL . '/frontend/src/js/mortage-calc-frontend.js',
				'version'   => SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_PATH . '/frontend/src/js/mortage-calc-frontend.js' ) : SREL_MORTGAGE_CALCULATOR_VERSION,
				'in_footer' => true,
			),
		);

		return $scripts;
	}

	/**
	 * Get registered styles
	 *
	 * @return array
	 */
	public function get_styles() {

		$styles = array(
			'srel-calc-front'             => array(
				'src'     => SREL_MORTGAGE_CALCULATOR_URL . '/frontend/src/css/mortage-calc-frontend.css',
				'version' => SREL_MORTGAGE_CALCULATOR_BETA ? filemtime( SREL_MORTGAGE_CALCULATOR_PATH . '/frontend/src/css/mortage-calc-frontend.css' ) : SREL_MORTGAGE_CALCULATOR_VERSION,
			),
		);

		return $styles;
	}

}
