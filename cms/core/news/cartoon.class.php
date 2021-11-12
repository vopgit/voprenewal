<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_news = new News();

//if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'section_category'=>$_action
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$rs = $_news->get_list($param_data);



$str_section_id = "";

if(count($rs) > 0){
	for ($j = 0 ; $j < count($rs); $j++) {

		if($str_section_id == ""){
			$str_section_id .= $rs[$j]['id'];
		}else{
			$str_section_id .= ",".$rs[$j]['id'];
		}
	}
}

//페이징
//$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
//$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>