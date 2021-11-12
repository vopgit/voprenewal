<?php
if(!defined('_HOME_TITLE')) exit;

$_SESSION['_admin'] = "";

session_destroy();

msg_replace('로그아웃 되었습니다.');
?>
