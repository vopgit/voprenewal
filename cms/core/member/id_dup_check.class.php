<?php 
if(!defined('_HOME_TITLE')) exit; 
header('Content-Type: application/json; charset=UTF-8');

if($id == ""){
	
	$result['code'] = "error";
	$result['msg'] = "ID가 없습니다.";

}else{ 	
	if(in_array($id, $_not_allow_id)){  //config정의
		$result['code'] = "error";
		$result['msg'] = "등록이 가능하지 않은 아이디입니다.";
	
	}else{
		
		$cnt = $db->total("select count(*) from TBL_MEMBER where user_id = '".$id."'");
		if($cnt > 0){
			$result['code'] = "error";
			$result['msg'] = "사용중인 아이디입니다.";
		}else{			
			$result['code'] = "success";
			$result['msg'] = "사용가능한 아이디입니다.";
		}
	}
}	

echo json_encode($result);
exit;