<?php 
if(!defined('_HOME_TITLE')) exit;

$param_data = array(
				's_serial' => urldecode($s_serial),
				's_title' => urldecode($s_title),	
				'nPage'=>$nPage
				);


$relate_comma = str_replace("|", ",", $relate_id);

$_contents = new Contents();

if($relate_comma  != ''){
	$sel = $_contents->get_contents($relate_comma);
}

$rs = $_contents->pop_get_list($param_data);

//페이징
if(empty($nPage)) $nPage = 1;
$nPageSize = 10;
$rs['paging'] = pageListPop($nPage, $rs['tot_page'], $nPageSize);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>