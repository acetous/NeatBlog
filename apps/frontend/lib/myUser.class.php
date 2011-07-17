<?php

class myUser extends sfBasicSecurityUser
{
	private $visitor = null;
	
	public function getVisitorID()
	{
		$request = sfContext::getInstance()->getRequest();
		if (is_null($this->visitor)) {
			$this->visitor = $request->getCookie('visitor');
			if (empty($this->visitor)) {
				$this->visitor = md5(uniqid(mt_rand(), true));
			}
			sfContext::getInstance()->getResponse()->setCookie('visitor', $this->visitor, time()+60*60*24*30);
		}
		return $this->visitor;
	}
}
