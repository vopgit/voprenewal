<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_news = new MainNews();

$nPageSize = 10;
$nPageBlock = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(				
				'nPage' => $nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data, array('top_tf'=>'Y', 'nPageSize'=>$nPageSize, 'orderby'=>'priority asc, update_time desc'));

$rs = $_news->get_news_list($param_data);

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageBlock, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>