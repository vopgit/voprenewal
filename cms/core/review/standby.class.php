<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_review = new Review();

//수정상태 허용여부
$is_allow_modify = true;

//삭제 권한 허용여부
$is_allow_delete = true;

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'mode'=>$mode,
				'next'=>'standby',
				'status'=>'standby',
				'sf_1'=>$sf_1,
				'st_1'=>$st_1,
				'sf_2'=>$sf_2,
				'st_2'=>$st_2,
				'nPage'=>$nPage
				);

$param_data = array_filter($param_data);
$param = makeParam($param_data);

//기자 권한은 본인 기사만 조회 가능
if($_SESSION['_admin']['role']=="reporter"){
	$param_data = array_merge($param_data, array('mine'=>$_SESSION['_admin']['no']));
}

$rs = $_review->get_list($param_data);


//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>