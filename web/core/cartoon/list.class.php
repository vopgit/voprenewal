<?php
if(!defined('_HOME_TITLE')) exit;

//클래스정의
$_contents = new Contents();

$nPageSize = 12;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
					'nPage'=>$nPage
				   );
$param_data = array_filter($param_data);
$param = makeParam($param_data);

//만평
$param_data = array_merge($param_data,  array('kind'=>4, 'nPageSize'=>$nPageSize));
$rs = $_contents->get_list($param_data);

$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>