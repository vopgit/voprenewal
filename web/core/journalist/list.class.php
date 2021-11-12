<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Contents();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
					'nPage'=>$nPage
					);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$journalist_id = urldecode($_base['url'][2]);
if($journalist_id == "") msg_err("유효하지 않은 요청입니다.");

//기자 및 대체명의 유효성 검증
if((int)$journalist_id > 0){
	$search_filed = 'member_id';
	$rs2 = $db->row("select name from TBL_MEMBER where id = '".$journalist_id."' and del_tf='N'");
	if($rs2['name'] == "") msg_err("대상을 확인할 수 없습니다.");
	$name_print = $rs2['name']." 기자";
}else{
	$search_filed = 'contributor';
	$cnt = $db->total("select count(*) from TBL_CONTENTS where contributor = '".$journalist_id."'");
	if($cnt < 1){
		//원소스에서도 검색
		$cnt = $db->total("select count(*) from TBL_OSMU where contributor = '".$journalist_id."'");
		if($cnt < 1){
			msg_err("대상을 확인할 수 없습니다.");
		}
	}
	$name_print = $journalist_id;
}

$param_data = array_merge($param_data, array(
											'journalist_filed'=>$search_filed, 
											'journalist_id'=>$journalist_id, 
											'nPageSize'=>$nPageSize
											));



//리스트 가져오기
$rs = $_contents->get_list($param_data);

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>