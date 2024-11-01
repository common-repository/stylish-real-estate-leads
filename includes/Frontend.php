<?php
namespace SREL_Calculator_Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Frontend Pages Handler
 */
class Frontend {

	public function __construct() {
		add_shortcode( 'srel-mortgage-calc', array( $this, 'render_mortage_calc_frontend' ) );
		add_shortcode( 'srel-rental-property-calculator', array( $this, 'render_mortage_calc_frontend' ) );
		add_shortcode( 'lre-mortgage-calc', array( $this, 'render_mortage_calc_frontend' ) );
	}

	/**
	 * Render frontend app
	 *
	 * @param  array $atts
	 * @param  string $content
	 *
	 * @return string
	 */
	public function render_mortage_calc_frontend( $atts, $content = '' ) {
		$id = wp_parse_args( $atts, array( 'id' => 0 ) )['id'];
		wp_enqueue_script( 'srel-mortage-calc-front-comma-number' );
		wp_enqueue_script( 'srel-mortage-calc-front-sweetalert2' );
		wp_enqueue_script( 'srel-mortage-calc-front-autoNumeric' );
		wp_enqueue_script( 'srel-mortage-calc-front' );
		wp_enqueue_style( 'srel-calc-front' );

		//        $html = file_get_contents( SREL_MORTGAGE_CALCULATOR_PATH . '/assets/index.php' );
		$html_rendered = $this->get_rendered_html( SREL_MORTGAGE_CALCULATOR_PATH . '/assets/index.php' );
		// $links         = "<link rel='stylesheet' href='" . SREL_MORTGAGE_CALCULATOR_URL . '/assets/css/icons.min.css' . "'>";
		// $styles        = '<style>' . file_get_contents( SREL_MORTGAGE_CALCULATOR_PATH . '/frontend/src/css/mortage-calc-frontend.css' ) . '</style>' .
		// 	'<style>' . file_get_contents( SREL_MORTGAGE_CALCULATOR_PATH . '/frontend/src/css/balloon.min.css' ) . '</style>';
		return ( $html_rendered );
	}
	public function get_rendered_html( $path ) {
		ob_start();
		include $path;
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}
}
