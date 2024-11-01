<?php
/**
 * Plugin Name: Stylish Real Estate Leads
 * Description: Convert insights to leads using engaging real estate calculators designed for lead capture.
 * Plugin URI: https://www.stylishcostcalculator.com/srel/
 * Author: Designful Inc
 * Author URI: https://designful.ca/
 * Version: 1.0.4
 * License: GPL2
 * Text Domain: stylish-real-estate-leads
 * Domain Path: /languages/
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * StylishRealEstateLeads class
 *
 * @class StylishRealEstateLeads The class that holds the entire StylishRealEstateLeads plugin
 */
final class StylishRealEstateLeads {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	public $version = '1.0.4';

	/**
	 * Beta database schema version
	 *
	 * @var string
	 */
	public $beta_schema_version = '1.0.4.5';

	/**
	 * Plugin version
	 *
	 * @var bool
	 */
	public $is_beta = false;

	/**
	 * Holds various class instances
	 *
	 * @var array
	 */
	private $container = array();

	/**
	 * Constructor for the StylishRealEstateLeads class
	 *
	 * Sets up all the appropriate hooks and actions
	 * within our plugin.
	 */
	public function __construct() {

		$this->define_constants();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
		add_action( 'plugins_loaded', array( $this, 'srel_plugin_upgrade' ) );
	}

	/**
	 * Initializes the StylishRealEstateLeads() class
	 *
	 * Checks for an existing StylishRealEstateLeads() instance
	 * and if it doesn't find one, creates it.
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new StylishRealEstateLeads();
		}

		return $instance;
	}

	/**
	 * Magic getter to bypass referencing plugin.
	 *
	 * @param $prop
	 *
	 * @return mixed
	 */
	public function __get( $prop ) {
		if ( array_key_exists( $prop, $this->container ) ) {
			return $this->container[ $prop ];
		}

		return $this->{$prop};
	}

	/**
	 * Magic isset to bypass referencing plugin.
	 *
	 * @param $prop
	 *
	 * @return mixed
	 */
	public function __isset( $prop ) {
		return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
	}

	/**
	 * Define the constants
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'SREL_MORTGAGE_CALCULATOR_VERSION', $this->version );
		define( 'SREL_MORTGAGE_CALCULATOR_BETA', $this->is_beta );
		define( 'SREL_MORTGAGE_CALCULATOR_FILE', __FILE__ );
		define( 'SREL_MORTGAGE_CALCULATOR_EDD_ITEM_ID', 3036 );
		define( 'SREL_MORTGAGE_CALCULATOR_APP_NAME', 'Stylish Real Estate Leads PRO' );
		define( 'SREL_MORTGAGE_CALCULATOR_UPDATE_SERVER', 'https://members.stylishpricelist.com' );
		define( 'SREL_MORTGAGE_CALCULATOR_PATH', dirname( SREL_MORTGAGE_CALCULATOR_FILE ) );
		define( 'SREL_MORTGAGE_CALCULATOR_INCLUDES', SREL_MORTGAGE_CALCULATOR_PATH . '/includes' );
		define( 'SREL_MORTGAGE_CALCULATOR_URL', plugins_url( '', SREL_MORTGAGE_CALCULATOR_FILE ) );
		define( 'SREL_MORTGAGE_CALCULATOR_ASSETS', SREL_MORTGAGE_CALCULATOR_URL . '/assets' );
		define( 'SREL_MORTGAGE_CALCULATOR_ASSETS_DIR', SREL_MORTGAGE_CALCULATOR_PATH . '/assets' );
		define(
			'SREL_ALLOWTAGS',
			array(
				'h4'         => array(
					'class' => array(),
				),
				'b'          => array(
					'class' => array(),
				),
				'strong'     => array(
					'class' => array(),
				),
				'br'         => array(),
				'hr'         => array(),
				'li'         => array(
					'class' => array(),
				),
				'ul'         => array(
					'class' => array(),
				),
				'i'          => array(
					'title'       => array(),
					'data-toggle' => array(),
				),
				'div'        => array(
					'class' => array(),
					'id'    => array(),
				),
				'img'        => array(
					'src'   => array(),
					'class' => array(),
					'alt'   => array(),
				),
				'a'          => array(
					'href'   => array(),
					'class'  => array(),
					'target' => array(),
				),
				'span'       => array(
					'class' => array(),
				),
				'first-name' => array(),
			)
		);

	}

	/**
	 * Load the plugin after all plugins are loaded
	 *
	 * @return void
	 */
	public function init_plugin() {
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Placeholder for activation function
	 *
	 * Nothing being called here yet.
	 */
	public function activate() {
		$installed = get_option( 'SREL_MORTGAGE_CALCULATOR_INSTALLED' );
		if ( ! $installed ) {
			update_option( 'SREL_MORTGAGE_CALCULATOR_INSTALLED', time() );
		}
		update_option( 'SREL_MORTGAGE_CALCULATOR_VERSION', SREL_MORTGAGE_CALCULATOR_VERSION );
	}

	private function get_database_schema_version() {
		$schema_version = defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' ) ? SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION . '_pro' : SREL_MORTGAGE_CALCULATOR_VERSION;
		return $this->is_beta ? $this->beta_schema_version : $schema_version;
	}

	function srel_plugin_upgrade() {
		global $wpdb;
		global $srel_db_version;
		$srel_db_version    = $this->get_database_schema_version();
		$current_db_version = get_option( 'srel_db_version' );
		if ( $current_db_version !== $srel_db_version ) {
			if ( defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_FILE' ) && file_exists( SREL_MORTGAGE_CALCULATOR_PREMIUM_FILE ) ) {
				require_once SREL_MORTGAGE_CALCULATOR_PREMIUM_INCLUDES . '/install.php';
				srel_pro_create_database_tables( $wpdb );

			} else {
				require_once SREL_MORTGAGE_CALCULATOR_INCLUDES . '/install.php';
				srel_create_database_tables( $wpdb );

			}
		}
	}
	/**
	 * Placeholder for deactivation function
	 *
	 * Nothing being called here yet.s
	 */
	public function deactivate() {

	}

	/**
	 * Include the required files
	 *
	 * @return void
	 */
	public function includes() {
		require SREL_MORTGAGE_CALCULATOR_INCLUDES . '/functions.php';
		require_once SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Assets.php';
		require SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Integrations/GutenbergBlock.php';

		if ( $this->is_request( 'admin' ) ) {
			require_once SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Controllers/MenuController.php';
		}

		if ( $this->is_request( 'frontend' ) ) {
			$frontend_files_base_path = ( defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' ) ? SREL_MORTGAGE_CALCULATOR_PREMIUM_INCLUDES : SREL_MORTGAGE_CALCULATOR_INCLUDES );
			require_once $frontend_files_base_path . '/Frontend.php';
		}

		if ( $this->is_request( 'ajax' ) ) {
			require_once SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Ajax/AjaxAction.php';
			require_once SREL_MORTGAGE_CALCULATOR_INCLUDES . '/Ajax/AjaxCallbacks.php';
		}
	}
	/**
	 * Initialize the hooks
	 *
	 * @return void
	 */
	public function init_hooks() {

		add_action( 'init', array( $this, 'init_classes' ) );

		// Localize our plugin
		add_action( 'init', array( $this, 'localization_setup' ) );
		if ( $this->is_request( 'admin' ) ) {
			if ( class_exists( '\SREL_Calculator_Lib\Controllers\MenuController' ) ) {
				// Loading menus for the free version
				$plugin_settings_controller = new \SREL_Calculator_Lib\Controllers\MenuController();
				$plugin_settings_controller->add_settings_page_menu();
			}
		}
		//?hides funky messages of WordPress
		add_action( 'admin_print_scripts', array( $this, 'admin_hide_notices' ) );
		
		$block = new \SREL_Calculator_Lib\Integrations\Gutenberg_Block();
		if ( $block->allow_load() ) {
			$block->load();
		}

	}

	public function admin_hide_notices() {
		$exclusion_pages = array( 'srel-view-forms', 'srel-help', 'srel-license' );
		if ( empty( $_REQUEST['page'] ) || ! in_array( $_REQUEST['page'], $exclusion_pages ) ) {
			return;
		}
		global $wp_filter;
		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $notices_type ) {
			if ( empty( $wp_filter[ $notices_type ]->callbacks ) || ! is_array( $wp_filter[ $notices_type ]->callbacks ) ) {
				continue;
			}
			foreach ( $wp_filter[ $notices_type ]->callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $arr ) {
					if ( is_object( $arr['function'] ) && $arr['function'] instanceof Closure ) {
						unset( $wp_filter[ $notices_type ]->callbacks[ $priority ][ $name ] );
						continue;
					}
					$class = ! empty( $arr['function'][0] ) && is_object( $arr['function'][0] ) ? strtolower( get_class( $arr['function'][0] ) ) : '';
					if (
					! empty( $class ) &&
					strpos( $class, 'srel' ) !== false
					) {
						continue;
					}
					if (
					! empty( $class ) &&
					strpos( $class, 'df_srel' ) !== false
					) {
						continue;
					}
					if (
					! empty( $name ) && ( strpos( $name, 'scc' ) === false )
					) {
						unset( $wp_filter[ $notices_type ]->callbacks[ $priority ][ $name ] );
					}
				}
			}
		}
	}

	/**
	 * Instantiate the required classes
	 *
	 * @return void
	 */
	public function init_classes() {
		$this->container['assets'] = new SREL_Calculator_Lib\Assets();

		if ( $this->is_request( 'frontend' ) ) {
			$is_premium_active           = defined( 'SREL_MORTGAGE_CALCULATOR_PREMIUM_VERSION' );
			$this->container['frontend'] = $is_premium_active ? new SREL_Calculator_Pro_Lib\Frontend() : new SREL_Calculator_Lib\Frontend();
		}

		if ( $this->is_request( 'ajax' ) && ! isset( $_GET['wc-ajax'] ) ) {
			$this->container['ajax'] = new SREL_Calculator_Lib\Ajax\AjaxAction();
		}
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @uses load_plugin_textdomain()
	 */
	public function localization_setup() {
		load_plugin_textdomain( 'stylish-real-estate-leads', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();

			case 'ajax':
				return defined( 'DOING_AJAX' );

			case 'rest':
				return defined( 'REST_REQUEST' );

			case 'cron':
				return defined( 'DOING_CRON' );

			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

} // StylishRealEstateLeads

$srel_plugin = StylishRealEstateLeads::init();
