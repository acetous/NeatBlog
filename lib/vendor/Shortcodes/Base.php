<?php

abstract class Shortcodes_Base
{
	protected $text;
	
	abstract protected function replace($shortcode, $tag);
	abstract protected function getShortcodes();
	
	protected function getTags($shortcode, $params) {
		$regex = sprintf('/\[%s(.*)?\]/iU', $shortcode);
		$tags = array();
		
		preg_match_all($regex, $this->text, $tags, PREG_SET_ORDER);
		
		$ret = array();
		foreach ($tags as $tag) {
			$ret2 = array();
			$ret2['shortcode'] = $shortcode;
			$ret2['tag'] = $tag[0];
						
			$matches = array();
			preg_match_all('/[^\s"]+|"[^"]+"/i', $tag[1], $matches);
			
			foreach ($matches[0] as $i => $v) {
				$v = trim($v);
				if (substr($v, 0, 1) == '"' && substr($v, -1) == '"')
					$v = substr($v, 1, strlen($v) - 2);
				if (array_key_exists($i, $params))
					$ret2[$params[$i]] = $v;
				else 
					$ret2[] = $v;
			}
			$ret[] = $ret2;
		} 
		
		return $ret;
	}
	
	protected function applyInternal() {
		$shortcodes = $this->getShortcodes();
		
		foreach ($shortcodes as $shortcode => $params) {
			$tags = $this->getTags($shortcode, $params);
			
			foreach ($tags as $tag) {
				$this->text = str_replace($tag['tag'], $this->replace($tag['shortcode'], $tag), $this->text);
			}
		}
		
		return $this->text;
	}
	
	protected function getCacheDir() {
		return sfConfig::get('sf_cache_dir').'/'.strtolower(get_called_class());
	}
	
	protected function getWebDir() {
		return sfConfig::get('sf_upload_dir').'/'.strtolower(get_called_class());
	}
	
	protected function getRelativeWebUrl() {
		return 'uploads/'.strtolower(get_called_class());
	}
	
	public static function apply($text) {
		$class = new static();
		$class->text = $text;
		return $class->applyInternal();
	}
}