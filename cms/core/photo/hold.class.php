<?php 
if(!defined('_HOME_TITLE')) exit;

$_photos = new Photos();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				's_serial'=>$s_serial,
				's_title'=>$s_title,				
				's_name'=>$s_name,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//권한 에디터-전체, 기자-본인 포토만 
if($_SESSION['_admin']['role'] != "editor") $param_data = array_merge($param_data, array('mine'=>$_SESSION['_admin']['no']));

$param_data = array_merge($param_data, array('status' => 'reserved1', 'nPageSize'=>$nPageSize));

//리스트 가져오기
$rs = $_photos->get_list($param_data);

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>