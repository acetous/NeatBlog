<?php

class ImageResize
{
	private $image;
	
	public function __construct($image)
	{
		$this->image = $image;
	}
	
	public function resize($width, $height, $zoom = 1, $proportional = true, $type = null, $output = null)
	{
		list($imgName, $imgType) = preg_split('/\.(?=([a-zA-Z]+$))/', basename($this->image));
		list($imgWidth, $imgHeight) = getimagesize($this->image);
		
		if (is_null($type)) {
			$type = $imgType;
		}
		
		if ($proportional) {
			$factor = max(
				$imgWidth / $width, 
				$imgHeight / $height
			);
			
			$width = $imgWidth / $factor;
			$height = $imgHeight / $factor;
		}
		
		if (is_null($output)) {
			$output = dirname($this->image) .'/'. $imgName . '-'.$width.'x'.$height.'.'.$type;
		} else {
			if (substr($output, strlen($output) - strlen($type)) != $type) {
				$output .= '.'.$type;
			}
		}
		
		// Zoom
		$maxZoomX = $imgWidth / $width;
		$maxZoomY = $imgHeight / $height;
		$zoom = min($zoom, $maxZoomX, $maxZoomY);
		$srxW = round($imgWidth / $zoom);
		$srcH = round($imgHeight / $zoom);
		$srcX = round(($imgWidth - $srxW) / 2);
		$srcY = round(($imgHeight - $srcH) / 2);;
		
		$resizedImg = imagecreatetruecolor($width, $height);
		$sourceImg = $this->getRessourceForSource();
		
		imagecopyresampled($resizedImg, $sourceImg, 0, 0, $srcX, $srcY, $width, $height, $srxW, $srcH);
		
		switch ($type) {
			case 'png':
				imagepng($resizedImg, $output);
				break;
			case 'jpg':
			case 'jpeg':
				imagejpeg($resizedImg, $output);
				break;
			case 'gif':
				imagegif($resizedImg, $output);
				break;
			default:
				throw new Exception('Cannot create images for type '.$type);
		}
		
		imagedestroy($resizedImg);
		imagedestroy($sourceImg);
	}
	
	private function getRessourceForSource() {
		list($imgName, $imgType) = preg_split('/\.(?=([a-zA-Z]+$))/', basename($this->image));
		switch ($imgType) {
			case 'png':
				return imagecreatefrompng($this->image);
			case 'jpg':
			case 'jpeg':
				return imagecreatefromjpeg($this->image);
			case 'gif':
				return imagecreatefromgif($this->image);
			default:
				throw new Exception('Cannot create images from type '.$type);
		}
	}
}