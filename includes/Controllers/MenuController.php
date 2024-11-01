<?php

namespace SREL_Calculator_Lib\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class MenuController {
	// Add Settings page to admin menu
	function add_settings_page_menu() {
		return add_action( 'admin_menu', array( $this, 'settings_menu_page' ) );
	}
	// Register the menu and submenu pages
	public function settings_menu_page() {
		// Add the main menu page
		$pcc_settings_page = add_menu_page(
			'Stylish Real Estate Leads',
			'Stylish Real Estate Leads',
			'manage_options',
			'srel-settings-page',
			function () {
				// if ( defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' ) ) {
				//     $template = SREL_MORTGAGE_CALCULATOR_PREMIUM_INCLUDES . '/Controllers/PageControllers/class-page-settings.php';
				//     if (file_exists($template) && !class_exists('\SREL_Calculator_Pro_Lib\Controllers\PageControllers\SettingsPage')) {
				//         require $template;
				//     }
				// } else {
					$this->handle_routes();
				// }
			},
			SREL_MORTGAGE_CALCULATOR_ASSETS . '/images/srel-dashicon.png',
			80
		);
		// View Real Estate Lead Forms
		add_submenu_page(
			'srel-settings-page',
			'Calculators & Lead Forms',
			'Calculators & Lead Forms',
			'manage_options',
			'srel-view-forms',
			array( $this, 'handle_routes' )
		);
		remove_submenu_page( 'srel-settings-page', 'srel-settings-page' );
		// Help Page
		add_submenu_page(
			'srel-settings-page',
			'Help',
			'Help',
			'manage_options',
			'srel-help',
			array( $this, 'handle_routes' )
		);
		if ( defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' ) ) {
			add_submenu_page(
				'srel-settings-page',
				'License',
				'License',
				'manage_options',
				'srel-license',
				function () {
					$template = SREL_MORTGAGE_CALCULATOR_PREMIUM_INCLUDES . '/Controllers/PageControllers/class-page-license.php';
					if ( file_exists( $template ) && ! class_exists( '\SREL_Calculator_Pro_Lib\Controllers\PageControllers\LicensePage' ) ) {
						require $template;
					}
				}
			);
			add_submenu_page(
				'',
				'Quote Viewer',
				null,
				'manage_options',
				'srel-quote-management-screen',
				function () {
					$template = SREL_MORTGAGE_CALCULATOR_PREMIUM_INCLUDES . '/Controllers/PageControllers/class-page-quote.php';
					if ( file_exists( $template ) && ! class_exists( '\SREL_Calculator_Pro_Lib\Controllers\PageControllers\PageQuote' ) ) {
						require $template;
					}
				}
			);
		}
	}
	public function handle_routes() {
		// $template = dirname(__DIR__,1) . '/formController.php';
		$template = SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Controllers/dealer.php';
		// if (file_exists($template)) {
		require $template;
		// }
	}

}
