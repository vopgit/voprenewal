<?php
if(!defined('_HOME_TITLE')) exit;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'type'=>$type,
				'status'=>$status,				
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//본인 기사, 포토만 
$param_data = array_merge($param_data, array('mine'=>$_SESSION['_admin']['no'], 'contents_id'=>$contents_id));

$_contents = new Contents();

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

$rs_newsKind = $_contents->get_NewsKindList();

//수정상태 허용여부
$is_allow_modify = true;

//편집화면에서 넘어온 경우 - refer
$returnUrl = ($refer != '') ? $refer : $param['query'];

if($contents_id != ""){

	if($type == "image") $rs = $_contents->get_read_photo($param_data);
	else $rs = $_contents->get_read($param_data);
	
	if(!in_array($rs['status'], array('tempstored', 'reserved1', 'reserved2'))) $is_allow_modify = false;

	if($rs['tags'] != ''){
		$rs['tags_print'] = $_contents->get_related_tags($rs['tags']);
	}
	
	//********* 기존데이터 개행문자 삭제 ***********//
	if($rs['id'] <= 1593731){
		$rs['content'] = preg_replace('/\r\n|\r|\n/', '', $rs['content']);		
	}

	//관련기사 가져오기
	if($rs['related'] != ''){				
		$rs['relate'] = $_contents->get_related_contents($rs['related']);
	}

	//원소스 가져오기
	if($rs['onesource'] != ''){				
		$rs['one'] = $db->select("select id, serial from TBL_OSMU where id in (".$rs['onesource'].")");
	}

	//컬럼 그룹 가져오기
	if($rs['column_id'] > 0){				
		$rs['column_title'] = $db->rowone("select title from TBL_COLUMN where id = '".$rs['column_id']."'");
	}

	//민소픽 그룹 가져오기
	if($rs['minsopick_id'] != ''){				
		$rs['minsopick_title'] = $db->rowone("select title from TBL_MINSOPICK where id = '".$rs['minsopick_id']."'");
	}

} else {
	//신규등록인 경우
	switch($_page) {
		case "article":
			$default_kind = '1';
			break;
		case "leading":
			$default_kind = '2';
			break;
		case "column":
			$default_kind = '3';
			break;
		case "cartoon":
			$default_kind = '4';
			break;
		case "minsopick":
			$default_kind = '5';
			break;
		case "fb":
			$default_kind = '7';
			break;
		case "local":
			$default_kind = '8';
			break;
		default:
			$default_kind = '';
	}
}

?>