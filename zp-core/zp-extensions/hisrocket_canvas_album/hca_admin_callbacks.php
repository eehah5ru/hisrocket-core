<?php 
require_once(dirname(dirname(dirname(__FILE__))).'/template-functions.php');
require_once('functions-hca.php');

if (!zp_loggedin(ADMIN_RIGHTS | MANAGE_ALL_ALBUM_RIGHTS)) {
	header('Location: ' . FULLWEBPATH . '/' . ZENFOLDER . '/admin.php');
	exit();
}


HCAHandlers::handle();

class HCAHandlers {
	static function handle () {
		$action = HCAParamUtils::getAction();
		
		try {
			switch ($action) {
				case "move_image":
					HCAHandlers::moveImage();			
					break;
				case "resize_image":
					HCAHandlers::resizeImage();
					break;
				case "resize_canvas":
					HCAHandlers::resizeCanvas();
					break;				
				default:
					HCAHandlers::unknownAction();
			}
		} catch (Exception $e) {
			HCAUtils::handleException($e);
		}
	}
	
	private static function moveImage () {
		$image = new HCAImage(HCAParamUtils::getAlbumFolder(), HCAParamUtils::getImageFileName());
		
		$image->setPositionTop(HCAParamUtils::getPositionTop());
		$image->setPositionLeft(HCAParamUtils::getPositionLeft());
		
		$image->save();
		
		echo "Image Position was updated\n";
		echo "Position Top: " . HCAParamUtils::getPositionTop() . "\n";
		echo "Position Left: " . HCAParamUtils::getPositionLeft() . "\n";
	}
	
	
	private static function resizeImage () {
		$image = new HCAImage(HCAParamUtils::getAlbumFolder(), HCAParamUtils::getImageFileName());
		
		$image->setWidth(HCAParamUtils::getWidth());
		$image->setHeight(HCAParamUtils::getheight());
		
		$image->save();
		
		echo "Image Size was updated\n";
		echo "Width: " . HCAParamUtils::getWidth() . "\n";
		echo "Height: " . HCAParamUtils::getHeight() . "\n";		
	}
	
	
	private static function resizeCanvas () {
		$album = new HCAAlbum(HCAParamUtils::getAlbumFolder());
		
		$album->setWidth(HCAParamUtils::getWidth());
		$album->setHeight(HCAParamUtils::getheight());
		
		$album->save();
		
		echo "Canvas Size was updated\n";
		echo "Width: " . HCAParamUtils::getWidth() . "\n";
		echo "Height: " . HCAParamUtils::getHeight() . "\n";		
	}
	
	private static function unknownAction () {
		header("Status: 404 Action not found");
		exit();
	}
}

class HCAAlbum {
	private $width = NULL;
	private $height = NULL;
	
	private $album;	
	
	public function __construct ($album_folder) {
		$gallery_object = new Gallery();
		$this->album = new Album($gallery_object, $album_folder);
	}
	
	public function setWidth ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Width value" . $value . "is not numeric");
		}
		
		$this->width = $value;
	}
	
	
	public function setHeight ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Height value" . $value . "is not numeric");
		}
		
		$this->height = $value;		
	}	
	
	
	public function save () {
		$this->updateCustomData();

		if (!($this->album->save())) {
			throw new Exception("Got error during save album");
		}
	}
	
	
	private function updateCustomData () {
		$custom_data = json_decode($this->album->getCustomData());
		
		if ($this->isWidthSet()) {
			$custom_data->width = $this->width;
		}
		
		if ($this->isHeightSet()) {
			$custom_data->height = $this->height;
		}
		
		$this->album->setCustomData(json_encode($custom_data));
	}
	
	
	private function isWidthSet () {
		return !is_null($this->width);
	}
	
	
	private function isHeightSet () {
		return !is_null($this->height);
	}	
			
}


class HCAImage {
	private $width = NULL;
	private $height = NULL;
	private $position_top = NULL;
	private $position_left = NULL;
	
	private $image;
	
	
	public function __construct ($album_folder, $image_file_name) {
		$gallery_object = new Gallery();
		$album_object = new Album($gallery_object, $album_folder);
		$this->image = newImage($album_object,$image_file_name);		
	}
	
	public function setWidth ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Width value" . $value . "is not numeric");
		}
		
		$this->width = $value;
	}
	
	
	public function setHeight ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Height value" . $value . "is not numeric");
		}
		
		$this->height = $value;		
	}
	
	public function setPositionTop ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Position top value" . $value . "is not numeric");
		}
		
		$this->position_top = $value;		
	}
	
	public function setPositionLeft ($value) {
		if (!is_numeric($value)) {
			throw new Exception("Position left value" . $value . "is not numeric");
		}
		
		$this->position_left = $value;		
	}		
	
	
	public function save () {
		$this->updateCustomData();

		if (!($this->image->save())) {
			throw new Exception("Got error during save image");
		}
	}
	
	
	private function updateCustomData () {
		$custom_data = json_decode($this->image->getCustomData());
		
		if ($this->isWidthSet()) {
			$custom_data->width = $this->width;
		}
		
		if ($this->isHeightSet()) {
			$custom_data->height = $this->height;
		}
		
		if ($this->isPositionTopSet()) {
			$custom_data->position_top = $this->position_top;
		}
		
		if ($this->isPositionLetSet()) {
			$custom_data->position_left = $this->position_left;
		}
		
		$this->image->setCustomData(json_encode($custom_data));
	}
	
	
	private function isWidthSet () {
		return !is_null($this->width);
	}
	
	
	private function isHeightSet () {
		return !is_null($this->height);
	}
	
	
	private function isPositionTopSet () {
		return !is_null($this->position_top);
	}	
	
	private function isPositionLetSet () {
		return !is_null($this->position_left);
	}	
}


class HCAUtils {
	public static function handleException ($e) {
		header("Status 505: Got error " . $e->getMessage());
		exit();
	}
}


class HCAParamUtils {
	static function getAction () {
		return HCAParamUtils::getGetParameter('action');		
	}
	
	static function getImageFileName () {
		return HCAParamUtils::getGetParameter('image_file_name');
	}
	
	static function getAlbumFolder () {
		return HCAParamUtils::getGetParameter('album_folder');		
	}
	
	static function getPositionTop () {
		return HCAParamUtils::getGetParameter("position_top");
	}
	
	static function getPositionLeft () {
		return HCAParamUtils::getGetParameter("position_left");
	}
	
	static function getWidth () {
		return HCAParamUtils::getGetParameter('width');
	}
	
	static function getHeight () {
		return HCAParamUtils::getGetParameter('height');
	}
	
	
	private static function getGetParameter ($param_name) {
		global $_GET;
		$result = sanitize($_GET[$param_name]);
		
		if (empty($result)) {
			header("Status: 505" . $param_name . "is empty");
			exit();
		}
		
		return $result;		
	}
}
?>