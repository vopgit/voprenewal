<?php 
if(!defined('_HOME_TITLE')) exit;

$_photos = new Photos();

$nPageSize = 4;
$nPageBlock = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'sf'=>$sf,
				'st'=>$st,				
				'me'=>$me,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//검색
if($st != ''){
	if($sf == 'serial') $param_data = array_merge($param_data, array('s_serial'=>$st));
	else if($sf == 'title') $param_data = array_merge($param_data, array('s_title'=>$st));
	else if($sf == 'name') $param_data = array_merge($param_data, array('s_name'=>$st));
}

//목록 사이즈 지정
$param_data = array_merge($param_data, array('nPageSize'=>$nPageSize));

//본인 포토만
if($me == "mine") $param_data = array_merge($param_data, array('mine'=>$_SESSION['_admin']['no']));

//리스트 가져오기
$rs = $_photos->get_list($param_data);

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageBlock, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>