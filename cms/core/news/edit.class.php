<?php
if(!defined('_HOME_TITLE')) exit;

if($top_id == "") msg_err("대상이 없습니다");

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'nPage' => $nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data, array('top_id'=>$top_id));

$_news = new MainNews();

$rs = $_news->get_news_read($top_id);

$rs['photo'] = getListPhoto(_IMAGE_ROOT, $rs['thumbnail1']);

//메인 뉴스 조회
if($rs['id'] == '') msg_err("대상을 조회할 수 없습니다");
$article_id = (int)substr($rs['serial'], 1, 11);

//본기사 조회
$rs2 = $_news->get_read(array('contents_id' => $article_id));
if($rs2['id'] == '') msg_err("본 기사를 조회할 수 없습니다.");

//관련기사
$related = json_decode($rs['related']);

//순위
if($rs['grade'] == "TOP"){
	$option_start = 1;
	$option_end = 3;
}else if($rs['grade'] == "MINOR"){
	$option_start = 4;
	$option_end = 6;
}else if($rs['grade'] == "SUB"){
	$option_start = 7;
	$option_end = 22;
}


if($rs2['tags'] != ''){
	$rs2['tags_print'] = $_news->get_related_tags($rs2['tags']);
}

//기존데이터 개행문자 삭제
if($rs2['id'] <= 1593731){
	$rs2['content'] = preg_replace('/\r\n|\r|\n/', '', $rs2['content']);		
}

//관련기사 가져오기
if($rs2['related'] != ''){				
	$rs2['relate'] = $_news->get_related_contents($rs2['related'], 'B.title');
}

//원소스 가져오기
//if($rs2['onesource'] != ''){				
//	$rs2['one'] = $db->select("select id, serial from TBL_OSMU where id in (".$rs2['onesource'].")");
//}

?>