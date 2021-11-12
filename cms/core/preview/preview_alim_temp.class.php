<?php
if(!defined('_HOME_TITLE')) exit;


if($mode == "preview_temp" && $_SERVER["REQUEST_METHOD"] == "POST"){

	$_alim = new Alim();

	$contents = $_alim->parse_conetents(stripslashes($contents));
		
	$data = array('content'=>$contents);
	echo json_encode($data);
	exit;

}