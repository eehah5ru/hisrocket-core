<?php
/**
 *
 * Use to overlay thumbnail images with icons depending on the state of the image.
 * The icon with which the thumbnail is flagged is selectable by option. A standard
 * set of icons is provided. More can be used by storing them in the user plugin folder
 * in a subfolder named "flag_thumbnail".
 *
 * States which may be flagged:
 * 		New--images will be in this state based on their date (or mtime) being within the
 * 				 selected "range" of the current day.
 * 		Protected--images which are password protected, either themsleves or because they are
 * 							 in a password protected album.
 * 		Un-published--images that are marked as not visible.
 * 		Geodata tagged--images which have latitude/longitude information in their EXIF metadata.
 *
 * @author Stephen Billard (sbillard) and Malte Müller (acrylian)
 * @package plugins
 */
$plugin_description = sprintf(gettext('Apply <img src="%1$s/lock.png" alt=""/> over thumbnails of <em>password protected</em> images and albums,
																						 <img src="%1$s/action.png" alt=""/> over thumbnails of <em>un-published</em> albums  images,
																						 <img src="%1$s/new.png" alt=""/> over thumbnails of <em>"new"</em> images and albums,
																						 and <img src="%1$s/GPS.png" alt=""/> over thumbnails of <em>geocoded</em> images'),WEBPATH.'/'.ZENFOLDER.'/'.PLUGIN_FOLDER.'/flag_thumbnail');
$plugin_author = "Stephen Billard (sbillard)";
$plugin_version = '1.4.1';
$option_interface = 'flag_thumbnailOptions';

zp_register_filter('standard_image_thumb_html', 'flag_thumbnail_std_image_thumbs');
zp_register_filter('standard_album_thumb_html', 'flag_thumbnail_std_album_thumbs', 1);
zp_register_filter('custom_album_thumb_html', 'flag_thumbnail_custom_album_thumbs', 1);
zp_register_filter('custom_image_html', 'flag_thumbnail_custom_images', 1);

/**
 * Plugin option handling class
 *
 */
class flag_thumbnailOptions {

	function flag_thumbnailOptions() {
		setOptionDefault('flag_thumbnail_date', 'date');
		setOptionDefault('flag_thumbnail_range', '3');
		setOptionDefault('flag_thumbnail_new_text', 'NEW');
		setOptionDefault('flag_thumbnail_unpublished_text', 'unpub');
		setOptionDefault('flag_thumbnail_locked_text', 'locked');
		setOptionDefault('flag_thumbnail_geodata_text', 'GPS');
		setOptionDefault('flag_thumbnail_use_text', '');
		setOptionDefault('flag_thumbnail_flag_new', 1);
		setOptionDefault('flag_thumbnail_flag_locked', 1);
		setOptionDefault('flag_thumbnail_flag_unpublished', 1);
		setOptionDefault('flag_thumbnail_flag_geodata', 1);
		setOptionDefault('flag_thumbnail_new_icon', 'new.png');
		setOptionDefault('flag_thumbnail_unpublished_icon', 'action.png');
		setOptionDefault('flag_thumbnail_locked_icon', 'lock.png');
		setOptionDefault('flag_thumbnail_geodata_icon', 'GPS.png');
	}

	function getOptionsSupported() {
		$buttons = array();
		$icons = getPluginFiles('*.png','flag_thumbnail');
		foreach ($icons as $icon) {
			$icon = str_replace(SERVERPATH, WEBPATH, $icon);
			$buttons['  <img src="'.$icon.'" />'] = basename($icon);
		}
		return array(	'» '.gettext('Criteria') => array('key' => 'flag_thumbnail_date', 'type' => OPTION_TYPE_SELECTOR,
																								'order' => 3.6,
																								'selections' => array(gettext('date')=>"date",gettext('mtime')=>"mtime"),
																								'desc' => gettext("Select the basis for considering if an image is new.")),
									'» '.gettext('Icon').chr(0).'3' => array('key' => 'flag_thumbnail_new_icon', 'type' => OPTION_TYPE_RADIO,
																								'order'=> 3.1,
																								'buttons' => $buttons, 'behind' => true,
																								'desc' => gettext('Select the icon that will show for "new" images.')),
									'» '.gettext('Icon').chr(0).'2' => array('key' => 'flag_thumbnail_unpublished_icon', 'type' => OPTION_TYPE_RADIO,
																								'order'=> 2.1,
																								'buttons' => $buttons, 'behind' => true,
																								'desc' => gettext('Select the icon that will show for "un-published" images.')),
									'» '.gettext('Icon').chr(0).'4' => array('key' => 'flag_thumbnail_locked_icon', 'type' => OPTION_TYPE_RADIO,
																								'order'=> 4.1,
																								'buttons' => $buttons, 'behind' => true,
																								'desc' => gettext('Select the icon that will show for "Protected" images.')),
									'» '.gettext('Icon').chr(0).'5' => array('key' => 'flag_thumbnail_geodata_icon', 'type' => OPTION_TYPE_RADIO,
																								'order'=> 5.1,
																								'buttons' => $buttons, 'behind' => true,
																								'desc' => gettext('Select the icon that will show for images tagged with geodata.')),
									gettext('Un-published') => array('key' => 'flag_thumbnail_flag_unpublished', 'type' => OPTION_TYPE_CHECKBOX,
																								'order' => 2,
																								'desc' => gettext('Thumbnails for images which are not <em>published</em> will be marked.')),
									gettext('Protected') => array('key' => 'flag_thumbnail_flag_locked', 'type' => OPTION_TYPE_CHECKBOX,
																								'order' => 4,
																								'desc' => gettext('Thumbnails for images which are password protected or in password protected albums will be marked.')),
									gettext('New') => array('key' => 'flag_thumbnail_flag_new', 'type' => OPTION_TYPE_CHECKBOX,
																								'order' => 3,
																								'desc' => gettext('Thumbnails for images which have recently been added to the gallery will be marked.')),
									gettext('Geotagged') => array('key' => 'flag_thumbnail_flag_geodata', 'type' => OPTION_TYPE_CHECKBOX,
																								'order' => 5,
																								'desc' => gettext('Thumbnails for images which are geodata tagged will be marked.')),
									'» '.gettext('Aging') => array('key' => 'flag_thumbnail_range', 'type' => OPTION_TYPE_TEXTBOX,
																								'order' => 3.7,
																								'desc' => gettext("The range in days until images are no longer flagged as new.")),
									'» '.gettext('Text').chr(0).'3' => array('key' => 'flag_thumbnail_new_text', 'type' => OPTION_TYPE_TEXTBOX,
																								'order' => 3.5,
																								'desc' => gettext("Text flag for <em>new</em> images.")),
									'» '.gettext('Text').chr(0).'2' => array('key' => 'flag_thumbnail_unpublished_text', 'type' => OPTION_TYPE_TEXTBOX,
																								'order' => 2.5,
																								'desc' => gettext("Text flag for <em>un-published</em> images.")),
									'» '.gettext('Text').chr(0).'4' => array('key' => 'flag_thumbnail_locked_text', 'type' => OPTION_TYPE_TEXTBOX,
																								'order' => 4.5,
																								'desc' => gettext("Text flag for <em>protected</em> images.")),
									gettext('Use text') => array('key' => 'flag_thumbnail_use_text', 'type' => OPTION_TYPE_CHECKBOX,
																								'order' => 8,
																								'desc' => gettext('If checked, the defined <em>text</em> will be used in place of the icon. (Use the class<code>textasnewflag</code> for styling "text" overlays.)')),
									'» '.gettext('Text').chr(0).'5' => array('key' => 'flag_thumbnail_geodata_text', 'type' => OPTION_TYPE_TEXTBOX,
																								'order' => 5.5,
																								'desc' => gettext("Text flag for <em>geodata tagged</em> images."))

									);
	}
}

function flag_thumbnail_insert_class($html) {
	global $_zp_current_album, $_zp_current_image;
	if (getOption('flag_thumbnail_flag_new')) {
		if(isset($_zp_current_image)) {
			$obj = $_zp_current_image;
		} else {
			$obj = $_zp_current_album;
		}
		$html = '<span class="flag_thumbnail" style="position:relative; display:block;">'."\n".$html."\n";
		switch(getOption('flag_thumbnail_date')) {
			case "date":
				$imagedatestamp = strtotime($obj->getDateTime());
				break;
			case "mtime":
				$imagedatestamp = $obj->get('mtime');
				break;
		}
		$not_older_as = (60*60*24*getOption('flag_thumbnail_range'));
		$age = (time()-$imagedatestamp);
		if($age <= $not_older_as) {
			if(getOption('flag_thumbnail_use_text')) {
				$text = 	getOption('flag_thumbnail_new_text');
				$html .= '<span class="textasnewflag" style="position: absolute;top: 10px;right: 6px;">'.$text."</span>\n";
			} else {
				$img = getPlugin('flag_thumbnail/'.getOption('flag_thumbnail_new_icon'),false,true);
				$html .= '<img src="'.$img.'" alt="" style="position: absolute;top: 4px;right: 4px;"/>'."\n";
			}
		}
	}
	if (getOption('flag_thumbnail_flag_geodata')) {
		if (get_class($obj)=='Album') {
			$obj = $obj->getAlbumThumbImage();
		}
		if (is_object($obj) && get_class($obj)=='_Image') {
			$exif = $obj->getMetaData();
			if(!empty($exif['EXIFGPSLatitude']) && !empty($exif['EXIFGPSLongitude'])){
				if(getOption('flag_thumbnail_use_text')) {
					$text = 	getOption('flag_thumbnail_geodata_text');
					$html .= '<span class="textasnewflag" style="position: absolute;bottom: 10px;right: 6px;">'.$text."</span>\n";
				} else {
					$img = getPlugin('flag_thumbnail/'.getOption('flag_thumbnail_geodata_icon'),false,true);
					$html .= '<img src="'.$img.'" alt="" style="position: absolute;bottom: 4px;right: 4px;"/>'."\n";
				}
			}
		}
	}
	$i = strpos($html, 'class=');
	if ($i !== false) {
		$locked = strpos($html, 'password_protected', $i+7) !== false;
		$unpublished = strpos($html, 'not_visible', $i+7) !== false;

		if ($locked && getOption('flag_thumbnail_flag_locked')) {
			if(getOption('flag_thumbnail_use_text')) {
				$text = 	getOption('flag_thumbnail_locked_text');
				$html .= '<span class="textasnewflag" style="position: absolute;bottom: 10px;left: 4px;">'.$text."</span>\n";
			} else {
				$img =  getPlugin('flag_thumbnail/'.getOption('flag_thumbnail_locked_icon'),false,true);
				$html .= '<img src="'.$img.'" alt="" style="position: absolute;bottom: 4px;left: 4px;"/>'."\n";
			}

		}
		if ($unpublished && getOption('flag_thumbnail_flag_unpublished')) {
			if(getOption('flag_thumbnail_use_text')) {
				$text = 	getOption('flag_thumbnail_unpublished_text');
				$html .= '<span class="textasnewflag" style="position: absolute;top: 10px;left: 4px;">'.$text."</span>\n";
			} else {
				$img = getPlugin('flag_thumbnail/'.getOption('flag_thumbnail_unpublished_icon'),false,true);
				$html .= '<img src="'.$img.'" alt="" style="position: absolute;top: 4px;left: 4px;"/>'."\n";
			}
		}
	}
	$html .= "</span>\n";
	return $html;
}

function flag_thumbnail_custom_images($html, $thumbstandin) {
	if ($thumbstandin) {
		$html = flag_thumbnail_insert_class($html);
	}
	return $html;
}
function flag_thumbnail_std_image_thumbs($html) {
	$html = flag_thumbnail_insert_class($html);
	return $html;
}
function flag_thumbnail_std_album_thumbs($html) {
	$html = flag_thumbnail_insert_class($html);
	return $html;
}
function flag_thumbnail_custom_album_thumbs($html) {
	$html = flag_thumbnail_insert_class($html);
	return $html;
}

?>