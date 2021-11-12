<?php 
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();

$relate_comma = str_replace("|", ",", $relate_id);


//페이징
$nPageSize = 10;
if($nPage == "") $nPage = 1;


$param_data = array(
				's_serial' => urldecode($s_serial),
				's_title' => urldecode($s_title),
				'status' => 'published',
				'not_in' => $relate_comma,
				'nPage'=>$nPage,
				'nPageSize'=>$nPageSize
				);

$param_data = array_filter($param_data);
$param = makeParam($param_data);

if($relate_comma  != ''){
	$sel = $_contents->get_related_contents($relate_comma);
}
$rs = $_contents->get_list($param_data);


$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);
//$rs['paging'] = pageListPop($nPage, $rs['tot_page'], $nPageSize);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>