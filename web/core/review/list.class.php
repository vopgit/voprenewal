<?php
if(!defined('_HOME_TITLE')) exit;

//클래스정의
$_review = new Review();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
					'st'=>$st,
					'article' => $article,
					's_no' => $s_no,
					's_name' => $s_name,					
					'nPage'=>$nPage
				   );
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data,  array(
											'sel_filed'=> 'A.serial, A.contributor, A.published_date, B.title, B.description, B.content, C.mthumbnail, D.name, E.name as kind_name', 
											'orderby'=>'published_date desc, A.id desc',
											'nPageSize'=>$nPageSize
											));
$rs = $_review->get_list($param_data);
for($i=0; $i<count($rs['data']); $i++) {
	$str = $_review->parse_conetents($rs['data'][$i]['contents']);
	$rs['data'][$i]['photo'] = getImageInContent($str);
	$rs['data'][$i]['contents'] = strip_tags($str);

	if($st != "") $rs['data'][$i]['contents'] = str_highlight($st, $rs['data'][$i]['contents']);

	if($rs['data'][$i]['contributor'] != ""){
		$rs['data'][$i]['writer'] = $rs['data'][$i]['contributor'];
		$rs['data'][$i]['writer_url'] = "/review?s_name=".urlencode($rs['data'][$i]['contributor'])."&s_no=nick";
	}else{
		$rs['data'][$i]['writer'] = $rs['data'][$i]['name'];
		$rs['data'][$i]['writer_url'] = "/review?s_name=".urlencode($rs['data'][$i]['name'])."&s_no=".$rs['data'][$i]['member_id'];
	}




}

$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

//원기사 정보 가져오기
if($article != ""){
	$otitle = $db->rowone("select title from TBL_CONTENTS_BODY where contents_id = '".(int)substr($article, 1,11)."'");
}
?>