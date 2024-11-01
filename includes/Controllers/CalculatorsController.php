<?php

namespace SREL_Calculator_Lib\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class CalculatorsController {

	protected $db;
	protected $table_name;

	public function __construct() {
		global $wpdb;
		$this->db         = $wpdb;
		$this->table_name = $this->db->prefix . 'df_srel_calculators';
	}
	public function read( int $id = 0 ) {
		( 0 === $id ) ? $result = $this->db->get_results( "SELECT * FROM {$this->table_name}" ) :
			$result             = $this->db->get_row( $this->db->prepare( "SELECT * FROM {$this->table_name} WHERE id =%d", $id ) );
		return $result;
	}
	public function get_admin_email() {
		$admin_email = get_option( 'admin_email' );
		if ( $admin_email ) {
			return $admin_email;
		} else {
			return '';
		}
	}
}
