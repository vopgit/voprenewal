<?php
if(!defined('_HOME_TITLE')) exit;

$osmu_id = $_base['url'][3];

if($osmu_id == ""){
	echo '<script>parent.close_iframe();</script>';
	exit;
}

//미 저장된 원소스 미리보기
if($osmu_id == "temp") return;

$_osmu = new Osmu();
$_member = new Member();
$_contents = new Contents();

//정보조회
$rs = $_osmu->get_read($osmu_id);
$rs['writer'] = $_member->info($rs['member_id'], 'id, user_id, name, email');

//관련기사 재정의
for($i = 0; $i < count($rs['relate']) ; $i++){
	$rs['relate'][$i] = $_contents->get_read(array('contents_id'=>$rs['relate'][$i]['contents_id']));	
}

//기자 정보 
$rs['writer_print'] = ($rs['contributor'] != '') ? $rs['contributor'] : $rs['writer']['name']." 기자";

$str_email = ($rs['contributor'] != '') ? "" : $rs['writer']['email'];

$rs = stripslashes_deep($rs);

$rs['contents'] = $_osmu->parse_conetents($rs['contents']);

