<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_json('error', '잘못된 요청입니다.');
}

if(empty($_SESSION['_admin']['no'])) msg_json('error', '잘못된 요청입니다.');

include_once _ROOT."/core/common/thumb.class.php";

//편집 탑관리에 사용함 (부장님 추가, 2021-11-02)
include_once _ROOT."/core/news/dml_extend.class.php";

$_news = new News();

$common_data = array('section_category' => $section_category);

switch($section_category) {
	
	//isan
	case "isan":

		if(count($title) <= 0){
			msg_json('error', '필수 항목이 누락되었습니다.');
		}else{

			$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

			$arr_del_section_id = explode(',', $str_del_section_id);	//삭제 처리할 고유번호

			$arr_section_id = explode(',', $str_section_id);	//등록된 고유번호

			//고유번호 삭제 처리
			if(count($arr_del_section_id)>0){

				$del_idx_chk = true;

				for($i=0; $i<count($arr_del_section_id); $i++){

					if(($arr_del_section_id[$i] != "")&&(in_array($arr_del_section_id[$i], $arr_section_id))){
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);

						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($arr_del_section_id[$i], $up_data);

						if(!$result){
							$del_idx_chk = false;
						}
					}
				}

				if(!$del_idx_chk){
					msg_json('error', '삭제에 실패하였습니다.');
				}
			}


			//form 처리
			for($i=0; $i<count($title); $i++){

				if($section_id[$i] == ""){
					// INSERT

					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'title' => $title[$i],
						'description' => $description[$i],
						'serial' => $serial[$i],
						'subject_1' => $subject_1[$i],
						'content_1' => $content_1[$i],
						'subject_2' => $subject_2[$i],
						'content_2' => $content_2[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";


						if($_FILES['input_thumb']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					if (in_array($section_id[$i], $arr_del_section_id)) {
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);

					}else{
						// UPDATE

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";

						//$up_data3 = array();

						if($flag[$i] == "delete"){

							$up_data3 = array(
								'file_real_name' => 'NULL',
								'filename' =>'NULL',
								'filepath' =>'NULL',
								'filesize' =>'NULL',
								'file_width' => 'NULL', 
								'file_height' => 'NULL'
							);

						} else if($flag[$i] == "keep"){

							$up_data3 = array();

						} else {

							if($_FILES['input_thumb']['tmp_name'][$i] != ""){
								$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

								$img_info['width'] = $img_info[0];
								$img_info['height'] = $img_info[1];
								$img_info['size'] = $_FILES['input_thumb']['size'][$i];

								//워터마크 생성 여부
								$make_watermark = 'N';

								//이미지 업로드 - 워터마크, 썸네일 자동 생성
								$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
								
								//echo $upfile_pc."<br>";

								if($upfile_pc != ''){
									$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
								}

								$file_real_name = end(explode("/", $upfile_pc));

								//ob_flush();
								//flush();
								$up_data3 = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
								);
							}

						}

						$up_data = array(
							'title' => $title[$i],
							'description' => $description[$i],
							'priority'=>($i+1),
							'serial' => $serial[$i],
							'subject_1' => $subject_1[$i],
							'content_1' => $content_1[$i],
							'subject_2' => $subject_2[$i],
							'content_2' => $content_2[$i]
						);

						$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
						$up_data = array_merge($up_data, $up_data2);
						$up_data = array_merge($up_data, $up_data3);
						$up_data = array_merge($up_data, $common_data);
					}

					//debug($up_data);

					$result = $_news->update($section_id[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}
		}

		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;


	//photo
	case "photo":

		if(count($title) <= 0){
			msg_json('error', '필수 항목이 누락되었습니다.');
		}else{

			$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

			$arr_del_section_id = explode(',', $str_del_section_id);	//삭제 처리할 고유번호

			$arr_section_id = explode(',', $str_section_id);	//등록된 고유번호

			//고유번호 삭제 처리
			if(count($arr_del_section_id)>0){

				$del_idx_chk = true;

				for($i=0; $i<count($arr_del_section_id); $i++){

					if(($arr_del_section_id[$i] != "")&&(in_array($arr_del_section_id[$i], $arr_section_id))){
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);
						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($arr_del_section_id[$i], $up_data);

						if(!$result){
							$del_idx_chk = false;
						}
					}
				}

				if(!$del_idx_chk){
					msg_json('error', '삭제에 실패하였습니다.');
				}
			}


			//form 처리
			for($i=0; $i<count($title); $i++){

				if($section_id[$i] == ""){
					// INSERT
					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'type'=>$type[$i],
						'title' => $title[$i],
						'description' => $description[$i],
						'serial' => $serial[$i],
						'youtube' => $youtube[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";


						if($_FILES['input_thumb']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
								);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					if (in_array($section_id[$i], $arr_del_section_id)) {
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);

					}else{
						// UPDATE

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";

						//$up_data3 = array();

						if($flag[$i] == "delete"){

							$up_data3 = array(
								'file_real_name' => 'NULL',
								'filename' =>'NULL',
								'filepath' =>'NULL',
								'filesize' =>'NULL',
								'file_width' => 'NULL', 
								'file_height' => 'NULL'
							);

						} else if($flag[$i] == "keep"){

							$up_data3 = array();

						} else {

							if($_FILES['input_thumb']['tmp_name'][$i] != ""){
								$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

								$img_info['width'] = $img_info[0];
								$img_info['height'] = $img_info[1];
								$img_info['size'] = $_FILES['input_thumb']['size'][$i];

								//워터마크 생성 여부
								$make_watermark = 'N';

								//이미지 업로드 - 워터마크, 썸네일 자동 생성
								$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
								
								//echo $upfile_pc."<br>";

								if($upfile_pc != ''){
									$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
								}

								$file_real_name = end(explode("/", $upfile_pc));

								//ob_flush();
								//flush();
								$up_data3 = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
								);
							}

						}

						$up_data = array(
							'title' => $title[$i],
							'description' => $description[$i],
							'priority'=>($i+1),
							'type' => $type[$i],
							'serial' => $serial[$i],
							'youtube' => $youtube[$i],
						);

						$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
						$up_data = array_merge($up_data, $up_data2);
						$up_data = array_merge($up_data, $up_data3);
						$up_data = array_merge($up_data, $common_data);
					}

					$result = $_news->update($section_id[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}
		}

		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;



	
	//culture
	case "culture":

		if((count($title_entertainment) <= 0)||(count($title_culture) <= 0)||(count($title_sports) <= 0)){
			msg_json('error', '필수 항목이 누락되었습니다.');
		}else{

			$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

			$arr_section_id_entertainment = explode(',', $str_section_id_entertainment);	//등록된 고유번호
			$arr_section_id_culture = explode(',', $str_culture_section_id_culture);	//등록된 고유번호
			$arr_section_id_sports = explode(',', $str_sports_section_id_sports);	//등록된 고유번호



			//form 연예 처리
			for($i=0; $i<count($title_entertainment); $i++){

				if($section_id_entertainment[$i] == ""){
					// INSERT
					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'type'=>'entertainment',
						'title' => $title_entertainment[$i],
						'description' => $description_entertainment[$i],
						'serial' => $serial_entertainment[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";
						$img_info = "";


						if($_FILES['input_thumb_entertainment']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb_entertainment']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_entertainment']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_entertainment']['name'][$i], $_FILES['input_thumb_entertainment']['tmp_name'][$i], $_FILES['input_thumb_entertainment']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb_entertainment']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					//이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";
					$img_info = "";

					$up_data3 = array();

					if($flag_entertainment[$i] == "delete"){

						$up_data3 = array(
							'file_real_name' => 'NULL',
							'filename' =>'NULL',
							'filepath' =>'NULL',
							'filesize' =>'NULL',
							'file_width' => 'NULL', 
							'file_height' => 'NULL'
						);

					} else if($flag_entertainment[$i] == "keep"){

						$up_data3 = array();

					} else {

						if($_FILES['input_thumb_entertainment']['tmp_name'][$i] != ""){
							$img_info = getimagesize($_FILES['input_thumb_entertainment']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_entertainment']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_entertainment']['name'][$i], $_FILES['input_thumb_entertainment']['tmp_name'][$i], $_FILES['input_thumb_entertainment']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();
							$up_data3 = array(
								'file_real_name' => $file_real_name,
								'filename' => ltrim(fileRename($_FILES['input_thumb_entertainment']['name'][$i])),
								'filepath' => ltrim($upfile_pc, '/'),
								'filesize' => $img_info['size'],
								'file_width' => $img_info_pc[0], 
								'file_height' => $img_info_pc[1]
							);
						}

					}

					$up_data = array(
						'title' => $title_entertainment[$i],
						'description' => $description_entertainment[$i],
						'priority'=>($i+1),
						'serial' => $serial_entertainment[$i]
					);

					$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
					$up_data = array_merge($up_data, $up_data2);
					$up_data = array_merge($up_data, $up_data3);
					$up_data = array_merge($up_data, $common_data);

					$result = $_news->update($section_id_entertainment[$i], $up_data);


					if(!$result){
						$attach_file_chk = false;
					}

				}
			}




			//form 문화 처리
			for($i=0; $i<count($title_culture); $i++){

				if($section_id_culture[$i] == ""){
					// INSERT

					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'type'=>'culture',
						'title' => $title_culture[$i],
						'description' => $description_culture[$i],
						'serial' => $serial_culture[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";
						$img_info = "";


						if($_FILES['input_thumb_culture']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb_culture']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_culture']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_culture']['name'][$i], $_FILES['input_thumb_culture']['tmp_name'][$i], $_FILES['input_thumb_culture']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb_culture']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					//이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";
					$img_info = "";

					$up_data3 = array();

					if($flag_culture[$i] == "delete"){

						$up_data3 = array(
							'file_real_name' => 'NULL',
							'filename' =>'NULL',
							'filepath' =>'NULL',
							'filesize' =>'NULL',
							'file_width' => 'NULL', 
							'file_height' => 'NULL'
						);

					} else if($flag_culture[$i] == "keep"){

						$up_data3 = array();

					} else {

						if($_FILES['input_thumb_culture']['tmp_name'][$i] != ""){
							$img_info = getimagesize($_FILES['input_thumb_culture']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_culture']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_culture']['name'][$i], $_FILES['input_thumb_culture']['tmp_name'][$i], $_FILES['input_thumb_culture']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();
							$up_data3 = array(
								'file_real_name' => $file_real_name,
								'filename' => ltrim(fileRename($_FILES['input_thumb_culture']['name'][$i])),
								'filepath' => ltrim($upfile_pc, '/'),
								'filesize' => $img_info['size'],
								'file_width' => $img_info_pc[0], 
								'file_height' => $img_info_pc[1]
							);
						}

					}

					$up_data = array(
						'title' => $title_culture[$i],
						'description' => $description_culture[$i],
						'priority'=>($i+1),
						'serial' => $serial_culture[$i]
					);

					$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
					$up_data = array_merge($up_data, $up_data2);
					$up_data = array_merge($up_data, $up_data3);
					$up_data = array_merge($up_data, $common_data);

					$result = $_news->update($section_id_culture[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}


			//form 문화 처리
			for($i=0; $i<count($title_sports); $i++){

				if($section_id_sports[$i] == ""){
					// INSERT


					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'type'=>'sports',
						'title' => $title_sports[$i],
						'description' => $description_sports[$i],
						'serial' => $serial_sports[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";
						$img_info = "";


						if($_FILES['input_thumb_sports']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb_sports']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_sports']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_sports']['name'][$i], $_FILES['input_thumb_sports']['tmp_name'][$i], $_FILES['input_thumb_sports']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb_sports']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					//이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";
					$img_info = "";

					$up_data3 = array();

					if($flag_sports[$i] == "delete"){

						$up_data3 = array(
							'file_real_name' => 'NULL',
							'filename' =>'NULL',
							'filepath' =>'NULL',
							'filesize' =>'NULL',
							'file_width' => 'NULL', 
							'file_height' => 'NULL'
						);

					} else if($flag_sports[$i] == "keep"){

						$up_data3 = array();

					} else {

						if($_FILES['input_thumb_sports']['tmp_name'][$i] != ""){
							$img_info = getimagesize($_FILES['input_thumb_sports']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb_sports']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb_sports']['name'][$i], $_FILES['input_thumb_sports']['tmp_name'][$i], $_FILES['input_thumb_sports']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();
							$up_data3 = array(
								'file_real_name' => $file_real_name,
								'filename' => ltrim(fileRename($_FILES['input_thumb_sports']['name'][$i])),
								'filepath' => ltrim($upfile_pc, '/'),
								'filesize' => $img_info['size'],
								'file_width' => $img_info_pc[0], 
								'file_height' => $img_info_pc[1]
							);
						}

					}

					$up_data = array(
						'title' => $title_sports[$i],
						'description' => $description_sports[$i],
						'priority'=>($i+1),
						'serial' => $serial_sports[$i]
					);

					$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
					$up_data = array_merge($up_data, $up_data2);
					$up_data = array_merge($up_data, $up_data3);
					$up_data = array_merge($up_data, $common_data);

					$result = $_news->update($section_id_sports[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}

		}

		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;


	//유튜브 채널
	case "youtube":

		if(count($title) <= 0){
			msg_json('error', '필수 항목이 누락되었습니다.');
		}else{

			$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

			$arr_del_section_id = explode(',', $str_del_section_id);	//삭제 처리할 고유번호

			$arr_section_id = explode(',', $str_section_id);	//등록된 고유번호

			//고유번호 삭제 처리
			if(count($arr_del_section_id)>0){

				$del_idx_chk = true;

				for($i=0; $i<count($arr_del_section_id); $i++){

					if(($arr_del_section_id[$i] != "")&&(in_array($arr_del_section_id[$i], $arr_section_id))){
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);

						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($arr_del_section_id[$i], $up_data);

						if(!$result){
							$del_idx_chk = false;
						}
					}
				}

				if(!$del_idx_chk){
					msg_json('error', '삭제에 실패하였습니다.');
				}
			}


			//form 처리
			for($i=0; $i<count($title); $i++){

				if($section_id[$i] == ""){
					// INSERT
					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'title' => $title[$i],
						'youtube' => $youtube[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";


						if($_FILES['input_thumb']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{
					// UPDATE

					if (in_array($section_id[$i], $arr_del_section_id)) {
						// DELETE
						$up_data = array('del_tf' => 'Y', 'del_date' => $_base['time'], 'del_adm' => $_SESSION['_admin']['no'], 'del_ip' => $_SERVER["REMOTE_ADDR"]);

					}else{
						// UPDATE

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";

						$up_data3 = array();

						if($flag[$i] == "delete"){

							$up_data3 = array(
								'file_real_name' => 'NULL',
								'filename' =>'NULL',
								'filepath' =>'NULL',
								'filesize' =>'NULL',
								'file_width' => 'NULL', 
								'file_height' => 'NULL'
							);

						} else if($flag[$i] == "keep"){

							$up_data3 = array();

						} else {

							if($_FILES['input_thumb']['tmp_name'][$i] != ""){
								$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

								$img_info['width'] = $img_info[0];
								$img_info['height'] = $img_info[1];
								$img_info['size'] = $_FILES['input_thumb']['size'][$i];

								//워터마크 생성 여부
								$make_watermark = 'N';

								//이미지 업로드 - 워터마크, 썸네일 자동 생성
								$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
								
								//echo $upfile_pc."<br>";

								if($upfile_pc != ''){
									$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
								}

								$file_real_name = end(explode("/", $upfile_pc));

								//ob_flush();
								//flush();
								$up_data3 = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
								);
							}

						}

						$up_data = array(
							'title' => $title[$i],
							'youtube' => $youtube[$i],
							'priority'=>($i+1)
						);

						$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
						$up_data = array_merge($up_data, $up_data2);
						$up_data = array_merge($up_data, $up_data3);
						$up_data = array_merge($up_data, $common_data);
					}

					$result = $_news->update($section_id[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}
		}

		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;


	//isan
	case "cartoon":

		if(count($title) <= 0){
			msg_json('error', '필수 항목이 누락되었습니다.');
		}else{

			$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

			$arr_section_id = explode(',', $str_section_id);	//등록된 고유번호


			//form 처리
			for($i=0; $i<count($title); $i++){

				if($section_id[$i] == ""){
					// INSERT
					$data = array(
						'section_category' => $section_category,
						'priority'=>($i+1),
						'title' => $title[$i],
						'description' => $description[$i],
						'serial' => $serial[$i]
					);

					$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
					$data = array_merge($data, $data2);

					$in_id = $_news->insert($data);

					if($in_id != ""){

						//이미지 업로드
						$upfile_pc = "";
						$upfile_m = "";
						$img_info_pc = "";


						if($_FILES['input_thumb']['tmp_name'][$i] != ""){

							$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();

							$up_data = array(
									'file_real_name' => $file_real_name,
									'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
									'filepath' => ltrim($upfile_pc, '/'),
									'filesize' => $img_info['size'],
									'file_width' => $img_info_pc[0], 
									'file_height' => $img_info_pc[1]
							);

							$up_data = array_merge($up_data, $common_data);

							$result = $_news->update($in_id, $up_data);

							if(!$result){
								$attach_file_chk = false;
							}

						}

					}else{
						msg_json('error', '등록에 실패하였습니다.');
					}

				}else{

					// UPDATE

					//이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";

					$up_data3 = array();

					if($flag[$i] == "delete"){

						$up_data3 = array(
							'file_real_name' => 'NULL',
							'filename' =>'NULL',
							'filepath' =>'NULL',
							'filesize' =>'NULL',
							'file_width' => 'NULL', 
							'file_height' => 'NULL'
						);

					} else if($flag[$i] == "keep"){

						$up_data3 = array();

					} else {

						if($_FILES['input_thumb']['tmp_name'][$i] != ""){
							$img_info = getimagesize($_FILES['input_thumb']['tmp_name'][$i]);

							$img_info['width'] = $img_info[0];
							$img_info['height'] = $img_info[1];
							$img_info['size'] = $_FILES['input_thumb']['size'][$i];

							//워터마크 생성 여부
							$make_watermark = 'N';

							//이미지 업로드 - 워터마크, 썸네일 자동 생성
							$upfile_pc = $_news->upload($_FILES['input_thumb']['name'][$i], $_FILES['input_thumb']['tmp_name'][$i], $_FILES['input_thumb']['size'][$i], $make_watermark, $section_category);
							
							//echo $upfile_pc."<br>";

							if($upfile_pc != ''){
								$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
							}

							$file_real_name = end(explode("/", $upfile_pc));

							//ob_flush();
							//flush();
							$up_data3 = array(
								'file_real_name' => $file_real_name,
								'filename' => ltrim(fileRename($_FILES['input_thumb']['name'][$i])),
								'filepath' => ltrim($upfile_pc, '/'),
								'filesize' => $img_info['size'],
								'file_width' => $img_info_pc[0], 
								'file_height' => $img_info_pc[1]
							);
						}

					}

					$up_data = array(
						'title' => $title[$i],
						'description' => $description[$i],
						'priority'=>($i+1),
						'serial' => $serial[$i]
					);

					$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
					$up_data = array_merge($up_data, $up_data2);
					$up_data = array_merge($up_data, $up_data3);
					$up_data = array_merge($up_data, $common_data);


					$result = $_news->update($section_id[$i], $up_data);

					if(!$result){
						$attach_file_chk = false;
					}

				}
			}
		}

		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;


	//culture
	case "opinion":

		$attach_file_chk = true;	//첨부파일 업로드 이상 유무 체크용

		$arr_section_id_editorial = explode(',', $str_section_id_editorial);	//사설 등록된 고유번호
		$arr_section_id_culture = explode(',', $str_section_id_column);	//칼럼 등록된 고유번호
		$arr_section_id_sports = explode(',', $str_section_id_column_top);	//칼럼 오피니언 메인 상단 노출될 고유번호

		//form 사설 처리
		for($i=0; $i<count($title_editorial); $i++){

			if($section_id_editorial[$i] == ""){
				// INSERT

				$data = array(
					'section_category' => $section_category,
					'priority'=>($i+1),
					'type'=>'editorial',
					'title' => $title_editorial[$i],
					'description' => $description_editorial[$i],
					'serial' => $serial_editorial[$i]
				);

				$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
				$data = array_merge($data, $data2);

				$in_id = $_news->insert($data);

				if($in_id != ""){

				}else{
					msg_json('error', '등록에 실패하였습니다.');
				}

			}else{
				// UPDATE

				$up_data = array(
					'title' => $title_editorial[$i],
					'description' => $description_editorial[$i],
					'priority'=>($i+1),
					'serial' => $serial_editorial[$i]
				);

				$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
				$up_data = array_merge($up_data, $up_data2);
				$up_data = array_merge($up_data, $common_data);

				//debug($section_id_editorial[$i]);

				$result = $_news->update($section_id_editorial[$i], $up_data);

				if(!$result){
					$attach_file_chk = false;
				}

			}
		}


		//form 칼럼 오피니언 메인 상단용 처리
		for($i=0; $i<count($title_column_top); $i++){

			if($section_id_column_top[$i] == ""){
				// INSERT

				$data = array(
					'section_category' => $section_category,
					'priority'=>($i+1),
					'type'=>'column',
					'top_tf' => $top_tf[$i],
					'title' => $title_column_top[$i],
					'description' => $description_column_top[$i],
					'serial' => $serial_column_top[$i]
				);

				$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
				$data = array_merge($data, $data2);

				$in_id = $_news->insert($data);

				if($in_id != ""){

					//이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";
					$img_info = "";

					if($_FILES['input_thumb_column_top']['tmp_name'][$i] != ""){

						$img_info = getimagesize($_FILES['input_thumb_column_top']['tmp_name'][$i]);

						$img_info['width'] = $img_info[0];
						$img_info['height'] = $img_info[1];
						$img_info['size'] = $_FILES['input_thumb_column_top']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc = $_news->upload($_FILES['input_thumb_column_top']['name'][$i], $_FILES['input_thumb_column_top']['tmp_name'][$i], $_FILES['input_thumb_column_top']['size'][$i], $make_watermark, $section_category);
						
						//echo $upfile_pc."<br>";

						if($upfile_pc != ''){
							$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
						}

						$file_real_name = end(explode("/", $upfile_pc));

						//ob_flush();
						//flush();

						$up_data = array(
								'thumb_file_real_name' => $file_real_name,
								'thumb_filename' => ltrim(fileRename($_FILES['input_thumb_column_top']['name'][$i])),
								'thumb_filepath' => ltrim($upfile_pc, '/'),
								'thumb_filesize' => $img_info['size'],
								'thumb_file_width' => $img_info_pc[0], 
								'thumb_file_height' => $img_info_pc[1]
						);

						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($in_id, $up_data);

						if(!$result){
							$attach_file_chk = false;
						}

					}

				}else{
					msg_json('error', '등록에 실패하였습니다.');
				}

			}else{
				// UPDATE

				//이미지 업로드
				$upfile_pc = "";
				$upfile_m = "";
				$img_info_pc = "";
				$img_info = "";

				$up_data3 = array();

				if($flag_column_top[$i] == "delete"){

					$up_data3 = array(
						'thumb_file_real_name' => 'NULL',
						'thumb_filename' =>'NULL',
						'thumb_filepath' =>'NULL',
						'thumb_filesize' =>'NULL',
						'thumb_file_width' => 'NULL', 
						'thumb_file_height' => 'NULL'
					);

				} else if($flag_column_top[$i] == "keep"){

					$up_data3 = array();

				} else {

					if($_FILES['input_thumb_column_top']['tmp_name'][$i] != ""){
						$img_info = getimagesize($_FILES['input_thumb_column_top']['tmp_name'][$i]);

						$img_info['width'] = $img_info[0];
						$img_info['height'] = $img_info[1];
						$img_info['size'] = $_FILES['input_thumb_column_top']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc = $_news->upload($_FILES['input_thumb_column_top']['name'][$i], $_FILES['input_thumb_column_top']['tmp_name'][$i], $_FILES['input_thumb_column_top']['size'][$i], $make_watermark, $section_category);
						
						//echo $upfile_pc."<br>";

						if($upfile_pc != ''){
							$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
						}

						$file_real_name = end(explode("/", $upfile_pc));

						//ob_flush();
						//flush();
						$up_data3 = array(
							'thumb_file_real_name' => $file_real_name,
							'thumb_filename' => ltrim(fileRename($_FILES['input_thumb_column_top']['name'][$i])),
							'thumb_filepath' => ltrim($upfile_pc, '/'),
							'thumb_filesize' => $img_info['size'],
							'thumb_file_width' => $img_info_pc[0], 
							'thumb_file_height' => $img_info_pc[1]
						);
					}

				}

				$up_data = array(
					'title' => $title_column_top[$i],
					'description' => $description_column_top[$i],
					'priority'=>($i+1),
					'serial' => $serial_column_top[$i]
				);

				$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
				$up_data = array_merge($up_data, $up_data2);
				$up_data = array_merge($up_data, $up_data3);
				$up_data = array_merge($up_data, $common_data);

				$result = $_news->update($section_id_column_top[$i], $up_data);

				if(!$result){
					$attach_file_chk = false;
				}

			}
		}


		//form 칼럼 처리
		for($i=0; $i<count($title_column); $i++){

			if($section_id_column[$i] == ""){
				// INSERT

				$data = array(
					'section_category' => $section_category,
					'priority'=>($i+1),
					'type'=>'column',
					'top_tf' => $top_tf_column[$i],
					'color' => $color[$i],
					'title' => $title_column[$i],
					'description' => $description_column[$i],
					'serial' => $serial_column[$i]
				);

				$data2 = array('reg_date' => $_base['time'], 'reg_adm' => $_SESSION['_admin']['no'], 'reg_ip' => $_SERVER["REMOTE_ADDR"]);
				$data = array_merge($data, $data2);

				$in_id = $_news->insert($data);

				if($in_id != ""){

					//기사 섬네일 이미지 업로드
					$upfile_pc = "";
					$upfile_m = "";
					$img_info_pc = "";
					$img_info = "";

					if($_FILES['input_thumb_column']['tmp_name'][$i] != ""){

						$img_info = getimagesize($_FILES['input_thumb_column']['tmp_name'][$i]);

						$img_info['width'] = $img_info[0];
						$img_info['height'] = $img_info[1];
						$img_info['size'] = $_FILES['input_thumb_column']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc = $_news->upload($_FILES['input_thumb_column']['name'][$i], $_FILES['input_thumb_column']['tmp_name'][$i], $_FILES['input_thumb_column']['size'][$i], $make_watermark, $section_category, "thumb");
						
						//echo $upfile_pc."<br>";

						if($upfile_pc != ''){
							$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
						}

						$file_real_name = end(explode("/", $upfile_pc));

						//ob_flush();
						//flush();

						$up_data = array(
								'thumb_file_real_name' => $file_real_name,
								'thumb_filename' => ltrim(fileRename($_FILES['input_thumb_column']['name'][$i])),
								'thumb_filepath' => ltrim($upfile_pc, '/'),
								'thumb_filesize' => $img_info['size'],
								'thumb_file_width' => $img_info_pc[0], 
								'thumb_file_height' => $img_info_pc[1]
						);

						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($in_id, $up_data);

						if(!$result){
							$attach_file_chk = false;
						}

					}

					//기자 이미지 업로드
					$upfile_pc_writer = "";
					$upfile_m_writer = "";
					$img_info_pc_writer = "";
					$img_info_writer = "";

					if($_FILES['input_thumb_column_writer']['tmp_name'][$i] != ""){

						$img_info_writer = getimagesize($_FILES['input_thumb_column_writer']['tmp_name'][$i]);

						$img_info_writer['width'] = $img_info_writer[0];
						$img_info_writer['height'] = $img_info_writer[1];
						$img_info_writer['size'] = $_FILES['input_thumb_column_writer']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc_writer = $_news->upload($_FILES['input_thumb_column_writer']['name'][$i], $_FILES['input_thumb_column_writer']['tmp_name'][$i], $_FILES['input_thumb_column_writer']['size'][$i], $make_watermark, $section_category, "writer");
						
						//echo $upfile_pc."<br>";

						if($upfile_pc_writer != ''){
							$img_info_pc_writer = getimagesize(_IMAGE_ROOT.$upfile_pc_writer);
						}

						$writer_file_real_name = end(explode("/", $upfile_pc_writer));

						//ob_flush();
						//flush();

						$up_data = array(
								'writer_file_real_name' => $writer_file_real_name,
								'writer_filename' => ltrim(fileRename($_FILES['input_thumb_column_writer']['name'][$i])),
								'writer_filepath' => ltrim($upfile_pc_writer, '/'),
								'writer_filesize' => $img_info_writer['size'],
								'writer_file_width' => $img_info_pc_writer[0], 
								'writer_file_height' => $img_info_pc_writer[1]
						);

						$up_data = array_merge($up_data, $common_data);

						$result = $_news->update($in_id, $up_data);

						if(!$result){
							$attach_file_chk = false;
						}

					}

				}else{
					msg_json('error', '등록에 실패하였습니다.');
				}

			}else{
				// UPDATE

				//이미지 업로드
				$upfile_pc = "";
				$upfile_m = "";
				$img_info_pc = "";
				$img_info = "";

				$up_data3 = array();

				if($flag_column[$i] == "delete"){

					$up_data3 = array(
						'thumb_file_real_name' => 'NULL',
						'thumb_filename' =>'NULL',
						'thumb_filepath' =>'NULL',
						'thumb_filesize' =>'NULL',
						'thumb_file_width' => 'NULL', 
						'thumb_file_height' => 'NULL'
					);

				} else if($flag_column[$i] == "keep"){

					$up_data3 = array();

				} else {

					if($_FILES['input_thumb_column']['tmp_name'][$i] != ""){
						$img_info = getimagesize($_FILES['input_thumb_column']['tmp_name'][$i]);

						$img_info['width'] = $img_info[0];
						$img_info['height'] = $img_info[1];
						$img_info['size'] = $_FILES['input_thumb_column']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc = $_news->upload($_FILES['input_thumb_column']['name'][$i], $_FILES['input_thumb_column']['tmp_name'][$i], $_FILES['input_thumb_column']['size'][$i], $make_watermark, $section_category, "thumb");
						
						//echo $upfile_pc."<br>";

						if($upfile_pc != ''){
							$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
						}

						$file_real_name = end(explode("/", $upfile_pc));

						//ob_flush();
						//flush();
						$up_data3 = array(
							'thumb_file_real_name' => $file_real_name,
							'thumb_filename' => ltrim(fileRename($_FILES['input_thumb_column']['name'][$i])),
							'thumb_filepath' => ltrim($upfile_pc, '/'),
							'thumb_filesize' => $img_info['size'],
							'thumb_file_width' => $img_info_pc[0], 
							'thumb_file_height' => $img_info_pc[1]
						);
					}

				}


				//기자 이미지 업로드
				$upfile_pc_writer = "";
				$upfile_m_writer = "";
				$img_info_pc_writer = "";
				$img_info_writer = "";

				$up_data4 = array();

				if($flag_column_writer[$i] == "delete"){

					$up_data3 = array(
						'writer_file_real_name' => 'NULL',
						'writer_filename' =>'NULL',
						'writer_filepath' =>'NULL',
						'writer_filesize' =>'NULL',
						'writer_file_width' => 'NULL', 
						'writer_file_height' => 'NULL'
					);

				} else if($flag_column_writer[$i] == "keep"){

					$up_data4 = array();

				} else {

					if($_FILES['input_thumb_column_writer']['tmp_name'][$i] != ""){
						$img_info_writer = getimagesize($_FILES['input_thumb_column_writer']['tmp_name'][$i]);

						$img_info_writer['width'] = $img_info_writer[0];
						$img_info_writer['height'] = $img_info_writer[1];
						$img_info_writer['size'] = $_FILES['input_thumb_column_writer']['size'][$i];

						//워터마크 생성 여부
						$make_watermark = 'N';

						//이미지 업로드 - 워터마크, 썸네일 자동 생성
						$upfile_pc_writer = $_news->upload($_FILES['input_thumb_column_writer']['name'][$i], $_FILES['input_thumb_column_writer']['tmp_name'][$i], $_FILES['input_thumb_column_writer']['size'][$i], $make_watermark, $section_category, "writer");
						
						//echo $upfile_pc."<br>";

						if($upfile_pc_writer != ''){
							$img_info_pc_writer = getimagesize(_IMAGE_ROOT.$upfile_pc_writer);
						}

						$writer_file_real_name = end(explode("/", $upfile_pc_writer));

						//ob_flush();
						//flush();
						$up_data4 = array(
							'writer_file_real_name' => $writer_file_real_name,
							'writer_filename' => ltrim(fileRename($_FILES['input_thumb_column_writer']['name'][$i])),
							'writer_filepath' => ltrim($upfile_pc_writer, '/'),
							'writer_filesize' => $img_info_writer['size'],
							'writer_file_width' => $img_info_pc_writer[0], 
							'writer_file_height' => $img_info_pc_writer[1]
						);
					}

				}


				$up_data = array(
					'title' => $title_column[$i],
					'color' => $color[$i],
					'description' => $description_column[$i],
					'priority'=>($i+1),
					'serial' => $serial_column[$i]
				);

				$up_data2 = array('modi_date' => $_base['time'], 'modi_adm' => $_SESSION['_admin']['no'], 'modi_ip' => $_SERVER["REMOTE_ADDR"]);
				$up_data = array_merge($up_data, $up_data2);
				$up_data = array_merge($up_data, $up_data3);
				$up_data = array_merge($up_data, $up_data4);
				$up_data = array_merge($up_data, $common_data);

				$result = $_news->update($section_id_column[$i], $up_data);

				if(!$result){
					$attach_file_chk = false;
				}

			}
		}



		if($attach_file_chk){
			msg_json('success', '');
		}else{
			msg_json('error', '이미지 등록에 실패하였습니다.');
		}

		break;

	default:
		msg_json('error', '잘못된 요청입니다.');
}
exit;
