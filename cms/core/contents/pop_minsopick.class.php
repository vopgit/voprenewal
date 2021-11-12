<?php 
if(!defined('_HOME_TITLE')) exit;

$_pop = new Popup();

$param_data = array(
				'orderby' => 'priority asc'
				);
$rs = $_pop->get_popup_ty6_list($param_data);
