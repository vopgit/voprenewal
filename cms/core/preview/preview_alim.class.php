<?php
if(!defined('_HOME_TITLE')) exit;

$notice_id = $_base['url'][3];

if($notice_id == ""){
	echo '<script>parent.close_iframe();</script>';
	exit;
}

//미 저장된 원소스 미리보기
if($notice_id == "temp") return;

$_alim = new Alim();
$_member = new Member();


//정보조회
$rs = $_alim->get_read($notice_id);
$rs['writer'] = $_member->info($rs['member_id'], 'id, user_id, name, email');

//기자 정보 
$rs['writer_print'] = ($rs['contributor'] != '') ? $rs['contributor'] : $rs['writer']['name']." 기자";

$rs = stripslashes_deep($rs);

$rs['contents'] = $_alim->parse_conetents($rs['contents']);

