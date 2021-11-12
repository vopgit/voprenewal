<?php
if(!defined('_HOME_TITLE')) exit;

$_menu_code = "0802"; // config -> menu code

$_member = new Member;

//파라미터
$param_data = array(
		'grp' => $grp,
		'nm' => $nm,
		'em' => $em,
		'pm' => $pm,
		'nPage' => $nPage
		);

//return $param['query'], $param['nopage'] - (페이징 사용)
$param = makeParam($param_data);


if($no == "") msg_err('잘못된 요청입니다');

//회원정보 조회
$rs = $_member->info($no);
if($rs['id'] == "") msg_err("대상을 조회할 수 없습니다.");

list($rs['email1'], $rs['email2']) = explode("@", $rs['email']);

//내기사, 내사진 통계
$mypost = $_member->get_posts_count($rs['id']);
?>