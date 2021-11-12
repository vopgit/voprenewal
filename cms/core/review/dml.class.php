<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_json('error', '잘못된 요청입니다.');
}

if(empty($_SESSION['_admin']['no'])) msg_json('error', '잘못된 요청입니다.');

$_review = new Review();

//공통 데이터
$data = array(
			'contributor' => $contributor,
			'email' => $email,
			'osmu_id' => $osmu_id,
			'contents' => $contents
		);

switch($mode) {
	
	//신규등록
	case "INSERT_REVIEW":
	
		$data2 = array('member_id' => $_SESSION['_admin']['no'], 'reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
		$data = array_merge($data, $data2);

		$in_id = $_review->regist($data);
		
		//if($related != '') $_review->save_related($in_id, $related);
	
		if($in_id) msg_json('success', $in_id);	
		else msg_json('error', '등록에 실패하였습니다.');
		
		break;
	
	//수정
	case "MODIFY_REVIEW":

		if(empty($review_id)) msg_json('error', '대상이 없습니다.');

		$data2 = array(
			'modi_date' => $_base['time'],
			'modi_adm' => $_SESSION['_admin']['no'],
			'modi_ip' => $_SERVER["REMOTE_ADDR"]
			);
		$data = array_merge($data, $data2);
		
		$result = $_review->update($review_id, $data);

		if($n_status == "published"){
			$_review->make_static($review_id, 'modify');
		}

		if($result) msg_json('success', '성공');	
		else msg_json('error', '수정에 실패하였습니다.');
	
		break;

	// 삭제
	case "DEL_SEL_ID": 		
		
		if(empty($review_id)) msg_json('error', '잘못된 요청입니다.');

		//공통 데이터
		$data2 = array(
			'del_adm' => $_SESSION['_admin']['no'],
			'del_tf' => 'Y',
			'del_ip' => $_SERVER["REMOTE_ADDR"],
			'del_date' => date("Y-m-d H:i:s")
		);
		$result = $_review->del_update($review_id, $data2);

		if($result) msg_json('success', '성공');	
		else msg_json('error', '삭제에 실패하였습니다.');

		exit;

		break;



	// 삭제
	case "selDelete":

		$param_data = array(
		'nPage'=>$nPage
		);

		$param = makeParam($param_data);

		if(count($chk) < 1) msg_err("대상이 없습니다");

		if($adm_no == "") msg_err("주요 등록 항목이 누락되었습니다.");

		if($db->query("update TBL_REVIEW set del_tf = 'Y', del_adm = '".$adm_no."', del_date = now(), del_ip = '".$_SERVER["REMOTE_ADDR"]."' where id in (".implode(',', $chk).")")) 
			msg_json('success', '성공');
		else msg_json('error', '삭제에 실패하였습니다.');

		exit;
		break;

	// 삭제
	case "UPDATE_STATUS_SEL_ID":

		if(empty($status)) msg_json('error', '대상이 없습니다.');

		$arr_status=explode(',', $status);	// status 값 예 : id|status,id|status,id|status...

		$resutl_tf = true;

		for($i = 0; $i < count($arr_status); $i++){
			
			$arr_id_status = "";	//초기화

			$arr_id_status = explode('|',$arr_status[$i]);

			if((!empty($arr_id_status[0]))&&(!empty($arr_id_status[1]))){

				$qry = "";
				$qry2 = "";

				//상태가 published 일 경우  publish 관련 추가 정보 업데이트
				if($arr_id_status[1] == "published"){
					$qry2 = ", published_tf='Y', published_adm = '".$_SESSION['_admin']['no']."', published_date = now(), published_ip = '".$_SERVER["REMOTE_ADDR"]."'";

					
				}else{
					$qry2 = ", published_tf='N', published_adm = '', published_date = '', published_ip = ''";
				}


				$qry = "update TBL_REVIEW set status = '".$arr_id_status[1]."', modi_adm = '".$_SESSION['_admin']['no']."', modi_date = now(), modi_ip = '".$_SERVER["REMOTE_ADDR"]."' ".$qry2." where id = ".$arr_id_status[0]." and del_tf = 'N' ";

				if($db->query($qry)) {

					

					//static발행
					if($arr_id_status[1] == "published"){

						staticLog(1, 1, 1);

						if($from_page == "standby") $_review->make_static($arr_id_status[0], 'new');
						else $_review->make_static($arr_id_status[0], 'modify');
					}
					
				}else{
					$resutl_tf = false;
				}

			}

		}

		//echo "aaaaaaaa :: ".count($arr_status);

		//msg_json ('error', $status);

		if(!$resutl_tf)  msg_json('error', '일부 정보가 반영되지 않았습니다.');
		else msg_json('success', '성공');

		exit;
		break;

	default:
		msg_json('error', '잘못된 요청입니다.');
}
exit;
