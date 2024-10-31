<?php 
/**
 *  Preview Posts Everywhere
 *
 * @package   Wpsam_Ppe
 * @author    Pawel Wawrzyniak <sensei@wpsamurai.pl>
 * @license   GPL-2.0+
 * @link      http://wpsamurai.pl
 * @copyright 2013 Pawel Wawrzyniak
 */

/**
 *  Preview Posts Everywhere
 *
 * @package Wpsam_Ppe
 * @author    Pawel Wawrzyniak <sensei@wpsamurai.pl>
 */
class Wpsam_Ppe_Settings{
	
	
	const SETTINGS_SLUG = 'wpsam_ppe_settings';
	
	
	/**
	 * Unique identifier for your plugin.
	 *
	 * The variable name is used as the text domain when internationalizing strings of text.
	 * Its value should match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0
	 *
	 * @var      string
	 */
	private $plugin_slug = 'wpsam-ppe';
	
	/**
	 * Instance of this class.
	 *
	 * @since    1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
	
	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
	
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
	
		return self::$instance;
	}
	

	/**
	 * Constructor
	 * 
	 * @since     1.0
	 */
	private function __construct() {
	
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		
		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . 'wpsam-ppe.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
		
		// Register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

	}
	
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0
	 */
	public function load_plugin_textdomain() {
	
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	
		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	
	
	
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0
	 */
	public function add_plugin_admin_menu() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
				__( 'Preview Posts Everywhere', $this->plugin_slug ),
				__( 'Preview Posts Everywhere', $this->plugin_slug ),
				'manage_options',
				$this->plugin_slug,
				array( $this, 'display_plugin_admin_page' )
		);
	
	}
	
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
	
	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0
	 */
	public function add_action_links( $links ) {
	
		return array_merge(
				array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
				),
				$links
		);
	
	}
	
	
	/**
	 *
	 * Register settings
	 * 
	 * @since    1.0
	 */
	public function register_settings() {
	
		// add_settings_section( $id, $title, $callback, $page )
		  add_settings_section(
			'wpsam-ppe-settings-main-section',
			__('Main Settings', $this->plugin_slug),
			array($this, 'print_main_settings_section_info'),
			$this->plugin_slug
		);
	
	
		// add_settings_field( $id, $title, $callback, $page, $section, $args )
			add_settings_field(
				'show_in_all_queries',
				__('Add drafts to all queries', $this->plugin_slug),
				array($this, 'create_input_main_query'),
				$this->plugin_slug,
				'wpsam-ppe-settings-main-section'
				);
	
		// add_settings_field( $id, $title, $callback, $page, $section, $args )
			add_settings_field(
					'roles',
					__('Select roles', $this->plugin_slug),
					array($this, 'create_input_role'),
					$this->plugin_slug,
					'wpsam-ppe-settings-main-section'
				);
	
	
		register_setting( 
			'wpsam_ppe_settings',
			self::SETTINGS_SLUG,
			array($this, 'settings_validate')
		);
	
	
	}
	
	
	/**
	 * 
	 * Validate settings
	 * 
	 * @param unknown $input
 	 * @since    1.0
	 */
	public function settings_validate( $input ){
	
		
		return $input;
		
	}
	
	public function print_main_settings_section_info(){
		echo '';
	}
	
	
	/**
	 * Create checkbox show in all queries
	 *
	 * @since 1.0
	 *
	 */
	public function create_input_main_query(){
		
		$options = get_option(self::SETTINGS_SLUG);
		
		$show_in_all_queries = isset($options['show_in_all_queries'])?$options['show_in_all_queries']:0;
		
		echo '<input type="checkbox" name="wpsam_ppe_settings[show_in_all_queries]" value="1" ' . checked( 1, $show_in_all_queries, false ) . ' /><br/>';
		echo '<small>'.__('Select that box if you want to show drafts in all places where WP_Query is used (for example in widgets) .',$this->plugin_slug).'</small>';
	}
	
	
	/**
	 * Create select for roles
	 *
	 * @since 1.0
	 *
	 */
	public function create_input_role(){

		$options = get_option( self::SETTINGS_SLUG );
		
		$roles = isset($options['roles'])?$options['roles']:array(); //array
		
		$html = '<select multiple name="wpsam_ppe_settings[roles][]">';

		foreach (wpsam_get_role_names() as $key=>$name){
			
			if (in_array($key, $roles)){
				$selected = 'selected';
			}
			else{
				$selected = '';
			}
			
			$html .= '<option value="'.$key.'"' . $selected . '>' . $name . '</option>';
		}
		
		$html .= '</select>';
		$html .= '<br/>';
		$html .= '<small>'.__('Select roles that should see drafts.',$this->plugin_slug).'</small>';
		
		echo $html;
 
	}
	
	
	
	/**
	 * Fired when the plugin is activated.
	 *
	 * @since 1.0
	 *
	 */
	public static function activate() {
		
			// By default show draft only in main query and only for users with administrator role
			$default_settings = array(
			'show_in_all_queries' => false,	
			'roles' => array( 'administrator' ),
			);
			
			if ( !get_option( Wpsam_Ppe_Settings::SETTINGS_SLUG ) ){
				
				add_option( Wpsam_Ppe_Settings::SETTINGS_SLUG, $default_settings );
				
			}
		
	}
	
	
}