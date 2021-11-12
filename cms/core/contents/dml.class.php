<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_err('잘못된 요청입니다.');
}
if($_base['method'] != 'POST') exit;

$_contents = new Contents();

//파일업로드 
if(isset($_POST['input_thumb_values'])) {
	$img_values = str_replace("\\","",$_POST['input_thumb_values']);
	$img_jason = json_decode($img_values);
	$img_TMP = explode(',',$img_jason->data);
	$img_DATA = base64_decode($img_TMP[1]);

	if($img_DATA) {
		$ext = strtolower(end(explode(".", $img_jason->name)));

		$fdir = "/mobilethumbnail/".date('Y-m');
		$fpath = realpath(_IMAGE_ROOT).$fdir;
		if(!file_exists($fpath)){
			@mkdir($fpath, 0777, true);
			@chmod($fpath, 0777);
		}
		$upload_filename = $contents_id."_".generateRandomString().".".$ext;

		$handle = @fopen($fpath.'/'.$upload_filename, 'w');
		fwrite($handle, $img_DATA);
		fclose($handle);

		@chmod( $fpath.'/'.$upload_filename, 0777);
		$up_mthumbnail = $fdir.'/'.$upload_filename;
   }
} 

//공통데이터
if($news_kind != '3') $column_id = '';
if($news_kind != '5') $minsopick_id = '';

$data = array(
			'type' => $type,
			'kind' => $news_kind, 
			'category_id' => $news_category,
			'column_id' => $column_id,
			'minsopick_id' => $minsopick_id,
			'onesource' => $osmu, 
			'contributor' => $contributor,
			'related' => $related,
			'tags' => $_contents->make_tags($tags)
			);

$data_body = array(			
			'title' => $title,
			'description' => removeEnter($description),
			'content' => $contents
			);
//mid
$data_mobile = array(
			'mtitle' => $mtitle,
			'mdescription' => removeEnter($mdescription),
			);

switch($mode) {
	
	//신규등록
	case "new":					
		
		if(empty($title)) msg_err('제목이 없습니다.');

		$data = array_merge($data, array('regist_time' => $_base['time']));
		
		if($_POST['input_thumb_values'] != ''){
			$mfilename = $_contents->upload_mobile_thumb($_POST['input_thumb_values']);
			if($mfilename != '') $data_mobile = array_merge($data_mobile, array('mthumbnail' => $mfilename));
		}
		
		$result = $_contents->insert($data, $data_body, $data_mobile);
		if($result){			
			msg_replace("등록 되었습니다.", "/contents/list".urldecode($returnUrl));
		}else{			
			msg_err("등록에 실패하였습니다");
		}

		break;

	//수정
	case "modify":

		if(empty($contents_id)) msg_err('대상이 없습니다.');

		//에디터가 편집시
		if($request_from == "Y") $data = array_merge($data, array('request_from' => $_SESSION['_admin']['name']." 편집자가 고쳤습니다. (".$_base['time'].")"));

		$data = array_merge($data, array('update_time' => $_base['time'], 'old_osmu' => $old_osmu));

		$where = array('id' => $contents_id);

		$result = $_contents->update($contents_id, $data, $where);

		$result2 = $_contents->update($contents_id, $data_body, array('contents_id' => $contents_id), 'TBL_CONTENTS_BODY');

		if($_POST['input_thumb_values'] != ''){
			$mfilename = $_contents->upload_mobile_thumb($_POST['input_thumb_values']);
			if($mfilename != '') $data_mobile = array_merge($data_mobile, array('mthumbnail' => $mfilename));
		}

		$result3 = $_contents->update($contents_id, $data_mobile, array('contents_id' => $contents_id), 'TBL_CONTENTS_MOBILE');

		if($result && $result2 && $result2){
			if($fromUrl != '')  msg_replace("수정되었습니다.", urldecode($fromUrl));
			else msg_replace("수정되었습니다.", "/contents/list".urldecode($returnUrl));
		}else{
			msg_err("수정에 실패하였습니다");
		}
		
	
		break;

	//송고 - ajax 
	case "send":

		if(empty($contents_id)) msg_err('대상이 없습니다.');
		
		$result = $_contents->set_status($contents_id, 'standby');
		saveLog($contents_id, '송고', $status.'→standby');

		if($result) echo "success";
		else echo "수정에 실패하였습니다";

		break;

	//상태변경 - ajax 
	case "change_status":

		if(empty($contents_id)) msg_json('error', '대상이 없습니다.');
		if(empty($status)) msg_json('error', '변경 상태를 확인할 수 없습니다.');
		if(empty($old_status)) msg_json('error', '기존 상태를 확인할 수 없습니다.');

		$result = $_contents->set_status($contents_id, $status);
		
		if($result){
			if($status == 'standby') $log_title = "편집대기";
			else if($status == 'deleted') $log_title = "삭제";
			
			saveLog($contents_id, $status, $old_status.'→'.$status);

			if($result) echo "success";
		}else{
			echo "수정에 실패하였습니다";
		}

		break;
	
	default:
		msg_err('잘못된 요청입니다.');
}
exit;
