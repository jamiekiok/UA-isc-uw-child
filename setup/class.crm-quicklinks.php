<?php
/**
 * CRM_Quicklinks
 *
 * This installs the front page quicklinks location.
 *
 * @package isc-uw-child
 */
/**
 * CRM_Quicklinks
 */
class CRM_Quicklinks {
	const NAME              = 'CRM Quick Links';
	const LOCATION       = 'crm-quicklinks';
	/**
	 * Constructor method
	 */
	function __construct() {
		$this->menu_items = array();
		add_action( 'after_setup_theme', array( $this, 'register_crm_quicklinks' ) );
	}
	/**
	 * Registration method
	 */
	function register_crm_quicklinks() {
		register_nav_menu( self::LOCATION, __( self::NAME ) );
	}
}