<?php
if(!defined('_HOME_TITLE')) exit;

if(substr($_base['url'][2], 0, 1) != 'N' || strlen($_base['url'][2]) != 12)  msg_err("조회 대상을 확인할 수 없습니다");

$id = (int)substr($_base['url'][2], 1, 11);

//메뉴정의
$_alim = new Alim();
$_contents = new Contents();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'st'=>$st,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs = $_alim->get_read($id);

//내용 파싱
$rs['contents'] = $_contents->parse_conetents($rs['contents']);



//이전글, 다음글
$stext = ($param['st'] != "") ? $param['st'] : $st;
$add_sql = ($st != '') ? " and (title like '%".urldecode($stext)."%' or contents like '%".urldecode($stext)."%') " : "";

if($rs['top_tf'] == "Y"){ //공지글인 경우
	
	//이전글
	$sql = "select min(id) from TBL_NOTICE where id > '".$id."' and top_tf= 'Y' and use_tf='Y' and del_tf='N' ".$add_sql;
	$pre = $db->rowone($sql);

	if($pre != ""){
		$pre = $_alim->get_read($pre);
	}

	//다음글
	$sql = "select max(id) from TBL_NOTICE where id < '".$id."' and top_tf= 'Y' and use_tf='Y' and del_tf='N' ".$add_sql;
	$next = $db->rowone($sql);

	if($next != ""){
		$next = $_alim->get_read($next);
	}else{
		//없는 경우 일반글 마지막 글
		$sql = "select max(id) from TBL_NOTICE where top_tf= 'N' and use_tf='Y' and del_tf='N' ".$add_sql;
		$next = $db->rowone($sql);
		if($next != ""){
			$next = $_alim->get_read($next);
		}
	}

} else { //일반글

	//이전글
	$sql = "select min(id) from TBL_NOTICE where id > '".$id."' and top_tf= 'N' and use_tf='Y' and del_tf='N' ".$add_sql;
	$pre = $db->rowone($sql);

	if($pre != ""){
		$pre = $_alim->get_read($pre);
	}else{		
		//없는 경우 공지글 마지막 글
		$sql = "select min(id) from TBL_NOTICE where top_tf= 'Y' and use_tf='Y' and del_tf='N' ".$add_sql;
		$pre = $db->rowone($sql);		
		if($pre != ""){
			$pre = $_alim->get_read($pre);
		}
	}

	//다음글
	$sql = "select max(id) from TBL_NOTICE where id < '".$id."' and top_tf= 'N' and use_tf='Y' and del_tf='N' ".$add_sql;
	$next = $db->rowone($sql);

	if($next != ""){
		$next = $_alim->get_read($next);
	}
}
