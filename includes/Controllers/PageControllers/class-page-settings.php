<?php

namespace SREL_Calculator_Lib\Controllers\PageControllers;
use SREL_Calculator_Lib\Controllers\CalculatorsController;
use SREL_Calculator_Lib\Controllers\PageControllers\PagesBreadcrumbs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once dirname( __FILE__ ) . '/class-pages-breadcrumbs.php';
class SettingsPage extends PagesBreadcrumbs {


	public function __construct() {
		$prefilled_data = array(
			'autofill'      => array(
				'interest_rate' => 5,
				'loan_term'     => 25,
				'closing_cost'  => 2,
				'vacancy_rate'  => 5,
				'property_tax'  => 0.7,
				'maintenance'   => 0.5,
				'insurance'     => 1,
				'cost_to_sell'  => 4,
			),
			'brand'         => array(
				'logo'                     => '',
				'primary_email_text_color' => '#FFFFFF',
				'email_background_color'   => '#000000',
				'primary_color'            => '#304af8',
				'sec_color'                => '#000000',
			),
			'custom_fields' => array(
				'phone_number' => '0',
				'comment_box'  => '0',
			),
			'email'         => array(
				'to'      => '',
				'cc'      => '',
				'bcc'     => '',
				'subject' => 'Your Property Cashflow and Mortgage Estimation',
			),
			'webhook'       => array( 'url' => '' ),
			'thank_you'     => array( 'page' => '' ),
			'footer'        => array(
				'cta_button_one'         => array(
					'title'      => '',
					'text'       => '',
					'text_color' => '#FFFFFF',
					'link'       => '',
				),
				'cta_button_two'         => array(
					'title'      => '',
					'text'       => '',
					'text_color' => '#FFFFFF',
					'link'       => '',
				),
				'cta_button_three'       => array(
					'title'      => '',
					'text'       => '',
					'text_color' => '#FFFFFF',
					'link'       => '',
				),
				'realtor_image'          => '',
				'realtor_footer_message' => '',
				'title'                  => 'Are you looking to buy or sell your home?',
			),
			'get_insights'  => array( 'force' => '0' ),
		);
		add_option( 'srel_settings_page_options', $prefilled_data, '', 'yes' );
		require dirname( __DIR__, 2 ) . '/Controllers/CalculatorsController.php';
		$calculator  = new CalculatorsController();
		$admin_email = $calculator->get_admin_email();
		parent::__construct();
		require dirname( __DIR__, 2 ) . '/View/header.php';
		if ( isset( $_GET['id'] ) ) {
			$id         = intval($_GET['id']);
			$calculator = $calculator->read( $id );
			if ( $calculator ) {
				$settings = json_decode( json_encode( $calculator->settings ), true );
				require dirname( __DIR__, 2 ) . '/View/settings-page.php';
			}
		}
	}
}

new SettingsPage();
