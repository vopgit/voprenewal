<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_json('error', '잘못된 요청입니다.');
}

if(empty($_SESSION['_admin']['no'])) msg_json('error', '잘못된 요청입니다.');

$_alim = new Alim();

//공통 데이터
$data = array(
			'member_id' => $_SESSION['_admin']['no'],
			'top_tf' => $top_tf,
			'use_tf' => $use_tf,
			'category' => $category,
			'title' => $title,
			'contents' => $contents,
			'contributor' => $contributor,
		);



switch($mode) {
	
	//신규등록
	case "new":
		
		$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);

		$data = array_merge($data, $data2);

		//미리보기시
		if($_GET['tmp'] == "temp"){
			$in_id = $_alim->regist_temp($data);
			echo $in_id;
			exit;
		}

		$in_id = $_alim->regist($data);
	
		if($in_id) msg_json('success', $in_id);	
		else msg_json('error', '등록에 실패하였습니다.');
		
		break;
	
	//수정
	case "modify":

		if(empty($notice_id)) msg_json('error', '대상이 없습니다.');

		$data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);

		$data = array_merge($data, $data2);
		
		$result = $_alim->update($notice_id, $data);

		if($result) msg_json('success', '성공');	
		else msg_json('error', '수정에 실패하였습니다.');
	
		break;

	//첨부파일 삭제
	case "del_attach": 		
		
		if($id == "") msg_json('error', '잘못된 요청입니다.');

		$result = $_alim->delete_attach($id);

		if($result) msg_json('success', '성공');	
		else msg_json('error', '삭제에 실패하였습니다.');

		break;

	// 삭제
	case "selDelete":

		$param_data = array(
		'nPage'=>$nPage
		);

		$param = makeParam($param_data);


		//form 내 배열로 된 name 처리 방법
		$arr_chk = $_POST[chk];

		if(count($arr_chk) < 1) msg_err("대상이 없습니다");

		$qry = "update TBL_NOTICE set del_tf = 'Y', del_adm = '".$_SESSION['_admin']['no']."', del_date = now(), del_ip = '".$_SERVER["REMOTE_ADDR"]."' where id in (".implode(',', $arr_chk).")";

		if($db->query($qry)){
			msg_replace("삭제되었습니다", 'list'.$param['query']);
		}else{
			msg_err("삭제에 실패하였습니다");
		}

		break;

	default:
		msg_json('error', '잘못된 요청입니다.');
}
exit;
