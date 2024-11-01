<?php

namespace SREL_Calculator_Lib\Controllers\PageControllers;
use SREL_Calculator_Lib\Controllers\CalculatorsController;
use SREL_Calculator_Lib\Controllers\PageControllers\PagesBreadcrumbs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once dirname( __FILE__ ) . '/class-pages-breadcrumbs.php';
class ViewFormsPage extends PagesBreadcrumbs {


	public function __construct() {
		require dirname( __DIR__, 2 ) . '/Controllers/CalculatorsController.php';
		$calculator  = new CalculatorsController();
		$calculators = $calculator->read();
		parent::__construct();
		require dirname( __DIR__, 2 ) . '/View/header.php';
		require dirname( __DIR__, 2 ) . '/View/lead-forms.php';
	}
}

new ViewFormsPage();
