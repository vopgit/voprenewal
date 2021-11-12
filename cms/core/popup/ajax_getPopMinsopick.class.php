<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Popup();

if($_POST['mode'] == "") exit;


if($mode == "INSERT"){

	if($title == "") msg_err("주요 항목이 누락되었습니다.");

	$str_max_priority = 0;	//초기화

	$qry_priority = "select MAX(priority) as max_priority from TBL_MINSOPICK where del_tf = 'N' ";

	$rs_priority = $db->select($qry_priority);
	$str_max_priority = $rs_priority[0]["max_priority"];

	//echo "qry_priority :: ".$str_max_priority;
	//exit;

	$arr_variables = array(
				'title'=>trim($title),
				'priority'=>($str_max_priority+1),
				'reg_date'=>date("Y-m-d H:i:s"),
				'reg_adm'=>$_SESSION['_admin']["no"],
				'reg_ip'=>$_SERVER["REMOTE_ADDR"]
				);


	$result = $db->insert("TBL_MINSOPICK", $arr_variables);

	if(!$result){

		echo "FAIL";
		exit;

	}else{

		$param_data = array(
						);

		$param_data = array_filter($param_data);

		//리스트 가져오기
		$rs = $_contents->get_popup_ty6_list($param_data);

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
						<div class="row ai_c">
							<div class="col_20 t_left">
								<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['title']?>')">
									<div class="table_ellip">
										<span> <?=$rs[$j]['title']?></span>
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

	if($title == ""  || $uid == "") msg_err("주요 항목이 누락되었습니다.");

	$arr_variables = array(
				'title'=>trim($title),
				'modi_date'=>date("Y-m-d H:i:s"),
				'modi_adm'=>$_SESSION['_admin']["no"],
				'modi_ip'=>$_SERVER["REMOTE_ADDR"]
				);

	$arr_where = array(
				'id'=>$uid,
				'del_tf'=>'N'
				);

	$result = $db->update("TBL_MINSOPICK", $arr_variables, $arr_where, '');

	if(!$result){

		echo "FAIL";
		exit;

	}else{

		$param_data = array(
						);

		$param_data = array_filter($param_data);

		//리스트 가져오기
		$rs = $_contents->get_popup_ty6_list($param_data);

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
						<div class="row ai_c">
							<div class="col_20 t_left">
								<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['title']?>')">
									<div class="table_ellip">
										<span> <?=$rs[$j]['title']?></span>
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

if($mode == "SORT_ORDER"){

	if($type == "" || $nsort == "" || $uid == "") msg_err("주요 항목이 누락되었습니다.");

	if($type == "plus"){ //plus 하위로

		$chgPos = (int)$nsort + 1;

		$row = $db->total("select count(*) as cnt from  TBL_MINSOPICK where priority >= ".$chgPos." and del_tf = 'N' ");

		if($row < 1){
			echo "MIN";
			exit;
		}else{
			$db->query("update TBL_MINSOPICK set priority = priority-1 where priority	 = ".$chgPos." and del_tf = 'N' ");	
			$db->query("update TBL_MINSOPICK set priority = '".$chgPos."' where id = ".$uid." and del_tf = 'N' ");	
		}	

	}else{ //minus (상위로)

		if((int)$nsort <= 0){
			echo "MAX";
			exit;
		}

		$chgPos = (int)$nsort - 1;

		$row = $db->total("select count(*) as cnt from  TBL_MINSOPICK where priority <= ".$chgPos." and del_tf = 'N' ");	

		if($row < 1){
			echo "MAX";
			exit;
		}else{
			$db->query("update TBL_MINSOPICK set priority = priority+1 where priority = ".$chgPos." and del_tf = 'N' ");
			$db->query("update TBL_MINSOPICK set priority = '".$chgPos."' where id = ".$uid." and del_tf = 'N' ");
		}	

	}


	$param_data = array(
					);

	$param_data = array_filter($param_data);

	//리스트 가져오기
	$rs = $_contents->get_popup_ty6_list($param_data);

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
					<div class="row ai_c">
						<div class="col_20 t_left">
							<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['title']?>')">
								<div class="table_ellip">
									<span> <?=$rs[$j]['title']?></span>
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


if($mode == "SEL_DELETE"){

	if(count($dataArr) < 1) msg_err("주요 항목이 누락되었습니다.");

	for ($j = 0 ; $j < count($dataArr); $j++) {
		$row = $db->total("select count(*) as cnt from  TBL_MINSOPICK where id = ".$dataArr[$j]." and del_tf = 'N'");

		if($row > 0){
			$db->query("update TBL_MINSOPICK set del_tf = 'Y', del_date=now(), del_adm='".$_SESSION['_admin']["no"]."', del_ip='".$_SERVER["REMOTE_ADDR"]."' where id = ".$dataArr[$j]);	
		}
	}


	$param_data = array(
					);

	$param_data = array_filter($param_data);

	//리스트 가져오기
	$rs = $_contents->get_popup_ty6_list($param_data);

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
					<div class="row ai_c">
						<div class="col_20 t_left">
							<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['title']?>')">
								<div class="table_ellip">
									<span> <?=$rs[$j]['title']?></span>
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

exit;

?>