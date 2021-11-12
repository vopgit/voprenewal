<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Contents();
$_popup = new Popup();

$contents_types = array('article', 'image', 'post', 'video', 'slide');
//$_post_status - config 정의			

$nPageSize = 10;
$nPageBlock = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(				
				's_kind' => $s_kind,
				's_grp' => $s_grp, /*민소픽, 컬럼 그룹*/
				's_serial' => $s_serial,
				's_title' => $s_title,
				's_name' => $s_name,	
				'nPage' => $nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

if($_action == 'minsopick'){  /*민소픽*/

	$param_data = array_merge($param_data, array('kind' => '5', 'status' => 'published', 'orderby'=>'published_time desc', 'nPageSize'=>$nPageSize));

	//그룹
	$rs2 = $_popup->get_popup_ty6_list();
	foreach($rs2 as $rs2) {
		$group[$rs2['id']] = $prefix.$rs2['title'];
	}

}else if($_action == 'column'){ /*컬럼*/

	$param_data = array_merge($param_data, array('kind' => '3', 'status' => 'published', 'nPageSize'=>$nPageSize));

	//그룹
	$rs2 = $_popup->get_popup_ty2_list(array('orderby'=>'use_tf desc, priority asc'));
	foreach($rs2 as $rs2) {
		$prefix = ($rs2['use_tf'] == "Y") ? "" : "(휴재/마감)";
		$group[$rs2['id']] = $prefix.$rs2['description'];
	}
	
}else{ 

	if($_action == 'standby') $qry_status = 'standby';  
	else if($_action == 'portal') $qry_status = 'published'; 
	else if($_action == 'tempstored') $qry_status = 'edit'; //('tempstored', 'reserved1', 'reserved2')
	else $qry_status = $_action; 

	//발행된 기사 발행일자 정렬
	if($_action == 'published') $param_data = array_merge($param_data, array('orderby' => 'published_time desc'));

	$param_data = array_merge($param_data, array('status' => $qry_status, 'nPageSize'=>$nPageSize));
}

$rs = $_contents->get_list($param_data);

//발행된 기사 TOP기사 여부 확인
if($_action == 'published'){
	for($i=0; $i<count($rs['data']); $i++) {
		$cnt = $db->total("select count(*) as cnt from TBL_MAIN where serial = '".$rs['data'][$i]['serial']."' and del_tf = 'N'");
		$rs['data'][$i]['is_top'] = ($cnt > 0) ? 'Y' : 'N';
	}
}

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageBlock, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

//기사종류
$rs_newsKind = $_contents->get_NewsKindList();
?>