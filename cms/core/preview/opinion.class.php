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

// 오피니언 메인 > 사설 저회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'editorial',
				'del_tf'=>'N'
				);

$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_editorial= $_opinion->get_preview_opinion_list($param_data);


//오피니언 메인 > 칼럼 TOP 조회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'Y',
				'del_tf'=>'N'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_column_top= $_opinion->get_preview_opinion_list($param_data);


//오피니언 메인 > 칼럼 조회
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'N',
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_column= $_opinion->get_preview_opinion_column_list($param_data);


//오피니언 메인 칼럼그룹 리스트
$param_data = array(
				'use_tf'=>$use_tf,
				'del_tf'=>'N'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_column_group= $_opinion->get_column_group_list($param_data);

?>