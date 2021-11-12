<?php
if(!defined('_HOME_TITLE')) exit;

$_osmu = new Osmu();
$_contents = new Contents();

$filters = array(
			'type'=>$_type, 
			'contents_id'=>$_page, 
			);

$rs = $_contents->get_read($filters);

//민소픽 처리
if($rs['kind'] == '5' && $rs['id'] != ''){
	header('Location: /preview/minsopick/'.$rs['id']);
	exit;
}

$rs['body'] = $_contents->parse_conetents($rs['content']);


//관련기사
$relate = explode(",", $rs['related']);
for($i = 0; $i < count($relate) ; $i++){
	if($relate[$i] != '') $rs['relate'][$i] = $_contents->get_read(array('contents_id'=>$relate[$i]));	
}

//원소스
$os = explode(",", $rs['onesource']);
for($i = 0; $i < count($os) ; $i++){
	if($os[$i] != '') $rs['osmu'][$i] = $_osmu->get_read($os[$i]);	
}