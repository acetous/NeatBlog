<?php

class ImageResize
{
	private $image;
	
	public function __construct($image)
	{
		$this->image = $image;
	}
	
	public function resize($width, $height, $proportional = true, $type = null, $output = null)
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
			$output = dirname($this->image) . $imgName . '-thumb.'.$type;
		} else {
			if (substr($output, strlen($output) - strlen($type)) != $type) {
				$output .= '.'.$type;
			}
		}
		
		$resizedImg = imagecreatetruecolor($width, $height);
		$sourceImg = $this->getRessourceForSource();
		
		imagecopyresampled($resizedImg, $sourceImg, 0, 0, 0, 0, $width, $height, $imgWidth, $imgHeight);
		
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
}