<?php
if(!defined('_HOME_TITLE')) exit;

if($contents_id == "") msg_err("대상이 없습니다");

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				's_kind' => $s_kind,
				's_serial' => $s_serial,
				's_title' => $s_title,
				's_name' => $s_name,	
				'nPage' => $nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data, array('contents_id'=>$contents_id));

$_contents = new Contents();

switch($refer) {
	case "standby":
		$_menu_code = "0701";
		break;
	case "published":
		$_menu_code = "0702";
		break;
	case "tempstored":
		$_menu_code = "0703";
		break;
	default:
		$_menu_code = "0701";
}

$rs_newsKind = $_contents->get_NewsKindList();

//수정상태 허용여부
$is_allow_modify = true;

if($type == "image") $rs = $_contents->get_read_photo($param_data);
else $rs = $_contents->get_read($param_data);

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

//컬럼 타이틀 가져오기
if($rs['column_id'] > 0){				
	$rs['column_title'] = $db->rowone("select description from TBL_COLUMN where id = '".$rs['column_id']."'");
}

//민소픽 타이틀 가져오기
if($rs['minsopick_id'] != ''){				
	$rs['minsopick_title'] = $db->rowone("select title from TBL_COLUMN where id = '".$rs['minsopick_id']."'");
}

?>