<?php
if(!defined('_HOME_TITLE')) exit;

//메뉴정의
$_contents = new Contents();
$_osmu = new Osmu();

$nPageSize = 10;
if($nPage == "") $nPage = 1;

//파라미터 : return $param['query'], $param['nopage'] - (페이징 사용)
$param_data = array(
				'st' => $st,
				'article' => $article,
				'contents_id' => $content,
				's_no' => $s_no,
				's_name' => $s_name,	
				'nPage'=>$nPage
				);
$param_data = array_filter($param_data);
$param = makeParam($param_data);

if($_category != ''){ 
	$param_data = array_merge($param_data, array('nPageSize'=>$nPageSize));
}

//리스트 가져오기
$rs = $_osmu->get_list($param_data);

if($rs['total'] > 0){
	for($i=0; $i<count($rs['data']); $i++) {
		$str = $_osmu->parse_conetents($rs['data'][$i]['contents']);
		$rs['data'][$i]['photo'] = getImageInContent($str);
		$rs['data'][$i]['contents'] = strip_tags($str);

		if($rs['data'][$i]['contributor'] != ""){
			$rs['data'][$i]['writer'] = $rs['data'][$i]['contributor'];
			$rs['data'][$i]['writer_url'] = "/onesource?s_name=".urlencode($rs['data'][$i]['contributor'])."&s_no=nick";
		}else{
			$rs['data'][$i]['writer'] = $rs['data'][$i]['name'];
			$rs['data'][$i]['writer_url'] = "/onesource?s_name=".urlencode($rs['data'][$i]['name'])."&s_no=".$rs['data'][$i]['member_id'];
		}
	}
}

//페이징
$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageSize, $param['nopage']);

//시작일련번호
$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

?>