<?php 

class Shortcodes_Video extends Shortcodes_Base
{	
	protected function getShortcodes() {
		return array(
			'video' => array('url', 'float')
		);
	}
	
	protected function replace($shortcode, $tag) {
		try {
			$this->url = $tag['url'];
			$this->float = isset($tag['float']) ? $tag['float'] : '';
			$this->size = isset($tag['size']) ? $tag['size'] : '';
			$this->host = $this->getVideoHost($this->url);
			$this->id = $this->getVideoId($this->url);
			$this->thumbnail = $this->getThumbnail();
		
			return $this->render();
		} catch (Shortcodes_Exception $e) {
			return $tag['tag'];
		}
	}
	
	private function render() {
		return '
		<div class="shortcode-video span3 thumbnail" style="float:'.($this->float ? $this->float : 'right').';">
		<a
			class="fancybox"
			style="background-image: url('. image_path($this->thumbnail) .');"
			href="'.$this->url.'"
		>'.image_tag('/assets/modern/video.png').'</a>
		</div>';
	}
	
	private function getVideoHost($url) {
		if (strpos($url, 'http://www.youtube.com/') === 0)
			return 'Youtube';
		if (strpos($url, 'https://www.youtube.com/') === 0)
			return 'Youtube';
		if (strpos($url, 'http://vimeo.com/') === 0) {
			return 'Vimeo';
		}
		
		throw new Shortcodes_Exception('Host for [video] tag not supported');
	}
	
	private function getVideoId() {
		switch($this->host) {
			case 'Youtube':
				$matches = array();
				preg_match('/v=(.*)(&|$)/iU', $this->url, $matches);
				return $matches[1];
			case 'Vimeo':
				$matches = array();
				preg_match('/\d+/i', $this->url, $matches);
				return $matches[0];
		}
		throw new Shortcodes_Exception('Host for [video] tag not supported');
	}
	
	private function getThumbnail() {
		if (!is_dir($this->getWebDir())) {
			mkdir($this->getWebDir(), 0777, true);
		}
		
		$file = '/'.md5($this->host . $this->id).'.jpg';
		
		if (!file_exists($this->getWebDir() . $file)) {
			$thumbnail = '';
			switch ($this->host) {
				case 'Youtube':
					$thumbnail = sprintf('http://img.youtube.com/vi/%s/hqdefault.jpg', $this->id);
					break;
				case 'Vimeo':
					$video = file_get_contents('http://vimeo.com/api/v2/video/'.$this->id.'.json');
					$video = json_decode($video);
					$thumbnail = $video[0]->thumbnail_large;
					break;
				default:
					throw new Shortcodes_Exception('Host for [video] tag not supported');
			}
			
			file_put_contents($this->getWebDir() . $file, file_get_contents($thumbnail));
		}
		
		return '/' . $this->getRelativeWebUrl() . $file;
	}
}