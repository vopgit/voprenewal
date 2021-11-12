<?php 
if(!defined('_HOME_TITLE')) exit;

if($_page < 1){
	echo "<script>parent.close_iframe();</script>";
	exit;
}

$_photos = new Photos();

$param_data = array('photo_id'=>$_page);

//상세 가져오기
$rs = $_photos->get_read($param_data);

if($rs == 'no_id' || $rs == 'no_rs'){
	echo "<script>alert('대상을 확인할 수 없습니다".$rs."-".$_page."');parent.close_iframe();</script>";
	exit;
}
