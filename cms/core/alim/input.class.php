<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_alim = new Alim();

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'contents'=>$contents,
				'title'=>$title,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$contributor = $_SESSION['_admin']['name'];

//수정
if($mode == "modify"){
	if($notice_id == "") msg_err("수정 대상이 없습니다");
	$rs = $_alim->get_read($notice_id);

	if($rs['contributor']!=""){
		$contributor = $rs['contributor'];
	}else{
		$contributor = $_SESSION['_admin']['name'];
	}
}


