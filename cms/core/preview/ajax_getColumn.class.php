<?php
if(!defined('_HOME_TITLE')) exit;

$_opinion = new Opinion();

if($_POST['mode'] == "") exit;

if($mode == "CHANGE_STATUS_VIEW"){

	if($_POST['use_tf'] == "") msg_err("주요 항목이 누락되었습니다.");

	//오피니언 메인 칼럼그룹 리스트
	$param_data = array(
					'use_tf'=>$use_tf,
					'del_tf'=>'N'
					);
	$param_data = array_filter($param_data);
	$param = makeParam($param_data);

	$rs_column_group= $_opinion->get_column_group_list($param_data);

	if(count($rs_column_group) > 0){

		for ($j = 0 ; $j < count($rs_column_group); $j++) {
			$data = $rs_column_group[$j];
			?>
				<li>
					<div class="img_list_item">
						<div class="img_list_img">
							<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')">
								<img src="<?=$data['photo']?>" alt="샘플이미지" />
							</a>
						</div>
						<div class="img_list_text">
							<p class="img_list_tit">
								<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')"><span><?=$data['description']?></span></a>
							</p>
						</div>
					</div>
				</li>
			<?
		}
	}else{
		?>
			<li>
				<div class="img_list_item">
					조회 결과가 없습니다.
				</div>
			</li>
		<?
	}
}

exit;
















// 아래 내용은 사용하지 않을시 삭제 가능

if($mode == "SORT_ORDER"){

	if($type == "" || $nsort == "" || $uid == "" || $status == "") msg_err("주요 항목이 누락되었습니다.");

	if($type == "plus"){ //plus 하위로

		$chgPos = (int)$nsort + 1;

		$row = $db->total("select count(*) as cnt from  TBL_COLUMN where priority >= ".$chgPos." and del_tf = 'N' and use_tf = '".$status."'");

		if($row < 1){
			echo "MIN";
			exit;
		}else{
			$db->query("update TBL_COLUMN set priority = priority-1 where priority	 = ".$chgPos." and del_tf = 'N' and use_tf = '".$status."'");	
			$db->query("update TBL_COLUMN set priority = '".$chgPos."' where id = ".$uid." and del_tf = 'N' and use_tf = '".$status."'");	
		}	

	}else{ //minus (상위로)

		if((int)$nsort <= 0){
			echo "MAX";
			exit;
		}

		$chgPos = (int)$nsort - 1;

		$row = $db->total("select count(*) as cnt from  TBL_COLUMN where priority <= ".$chgPos." and del_tf = 'N' and use_tf = '".$status."'");	

		if($row < 1){
			echo "MAX";
			exit;
		}else{
			$db->query("update TBL_COLUMN set priority = priority+1 where priority = ".$chgPos." and del_tf = 'N' and use_tf = '".$status."'");
			$db->query("update TBL_COLUMN set priority = '".$chgPos."' where id = ".$uid." and del_tf = 'N' and use_tf = '".$status."'");
		}	

	}


	$param_data = array(
				'status'=>$status
					);

	//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa :: ".$status;

	$param_data = array_filter($param_data);


	//리스트 가져오기
	$rs = $_contents->get_popup_ty2_list($param_data);

	for ($j = 0 ; $j < count($rs); $j++) {
		?>
			<tr>
				<td class="act_tc3">
					<label class="fm_ch ">
						<input type="checkbox" name="pick_ch[]" value="<?=$rs[$j]['id']?>" class="pick_ch">
						<span class="_icon"></span>
					</label>
				</td>
				<td class="act_tc3"><?=$j+1?></td>
				<td class="act_tc3">
					<div class="row">
						<div class="col_20 t_left">
							<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['description']?>')">
								<div class="table_ellip">
									<span> <?=$rs[$j]['description']?></span>
								</div>
							</a>
						</div>
						<div class="col_4 t_right ">
							<div class="arrow_btn row ai_c jc_fe t_right">
								<button type="button" class="btn act_down arrow" onclick="js_updown('plus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_down"></i></button>
								<button type="button" class="btn act_up arrow" onclick="js_updown('minus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_up"></i></button>
							</div>
						</div>

					</div>
				</td>
			</tr>
		<?
	}

}





if(($mode == "UPDATE_STATUS")||($mode == "SEL_DELETE")){

	if($dataArr == ""  || $status == "") msg_err("주요 항목이 누락되었습니다.");


	if($status == "Y"){ //휴재 마감처리
		$str_statue = "N";
	}else{ //연재처리
		$str_statue = "Y";
	}

	$str_max_priority = 0;	//초기화

	$qry_priority = "select MAX(priority) as max_priority from TBL_COLUMN where del_tf = 'N' and use_tf = '".$str_statue."'";

	$rs_priority = $db->select($qry_priority);
	$str_max_priority = $rs_priority[0]["max_priority"];

	//echo "qry_priority :: ".$str_max_priority;
	//exit;

	if($mode == "UPDATE_STATUS"){

		for ($j = 0 ; $j < count($dataArr); $j++) {
			$row = $db->total("select count(*) as cnt from  TBL_COLUMN where id = ".$dataArr[$j]." and del_tf = 'N'");

			if($row > 0){
				$db->query("update TBL_COLUMN set use_tf = '".$str_statue."', priority = '".($str_max_priority+1)."', modi_date=now(), modi_adm='".$_SESSION['_admin']["no"]."', modi_ip='".$_SERVER["REMOTE_ADDR"]."' where id = ".$dataArr[$j]." and del_tf = 'N' ");	
			}
		}

	}else{

		for ($j = 0 ; $j < count($dataArr); $j++) {
			$row = $db->total("select count(*) as cnt from  TBL_COLUMN where id = ".$dataArr[$j]." and del_tf = 'N'");

			if($row > 0){
				$db->query("update TBL_COLUMN set del_tf = 'Y', del_date=now(), del_adm='".$_SESSION['_admin']["no"]."', del_ip='".$_SERVER["REMOTE_ADDR"]."' where id = ".$dataArr[$j]);	
			}
		}

	}

	$param_data = array(
				'status'=>$status
					);

	$param_data = array_filter($param_data);

	//리스트 가져오기
	$rs = $_contents->get_popup_ty2_list($param_data);

	for ($j = 0 ; $j < count($rs); $j++) {
		?>
			<tr>
				<td class="act_tc3">
					<label class="fm_ch ">
						<input type="checkbox" name="pick_ch[]" value="<?=$rs[$j]['id']?>" class="pick_ch">
						<span class="_icon"></span>
					</label>
				</td>
				<td class="act_tc3"><?=$j+1?></td>
				<td class="act_tc3">
					<div class="row">
						<div class="col_20 t_left">
							<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['description']?>')">
								<div class="table_ellip">
									<span> <?=$rs[$j]['description']?></span>
								</div>
							</a>
						</div>
						<div class="col_4 t_right ">
							<div class="arrow_btn row ai_c jc_fe t_right">
								<button type="button" class="btn act_down arrow" onclick="js_updown('plus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_down"></i></button>
								<button type="button" class="btn act_up arrow" onclick="js_updown('minus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_up"></i></button>
							</div>
						</div>

					</div>
				</td>
			</tr>
		<?
	}

}




if($mode == "INSERT"){

	if($desc == ""  || $status == "") msg_err("주요 항목이 누락되었습니다.");

	$str_max_priority = 0;	//초기화

	$qry_priority = "select MAX(priority) as max_priority from TBL_COLUMN where del_tf = 'N' and use_tf = '".$status."'";

	$rs_priority = $db->select($qry_priority);
	$str_max_priority = $rs_priority[0]["max_priority"];

	//echo "qry_priority :: ".$str_max_priority;
	//exit;

	$arr_variables = array(
				'description'=>trim($desc),
				'use_tf'=>$status,
				'priority'=>($str_max_priority+1),
				'reg_date'=>date("Y-m-d H:i:s"),
				'reg_adm'=>$_SESSION['_admin']["no"],
				'reg_ip'=>$_SERVER["REMOTE_ADDR"]
				);


	$result = $db->insert("TBL_COLUMN", $arr_variables);

	if(!$result){

		echo "FAIL";
		exit;

	}else{

		$param_data = array(
					'status'=>$status
						);

		$param_data = array_filter($param_data);

		//리스트 가져오기
		$rs = $_contents->get_popup_ty2_list($param_data);

		for ($j = 0 ; $j < count($rs); $j++) {
			?>
				<tr>
					<td class="act_tc3">
						<label class="fm_ch ">
							<input type="checkbox" name="pick_ch[]" value="<?=$rs[$j]['id']?>" class="pick_ch">
							<span class="_icon"></span>
						</label>
					</td>
					<td class="act_tc3"><?=$j+1?></td>
					<td class="act_tc3">
						<div class="row">
							<div class="col_20 t_left">
								<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['description']?>')">
									<div class="table_ellip">
										<span> <?=$rs[$j]['description']?></span>
									</div>
								</a>
							</div>
							<div class="col_4 t_right ">
								<div class="arrow_btn row ai_c jc_fe t_right">
									<button type="button" class="btn act_down arrow" onclick="js_updown('plus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_down"></i></button>
									<button type="button" class="btn act_up arrow" onclick="js_updown('minus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_up"></i></button>
								</div>
							</div>

						</div>
					</td>
				</tr>
			<?
		}
	}

}



if($mode == "UPDATE"){

	if($desc == ""  || $uid == ""  || $status == "") msg_err("주요 항목이 누락되었습니다.");

	$str_max_priority = 0;	//초기화

	$qry_priority = "select MAX(priority) as max_priority from TBL_COLUMN where del_tf = 'N' and use_tf = '".$status."'";

	$rs_priority = $db->select($qry_priority);
	$str_max_priority = $rs_priority[0]["max_priority"];

	//echo "qry_priority :: ".$str_max_priority;
	//exit;

	$arr_variables = array(
				'description'=>trim($desc),
				'modi_date'=>date("Y-m-d H:i:s"),
				'modi_adm'=>$_SESSION['_admin']["no"],
				'modi_ip'=>$_SERVER["REMOTE_ADDR"]
				);

	$arr_where = array(
				'id'=>$uid,
				'del_tf'=>'N'
				);

	$result = $db->update("TBL_COLUMN", $arr_variables, $arr_where, '');

	if(!$result){

		echo "FAIL";
		exit;

	}else{

		$param_data = array(
					'status'=>$status
						);

		$param_data = array_filter($param_data);

		//리스트 가져오기
		$rs = $_contents->get_popup_ty2_list($param_data);

		for ($j = 0 ; $j < count($rs); $j++) {
			?>
				<tr>
					<td class="act_tc3">
						<label class="fm_ch ">
							<input type="checkbox" name="pick_ch[]" value="<?=$rs[$j]['id']?>" class="pick_ch">
							<span class="_icon"></span>
						</label>
					</td>
					<td class="act_tc3"><?=$j+1?></td>
					<td class="act_tc3">
						<div class="row">
							<div class="col_20 t_left">
								<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['description']?>')">
									<div class="table_ellip">
										<span> <?=$rs[$j]['description']?></span>
									</div>
								</a>
							</div>
							<div class="col_4 t_right ">
								<div class="arrow_btn row ai_c jc_fe t_right">
									<button type="button" class="btn act_down arrow" onclick="js_updown('plus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_down"></i></button>
									<button type="button" class="btn act_up arrow" onclick="js_updown('minus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_up"></i></button>
								</div>
							</div>

						</div>
					</td>
				</tr>
			<?
		}
	}

}



exit;

?>