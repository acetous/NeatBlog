<?php

function pager_navigation($pager, $uri)
{
	$navigation = '';
	
	foreach (sfContext::getInstance()->getRequest()->getGetParameters() as $index => $value) {
		if (preg_match(sprintf('/(&|\?)%s=/', $index), $uri) === 0) {
			$uri .= (strpos($uri, '?') === false ? '?' : '&') . $index . '=' . $value;
		}
	}

	if ($pager->haveToPaginate())
	{
		$navigation .= __('Page ') . $pager->getPage() .' '. __('of') .' '. $pager->getLastPage() .' - ';
		if ($pager->getPage() == $pager->getFirstPage()) {
			$navigation .= '<a href="'.str_replace('PAGE', $pager->getNextPage(), $uri).'">'.__('next').'</a>';
		} elseif ($pager->getPage() == $pager->getLastPage()) {
			$navigation .= '<a href="'.str_replace('PAGE', $pager->getPreviousPage(), $uri).'">'.__('previous').'</a>';
		} else {
			$navigation .= '<a href="'.str_replace('PAGE', $pager->getPreviousPage(), $uri).'">'.__('previous').'</a>';
			$navigation .= ' - ';
			$navigation .= '<a href="'.str_replace('PAGE', $pager->getNextPage(), $uri).'">'.__('next').'</a>';
		}
	}

	return $navigation;
}