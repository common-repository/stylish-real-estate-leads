<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function srel_create_database_tables( $wpdb ) {

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$charset_collate = '';

	if ( ! empty( $wpdb->charset ) ) {
		$charset_collate .= "DEFAULT CHARACTER SET {$wpdb->charset}";
	}
	if ( ! empty( $wpdb->collate ) ) {
		$charset_collate .= " COLLATE {$wpdb->collate}";
	}
	global $srel_db_version;
	$installed_ver = get_option( 'srel_db_version' );
	if ( $installed_ver !== $srel_db_version ) {

		$sql = "CREATE TABLE {$wpdb->prefix}df_srel_leads (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `first_name` varchar(255) NULL,
        `last_name` varchar(255) NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(255) NULL,
        `property_address` varchar(2550) NOT NULL,
        `property_price` varchar(250) NOT NULL,
        `calculated_result_json` longtext NOT NULL,
        `email_sent` tinyint(3) DEFAULT 0 NOT NULL,
        `years` varchar(255) NULL,
        `rating` varchar(255) NULL,
        `misc` longtext NULL,
        `comment` longtext NULL,
        `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `browser_ua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    ) {$charset_collate}";
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		$sql_calculator = "CREATE TABLE {$wpdb->prefix}df_srel_calculators (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `shortcode` varchar(255) NULL,
        `settings` longtext NULL,
         PRIMARY KEY (`id`)
    ) {$charset_collate}";
		dbDelta( $sql_calculator );
		srel_populate_calculators_table( $wpdb );
		update_option( 'srel_db_version', $srel_db_version );
	}
}
function srel_populate_calculators_table( $wpdb ) {
	global $wpdb;
	$table_name     = $wpdb->prefix . 'df_srel_calculators';
	$calculators    = array(
		'Rental Property Calculator'     => array( 'shortcode' => 'srel-rental-property-calculator' ),
		'Mortgage Calculator'            => array(),
		'Mortgage Retirement Calculator' => array(),
		'Interest Calculator'            => array(),
	);
	$prefilled_data = array(
		'interest_rate'            => 4.75,
		'loan_term'                => 30,
		'closing_cost'             => 2,
		'vacancy_rate'             => 5,
		'property_tax'             => 0.7,
		'maintenance'              => 0.5,
		'insurance'                => 0.3,
		'cost_to_sell'             => 4,
		'logo'                     => '',
		'primary_email_text_color' => '#FFFFFF',
		'email_background_color'   => '#000000',
		'primary_color'            => '#000',
		'sec_color'                => '#000000',
		'phone_number'             => '0',
		'comment_box'              => '0',
		'to'                       => '',
		'cc'                       => '',
		'bcc'                      => '',
		'subject'                  => 'Insights from Your Rental Property Calculator Results',
		'webhook_url'              => '',
		'thank_you_page'           => '',
		'annual_rent_increase'     => 2,
		'annual_expense_increase'  => 3,
		'title_and_text_color'     => '#000000',
		'cta_button_one'           => array(
			'title'      => 'Sellers',
			'text'       => 'Fast Home Evaluation',
			'text_color' => '#0a0a0a',
			'link'       => 'https://example.com',
		),
		'cta_button_two'           => array(
			'title'      => 'Buyers',
			'text'       => 'Automated Home Search',
			'text_color' => '#0a0a0a',
			'link'       => 'https://example.com',
		),
		'cta_button_three'         => array(
			'title'      => 'Real estate questions?',
			'text'       => 'Ask Seller a Question',
			'text_color' => '#0a0a0a',
			'link'       => 'https://example.com',
		),
		'realtor_image'            => '',
		'realtor_footer_message'   => 'Warm regards, Seller',
		'title'                    => 'Are you looking to buy or sell your home?',
		'force'                    => '0',
	);
	foreach ( $calculators as $name => $data ) {
		$nvp   = array();
		$query = $wpdb->prepare( "SELECT COUNT(*) FROM ". $wpdb->prefix . 'df_srel_calculators' ." WHERE name = %s", $name );
		$count = $wpdb->get_var( $query );
		if ( empty( $count ) ) {
			$nvp['name'] = $name;
			if ( ! empty( $data ) ) {
				$nvp['shortcode'] = $data['shortcode'];
				if ( 'srel-rental-property-calculator' === $data['shortcode'] ) {
					$nvp['settings'] = json_encode( $prefilled_data );
				}
			}
			$wpdb->insert( $table_name, $nvp );
		}
	}
}
