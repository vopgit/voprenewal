<?php 
if(!defined('_HOME_TITLE')) exit;

$_pop = new Popup();

$param_data = array(
				'orderby' => 'use_tf desc, priority asc'
				);
$rs = $_pop->get_popup_ty2_list($param_data);
