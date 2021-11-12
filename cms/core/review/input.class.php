<?php
if(!defined('_HOME_TITLE')) exit;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)

$param_data = array(
				'status'=>$status,
				'next'=>$next,
				'sf_1'=>$sf_1,
				'st_1'=>$st_1,
				'sf_2'=>$sf_2,
				'st_2'=>$st_2,
				'nPage'=>$nPage
				);

$param_data = array_filter($param_data);
$param = makeParam($param_data);

$mine = "";

if($_SESSION['_admin']['role']!="editor"){
	$mine = $_SESSION['_admin']['no'];
}

$param_data = array_merge($param_data, array('mine'=>$mine, 'review_id'=>$review_id));

$_contents = new Review();

switch($_page) {
	case "leading":
		$_menu_code = "0102";
		break;
	case "column":
		$_menu_code = "0103";
		break;
	case "cartoon":
		$_menu_code = "0104";
		break;
	case "minsopick":
		$_menu_code = "0105";
		break;
	case "fb":
		$_menu_code = "0106";
		break;
	case "local":
		$_menu_code = "0107";
		break;
	default:
		$_menu_code = "0101";
}

//수정상태 허용여부
$is_allow_modify = true;

//$contributor = $_SESSION['_admin']['name'];

if($review_id != ""){
	$rs = $_contents->get_read($param_data);

	//원소스 가져오기
	if($rs['osmu_id'] != ''){
		//$osmu_serial = $_contents->get_related_contents($rs['osmu_id']);
	}

	if($rs['email'] != ''){
		$email_arr = explode ("@", $rs['email']);
		//$osmu_serial = $_contents->get_related_contents($rs['osmu_id']);
	}

	if($rs['del_tf']=="Y") $is_allow_modify = false;


//	if($rs['contributor']!=""){
//		$contributor = $rs['contributor'];
//	}else{
//		$contributor = $_SESSION['_admin']['name'];
//	}

}else{
	$email_arr = explode ("@", $_SESSION['_admin']['email']);
}


?>