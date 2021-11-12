<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_news = new News();

//if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)

//연예
$param_data = array(
				'section_category'=>$_action,
				'type'=>'entertainment'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_entertainment= $_news->get_list($param_data);

//문화
$param_data = array(
				'section_category'=>$_action,
				'type'=>'culture'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_culture= $_news->get_list($param_data);


//스포츠
$param_data = array(
				'section_category'=>$_action,
				'type'=>'sports'
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs_sports= $_news->get_list($param_data);



$str_section_id_entertainment = "";
$str_culture_section_id_culture = "";
$str_sports_section_id_sports = "";

if(count($rs_entertainment) > 0){
	for ($j = 0 ; $j < count($rs_entertainment); $j++) {

		if($str_section_id_entertainment == ""){
			$str_section_id_entertainment .= $rs_entertainment[$j]['id'];
		}else{
			$str_section_id_entertainment .= ",".$rs_entertainment[$j]['id'];
		}
	}
}

if(count($rs_culture) > 0){
	for ($j = 0 ; $j < count($rs_culture); $j++) {

		if($str_culture_section_id_culture == ""){
			$str_culture_section_id_culture .= $rs_culture[$j]['id'];
		}else{
			$str_culture_section_id_culture .= ",".$rs_culture[$j]['id'];
		}
	}
}

if(count($rs_sports) > 0){
	for ($j = 0 ; $j < count($rs_sports); $j++) {

		if($str_sports_section_id_sports == ""){
			$str_sports_section_id_sports .= $rs_sports[$j]['id'];
		}else{
			$str_sports_section_id_sports .= ",".$rs_sports[$j]['id'];
		}
	}
}

?>