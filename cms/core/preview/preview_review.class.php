<?php
if(!defined('_HOME_TITLE')) exit;

$review_id = $_base['url'][3];


if($review_id == ""){
	echo '<script>parent.close_iframe();</script>';
	exit;
}



//미 저장된 원소스 미리보기
if($review_id == "temp") return;

//$_osmu = new Osmu();
$_osmu = new Contents();
$_member = new Member();
$_contents = new Review();


//정보조회
$rs = $_contents->get_read(array('review_id'=>$review_id));

$rs['writer'] = $_member->info($rs['member_id'], 'id, user_id, name, email');

//원기사 재정의
if($rs['osmu_id'] != ''){
	//$data = $_osmu->get_read($rs['osmu_id']);

	$data = $_osmu->pop_get_read($rs['osmu_id']);

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


}else{
	$relate_html = '<li class="t_center "><p class="ptb_10">등록된 원 기사가 없습니다.</p></li>';
}


//기자 정보 
$rs['writer_print'] = ($rs['contributor'] != '') ? $rs['contributor'] : $rs['writer']['name']." 기자";

$rs = stripslashes_deep($rs);

$rs['contents'] = $_contents->parse_conetents($rs['contents']);

