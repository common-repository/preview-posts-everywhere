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
class Wpsam_Ppe {

	
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.1';
	
	/**
	 * Instance of this class.
	 *
	 * @since    1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
	
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
	 * Initialize the plugin by setting main action
	 *
	 * @since     1.0
	 */
	private function __construct() {

		// Main action 
		 add_action( 'pre_get_posts', array( $this, 'add_posts' ) ); 
		 
	}

	/**
	 * 
	 * Change pre_get_posts action
	 * 
	 * @since    1.0
	 */
	public function add_posts( $query ) {
		
		// Only for logged in users and not in backend
		if ( is_user_logged_in() && !is_admin() ) {

			// Get settings
			$settings = get_option( Wpsam_Ppe_Settings::SETTINGS_SLUG, array() );
			
			// Check if user has role that allows preview draft posts
			if ( !wpsam_check_user_role( $settings['roles'] ) ){
				return false;
			}
			
			
			// Get current post status
			$post_status = $query->get('post_status');
			
			// If there is nothing in post_status then set it to public (default)
			if (empty($post_status)){
				$post_status = get_post_stati( array('public' => true) );

			}
			else{
				// if not empty make sure that it is an array
				if ( !is_array($post_status) ){
					$post_status = array($post_status);
				}
				
			}
			
			//add draft status to list of current statuses
			$post_status = array_merge($post_status, array('draft'));
				
			
			$show_in_all_queries = isset ( $settings['show_in_all_queries'] )?$settings['show_in_all_queries']:0;
			
			// check if we should add drafts to all quereies or only to main query
			if ( $show_in_all_queries == 1 ){
				
				$query->set( 'post_status', $post_status );
				
			}
			else{

				if ( $query->is_main_query() ) {
					$query->set( 'post_status', $post_status );
				}
				
			}
	
		} 
		
	    
	}
	

}


