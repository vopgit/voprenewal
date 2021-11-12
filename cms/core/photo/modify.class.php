<?php 
if(!defined('_HOME_TITLE')) exit;

$_photos = new Photos();

if($photo_id == "") msg_err("대상이 없습니다");

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				's_serial'=>$s_serial,
				's_title'=>$s_title,				
				's_name'=>$s_name,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

	
//상세 가져오기
$rs = $_photos->get_read(array('photo_id'=>$photo_id));

$rs['tag_str'] = restore_tags($rs['tags']);
$rs['photo']   = getListPhoto(_IMAGE_ROOT,  ltrim($rs['file_name'], '/'));
$rs['photo_m']   = getListPhoto(_IMAGE_ROOT,  ltrim($rs['file_name_m'], '/'));