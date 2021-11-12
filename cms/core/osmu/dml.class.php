<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_json('error', '잘못된 요청입니다.');
}

if(empty($_SESSION['_admin']['no'])) msg_json('error', '잘못된 요청입니다.');

$_osmu = new Osmu();

//공통 데이터
$data = array(
			'member_id' => $_SESSION['_admin']['no'],
			'title' => $title,
			'contents' => $contents,
			'contributor' => $contributor,
		);



switch($mode) {
	
	//신규등록
	case "new":	
		$data2 = array('regist_time' => $_base['time'], 'published_time' => $_base['time']);
		$data = array_merge($data, $data2);

		//미리보기시
		if($_GET['tmp'] == "temp"){
			$in_id = $_osmu->regist_temp($data);
			echo $in_id;
			exit;
		}

		$in_id = $_osmu->regist($data, $related);
		
		if($related != '') $_osmu->save_related($in_id, $related);

		//스태틱만들기
		$_osmu->make_static($in_id, 'new');		

		if($in_id) msg_json('success', $in_id);	
		else msg_json('error', '등록에 실패하였습니다.');
		
		break;
	
	//수정
	case "modify":

		if(empty($osmu_id)) msg_json('error', '대상이 없습니다.');

		$data2 = array('update_time' => $_base['time']);
		$data = array_merge($data, $data2);
		
		//$result = $_osmu->update($osmu_id, $data, $related);

		$result = $_osmu->update_for_related($osmu_id, $data, $related, $old_related);

		//스태틱만들기
		$_osmu->make_static($osmu_id, 'modify');

		if($result) msg_json('success', '성공');	
		else msg_json('error', '수정에 실패하였습니다.');
	
		break;

	//첨부파일 삭제
	case "del_attach": 		
		
		if($id == "") msg_json('error', '잘못된 요청입니다.');

		$result = $_osmu->delete_attach($id);

		if($result) msg_json('success', '성공');	
		else msg_json('error', '삭제에 실패하였습니다.');

		break;

	default:
		msg_json('error', '잘못된 요청입니다.');
}
exit;
