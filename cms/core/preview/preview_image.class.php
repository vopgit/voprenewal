<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();

$filters = array(
			'type'=>'image', 
			'contents_id'=>$_page, 
			);

$rs = $_contents->get_read_photo($filters);

?>
