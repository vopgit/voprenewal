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

?>