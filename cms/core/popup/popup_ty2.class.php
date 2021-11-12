<?php
if(!defined('_HOME_TITLE')) exit;
//메뉴정의
$_contents = new Popup();


$param_data = array(
				'status'=>$status
				);

$param_data = array_filter($param_data);
$param = makeParam($param_data);


//리스트 가져오기
$rs = $_contents->get_popup_ty2_list($param_data);
?>