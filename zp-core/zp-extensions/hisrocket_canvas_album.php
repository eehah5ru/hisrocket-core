<?php
/**
 * Adding absolute positioning for images on the album canvas
 *
 * @author Nicolay Spesivtsev (eehah5ru)
 * @package plugins
 */
$plugin_is_filter = 9|CLASS_PLUGIN|THEME_PLUGIN;
$plugin_description = gettext("Adding absolute positioning for images on the album canvas");
$plugin_author = "Nicolay Spesivtsev (eehah5ru)";
$plugin_version = '0.0.1';
$option_interface = 'hisrocket_canvas_album_options';

/*
if (getOption('logger_log_guests')) zp_register_filter('guest_login_attempt', 'security_logger_guestLoginLogger',1);
zp_register_filter('admin_allow_access', 'security_logger_adminGate',1);
zp_register_filter('admin_managed_albums_access', 'security_logger_adminAlbumGate',1);
zp_register_filter('save_user', 'security_logger_UserSave',1);
zp_register_filter('admin_XSRF_access', 'security_logger_admin_XSRF_access',1);
zp_register_filter('admin_log_actions', 'security_logger_log_action',1);
zp_register_filter('log_setup','security_logger_log_setup',1);
*/

zp_register_filter('edit_album_custom_data', 'hca_edit_album_custom_data', 1);
zp_register_filter('load_theme_script', 'hca_load_theme_script',2);
zp_register_filter('edit_image_custom_data', 'hca_edit_image_custom_data', 1);

// register the scripts needed

zp_register_filter('theme_head','hca_add_admin_js');
zp_register_filter('theme_body_open','hca_add_admin_callback_urls');



require_once(substr(basename(__FILE__),0,-4).'/functions-hca.php');

/**
 * Plugin option handling class
 *
 */
class hisrocket_canvas_album_options {
	/**
	 * class instantiation function
	 *
	 * @return hisrocket_canvas_album_options
	 */
	function hisrocket_canvas_album_options() {
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

function hca_add_admin_js () {
	$ME = substr(basename(__FILE__),0,-4);
	if (isset($_GET['editcanvas']) && zp_loggedin(ADMIN_RIGHTS | MANAGE_ALL_ALBUM_RIGHTS)) {
		?>
			<script type="text/javascript" src="<?php echo WEBPATH.'/'.ZENFOLDER.'/'.PLUGIN_FOLDER.'/'.$ME; ?>/jquery.edit_canvas.js"></script>
			<style type="text/css">
				#canvas { border: solid 1px; }
				div.dialog-form label, div.dialog-form input { display:block; }				
				div.dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }
				div.dialog-form	fieldset { padding:0; border:0; margin-top:25px; }
				.ui-dialog .ui-state-error { padding: .3em; }
				.validateTips { border: 1px solid transparent; padding: 0.3em; }				

				.spinner {
				    position: fixed;
				    top: 50%;
				    left: 50%;
				    margin-left: -50px; /* half width of the spinner gif */
				    margin-top: -50px; /* half height of the spinner gif */
				    text-align:center;
				    z-index:1234;
				    overflow: auto;
				    width: 100px; /* width of the spinner gif */
				    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
				}
				
			</style>
		<?php
	}
}

function hca_add_admin_callback_urls () {
	$ME = substr(basename(__FILE__),0,-4);
	$base_path = WEBPATH.'/'.ZENFOLDER.'/'.PLUGIN_FOLDER.'/'.$ME;
	
	if (isset($_GET['editcanvas']) && zp_loggedin(ADMIN_RIGHTS | MANAGE_ALL_ALBUM_RIGHTS)) {
		?>
			<input type="hidden" name="callback_url" value="<?php echo $base_path; ?>/hca_admin_callbacks.php" />
			
			<div id="change-canvas-size-form" class="dialog-form" title="Change canvas size">
				<p class="validateTips">All form fields are required.</p>

				<form>
				<fieldset>
					<label for="width">Width</label>
					<input type="text" name="width" id="width" class="text ui-widget-content ui-corner-all" />
					<label for="height">Height</label>
					<input type="text" name="height" id="height" value="" class="text ui-widget-content ui-corner-all" />
				</fieldset>
				</form>
			</div>
			
			<div id="change-image-params-form" class="dialog-form" title="Change image params">
				<p class="validateTips">All form fields are required.</p>

				<form>
				<fieldset>
					<label for="image-width">Width</label>
					<input type="text" name="image-width" id="image-width" class="text ui-widget-content ui-corner-all" />
					<label for="image-height">Height</label>
					<input type="text" name="image-height" id="image-height" value="" class="text ui-widget-content ui-corner-all" />
					<label for="image-position-top">Position Top</label>
					<input type="text" name="image-position-top" id="image-position-top" value="" class="text ui-widget-content ui-corner-all" />
					<label for="image-position-left">Position Left</label>
					<input type="text" name="image-position-left" id="image-position-left" value="" class="text ui-widget-content ui-corner-all" />										
				</fieldset>
				</form>
			</div>	
			
			<div id="spinner" class="spinner" style="display:none;">
			    <img id="img-spinner" src="<?php echo $base_path; ?>/loading.gif" alt="Loading"/>
			</div>			
			
			<button id="change-canvas-size-button">Change canvas size</button>
			
		<?php
	}		
}



function hca_edit_image_custom_data($string, $image, $currentimage) {
	global $hca_default_options;
	if (strlen($image->getCustomData()) == 0) {
		$image->setCustomData(json_encode($hca_default_options));
	}
}

function hca_edit_album_custom_data($string, $album, $prefix) {
	global $hca_album_default_options;
	if (strlen($album->getCustomData()) == 0) {
		$album->setCustomData(json_encode($hca_album_default_options));
	}
}

function hca_load_theme_script($obj) {
	if (isset($_GET['editcanvas'])) {
		if (!(zp_loggedin(ADMIN_RIGHTS | MANAGE_ALL_ALBUM_RIGHTS))) { // prevent nefarious access to this page.
			header('Location: ' . FULLWEBPATH . '/' . ZENFOLDER . '/admin.php');
			exit();
		}
	}
	return $obj;
}

?>