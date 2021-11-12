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
				'name'=>$name,
				'nPageSize'=>$nPageSize,
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//리스트 가져오기
$rs = $_contents->get_list($param_data);


//카테고리 이름 배열
$arr_categories = array();

for ($i = 0 ; $i < count($rs['data']); $i++) {
	$data = $rs['data'][$i];
	$str_category ="";
	$arr_category = explode("|", $data['category_id']);

	if(count($arr_category) > 0){
		for($j=0; $j<count($arr_category); $j++) {
			if($arr_category[$j] != ""){
				$rs_category = $_contents->get_category($arr_category[$j]);
			}

			$str_category .=$rs_category.", ";
		}
	}

	$arr_categories[$i] = substr($str_category, 0, -2);
}


//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>