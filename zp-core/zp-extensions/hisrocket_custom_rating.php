<?php
/**
 * Adding custom rating functionality
 *
 * @author Nicolay Spesivtsev (eehah5ru)
 * @package plugins
 */
$plugin_is_filter = 9|ADMIN_PLUGIN|THEME_PLUGIN;
$plugin_description = gettext("Adding custom rating functionality");
$plugin_author = "Nicolay Spesivtsev (eehah5ru)";
$plugin_version = '0.0.1';
$option_interface = 'hisrocket_custom_rating_options';

/*
if (getOption('logger_log_guests')) zp_register_filter('guest_login_attempt', 'security_logger_guestLoginLogger',1);
zp_register_filter('admin_allow_access', 'security_logger_adminGate',1);
zp_register_filter('admin_managed_albums_access', 'security_logger_adminAlbumGate',1);
zp_register_filter('save_user', 'security_logger_UserSave',1);
zp_register_filter('admin_XSRF_access', 'security_logger_admin_XSRF_access',1);
zp_register_filter('admin_log_actions', 'security_logger_log_action',1);
zp_register_filter('log_setup','security_logger_log_setup',1);
*/

zp_register_filter('save_image_utilities_data', 'hcr_save_image_utilities_data', 1);




// require_once(substr(basename(__FILE__),0,-4).'/functions-hca.php');

/**
 * Plugin option handling class
 *
 */
class hisrocket_custom_rating_options {
	/**
	 * class instantiation function
	 *
	 * @return hisrocket_custom_rating_options
	 */
	function hisrocket_custom_rating_options() {
	}


	/**
	 * Reports the supported options
	 *
	 * @return array
	 */
	function getOptionsSupported() {
		return array();
	}

	function handleOption($option, $currentValue) {
	}
	
}

function hcr_save_image_utilities_data($image, $currentimage) {
	$total_value = sanitize_numeric($_POST[$currentimage . '-total-value'], 0);
	$total_votes = sanitize_numeric($_POST[$currentimage . '-total-votes'], 0);	
	
	$image->set('total_value', $total_value);
	$image->set('total_votes', $total_votes);	
	
	return $image;
}

?>