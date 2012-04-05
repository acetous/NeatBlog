<?php

class sfWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatterList
{
	protected
		$helpFormat 				= "%help%",
		$errorListFormatInARow		= "  <span class=\"help-inline\">\n%errors%  </span>\n",
		$errorRowFormatInARow		= "    %error%\n",
		$namedErrorRowFormatInARow	= "    %name%: %error%\n";
}