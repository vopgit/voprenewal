<?php
if(!defined('_HOME_TITLE')) exit;

$filters = array(
			'type'=>$_type, 
			'contents_id'=>$contents_id, 
			);

$_osmu = new Osmu();
$_contents = new Contents();

//수정모드에서 미리보기시 기본정보 가져오기
if($mode == "modify" && $contents_id != ""){
	$rs = $_contents->get_read($filters);
}

//수정된 정보로 변경
$rs['title'] = $title;
$rs['description'] = str_replace('\r\n', '', $description);

$rs['update_time'] = $_base['time'];

if($contributor != '') $rs['writer_print'] = $contributor;

$rs['body'] = $_contents->parse_conetents(stripslashes($contents));


//관련기사
$relate = explode(",", $related);
for($i = 0; $i < count($relate) ; $i++){
	if($relate[$i] != '') $rs['relate'][$i] = $_contents->get_read(array('contents_id'=>$relate[$i]));	
}

//원소스
$os = explode(",", $osmu);
for($i = 0; $i < count($os) ; $i++){
	if($os[$i] != '') $rs['osmu'][$i] = $_osmu->get_read($os[$i]);	
}