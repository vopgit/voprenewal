<?php
if(!defined('_HOME_TITLE')) exit;
refererCheck();

function setFailLogin(){
	$_SESSION['login']['fail'] = $_SESSION['login']['fail'] + 1;
	$_SESSION['login']['time'] = time();
}

if($_base['method'] == "POST" && $mode == 'login'){

	$_member = new Member();

	if(strlen($vop_id) < 4 || strlen($vop_pwd) < 4) msg_json('Error', "아이디 또는 비밀번호를 확인하여 주세요");

	$failCnt = ($_SESSION['login']['fail'] != "") ? $_SESSION['login']['fail'] : 0;

	//로그인제한
	if($failCnt > 4){		
		if(time() - $_SESSION['login']['time'] < 600){
			msg_json('Error', "로그인 오류 5회 초과로 10분간 로그인을 하실 수 없습니다.");			
		}	
	}

	//회원조회
	$rs = $_member->infoById($vop_id);
	if($rs['id'] == ""){
		setFailLogin();
		msg_json('Error', "아이디 또는 비밀번호를 확인하여 주세요.");
	}

	//비밀번호 검증
	if(crypt($vop_pwd.$_base['postfix'], $rs['password']) != $rs['password']){
		setFailLogin();
		msg_json('Error', "비밀번호를 확인하여 주세요".crypt($vop_pwd.$_base['postfix'], $rs['password'])."-".$rs['password']);
	}

	//로그인 성공 - 세션 create
	$_SESSION['_admin'] = array(
								'no' => $rs['id'],
								'id' => $rs['user_id'],
								'name' => $rs['name'],
								'email' => $rs['email'],
								'role' => $rs['user_type']
								);
	
	//로그인 로그 기록
	$log_data = array(
					  'member_id' => $rs['id'],
		              'logined_at' => date('Y-m-d H:i:s'),
					  'ip_address' => getUserIP()
					);
	$db->insert('TBL_MEMBER_LOGIN_LOGS', $log_data);

	//last 방문시간 업데이트
	$_member->update_last_visit($rs['id']);

	//로그인 오류회수 초기화
	unset($_SESSION['login']);

	//성공값 return	
	msg_json('success', '성공');
}

exit;