<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Contents();

$contents_types = array('article', 'image', 'post', 'video', 'slide');
//$_post_status - config 정의			

$nPageSize = ($type == "image") ? 8 : 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'type'=>$type,
				'status'=>$status,				
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//본인 기사, 포토만 
$param_data = array_merge($param_data, array('mine'=>$_SESSION['_admin']['no'], 'nPageSize'=>$nPageSize));

//리스트 가져오기
if($type == 'image') $rs = $_contents->get_photo_list($param_data);
else $rs = $_contents->get_list($param_data);

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>