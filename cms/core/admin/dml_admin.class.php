<?php
if(!defined('_HOME_TITLE')) exit;


$_contents = new Admin();

$_right['read']		= 'Y';
$_right['insert']	= 'Y';
$_right['update']	= 'Y';
$_right['delete']	= 'Y';
$_right['file']		= 'Y';
$_right['top']		= 'Y';
$_right['main']		= 'Y';

$param_data = array(
		'grp' => $grp,
		'sf' => $sf,
		'st' => $st,
		'nPage' => $nPage
		);
$param = makeParam($param_data);



//신규등록
if( $_base['method'] == 'POST' && $mode == "ADMIN_GROUP_INSERT"){

	if($_right['insert'] != 'Y') msg_err('등록 권한이 없습니다');

	$add_data = array(
			'GROUP_NAME' => $group_name,
			'GROUP_FLAG' => 'Y',
			'USE_TF' => 'Y',
			'REG_DATE' => date("Y-m-d H:i:s")
			);

	$result = $_contents->add_admin_group($add_data);

	if($result) msg_replace("등록되었습니다", 'list_admin_group');
	else msg_err("등록에 실패하였습니다");

	exit;

}

//정보수정
if($_base['method'] == 'POST' && $mode == "ADMIN_GROUP_MODIFY"){

	if($_right['update'] != 'Y') msg_err('수정 권한이 없습니다');

	if(empty($group_no))  msg_err('수정 대상이 없습니다');

	$add_data = array(
			'GROUP_NAME' => $group_name,
			'GROUP_FLAG' => 'Y',
			'USE_TF' => 'Y',
			'UP_ADM' => $_SESSION['s_adm_id'],
			'UP_DATE' => date("Y-m-d H:i:s")
			);

	$where = array('GROUP_NO' => $group_no);

	$result = $_contents->update_admin_group($add_data, $where);

	if($result) msg_replace("수정되었습니다", 'list_admin_group');
	else msg_err("수정에 실패하였습니다");

	exit;
}

//선택삭제
if($_base['method'] == 'POST' && $mode == "ADMIN_GROUP_DELETE"){

	if($_right['delete'] != 'Y') msg_err('삭제 권한이 없습니다');

	$param_data = array(
		'nPage'=>$nPage
	);

	$param = makeParam($param_data);

	if($group_no == "") msg_err("대상이 없습니다.");


	$add_data = array(
			'DEL_TF' => 'Y',
			'DEL_ADM' => $_SESSION['s_adm_id'],
			'DEL_DATE' => date("Y-m-d H:i:s")
			);

	$where = array('GROUP_NO' => $group_no);

	$result = $_contents->update_admin_group($add_data, $where);

	if($result) msg_replace("삭제되었습니다", 'list_admin_group'.$param['query']);
	else msg_err("삭제에 실패하였습니다");

	exit;

}

exit;