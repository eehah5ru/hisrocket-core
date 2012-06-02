<?php
/**
 * hisrocket-canvas-album - utility functions
 * @author Nicolay Spesivtsev (eehah5ru)
 * @package plugins
 */

$hca_default_options = (object) array(
	'width' => 100,
	'height' => 100,
	'position_left' => 100,
	'position_top' => 100
);

$hca_album_default_options = (object) array(
	'width' => 1000,
	'height' => 560
);


/*
* Functions for managing HCA options for album
*/

function getHCAAlbumWidth () {
	global $_zp_current_album;	
	return getHCAAlbumOption($_zp_current_album, 'width');	
}


function getHCAAlbumHeight () {
	global $_zp_current_album;	
	return getHCAAlbumOption($_zp_current_album, 'height');	
}


function getHCAAlbumOption ($album, $option_name) {
	global $hca_album_default_options;
	$options = getHCAAlbumOptions($album);

	if (is_null($options->$option_name)) {
		return $hca_album_default_options->$option_name;
	}
	
	return $options->$option_name;
}

function getHCAAlbumOptions ($album) {
	global $hca_album_default_options;
	if (strlen($album->getCustomData()) == 0) {
		return $hca_album_default_options;
	}
	
	return json_decode($album->getCustomData());
}


function printHCACSSForAlbum () {
	$result = "";
	
	$result = $result . "width:" . getHCAAlbumWidth() . "px;";	
	$result = $result . "height:" . getHCAAlbumHeight() . "px;";	
	return $result;
}


/*
* Functions for managing HCA options for images
*/

function getHCAWidth () {
	global $_zp_current_image;
	return getHCAOption($_zp_current_image, 'width');
}

function getHCAHeight () {
	global $_zp_current_image;	
	return getHCAOption($_zp_current_image, 'height');
}

function getHCAPositionLeft () {
	global $_zp_current_image;	
	return getHCAOption($_zp_current_image, 'position_left');	
}

function getHCAPositionTop () {
	global $_zp_current_image;	
	return getHCAOption($_zp_current_image, 'position_top');	
}

function getHCAOptions ($image) {
	global $hca_default_options;
	if (strlen($image->getCustomData()) == 0) {
		return $hca_default_options;
	}
	
	return json_decode($image->getCustomData());
}

function getHCAOption ($image, $option_name) {
	global $hca_default_options;
	$options = getHCAOptions($image);

	if (is_null($options->$option_name)) {
		return $hca_default_options->$option_name;
	}
	
	return $options->$option_name;
}


function printHCACSSForImage () {
	$result = "";
	
	$result = $result . "left:" . getHCAPositionLeft() . "px;";
	$result = $result . "top:" . getHCAPositionTop() . "px;";
	$result = $result . "width:" . getHCAWidth() . "px;";	
	// $result = $result . "height:" . getHCAHeight() . "px;";	
	return $result;
}



?>