<?php

namespace SREL_Calculator_Lib\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class dealer {

	public function __construct() {
		if ( isset( $_GET['page'] ) ) {
			$this->get( sanitize_text_field( $_GET['page'] ) );
		}
	}
	protected function get( $page ) {
		/**
		 * * This renders the pages acording to the menu options
		 * todo: needs formController to load data of forms
		 * @param page
		 */
		switch ( $page ) {
			case 'srel-settings-page':
				require dirname( __FILE__ ) . '/PageControllers/class-page-settings.php';
				break;
			case 'srel-view-forms':
				require dirname( __FILE__ ) . '/PageControllers/class-page-view-forms.php';
				break;
			case 'srel-help':
				require dirname( __FILE__ ) . '/PageControllers/class-page-help.php';
				break;
			default:
				require dirname( __FILE__ ) . '/PageControllers/class-page-view-forms.php';
		}
	}
}
new dealer();
