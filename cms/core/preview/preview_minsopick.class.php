<?php
if(!defined('_HOME_TITLE')) exit;

$_osmu = new Osmu();
$_contents = new Contents();

$filters = array(
			'type'=>$_type, 
			'contents_id'=>$_page, 
			);

$rs = $_contents->get_read($filters);
$rs['body'] = $_contents->parse_conetents($rs['content']);

//민소픽 그룹명
if($rs['minsopick_id'] > 0){
	$rs['group_name'] = $db->rowone("select title from TBL_MINSOPICK where id = '".$rs['minsopick_id']."'");
}


//관련기사
$relate = explode(",", $rs['related']);
for($i = 0; $i < count($relate) ; $i++){
	if($relate[$i] != '') $rs['relate'][$i] = $_contents->get_read(array('contents_id'=>$relate[$i]));	
}