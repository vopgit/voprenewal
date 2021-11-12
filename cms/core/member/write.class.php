<?php
if(!defined('_HOME_TITLE')) exit;

$_menu_code = "0802"; // config -> menu code

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

?>