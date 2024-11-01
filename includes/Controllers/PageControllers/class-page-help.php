<?php

namespace SREL_Calculator_Lib\Controllers;
use SREL_Calculator_Lib\Controllers\PageControllers\PagesBreadcrumbs;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once dirname( __FILE__ ) . '/class-pages-breadcrumbs.php';
class HelpPage extends PagesBreadcrumbs {


	public function __construct() {
		parent::__construct();
		require dirname( __DIR__, 2 ) . '/View/header.php';
		require dirname( __DIR__, 2 ) . '/View/help.php';
	}
}

new HelpPage();
