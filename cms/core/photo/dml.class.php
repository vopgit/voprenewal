<?php 
if(!defined('_HOME_TITLE')) exit;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 0){
	msg_err('잘못된 요청입니다.');
}

include_once _ROOT."/core/common/thumb.class.php";

$_photos = new Photos();
$_contents = new Contents();

function process($str){
	echo "<script>document.write('".$str."');</script>";
}

switch($mode) {
	
	//신규등록
	case "new":
	
		for($i=0; $i<count($title); $i++) {

			//태그
			$str_tags = ($tags[$i] != "") ? make_tags($tags[$i]) : "";


			//글등록
			$description[$i] = removeEnter($description[$i]);
			$data = array(
						'type' => 'image',
						'title' => $title[$i],
						'description' => $description[$i],
						'contributor' => $contributor[$i],
						'copyright'	=> $copyright[$i],
						'tags' => $str_tags
						);
			$data = array_filter($data);			
			$in_id = $_photos->insert($data);

			//echo $in_id;
			//시리얼넘버 생성
			$serial = $_photos->get_serial_number($in_id);

						
			//이미지 업로드
			$upfile_pc = "";
			$upfile_m = "";
			$img_info_pc = "";

			if($_FILES['userfile_p']['tmp_name'][$i] != ""){

				$img_info = getimagesize($_FILES['userfile_p']['tmp_name'][$i]);

				$img_info['width'] = $img_info[0];
				$img_info['height'] = $img_info[1];
				$img_info['size'] = $_FILES['userfile_p']['size'][$i];

				//워터마크 생성 여부
				$make_watermark = ($copyright[$i] == "") ? 'Y' : 'N';

				//이미지 업로드 - 워터마크, 썸네일 자동 생성
				$upfile_pc = $_photos->upload($_FILES['userfile_p']['name'][$i], $_FILES['userfile_p']['tmp_name'][$i], $_FILES['userfile_p']['size'][$i], $make_watermark);
				
				//echo $upfile_pc."<br>";

				if($upfile_pc != ''){
					$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
				}

				//debug($img_info);
				ob_flush();
				flush();
			}

			//모바일 이미지 업로드
			if($_FILES['userfile_m']['tmp_name'][$i] != ""){

				$img_info = getimagesize($_FILES['userfile_m']['tmp_name'][$i]);

				$img_info['width'] = $img_info[0];
				$img_info['height'] = $img_info[1];
				$img_info['size'] = $_FILES['userfile_m']['size'][$i];
				//$img_info['mime']

				//워터마크 생성 여부
				$make_watermark = ($copyright[$i] == "") ? 'Y' : 'N';

				//이미지 업로드 - 워터마크, 썸네일 자동 생성
				$upfile_m = $_photos->upload($_FILES['userfile_m']['name'][$i], $_FILES['userfile_m']['tmp_name'][$i], $_FILES['userfile_m']['size'][$i], $make_watermark);
				
				//echo $upfile_m."<br>";

				//debug($img_info);
				ob_flush();
				flush();
			}

			//데이터 업데이트
			$up_data = array(
							'serial' => $serial,
							'file_name' => ltrim($upfile_pc, '/'),
							'file_name_m' => ltrim($upfile_m, '/'),
							'mime' => $img_info_pc['mime'],
							'file_size' => $img_info_pc['size'],
							'width' => $img_info_pc[0], 
							'height' => $img_info_pc[1],
							'status' => 'published',
							'published_time' => $_base['time']
							);
			$up_data = array_filter($up_data);

			$_photos->update($in_id, $up_data);	

			//포토뉴스 동시 등록
			if($photo_news[$i] == 'Y'){ 

				$contents = '[사진:'.$serial.'/설명:'.$description[$i];
				if($contributor[$i] != '') $contents .='/저작권:'.$contributor[$i].']';
				else $contents .=']';
				
				//공통데이터
				$contents_data = array(
							'type' => 'article',
							'kind' => 6, 
							'contributor' => $copyright[$i],
							'tags' => $str_tags,
							'regist_time' => $_base['time']
							);
				$contents_data_body = array(			
							'title' => $title[0],
							'description' => $description[0],
							'content' => $contents
							);

				$_contents->insert($contents_data, $contents_data_body, '');

			}			
		}

		msg_replace('등록되었습니다', '/photo/list');

		break;

	//수정
	case "modify":

		if(empty($photo_id)) msg_err('대상이 없습니다.');


		//데이터 업데이트
		$up_data = array(
						'title' => $title,
						'description' => $description,
						'contributor' => $contributor,
						'copyright'	=> $copyright,
						'update_time' => $_base['time']
						);
		$up_data = array_filter($up_data);

		
		//태그
		if($old_tags_str != $tags){
			$str_tags = ($tags != "") ? make_tags($tags) : "";
			$up_data = array_merge($up_data, array('tags' => $str_tags));
		}


		//이미지 업로드
		$upfile_pc = "";
		$upfile_m = "";
		$img_info_pc = "";

		if($_FILES['userfile_p']['tmp_name'] != ""){

			$img_info = getimagesize($_FILES['userfile_p']['tmp_name']);

			$img_info['width'] = $img_info[0];
			$img_info['height'] = $img_info[1];
			$img_info['size'] = $_FILES['userfile_p']['size'];

			//워터마크 생성 여부
			$make_watermark = ($copyright == "") ? 'Y' : 'N';

			//이미지 업로드 - 워터마크, 썸네일 자동 생성
			$upfile_pc = $_photos->upload($_FILES['userfile_p']['name'], $_FILES['userfile_p']['tmp_name'], $_FILES['userfile_p']['size'], $make_watermark);
			
			//echo $upfile_pc."<br>";

			if($upfile_pc != ''){
				if($old_photo != '') removeOldPhotos($old_photo);

				$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
				
				$upfile_pc_data = array(
										'file_name' => ltrim($upfile_pc, '/'),
										'mime' => $img_info_pc['mime'],
										'file_size' => $img_info_pc['size'],
										'width' => $img_info_pc[0], 
										'height' => $img_info_pc[1]
									);		
				$up_data = array_merge($up_data, $upfile_pc_data);
			}
		}

		//모바일 이미지 업로드
		if($_FILES['userfile_m']['tmp_name'] != ""){

			$img_info = getimagesize($_FILES['userfile_m']['tmp_name']);

			$img_info['width'] = $img_info[0];
			$img_info['height'] = $img_info[1];
			$img_info['size'] = $_FILES['userfile_m']['size'];
			//$img_info['mime']

			//워터마크 생성 여부
			$make_watermark = ($copyright == "") ? 'Y' : 'N';

			//이미지 업로드 - 워터마크, 썸네일 자동 생성
			$upfile_m = $_photos->upload($_FILES['userfile_m']['name'], $_FILES['userfile_m']['tmp_name'], $_FILES['userfile_m']['size'], $make_watermark);
			
			if($upfile_m != ''){
				
				if($old_photo_m != '') removeOldPhotos($old_photo_m);

				$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_m);

				if($old_photo_m != '') removeOldPhotos($old_photo_m);
				$up_data = array_merge($up_data, array('file_name_m' => ltrim($upfile_m, '/')));
			}
		} else {
			if($photo_m_del == "Y" && $old_photo != ''){
				removeOldPhotos($old_photo_m);
				$up_data = array_merge($up_data, array('file_name_m' => ''));
			}
		}		
		
		$where = array('id' => $photo_id);
		$result = $_photos->update($photo_id, $up_data, array('mine'=>$_SESSION['_admin']['no']));	

		if($result) msg_replace('수정되었습니다', '/photo/list'.$param['query']);
		else msg_err('수정에 실패하였습니다');
	
		break;

	//보류
	case "hold":

		if(empty($photo_id)) msg_exit('대상이 없습니다.');
		
		//데이터 업데이트
		$up_data = array(
						'status' => 'reserved1',
						'update_time' => $_base['time']
						);

		$result = $_photos->update($photo_id, $up_data, array('mine'=>$_SESSION['_admin']['no']));		
		if($result) echo "success";
		else echo "보류처리에 실패하였습니다";
		
		break;

	//삭제
	case "del":

		if(empty($photo_id)) msg_exit('대상이 없습니다.');

		$serial = sprintf('%s%011d', 'P', $photo_id);

		//검색시간 소요로 보류
		//$cnt = $db->total("select count(*) from TBL_CONTENTS_BODY where content like '%".$serial."%'");
		
		//데이터 업데이트
		$up_data = array(
						'status' => 'deleted',
						'update_time' => $_base['time']
						);

		$result = $_photos->update($photo_id, $up_data, array('mine'=>$_SESSION['_admin']['no']));		
		if($result) echo "success";
		else echo "삭제에 실패하였습니다";

		break;
	
	//팝업에서 등록
	case "popin":
	
		//태그
		$str_tags = ($tags != "") ? make_tags($tags) : "";

		//글등록
		$description = removeEnter($description);
		$data = array(
					'type' => 'image',
					'title' => $title,
					'description' => $description,
					'contributor' => $contributor,
					'copyright'	=> $copyright,
					'tags' => $str_tags
					);
		$data = array_filter($data);			
		$in_id = $_photos->insert($data);

		//시리얼넘버 생성
		$serial = $_photos->get_serial_number($in_id);

						
		//이미지 업로드
		$upfile_pc = "";
		$upfile_m = "";
		$img_info_pc = "";

		if($_FILES['userfile_p']['tmp_name'] != ""){

			$img_info = getimagesize($_FILES['userfile_p']['tmp_name']);

			$img_info['width'] = $img_info[0];
			$img_info['height'] = $img_info[1];
			$img_info['size'] = $_FILES['userfile_p']['size'];

			//워터마크 생성 여부
			$make_watermark = ($copyright == "") ? 'Y' : 'N';

			//이미지 업로드 - 워터마크, 썸네일 자동 생성
			$upfile_pc = $_photos->upload($_FILES['userfile_p']['name'], $_FILES['userfile_p']['tmp_name'], $_FILES['userfile_p']['size'], $make_watermark);
			
			if($upfile_pc != ''){
				$img_info_pc = getimagesize(_IMAGE_ROOT.$upfile_pc);
			}

			ob_flush();
			flush();
		}

		//모바일 이미지 업로드
		if($_FILES['userfile_m']['tmp_name'] != ""){

			$img_info = getimagesize($_FILES['userfile_m']['tmp_name']);

			$img_info['width'] = $img_info[0];
			$img_info['height'] = $img_info[1];
			$img_info['size'] = $_FILES['userfile_m']['size'];
			//$img_info['mime']

			//워터마크 생성 여부
			$make_watermark = ($copyright == "") ? 'Y' : 'N';

			//이미지 업로드 - 워터마크, 썸네일 자동 생성
			$upfile_m = $_photos->upload($_FILES['userfile_m']['name'], $_FILES['userfile_m']['tmp_name'], $_FILES['userfile_m']['size'], $make_watermark);
			
			ob_flush();
			flush();
		}

		//데이터 업데이트
		$up_data = array(
						'serial' => $serial,
						'file_name' => ltrim($upfile_pc, '/'),
						'file_name_m' => ltrim($upfile_m, '/'),
						'mime' => $img_info_pc['mime'],
						'file_size' => $img_info_pc['size'],
						'width' => $img_info_pc[0], 
						'height' => $img_info_pc[1],
						'status' => 'published',
						'published_time' => $_base['time']
						);
		$up_data = array_filter($up_data);

		$_photos->update($in_id, $up_data);	

		msg_replace('등록되었습니다', '/photo/pop'.$rtnPage);

		break;

	default:
		msg_err('잘못된 요청입니다.');
}
exit;
