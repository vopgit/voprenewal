<?php 
//리뷰 저장 page
if(!defined('_HOME_TITLE')) exit; 

if($_base['method'] != 'POST'){
	echo "잘못된 요청입니다.";
	exit;
}

if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) < 0){	
	echo "유효한 요청이 아닙니다.";
	exit;
}

//db 연결
$db = new DB();

extractData($_POST);

if($serial == "" || strlen($serial) != 12){
	echo "리뷰대상을 확인할 수 없습니다.";
	exit;
}

if($email1 == "" || $email2 == ""){
	echo "이메일을 확인하여 주세요.";
	exit;
}

$id = (int)substr($serial, 1,11);

$contents = str_replace('\r\n', '<br>', $contents);
$contents = str_replace('\n', '<br>', $contents);

$data = array(
			'osmu_id' => $id,			
			'contributor' => $name,
			'email' => $email1.'@'.$email2,
			'contents' => $contents,
			'reg_date' => date('Y-m-d H:i:s'),
			'reg_ip' => getUserIP()
			);

$result = $db->insert('TBL_REVIEW', $data);
$in_id = $db->lastid();
$db->query("update TBL_REVIEW set serial = '".'R'.sprintf('%011d', $in_id)."' where id = '".$in_id."'");


if($result) echo "success";
else echo "등록에 실패하였습니다. 잠시 후 이용하여 주세요";

exit;