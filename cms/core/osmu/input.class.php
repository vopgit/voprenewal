<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_osmu = new Osmu();

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				's_serial'=>$s_serial,
				's_title'=>$s_title,				
				's_name'=>$s_name,				
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);


$is_allow_modify = true;

//수정
if($mode == "modify"){
	if($osmu_id == "") msg_err("수정 대상이 없습니다");
	$rs = $_osmu->get_read($osmu_id);

	if($rs['member_id'] != $_SESSION['_admin']['no'])  msg_err("수정 권한이 없습니다");
	//$is_allow_modify = false;
}


