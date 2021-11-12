<?php
if(!defined('_HOME_TITLE')) exit;

//클래스정의
$_contents = new Contents();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
					'nPage'=>$nPage
				   );
$param_data = array_filter($param_data);
$param = makeParam($param_data);

$param_data = array_merge($param_data,  array(
											'contributor'=>'이산아카데미', 
											'sel_filed'=> 'A.serial, A.contributor, A.published_time, B.title, B.description, B.content, C.mthumbnail, D.name, E.name as kind_name', 
											'orderby'=>'published_time desc',
											'nPageSize'=>$nPageSize
											));
$rs = $_contents->get_list($param_data);

if($rs['total'] > 0){
	for($i=0; $i<count($rs['data']); $i++) {
		$str = $_contents->parse_conetents($rs['data'][$i]['content']);
		$rs['data'][$i]['content'] = strip_tags($str);	
	}
}

$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);
?>