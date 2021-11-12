<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();
$_news = new News();

// 프론트용 box_style 태그 변환
function box_style_tag_replace($color){
	if($color == 'tagColorB') $color = 'c1';
	else if($color == 'tagColorR') $color = 'c2';
	else if($color == 'tagColorG') $color = 'c3';
	else if($color == 'tagColorBL') $color = 'c4';
	return $color;
}

//상단기사 22개
$sql = "SELECT A.*, B.id as contents_id FROM (
			SELECT *
			FROM TBL_MAIN where priority > 0 and top_tf ='Y' and del_tf= 'N'
				ORDER BY priority, update_time DESC
			LIMIT 18446744073709551615 
		) as A left join TBL_CONTENTS as B on A.serial = B.serial
		GROUP BY A.priority";

$top = $db->select($sql);

//기사데이터 가져오기 -> 추가 정의 및 재정의
for ($i=0; $i<count($top); $i++) {

	$top[$i]['data'] = $_contents->get_read(array('contents_id'=>$top[$i]['contents_id']));

	//제목
	if(trim($top[$i]['title']) == "") $top[$i]['title'] = $top[$i]['data']['title'];

	//설명
	if(trim($top[$i]['description']) == "") $top[$i]['description'] = $top[$i]['data']['description'];

	$relate_check = false;
	
	if($top[$i]['related'] != ""){

		$relate_data = json_decode($top[$i]['related']);

		for($j=0; $j<count($relate_data); $j++) {

			$top[$i]['related'] = array();
			
			if($relate_data[$j]->serial != ""){				

				$relate_check = true;

				//기사 타이틀이 없는 경우 원문 제목 가져오기
				if($relate_data[$j]->title == ""){					
					$r_id = (int)substr($relate_data[$j]->serial, 1, 11);
					$relate_data[$j]->title = getContentsData('TBL_CONTENTS_BODY', 'title', 'contents_id = '.$r_id);
				}

				array_push($top[$i]['related'], array(
												'serial'  =>$relate_data[$j]->serial,
												'title'  => $relate_data[$j]->title
												));
			}			
		}
	}
	
	//가져온 관련 기사가 없는 경우 원글에서 확인
	if(!$relate_check){
		if($top[$i]['data']['related'] != ''){				
			$top[$i]['related'] = $_contents->get_related_contents($top[$i]['data']['related'], 'title');  //2번째항목은 추가로 가져올 필드명 기입 (추가필드는 없는 경우 id, serial만 리턴)
		}
	}



	//이미지가 없는 경우 
	if($top[$i]['thumbnail1'] == ""){
		if($top[$i]['mthumbnail'] != ""){
			$top[$i]['thumbnail1'] = $top[$i]['mthumbnail'];
		}else{
			//없는 경우 원글에서 확인
			preg_match_all("/\[사진:([^\[]+)[*\]]/i", $top[$i]['data']['content'], $matches);
			if($matches[1][0] != ""){
				$thumb_serial = reset(explode("/", $matches[1][0]));
				if($thumb_serial != ""){
					$top3 = $db->row("select file_name, file_name_m from TBL_PHOTOS where serial = '".$thumb_serial."' limit 1");
					$top[$i]['thumbnail1'] = $top3['file_name'];
				}
			}
		}
	}
	
	//이미지 URL 변환
	if($top[$i]['thumbnail1'] != ""){
		$top[$i]['photo'] = rtrim(_IMAGE_URL,'/')."/".ltrim($top[$i]['thumbnail1'],'/');
	}
	
	$top[$i]['url'] = rtrim(_WEB_URL, '/').'/'.ltrim($top[$i]['serial'],'/').".html";

	// 관리자 - 프론트 제목 박스 css 상이로 변환
	$top[$i]['box_style'] = box_style_tag_replace($top[$i]['box_style']);

}

//오피니언 가져오기
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'column',
				'top_tf'=>'N'
				);
$opinion = $_news->get_list($param_data);

for($i=0; $i<count($opinion); $i++) {
	$info = $db->row("select A.contributor, B.name from TBL_CONTENTS A left join TBL_MEMBER B on A.member_id = B.id where A.serial = '".$opinion[$i]['serial']."'");
	if($info['contributor'] != '') $opinion[$i]['author'] = $info['contributor'];
	else if($info['name'] != '') $opinion[$i]['author'] = $info['name']." 기자";
	else $opinion[$i]['author'] = "민중의소리";
}



//사설 가져오기
$param_data = array(
				'section_category'=>'opinion',
				'type'=>'editorial',
				'top_tf'=>'N'
				);
$editorial = $_news->get_list($param_data);

//만평
$param_data = array('section_category'=>'cartoon');
$cartoon = $_news->get_list($param_data);

//이산 아카데미
$param_data = array('section_category'=>'isan');
$academy = $_news->get_list($param_data);

//포토/영상
$param_data = array('section_category'=>'photo');
$photo = $_news->get_list($param_data);

for($i=0; $i<count($opinion); $i++) {	
	if($photo[$i]['type'] == 'video'){
		$photo[$i]['link'] = $photo[$i]['youtube'];
		$photo[$i]['target'] = "_blank";
	}else{
		$photo[$i]['link'] = "/".$photo[$i]['seral'].".html";
		$photo[$i]['target'] = "_self";
	}
}

//연예
$param_data = array('section_category'=>'culture', 'type'=>'entertainment');
$entertainment = $_news->get_list($param_data);

//문화
$param_data = array('section_category'=>'culture', 'type'=>'culture');
$culture = $_news->get_list($param_data);

//스포츠/헬스
$param_data = array('section_category'=>'culture', 'type'=>'sports');
$sports = $_news->get_list($param_data);

//유튜브 채널
$param_data = array('section_category'=>'youtube');
$youtube = $_news->get_list($param_data);



//가장 많이 읽은 기사 - 오늘부터 7일전 발행 일련번호 가져오기
$cnt_result = $db->select("select id from TBL_CONTENTS where id != '' and status='published' and published_time >= (CURDATE()-INTERVAL 7 DAY)");
foreach($cnt_result as $val) {
	$cnt_id[] = $val['id'];
}
$cnt_id = implode(",", $cnt_id);
$sql = "select contents_id, (normal_count + mobile_count) as total from contents_viewcount where contents_id in (".$cnt_id.") order by total desc limit 5";
$hit_result = $db2->select($sql);

for($i=0; $i<count($hit_result); $i++) {
	$hit[$i] = $db->row("select A.serial, B.title from TBL_CONTENTS A left join TBL_CONTENTS_BODY B on A.id = B.contents_id where A.id = '".$hit_result[$i]['contents_id']."'");
}

//알림
$_alim = new Alim();
$param_data = array('nPage'=>1, 'nPageSize'=> 1, 'orderby'=>"A.id desc");
$alim = $_alim->get_list($param_data);
?>
