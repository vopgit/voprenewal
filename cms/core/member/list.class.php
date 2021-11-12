<?php
if(!defined('_HOME_TITLE')) exit;

$_menu_code = "0801"; // config -> menu code
$_member = new Member;

//전화번호 검색시 하이픈 제거
if($pm) $pm = str_replace('-', '', $pm);

//파라미터
$param_data = array(
		'grp' => $grp,
		'nm' => $nm,
		'em' => $em,
		'pm' => $pm,
		'nPage' => $nPage,
		'nPageSize' => $nPageSize, 
		'nPageBlock' => $nPageBlock
		);

$param_data = array_filter($param_data);
$param = makeParam($param_data);


//회원리스트 가져오기
$rs = $_member->get_list($param_data, $param);
?>