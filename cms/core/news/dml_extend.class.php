<?php 
if(!defined('_HOME_TITLE')) exit;

if($_base['method'] == "POST" && ($mode == "sel_del" || $mode == "chg_level")){

	if(strpos($_SERVER['HTTP_REFERER'], _HOST.'/news/top') < 1) msg_err('잘못된 요청입니다');

	if($mode == "sel_del"){
		for($i=0; $i< count($chk); $i++) {	
			if($chk[$i] != ""){
				$db->query("update TBL_MAIN set del_tf='Y' where id = '".$chk[$i]."'");
				saveLog($chk[$i], 'TopRank 삭제', 'Top기사 삭제');
			}
		}
		msg_replace('삭제되었습니다', '/news/'.$refer.'?nPage='.$nPage);
	
	}else{
	
		for($i=0; $i<count($top_id); $i++) {
			if($old_priority[$i] != $priority[$i]){

				if($priority[$i] <= 3) $grade = 'TOP';
				else if($priority[$i] <= 6) $grade = 'MINOR';
				else $grade = 'SUB';

				$db->query("update TBL_MAIN set grade = '".$grade."', priority = '".$priority[$i]."', update_time='".$_base['time']."' where id = '".$top_id[$i]."'");
				saveLog($top_id[$i], 'TopRank priority', $old_priority[$i].'->'.$priority[$i]);
			}
		}
		msg_replace('수정되었습니다', '/news/'.$refer.'?nPage='.$nPage);
	}

	exit;
}

//top 기사관리 - 노출대기에서 넘어온 것
if($_base['method'] == "POST" && ($mode == "sel" || $mode == "all")){

	if(strpos($_SERVER['HTTP_REFERER'], _HOST.'/news/top') < 1) msg_err('잘못된 요청입니다');

	for($i=0; $i<=9; $i++) {

		$modify = true;

		$check = $chk[$i];		
		$id = ${'top_id_'.$i};
		$old_grade = ${'old_grade_'.$i};
		$grade = ${'fm_rd_'.$i};

		if($mode == "sel"){ 
			if($check == '') $modify = false;
		}

		if($modify){

			if($grade == "DEL"){  //노출삭제

				$db->query("update TBL_MAIN set del_tf='Y' where id = '".$id."'");
				saveLog($id, 'Top 삭제', 'Top 기사 삭제');

			}else{

				$db->query("update TBL_MAIN set top_tf = 'Y' where id = '".$id."'");
				saveLog($id, 'Top 노출 승인', 'Top 노출 승인');
			}				
		}
	}

	msg_replace('수정되었습니다', '/news/'.$refer.'?nPage='.$nPage);

	exit;
}

//노출수정 화면에서 넘어온 것
if($_base['method'] == "POST" && $mode == "modify"){

	if(strpos($_SERVER['HTTP_REFERER'], _HOST.'/news/edit') < 1) msg_err('잘못된 요청입니다');
	if($top_id == "") msg_err('대상을 확인할 수 없습니다.');

	
	$thumb_name = $old_photo;
	if($del_img == "Y"){
		removeOldPhotos($old_photo);
		$thumb_name = "";
	}

	if($_FILES['userfile']['tmp_name']){
		
		//사용자 디렉토리 생성
		$fpath = _IMAGE_ROOT."/news";
		
		if(!file_exists($fpath)){
			@mkdir($fpath, 0777, true);
			@chmod($fpath, 0777);
		}

		//년월 디렉토리 생성
		$fpath = $fpath."/".date('Y-m');
		if(!file_exists($fpath)){
			@mkdir($fpath, 0777, true);
			@chmod($fpath, 0777);
		}

		//썸네일디렉토리생성
		$fpath_thumb = $fpath."/thumb";
		if(!file_exists($$fpath_thumb)){
			@mkdir($fpath_thumb, 0777, true);
			@chmod($fpath_thumb, 0777);
		}

		$filename = uploadSingle($_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['size'], $fpath, 10, 'image');

		if($filename != ''){
			include_once _ROOT."/core/common/thumb.class.php";

			$fname = end(explode("/", $filename));

			$resizeObj = new thumbImage($filename);
		
			$img_info = getimagesize($filename);
			
			// width 800이 초과되는 경우 resize
			if($img_info[0] > 800){
				$resizeObj -> resizeImage(800, 10000, 'landscape'); 
				$resizeObj -> saveImage($filename, 100);
			}
						
			//썸네일생성
			$thumb_path = str_replace($fname, "thumb/".$fname, $filename);
			$resizeObj -> resizeImage(150, 1000, 'landscape'); 
			$resizeObj -> saveImage($thumb_path, 100);

		}

		$thumb_name = str_replace(_IMAGE_ROOT, '', $filename);
	}

	$related = "";
	if($relate_serial != ''){
		for($i=0; $i<count($relate_serial); $i++) {
			if($relate_serial[$i] != ''){
				$related[$i]['serial'] = $relate_serial[$i];
				$related[$i]['title'] = $relate_title[$i];
			}
		}
	}

	$data = array(
				'priority' => $priority,
				'grade' => $article_level,
				'style' => $article_style,
				'box_style' => $tag_color,
				'box_title' => $box_title,
				'title' => $title,
				'description' => $description,
				'thumbnail1' => $thumb_name,
				'related' => json_encode_han($related),
				'update_time' => $_base['time']
				);
	$result = $db->update('TBL_MAIN', $data, array('id' => $top_id));

	if($result) msg_replace('수정되었습니다', '/news/'.$refer.'?nPage='.$nPage);
	else msg_err('수정에 실패하였습니다');

	exit;
}