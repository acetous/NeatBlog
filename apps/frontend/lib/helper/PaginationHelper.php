<?php

function pager_navigation($pager, $uri)
{
	$navigation = '';

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