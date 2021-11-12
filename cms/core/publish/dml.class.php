<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_err('잘못된 요청입니다.');
}
if($_base['method'] != 'POST') exit;

$_contents = new Contents();


switch($mode) {
	//발행된 기사에서 기사 삭제
	case "del_article":

		if($contents_id == '' || $serial == '') msg_exit('주요 항목이 누락되었습니다.');
		$result = $db->query("update TBL_CONTENTS set update_time = '".$_base['time']."', status = 'deleted' where id = '".$contents_id."'");

		if($result){

			//발행기사 삭제시 스택틱 파일 삭제 (2021.11.10)
			$ach_folder = substr($contents_id, 0, -3);							
			$save_path = _ARCHIVE_ROOT.$ach_folder;							

			$static_id = sprintf('%s%011d', 'A', $contents_id);
			$save_file_name = $static_id.".html";
			$save_target = $save_path."/".$save_file_name;

			del_file($save_path, $save_file_name);

			//발행기사의 삭제 로그
			saveLog($contents_id, 'deleted', 'published->deleted');

			$db->query("update TBL_MAIN set update_time = '".$_base['time']."', del_tf = 'Y' where serial = '".$serial."'");
			echo "success";	
		}else{
			echo "삭제에 실패하였습니다";
		}

		break;

	//발행된 기사에서 섹션 편집
	case "change_section":

		if($old_top == $change_top) msg_exit('변경 사항이 없습니다.');

		if($change_top == "Y"){  //TOP 등록

			$rs = $_contents->get_read(array('contents_id' =>$contents_id));
						
			$data = array(
						'serial' => $rs['serial'],
						'member_id' => $rs['member_id'],
						'grade'=>'STANDBY',
						'regist_time' => $_base['time'],
					);

			
			$result = $db->insert('TBL_MAIN', $data);
			saveLog($db->lastid(), 'TOP 등록', 'from 발행된기사');

			if($result) echo "success";
			else echo "등록에 실패하였습니다.";


		}else if($change_top == "N"){ //TOP 삭제

			$result = $db->query("update TBL_MAIN set update_time = '".$_base['time']."', del_tf = 'Y' where serial = '".$serial."'");

			saveLog($contents_id, 'TOP 삭제', 'from 발행된기사');

			if($result) echo "success";
			else echo "수정에 실패하였습니다.";

		}else{
			echo "요청을 처리할 수 없습니다.";
		}
		
		exit;

		break;
	
	//편집대기 선택 삭제 - ajax
	case "sel_del":	
		
		if(count($chk) < 1) msg_exit('선택된 기사가 없습니다');

		$data = array('status'=>'deleted');
		
		for($i=0; $i<count($chk); $i++) {
			$result = $_contents->update($chk[$i], $data);
			if($result) saveLog($chk[$i], 'deleted', 'standby->deleted');
		}

		if($result) echo "success";
		else echo "삭제에 실패하였습니다";

		break;

	//편집대기 - 전체 편집완료
	case "edit":

		for($i=0; $i<=9; $i++) {

			$id = ${'c_id_'.$i};
			$main = ${'is_main_'.$i};
			$old_status = ${'old_status_'.$i};
			$status = ${'status_'.$i};
			
			if($old_status != $status){
				
				$rs = $_contents->get_read(array('contents_id' =>$id));

				if($status == "published"){

					//발행시간 업데이트					
					$data = array("status" => $status, 'published_time' => $_base['time']);
					$result = $_contents->update($id, $data);
					
					if(!$result) msg_err("등록에 실패하였습니다.");

					//기사 static 발행
					$_contents->make_static($id, 'new', '편집대기->발행');
	
					//매인 등록
					if($main == "Y"){
						
						$data = array(
									'serial' => $rs['serial'],
									'member_id' => $rs['member_id'],
									'grade'=>'STANDBY',
									'regist_time' => $_base['time']
								);

						$result = $db->insert('TBL_MAIN', $data);
						if(!$result) msg_replace($id." - 메인섹션 등록에 실패하였습니다.", urldecode($returnUrl));
					}

				}else{  //status 만 변경
					
					if($status == "reserved1"){
						$data = array("mod_cnt"=>"++", "status" => $status, 'published_time' => 'null');					
					}else{
						$data = array("status" => $status, 'published_time' => 'null');					
					}

					$result = $_contents->update($id, $data);
				}
				
				//로그
				saveLog($id, $status, $old_status.'->'.$status);
			}
			

		}

		msg_replace('저장되었습니다.', urldecode($returnUrl));
	
		break;

	//발행된기사 - 스태틱 만들기 ajax
	case 'make_static': 

		if($contents_id == "") msg_exit('발행 대상이 없습니다');
		
		//기사 static 발행
		$result = $_contents->make_static($contents_id, 'modify', '발행기사 재발행');

		if($result) echo "success";
		else echo "발행에 실패하였습니다";
	
		break;


	//메인 엎기
	case 'make_main':

		echo "<style>body {font-size:12px; line-height:150%;}</style>";
		echo "기사/오피니언 엎기를 진행합니다...<br>엎기가 완료시까지 다소 시간이 소요될 수 있습니다.<br><br>";
		ob_flush();
		flush();

		//==================================================================
		echo "● 메인 엎기를 진행합니다.";
		//==================================================================
		ob_flush();
		flush();
		$make_data = array(
					'id' => encrypt(time()."_VOPMINSO"),
					'type' => 'main',
					'sender' => $_SESSION['_admin']['no']
					);

		$tmp = send_curl_post(_DOMAIN."/publish/make", $make_data);

		if($_SERVER["REMOTE_ADDR"] == "121.190.224.191"){
			//echo "temp ::: ".$tmp;
		}

		if($tmp != ""){	
		
			$save_path = _SECTION_ROOT."main";							
			make_dir($save_path);
			
			$tmp .= "\n\n\n<!-- static ".$_base['time']." -->";

			$save_file_name = "main-".date("Ymd")."-".date("His").".html";
			$save_target = $save_path."/".$save_file_name;

			//파일저장
			save_file($save_target, $tmp);

			if(file_exists($save_target)){

				//생성된 파일을 main-last.html로 심볼릭 생성
				@exec("rm -f ".$save_path."/main-last.html");
				@exec("ln -s ".$save_target." ".$save_path."/main-last.html");
				
				//로그 저장			
				staticLog('main', 'main', $save_file_name);

				echo " - 성공 ".$save_file_name."<br>";
			
			}else{
				
				//로그 저장			
				staticLog('main', 'main', $save_file_name." 생성실패");	 
				echo " - <font color='red'>실패</font> ".$save_file_name."<br>";

			}

			ob_flush();
			flush();
			
		}else{
			echo " - <font color='red'>실패</font><br>";
			ob_flush();
			flush();
		}

		//==================================================================
		echo "● 오피니언 엎기를 진행합니다";
		//==================================================================
		ob_flush();
		flush();

		$make_data = array(
					'id' => encrypt(time()."_VOPMINSO"),
					'type' => 'opinion',
					'sender' => $_SESSION['_admin']['no']
					);

		$tmp = send_curl_post(_DOMAIN."/publish/make", $make_data);

		if($tmp != ""){	
		
			$save_path = _SECTION_ROOT."opinion";							
			make_dir($save_path);
			
			$tmp .= "\n\n\n<!-- static ".$_base['time']." -->";

			$save_file_name = "opinion-".date("Ymd")."-".date("His").".html";
			$save_target = $save_path."/".$save_file_name;

			//파일저장
			save_file($save_target, $tmp);

			if(file_exists($save_target)){

				//생성된 파일을 main-last.html로 심볼릭 생성
				@exec("rm -f ".$save_path."/opinion-last.html");
				@exec("ln -s ".$save_target." ".$save_path."/opinion-last.html");

				//로그 저장			
				staticLog('opinion', 'opinion', $save_file_name);
				echo " - 성공 ".$save_file_name."<br>";
			}else{

				//로그 저장			
				staticLog('opinion', 'opinion', $save_file_name." 생성실패");	 
				echo " - <font color='red'>실패</font> ".$save_file_name."<br>";
			}

			ob_flush();
			flush();
			
		}else{
			echo " - <font color='red'>실패</font><br>";
			ob_flush();
			flush();
		}

		//==================================================================
		echo "● 민소픽 엎기를 진행합니다";
		//==================================================================
		ob_flush();
		flush();

		$make_data = array(
					'id' => encrypt(time()."_VOPMINSO"),
					'type' => 'minsopick',
					'sender' => $_SESSION['_admin']['no']
					);

		$tmp = send_curl_post(_DOMAIN."/publish/make", $make_data);

		if($tmp != ""){	
		
			$save_path = _SECTION_ROOT."minsopick";							
			make_dir($save_path);
			
			$tmp .= "\n\n\n<!-- static ".$_base['time']." -->";

			$save_file_name = "minsopick-".date("Ymd")."-".date("His").".html";
			$save_target = $save_path."/".$save_file_name;

			//파일저장
			save_file($save_target, $tmp);

			if(file_exists($save_target)){
				//생성된 파일을 main-last.html로 심볼릭 생성
				@exec("rm -f ".$save_path."/minsopick-last.html");
				@exec("ln -s ".$save_target." ".$save_path."/minsopick-last.html");
				
				//로그 저장			
				staticLog('minsopick', 'minsopick', $save_file_name);
				echo " - 성공 ".$save_file_name."<br>";

			}else{
				//로그 저장			
				staticLog('minsopick', 'minsopick', $save_file_name." 생성실패");	 
				echo " - <font color='red'>실패</font> ".$save_file_name."<br>";

			}

			ob_flush();
			flush();
			
		}else{
			echo " - <font color='red'>실패</font><br>";
			ob_flush();
			flush();
		}
		
		echo "<br><strong>엎기가 완료되었습니다.</strong><br> 결과 확인 후 하단 닫기 버튼을 클릭하여 주세요.";
		ob_flush();
		flush();

		break;

	default:
		echo '잘못된 요청입니다';		
}
exit;
