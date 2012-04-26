<?php 

function frontend_url() {
	return substr(url_for('@dashboard', true), 0, -8);
}