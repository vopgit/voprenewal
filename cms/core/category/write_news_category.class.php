<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Category();

//$contents_types = array('article', 'image', 'post', 'video', 'slide');
//$_post_status - config 정의			

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'seq'=>$seq,
				'name'=>$name,
				'nPageSize'=>$nPageSize,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$arr_category = Array();

if(isset($seq)){
	//가져오기
	$rs = $_contents->getCategoryRead($param_data);
}

?>