<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_opinion = new Opinion();

$nPageSize = 10;
$nPageBlock = 10;
if($nPage == "") $nPage = 1;


if($_controller == "preview"){
	// 공통
	$param_data = array(
				);
}

// 오피니언 메인 > 사설 조회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'editorial',
				'del_tf'=>'N'
				);
$param = makeParam($param_data);

$rs_editorial= $_opinion->get_preview_opinion_list($param_data);


//오피니언 메인 > 칼럼 TOP 조회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'Y',
				'del_tf'=>'N'
				);
$param = makeParam($param_data);

$rs_column_top= $_opinion->get_preview_opinion_list($param_data);


//오피니언 메인 > 칼럼 조회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'N',
				);
$param = makeParam($param_data);

$rs_column= $_opinion->get_preview_opinion_column_list($param_data);


//오피니언 메인 칼럼그룹 리스트
$param_data = array(
				'use_tf'=>'Y',
				'del_tf'=>'N'
				);
$param = makeParam($param_data);

$rs_column_group= $_opinion->get_column_group_list($param_data);

$param_data = array(
				'use_tf'=>'N',
				'del_tf'=>'N'
				);
$param = makeParam($param_data);

$rs_column_group_end= $_opinion->get_column_group_list($param_data);



//가장 많이 읽은 기사 - 오늘부터 7일전 발행 일련번호 가져오기 
$cnt_result = $db->select("select id from TBL_CONTENTS where kind in (2,3) and status='published' and published_time >= (CURDATE()-INTERVAL 7 DAY)");
foreach($cnt_result as $val) {
	$cnt_id[] = $val['id'];
}

$cnt_id = implode(",", $cnt_id);
$sql = "select contents_id, (normal_count + mobile_count) as total from contents_viewcount where contents_id in (".$cnt_id.") order by total desc limit 3";
$hit_result = $db2->select($sql);


for($i=0; $i<count($hit_result); $i++) {
	$hit[$i] = $db->row("select A.serial, B.title from TBL_CONTENTS A left join TBL_CONTENTS_BODY B on A.id = B.contents_id where A.id = '".$hit_result[$i]['contents_id']."'");
}


?>