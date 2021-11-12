<?php
if(!defined('_HOME_TITLE')) exit;


if($mode == "preview_temp" && $_SERVER["REQUEST_METHOD"] == "POST"){

	$_osmu = new Contents();
	$_contents = new Review();

	//원기사 재정의

	$relate = explode(",", $related);

	for($i = 0; $i < count($relate) ; $i++){
		if($relate[$i] != ''){
			//$data = $_osmu->get_read($relate[$i]);
			$data = $_osmu->pop_get_read($relate[$i]);

			$relate_html .= '<li>';
			$relate_html .=		'<a href="javascript:;" onclick="js_view(\''.$data['serial'].'\')">';

			$relate_html .=			'<span class="img_box">';
			$relate_html .=				'<span class="img_con">';

			if($data['file_name'] ==""){
				$relate_html .=					'<img src="https://via.placeholder.com/90x52/eeeeee/?text=(no image)" alt="이미지설명">';
			}else{
				$fpath = _IMAGE_ROOT."/".$data['file_name'];
				if(!file_exists($fpath)){
					$relate_html .=					'<img src="https://via.placeholder.com/90x52/eeeeee/?text=(no image)" alt="이미지설명">';
				}else{
					$relate_html .=					'<img src="'._IMAGE_URL.$data['file_name'].'" >';
				}
			}
			$relate_html .=				'</span>';
			$relate_html .=			'</span>';
			$relate_html .=			'<span>'.$data['title'].'</span>';
			$relate_html .=		'</a>';
			$relate_html .= '</li>';

		}
	}


	if($relate_html == ""){
		$relate_html = '<li class="t_center "><p class="ptb_10">등록된 원 기사가 없습니다.</p></li>';
	}

	$contents = $_contents->parse_conetents(stripslashes($contents));
		
	$data = array('relate'=>$relate_html, 'content'=>$contents);

	echo json_encode($data);
	exit;
}