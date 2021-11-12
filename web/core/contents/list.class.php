<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Contents();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array('nPage'=>$nPage);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

if($_category != ''){ 
	$param_data = array_merge($param_data, array('category_id'=>$_category, 'nPageSize'=>$nPageSize));
}

//리스트 가져오기
$rs = $_contents->get_list($param_data);

//ajax 페이지 로드
if($mode == "next_page"){
	include _SKINDIR."/contents/list_ajax.php";
	exit;
}

//많이 읽은 기사 - 오늘부터 7일전 발행 일련번호 가져오기
if($_category != "") $cate_qry = " and category_id='".$_category."' ";
$cnt_result = $db->select("select id from TBL_CONTENTS where id != '' ".$cate_qry." and status='published' and published_time >= (CURDATE()-INTERVAL 7 DAY)");
foreach($cnt_result as $val) {
	$cnt_id[] = $val['id'];
}
$cnt_id = implode(",", $cnt_id);
$sql = "select contents_id, (normal_count + mobile_count) as total from contents_viewcount where contents_id in (".$cnt_id.") and contents_kind != 'B' order by total desc limit 5";  //리뷰제외 조회
$hit_result = $db2->select($sql);

for($i=0; $i<count($hit_result); $i++) {
	$hit[$i] = $db->row("select A.serial, B.title from TBL_CONTENTS A left join TBL_CONTENTS_BODY B on A.id = B.contents_id where A.id = '".$hit_result[$i]['contents_id']."'");
}


$_news = new News();

//오피니언
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'N'
				);
$opinion = $_news->get_list($param_data);

if($opinion['total'] > 0){
	for($i=0; $i<count($opinion); $i++) {
		$info = $db->row("select A.contributor, B.name from TBL_CONTENTS A left join TBL_MEMBER B on A.member_id = B.id where A.serial = '".$opinion[$i]['serial']."'");
		if($info['contributor'] != '') $opinion[$i]['author'] = $info['contributor'];
		else if($info['name'] != '') $opinion[$i]['author'] = $info['name']." 기자";
		else $opinion[$i]['author'] = "민중의소리";
	}
}

//사설
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'editorial',
				'top_tf'=>'N'
				);
$editorial = $_news->get_list($param_data);

//만평
$param_data = array('section_category'=>'cartoon');
$cartoon = $_news->get_list($param_data);
?>