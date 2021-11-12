<?php
if(!defined('_HOME_TITLE')) exit;

$_member = new Member;

//전화번호 검색시 하이픈 제거
if($pm) $pm = str_replace('-', '', $pm);

//파라미터
$param_data = array(
		'grp' => $grp,
		'nm' => $nm,
		'em' => $em,
		'pm' => $pm,
		'nPage' => $nPage
		);

//return $param['query'], $param['nopage'] - (페이징 사용)
$param = makeParam($param_data);

//삭제
if($_base['method'] == 'POST' && $mode == "del"){

	if($no == "") msg_err('삭제 대상이 없습니다');

	$data = array(
				'del_tf' => 'Y',
				'update_time' => date("Y-m-d H:i:s")
			);
	$where = array(
				'id' => $no
			);

	$result = $_member->update($data, $where);
	if($result) msg_replace("삭제되었습니다", 'list'.$param['query']);
	else msg_err("삭제에 실패하였습니다");

	exit;
}

//공통처리
if($mode == "new" || $mode == "mod"){
	
	$email = ($email1 != "" &&  $email2 != "") ? $email1."@".$email2 : "";

	$data = array(
		'name' => $name,
		'email' => $email,
		'phone' => $phone,
		'mobile' => $mobile,
		'user_type' => $user_type,		
		);
}

//신규등록
if($_base['method'] == 'POST' && $mode == "new"){

	if($user_id == "" || $pwd == "" || $name == "" || $user_type == "") msg_err("주요 등록 항목이 누락되었습니다.");
	if(in_array($adm_id, $_not_allow_id)) msg_err("사용하실 수 없는 아이디입니다.");  //config정의
		
	$cnt = $_member->id_count($user_id);
	if($cnt > 0) msg_err("이미 등록된 아이디입니다.");

	$enc_pass = crypt($pwd.$_base['postfix']);


	//회원 사진 이미지 업로드
	$upfile_pc = "";
	$img_info_pc = "";
	$img_info = "";
	$upload_data = array();

	if($_FILES['input_thumb']['tmp_name'] != ""){

		$img_info = getimagesize($_FILES['input_thumb']['tmp_name']);

		$img_info['width'] = $img_info[0];
		$img_info['height'] = $img_info[1];
		$img_info['size'] = $_FILES['input_thumb']['size'];

		//워터마크 생성 여부
		$make_watermark = 'N';

		//이미지 업로드 - 워터마크, 썸네일 자동 생성
		$upfile_pc = $_member->upload($_FILES['input_thumb']['name'], $_FILES['input_thumb']['tmp_name'], $_FILES['input_thumb']['size'], $make_watermark);

		if($upfile_pc != ''){
			$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
		}

		$file_real_name = end(explode("/", $upfile_pc));

		$upload_data = array(
				'file_real_name' => $file_real_name,
				'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
				'filepath' => ltrim($upfile_pc, '/'),
				'filesize' => $img_info['size'],
				'file_width' => $img_info_pc[0], 
				'file_height' => $img_info_pc[1]
		);
	}

	$add_data = array(
			'user_id' => $user_id,
			'password' => $enc_pass,
			'regist_time' => date("Y-m-d H:i:s")
			);
	$data = array_merge($data, $add_data);
	$data = array_merge($data, $upload_data);

	$result = $_member->add($data);

	if($result) msg_replace("등록되었습니다", 'list');
	else msg_err("등록에 실패하였습니다");

	exit;
}

//정보수정
if($_base['method'] == 'POST' && $mode == "mod"){

	if(empty($no)) msg_err("대상이 없습니다");
	if($name == "" || $user_type == "") msg_err("주요 등록 항목이 누락되었습니다.");


	if($chgPwd == "Y"){		
		if(strlen($pwd) < 4)  msg_err("변경하실 비밀번호를 확인하여 주세요");
		$enc_pass = crypt($pwd.$_base['postfix']);
		$data = array_merge($data, array('password'=>$enc_pass));
	}

	$add_data = array(
			'update_time' => date("Y-m-d H:i:s")
			);
	$data = array_merge($data, $add_data);

	$where = array('id' => $no);

	$result = $_member->update($data, $where);
	
	if($result) msg_replace("수정되었습니다", 'list'.$param['query']);
	else msg_err("수정에 실패하였습니다");

	exit;
}

//개인정보수정
if($_base['method'] == 'POST' && $mode == "mod_me"){

	if($_SESSION['_admin']['no'] == "") msg_replace("", "/login");
	if($name == "") msg_err("주요 등록 항목이 누락되었습니다.");

	//회원 사진 이미지 업로드
	$upfile_pc = "";
	$img_info_pc = "";
	$img_info = "";
	$upload_data = array();


	if($flag == "delete"){

		$upload_data = array(
			'file_real_name' => 'NULL',
			'filename' =>'NULL',
			'filepath' =>'NULL',
			'filesize' =>'NULL',
			'file_width' => 'NULL', 
			'file_height' => 'NULL'
		);

	} else if($flag == "keep"){

		$upload_data = array();

	} else {

		if($_FILES['input_thumb']['tmp_name'] != ""){

			$img_info = getimagesize($_FILES['input_thumb']['tmp_name']);

			$img_info['width'] = $img_info[0];
			$img_info['height'] = $img_info[1];
			$img_info['size'] = $_FILES['input_thumb']['size'];

			//워터마크 생성 여부
			$make_watermark = 'N';

			//이미지 업로드 - 워터마크, 썸네일 자동 생성
			$upfile_pc = $_member->upload($_FILES['input_thumb']['name'], $_FILES['input_thumb']['tmp_name'], $_FILES['input_thumb']['size'], $make_watermark);

			if($upfile_pc != ''){
				$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
			}

			$file_real_name = end(explode("/", $upfile_pc));

			$upload_data = array(
					'file_real_name' => $file_real_name,
					'filename' => ltrim(fileRename($_FILES['input_thumb']['name'])),
					'filepath' => ltrim($upfile_pc, '/'),
					'filesize' => $img_info['size'],
					'file_width' => $img_info_pc[0], 
					'file_height' => $img_info_pc[1]
			);
		}
	}

	$email = ($email1 != "" &&  $email2 != "") ? $email1."@".$email2 : "";

	$data = array(
		'name' => $name,
		'email' => $email,
		'phone' => $phone,
		'mobile' => $mobile,
		'update_time' => date("Y-m-d H:i:s")
		);

	if($chgPwd == "Y"){		
		if(strlen($pwd) < 4)  msg_err("변경하실 비밀번호를 확인하여 주세요");
		$enc_pass = crypt($pwd.$_base['postfix']);
		$data = array_merge($data, array('password'=>$enc_pass));
	}

	$data = array_merge($data, $upload_data);

	$where = array('id' => $_SESSION['_admin']['no']);

	$result = $_member->update($data, $where);
	
	if($result) msg_replace("수정되었습니다", '/member/me');
	else msg_err("수정에 실패하였습니다");

	exit;
}


//개인탈퇴
if($_base['method'] == 'POST' && $mode == "del_me"){

	if($_SESSION['_admin']['no'] == "") msg_replace("", "/login");

	$data = array(
				'del_tf' => 'Y',
				'update_time' => date("Y-m-d H:i:s")
			);
	$where = array('id' => $_SESSION['_admin']['no']);

	$result = $_member->update($data, $where);

	if($result){
		unset($_SESSION['_admin']);
		session_destroy();
		msg_replace("탈퇴가 완료되었습니다", '/');

	}else{
		msg_err("탈퇴에 실패하였습니다");
	}

	exit;
}
exit;