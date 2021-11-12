<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_news = new News();

//if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)

//사설
$param_data = array(
				'section_category'=>$_action,
				'type'=>'editorial'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_editorial= $_news->get_list($param_data);


//칼럼 TOP
$param_data = array(
				'section_category'=>$_action,
				'type'=>'column',
				'top_tf'=>'Y'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_column_top= $_news->get_list($param_data);


//칼럼
$param_data = array(
				'section_category'=>$_action,
				'type'=>'column',
				'top_tf'=>'N'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_column= $_news->get_list($param_data);

$str_section_id_editorial = "";
$str_section_id_column_top = "";
$str_section_id_column = "";

if(count($rs_editorial) > 0){
	for ($j = 0 ; $j < count($rs_editorial); $j++) {

		if($str_section_id_editorial == ""){
			$str_section_id_editorial .= $rs_editorial[$j]['id'];
		}else{
			$str_section_id_editorial .= ",".$rs_editorial[$j]['id'];
		}
	}
}

if(count($rs_column_top) > 0){
	for ($j = 0 ; $j < count($rs_column_top); $j++) {

		if($str_culture_section_id_column_top == ""){
			$str_culture_section_id_column_top .= $rs_column_top[$j]['id'];
		}else{
			$str_culture_section_id_column_top .= ",".$rs_column_top[$j]['id'];
		}
	}
}


if(count($rs_column) > 0){
	for ($j = 0 ; $j < count($rs_column); $j++) {

		if($str_culture_section_id_column == ""){
			$str_culture_section_id_column .= $rs_column[$j]['id'];
		}else{
			$str_culture_section_id_column .= ",".$rs_column[$j]['id'];
		}
	}
}


?>