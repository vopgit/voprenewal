<?php
if(!defined('_HOME_TITLE')) exit;


if($mode == "preview_temp" && $_SERVER["REQUEST_METHOD"] == "POST"){
	$_osmu = new Osmu();
	$_contents = new Contents();

	//관련기사 재정의
	$relate = explode(",", $related);
	for($i = 0; $i < count($relate) ; $i++){
		if($relate[$i] != ''){
			$data = $_contents->get_read(array('contents_id'=>$relate[$i]));
			$relate_html .= '<li><a href="#'.$data['serial'].'"><span>'.$data['title'].'</span></a></li>';
		}
	}

	if($relate_html == ""){
		$relate_html = '<li class="t_center "><p class="ptb_10">등록된 관련 기사가 없습니다.</p></li>';
	}

	$contents = $_osmu->parse_conetents(stripslashes($contents));
		
	$data = array('relate'=>$relate_html, 'content'=>$contents);
	echo json_encode($data);
	exit;
}