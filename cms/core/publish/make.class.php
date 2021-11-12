<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0) exit;

if($_POST['id'] == "" || $_POST['type'] == "" || $_POST['sender'] == "") exit;

list($sendtime, $post_id) = explode('_', decrypt($_POST['id']));

if($post_id == "") exit;
if(time() - $sendtime > 10) exit;

$_contents = new Contents();
$_review = new Review();

//기사 static 발행 - 일반기사, 민소픽, 오피니언
if($type == "article"){

	//폴더 만들기
	$ach_folder = substr($post_id, 0, -3);
	$save_path = _ARCHIVE_ROOT.$ach_folder;							
	make_dir($save_path);

	$rs = $_contents->get_read(array('contents_id' => $post_id));

	if($rs['published_time'] == "" || $rs['published_time'] == '0000-00-00 00:00:00') $rs['published_time'] = $_base['time'];

	if($rs['tags'] != ''){
		$rs['tags_print'] = $_contents->get_related_tags($rs['tags']);
	}
	
	//********* 기존데이터 개행문자 삭제 ***********//
	if($rs['id'] <= 1593731){
		$rs['content'] = preg_replace('/\r\n|\r|\n/', '', $rs['content']);		
	}

	$rs['content'] = $_contents->parse_conetents($rs['content'], 'live');

	//컬럼 그룹 가져오기
	if($rs['column_id'] > 0){				
		$rs['column_title'] = $db->rowone("select title from TBL_COLUMN where id = '".$rs['column_id']."'");
	}

	//민소픽 그룹 가져오기
	if($rs['minsopick_id'] != ''){				
		$rs['minsopick_title'] = $db->rowone("select title from TBL_MINSOPICK where id = '".$rs['minsopick_id']."'");
	}

	//관련기사
	if($rs['related'] != ''){
		$rs['relate'] = $_contents->get_related_contents($rs['related'], 'B.title, C.mthumbnail as thumb');
	}

	//원소스
	$osmu_cnt = 0; //원소스 기사 갯수 초기화
	if($rs['onesource'] != ''){
		$rs['osmu'] = $db->select("select id, serial, title from TBL_OSMU where id in (".$rs['onesource'].") order by published_time desc limit 5");
		$osmu_cnt = $db->total("select count(*) as cnt from TBL_OSMU where id in (".$rs['onesource'].")");
	}

	//리뷰
	$param = array(
					'osmu_id' => $post_id,
					'status' => 'published',
					'published_tf' => 'Y',
					'del_tf' => 'N',
					'oderby' => 'A.published_date desc',
					'nPageSize' => 3
				  );
	$rs['review'] = $_review->get_list($param);	


	//후원정보 조회
	$support_name = ($rs['contributor'] != "") ? $rs['contributor'] : $rs['writer_name']." 기자";

	$support_data = file_get_contents('https://ecredit.vop.co.kr/voparticle_spon_mobile-202103.php?name='.urlencode($support_name));
	
	preg_match("/<span>(.*?)<\/span>/i", $support_data, $support_amount);  //후원금액
	$support_amount = $support_amount[1]; 
	
	preg_match_all("/<a[^>]*href=[\"']?([^>\"']+)[\"']?[^>]*>/i",$support_data, $support_link);
	//foreach($support_link[1] as $matches) {
		//echo $matches."<br>";
	//}

	//기자 사진
	$Writer_spon = $support_name;
	include _ROOT."/core/common/author.php";
	if($Writer_photo == "") $Writer_photo = _WEB_URL."/templates/2016/author_photo/photo.png";	

	$page_url = rtrim(_WEB_URL,'/')."/".$rs['serial'].".html";
	$page_image = ($rs['mthumbnail'] != '') ? rtrim($rs['mthumbnail'],'/') : 'mobilethumbnail/logothumb.jpg';
	$page_image = rtrim(_IMAGE_URL,'/')."/".$page_image;
	
	//meta 
	$og = array(
				'title' => remove_quote($rs['title']),
				'mtitle' => remove_quote($rs['title']),
				'url' => $page_url,
				'keywords' => $rs['tags_print'],
				'description' => ($rs['mdescription'] != '') ? $rs['mdescription'] : $rs['description'],
				'image' => $page_image,
				'author' => $support_name,
				'pub_date' => $rs['published_time'],
				'mod_date' =>  $rs['update_time'],
				'category' =>  $rs['category_name']
				);
	
	//오피니언 여부 확인
	$is_opinion = $db->total("select count(*) as cnt from TBL_MAIN_SECTION_OPINION where serial = '".$rs['serial']."' and use_tf ='Y' and del_tf = 'N'");

	//템플릿 파일 불러오기
	
	if($rs['kind'] == 5){ //민소픽
		$top_style_css = "type_pick"; 		
		include _ROOT."/resource/template/article_minsopick.php";

	}else if($is_opinion > 0){ //오피니언
		$top_style_css = "type_opinion";
		include _ROOT."/resource/template/article_opinion.php";
	
	}else{ //일반기사
		$top_style_css = "";
 		include _ROOT."/resource/template/article.php";
	}
}


//원소스 static 발행
if($type == "osmu"){

	$_osmu = new Osmu();
	$_member = new Member();

	//폴더 만들기
	$ach_folder = substr($post_id, 0, -3);
	$save_path = _ARCHIVE_ROOT.$ach_folder;							
	make_dir($save_path);

	//정보조회
	$rs = $_osmu->get_read($post_id);

	//기자 정보조회
	$rs['writer'] = $_member->info($rs['member_id'], 'id, user_id, name, email');
	$rs['writer_print'] = ($rs['contributor'] != "") ? $rs['contributor'] : $rs['writer']['name']." 기자 ".$rs['writer']['email'];

	//관련기사 재정의
	for($i = 0; $i < count($rs['relate']) ; $i++){
		$rs['relate'][$i] = $_contents->get_read(array('contents_id'=>$rs['relate'][$i]['contents_id']));	
	}

	$rs = stripslashes_deep($rs);
	$rs['contents'] = $_contents->parse_conetents($rs['contents'], 'live');

	if($rs['published_time'] == "" || $rs['published_time'] == '0000-00-00 00:00:00') $rs['published_time'] = $_base['time'];	

	//후원정보 조회
	$support_name = ($rs['contributor'] != "") ? $rs['contributor'] : $rs['writer']['name']." 기자";

	$support_data = file_get_contents('https://ecredit.vop.co.kr/voparticle_spon_mobile-202103.php?name='.urlencode($support_name));
	
	preg_match("/<span>(.*?)<\/span>/i", $support_data, $support_amount);  //후원금액
	$support_amount = $support_amount[1]; 
	
	preg_match_all("/<a[^>]*href=[\"']?([^>\"']+)[\"']?[^>]*>/i",$support_data, $support_link);
	//foreach($support_link[1] as $matches) {
		//echo $matches."<br>";
	//}

	//기자 사진
	$Writer_spon = $support_name;
	include _ROOT."/core/common/author.php";
	if($Writer_photo == "") $Writer_photo = _WEB_URL."/templates/2016/author_photo/photo.png";	

	$page_url = rtrim(_WEB_URL,'/')."/".$rs['serial'].".html";
	$page_image = ($rs['mthumbnail'] != '') ? rtrim($rs['mthumbnail'],'/') : 'mobilethumbnail/vop_meta.jpg';
	$page_image = rtrim(_IMAGE_URL,'/')."/".$page_image;
	
	//meta 
	$og = array(
				'title' => remove_quote($rs['title']),
				'mtitle' => remove_quote($rs['title']),
				'url' => $page_url,
				'keywords' => $rs['tags_print'],
				'description' => ($rs['mdescription'] != '') ? $rs['mdescription'] : $rs['description'],
				'image' => $page_image,
				'author' => $support_name,
				'pub_date' => $rs['published_time'],
				'mod_date' =>  $rs['update_time'],
				'category' =>  $rs['category_name']
				);
	
	//템플릿 파일 불러오기	
	$top_style_css = "type_source"; 
	include _ROOT."/resource/template/article_onesource.php";
}

//리뷰 static
if($type == "review"){

	$_review = new Review();
	$_member = new Member();	

	//정보조회
	$rs = $_review->get_read(array('review_id'=>$post_id));
	//debug($rs);

	//폴더 만들기
	$save_path = _ARCHIVE_ROOT.'review';
	make_dir($save_path);

	//$save_path = _ARCHIVE_ROOT.'review/'.substr(substr($rs['serial'][1], 1, 11), -7, 4);
	//make_dir($save_path);


	//기자 정보조회
	if($rs['member_id'] != ''){
		$rs['member'] = $_member->info($rs['member_id'], 'id, user_id, name, email');
	}else{
		$rs['member']['name'] = $rs['contributor'];
	}

	$rs = stripslashes_deep($rs);

	$rs['contents'] = $_contents->parse_conetents($rs['contents'], 'live');

	if($rs['published_date'] == "" || $rs['published_date'] == '0000-00-00 00:00:00') $rs['published_date'] = $_base['time'];	

	//후원정보 조회
	$support_name = ($rs['contributor'] != "") ? $rs['contributor'] : $rs['member']['name'];

	$support_data = file_get_contents('https://ecredit.vop.co.kr/voparticle_spon_mobile-202103.php?name='.urlencode($support_name));
	
	preg_match("/<span>(.*?)<\/span>/i", $support_data, $support_amount);  //후원금액
	$support_amount = $support_amount[1]; 
	
	preg_match_all("/<a[^>]*href=[\"']?([^>\"']+)[\"']?[^>]*>/i",$support_data, $support_link);
	//foreach($support_link[1] as $matches) {
		//echo $matches."<br>";
	//}

	//기자 사진
	$Writer_spon = $support_name;
	include _ROOT."/core/common/author.php";
	if($Writer_photo == "") $Writer_photo = _WEB_URL."/templates/2016/author_photo/photo.png";	

	$page_url = rtrim(_WEB_URL,'/')."/".$rs['serial'].".html";
	$page_image = ($rs['mthumbnail'] != '') ? rtrim($rs['mthumbnail'],'/') : 'mobilethumbnail/vop_meta.jpg';
	$page_image = rtrim(_IMAGE_URL,'/')."/".$page_image;	

	//meta 
	$og = array(
				'title' => remove_quote($rs['contributor']."님의 리뷰 - ".$rs['title']),
				'mtitle' => remove_quote($rs['contributor']."님의 리뷰 - ".$rs['title']),
				'url' => $page_url,
				'keywords' => remove_quote($rs['contributor']."님의 리뷰 - ".$rs['title']),
				'description' => remove_quote($rs['contributor']."님의 리뷰 - ".$rs['title']),
				'image' => $page_image,
				'author' => $support_name,
				'pub_date' => $rs['published_date'],
				'mod_date' =>  $rs['modi_date'],
				'category' =>  '리뷰'
				);

	
	//템플릿 파일 불러오기
	$top_style_css = "type_review";
	include _ROOT."/resource/template/article_review.php";

}

//메인엎기
if($type == "main"){

	if($post_id != "VOPMINSO") exit;

	//메인 class
	include _ROOT."/core/preview/preview_main.class.php";
	
	//메인 스킨
	include _ROOT."/resource/template/main.php";

}

//민소픽 엎기
if($type == "minsopick"){

	if($post_id != "VOPMINSO") exit;

	//민소픽 상단 3개
	$qry = "select A.id, A.serial, A.contributor, A.published_time, B.title, B.description, C.mthumbnail, D.name as writer_name
			from TBL_CONTENTS A 
			left join TBL_CONTENTS_BODY B on A.id = B.contents_id
			left join TBL_CONTENTS_MOBILE C on A.id = C.contents_id 
			left join TBL_MEMBER D on A.member_id = D.id
			where A.kind = 5 and status='published'
			order by published_time desc limit 3";
	$rs = $db->select($qry);

	//민소픽 그룹별 정렬 및 게시물 수 가져오기
	$sql = "select AA.* from 
			(select A.id, A.title, B.cnt from TBL_MINSOPICK A 
			left join (select minsopick_id, count(id) as cnt from TBL_CONTENTS where kind = 5 and status ='published' group by minsopick_id) B on A.id = B.minsopick_id
			where A.del_tf = 'N' order by A.priority) AA order by cnt desc";
	$rs2 = $db->select($sql);


	for($i=0; $i<count($rs2); $i++) {
		$qry = "select A.id, A.serial, A.contributor, A.published_time, B.title, B.description, C.mthumbnail, D.name as writer_name
				from TBL_CONTENTS A 
				left join TBL_CONTENTS_BODY B on A.id = B.contents_id
				left join TBL_CONTENTS_MOBILE C on A.id = C.contents_id 
				left join TBL_MEMBER D on A.member_id = D.id
				where A.kind = 5 and A.minsopick_id = '".$rs2[$i]['id']."' and status='published'
				order by published_time desc limit 3";
		$rs2[$i]['data'] = $db->select($qry);	
	}

	//meta 정의
	$og = array(
				'title' => '민소픽',
				'mtitle' => '민소픽',
				'url' => rtrim(_WEB_URL,'/')."/minsopick",
				'keywords' => '민소픽',
				'description' => '민중의소리가 자신있게 추천하는 기사 민소픽',
				'image' => rtrim(_IMAGE_URL,'/')."/".'mobilethumbnail/vop_meta.jpg',
				'author' => '민중의소리',
				'pub_date' => $_base['time'],
				'mod_date' =>  $_base['time'],
				'category' =>  '민소픽'
				);
	
	//스킨
	$top_style_css = "type_pick";
	$hide_view_container_css = 'Y';  //상단 컨테이너 view_container tag 출력여부(Y 일때 미출력)
	include _ROOT."/resource/template/minsopick.php";

}


//오피니언 엎기
if($type == "opinion"){

	$_opinion = new Opinion();

	// 오피니언 메인 > 사설 조회
	$param_data = array(
					'section_category'=>'opinion',
					'type'=>'editorial',
					'del_tf'=>'N'
					);
	$param = makeParam($param_data);
	$rs_editorial= $_opinion->get_preview_opinion_list($param_data);


	//오피니언 메인 > 칼럼 TOP 조회
	$param_data = array(
					'section_category'=>'opinion',
					'type'=>'column',
					'top_tf'=>'Y',
					'del_tf'=>'N'
					);
	$param = makeParam($param_data);
	$rs_column_top= $_opinion->get_preview_opinion_list($param_data);


	//오피니언 메인 > 칼럼 조회
	$param_data = array(
					'section_category'=>'opinion',
					'type'=>'column',
					'top_tf'=>'N',
					);
	$param = makeParam($param_data);
	$rs_column= $_opinion->get_preview_opinion_column_list($param_data);


	//오피니언 메인 칼럼그룹 리스트
	$param_data = array(
					'use_tf'=>'Y',
					'del_tf'=>'N'
					);
	$param = makeParam($param_data);

	$rs_column_group= $_opinion->get_column_group_list($param_data);

	$param_data = array(
				'use_tf'=>'N',
				'del_tf'=>'N'
				);
	$param = makeParam($param_data);
	$rs_column_group_end= $_opinion->get_column_group_list($param_data);



	//가장 많이 읽은 기사 - 오늘부터 7일전 발행 일련번호 가져오기 
	$cnt_result = $db->select("select id from TBL_CONTENTS where kind in (2,3) and status='published' and published_time >= (CURDATE()-INTERVAL 7 DAY)");
	foreach($cnt_result as $val) {
		$cnt_id[] = $val['id'];
	}

	$cnt_id = implode(",", $cnt_id);
	$sql = "select contents_id, (normal_count + mobile_count) as total from contents_viewcount where contents_id in (".$cnt_id.") order by total desc limit 3";
	$hit_result = $db2->select($sql);

	for($i=0; $i<count($hit_result); $i++) {
		$hit[$i] = $db->row("select A.serial, B.title from TBL_CONTENTS A left join TBL_CONTENTS_BODY B on A.id = B.contents_id where A.id = '".$hit_result[$i]['contents_id']."'");
	}

	$top_style_css = "type_opinion";
	$hide_view_container_css = 'Y';  //상단 컨테이너 view_container tag 출력여부(Y 일때 미출력)

	include _ROOT."/resource/template/opinion.php";

}
exit;

