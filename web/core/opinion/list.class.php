<?php
if(!defined('_HOME_TITLE')) exit;

//클래스정의
$_opinion = new Opinion();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
					'nPage'=>$nPage
				   );
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data,  array(
											'nPageSize'=>$nPageSize
											));


$rs_editorial_list= $_opinion->get_editorial_list($param_data);

//debug($rs_column_list);
//exit;

$rs_editorial_list['paging'] = pageList($_base['path'], $nPage, $rs_editorial_list['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs_editorial_list['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>