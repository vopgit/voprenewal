<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();

//최근 기사 10개 
$filters = array(
				'mine'=>$_SESSION['_admin']['no'], 
				'type'=>'article', 
				'nPageSize'=>5, 
				'nPage'=>1
				);
$article = $_contents->get_list($filters);

//최근 사진 4개
$filters = array(
				'mine'=>$_SESSION['_admin']['no'], 
				'type'=>'image', 
				'nPageSize'=>4, 
				'nPage'=>1
				);
$photo = $_contents->get_photo_list($filters);
?>
