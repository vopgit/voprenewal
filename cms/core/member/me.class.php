<?php
if(!defined('_HOME_TITLE')) exit;

$_member = new Member;

if($_SESSION['_admin']['no'] == "") msg_replace('로그인 후 이용하실 수 있습니다.'. '/login');

//회원정보 조회
$rs = $_member->info($_SESSION['_admin']['no']);
if($rs['id'] == "") msg_err("대상을 조회할 수 없습니다.");

list($rs['email1'], $rs['email2']) = explode("@", $rs['email']);

//내기사, 내사진 통계
$mypost = $_member->get_posts_count($rs['id']);
$myphoto = $_member->get_photo_count($rs['id']);
?>