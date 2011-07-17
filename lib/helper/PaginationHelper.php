<?php

function pager_navigation($pager, $uri)
{
	foreach (sfContext::getInstance()->getRequest()->getGetParameters() as $index => $value) {
		if (preg_match(sprintf('/(&|\?)%s=/', $index), $uri) === 0) {
			$uri .= (strpos($uri, '?') === false ? '?' : '&') . $index . '=' . $value;
		}
	}
	
	$vars = array(
		'current' => $pager->getPage(),
		'first' => $pager->getFirstPage(),
		'last' => $pager->getLastPage(),
		'next' => $pager->getNextPage(),
		'previous' => $pager->getPreviousPage(),
		
		'uri' => array(
			'current' => str_replace('PAGE', $pager->getPage(), $uri),
			'first' => str_replace('PAGE', $pager->getFirstPage(), $uri),
			'last' => str_replace('PAGE', $pager->getLastPage(), $uri),
			'next' => str_replace('PAGE', $pager->getNextPage(), $uri),
			'previous' => str_replace('PAGE', $pager->getPreviousPage(), $uri)
		)
	);
	
	if ($pager->haveToPaginate())
	{
		return Helpers::renderPartial('default', 'pagination', $vars);
	} else {
		return "";
	}
	
// 		$navigation .= __('Page ') . $pager->getPage() .' '. __('of') .' '. $pager->getLastPage() .' - ';
// 		if ($pager->getPage() == $pager->getFirstPage()) {
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getNextPage(), $uri).'" class="button">'.__('Next Page').'</a>';
// 		} elseif ($pager->getPage() == $pager->getLastPage()) {
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getFirstPage(), $uri).'" class="button left primary">'.__('First Page').'</a>';
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getPreviousPage(), $uri).'" class="button right">'.__('Previous Page').'</a>';
// 		} else {
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getFirstPage(), $uri).'" class="button left primary">'.__('First Page').'</a>';
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getPreviousPage(), $uri).'" class="button middle">'.__('Previous Page').'</a>';
// 			$navigation .= '<a href="'.str_replace('PAGE', $pager->getNextPage(), $uri).'" class="button right">'.__('Next Page').'</a>';
// 		}
}