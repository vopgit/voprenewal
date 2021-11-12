<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<script type="text/javascript">

	function js_write() {

		var frm = document.frm; 
		
		if (frm.group_no.value == "") {
		  frm.mode.value = "ADMIN_GROUP_INSERT";
		} else {
			frm.mode.value = "ADMIN_GROUP_MODIFY";
		}

		if (frm.group_name.value == "") {
		  	alert("관리자 그룹명을 입력 하십시오."); //관리자 그룹명을 입력 하십시오.
			frm.group_name.focus();
			return;
		}

		frm.target = "";
		frm.method = "post";
		frm.action = "/admin/dml_admin";
		frm.submit();
	}

	//조회
	function js_view(group_no, group_name) {

		var frm = document.frm; 
		frm.group_no.value = group_no;
		frm.group_name.value = group_name;
		frm.mode.value = "ADMIN_GROUP_MODIFY";
		frm.text_mode.value = '[수정 모드]'; //수정 모드
		document.getElementById("btn_save").text = "수정";
		$('#btn_del').show();

	}

	//선택삭제
	function js_delete(uid){
		var frm = document.frm;

		bDelOK = confirm('그룹을 삭제 하시겠습니까?\n해당 그룹에 속한 관리자도 같이 삭제 됩니다.');

		if (bDelOK==true) {
			frm.mode.value = "ADMIN_GROUP_DELETE";

			if(!isEmpty(uid)){
				frm.group_no.value = uid;
			}

			frm.target = "";
			frm.action = "/admin/dml_admin";
			frm.submit();
		}

	}

	function js_ChangeUseTf(id, use_tf) {
		var frm = document.frm;

		bDelOK = confirm('공개 여부를 변경 하시겠습니까?');

		if (bDelOK==true) {

			if (use_tf == "Y") {
				use_tf = "N";
			} else {
				use_tf = "Y";
			}

			frm.seq.value = id;
			frm.use_tf.value = use_tf;
			frm.mode.value = "use_tf_modify";
			frm.target = "";
			frm.action = "/category/dml_NewsKind";
			frm.submit();
		}
	}



//	function js_view(n){
//		var url = "<?=$param['query']?>";
//		location.href = "/contents/input?contents_id=" + n + url.replace("?", "&", url);
//	}

</script>


<div class="contain">

    <div class="wrap">

		<form  name="frm" id="frm" method="post">
			<input type="hidden" name="mode" id="mode" value="">
			<input type="hidden" name="group_no" value="">
			<input type="hidden" name="nPage" value="<?=$nPage?>">

			<div class="row ai_c mb_20">
				<h3>관리자 그룹 관리</h3>

				<div class="table_box horizontal">
					<table class="t_center">
						<colgroup>
							<col data-col-width="150" />
							<col data-col-width="450" />
						</colgroup>
						<thead >
							<tr>
								<th>
									관리자 그룹명
								</th>
								<td>
									<input type="text" class="txt" style="width:75%" name="group_name" required/>
									<input type="text" class="txt" name="text_mode" style="width:75px" style="border:0px; soild #FFF" value="[ 등록모드 ]" readonly="">
								</td>
							</tr>
						</thead>
					</table>

				</div>

				<div style="width:96%; margin:0 auto; text-align:center; padding:5px 0px 0px">
					<?php if($sPageRight_I == "Y") {?>
						<a href="javascript:;" onclick="js_write()" id="btn_save" class="btn blue">저장</a> &nbsp;
						<a href="javascript:;" onclick="js_cancel()" class="btn line">취소</a> &nbsp;
						<a href="javascript:;" onclick="js_delete()" id="btn_del" class="btn gray" style="display:none">삭제</a>
					<?php } ?>
				</div>

			</div>



			<div class="row ai_c mb_20">
				<span style="float:left">
					Total : <?=$rs['vNum']?>
				</span>
				<span style="float:right">
					
				</span>
			</div>




			<div class="table_box horizontal">
				<table class="t_center">
					<colgroup>
						<col data-col-width="40" />
						<col data-col-width="100" />
						<col data-col-width="100" />
						<col data-col-width="100"/>
					</colgroup>

					<thead >
						<tr>
							<th >No.</th>
							<th>그룹명</th>
							<th>메뉴별권한설정</th>
							<th>삭제</th>
						</tr>
					</thead>

					<tbody >
					<?php
						// $_post_status  config 정의
						for ($j = 0 ; $j < count($rs['data']); $j++) {
							$data = $rs['data'][$j];

							?>
							<tr>
								<td><?=$rs['vNum']-$j?></td>

								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['GROUP_NO']?>','<?=$data['GROUP_NAME']?>')"><?=$data['GROUP_NAME']?></a></div></td>

								<td>
									<div class="t_center ellip_1 fs_14">
									<? if ($sPageRight_U == "Y") { ?>
										<a href="javascript:NewWindow('pop_menu_list?group_no=<?=$data['GROUP_NO']?>&group_name=<?=urlencode($data['GROUP_NAME'])?>','pop_menu_list','820','650','YES')" class="btn btn_c2">권한관리</a>
									<? } ?>
									
									</div>
								</td>

								<td>
									<div class="t_center btn_box wp_5">
										<? if ($sPageRight_D == "Y") { ?>									 
											<? if ($data['GROUP_NO'] != 1) { ?><a href="javascript:js_delete('<?=trim($data['GROUP_NO'])?>');" class="btn dgray small">삭제</a><? } ?>
										<? } ?>

									</div>
								</td>

							</tr>
							<?php
						}
						?>
						<?php if($rs['total'] < 1){ ?>
							<tr>
								<td colspan="4">조회된 정보가 없습니다.</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

				<?php if($rs['total'] > 0){ ?>
					<div class="page_wrap">
						<?=$rs['paging']?>
					</div>
				<?php } ?>
			</div>

			<!--
			<div class="row wp_20 pt_40 pb_30">
				<div class="col_ ml_auto btn_box">
					<button type="button" class="btn_lg btn btn_line_c14" onclick="js_delete()"> 선택 삭제</button>
					<button type="button" class="btn_lg btn_c2 ml_10" onclick="js_write()"><span>등록</span></button>
				</div>
			</div>
			-->

		</form>

	</div>

</div>

<script type="text/javascript">

$(function(){
	$('#status').change(function(){
		var status = ($(this).val() == "") ? "" : "&status=" + $(this).val();
		location.href = "/contents/list?type=<?=$_get['type']?>" + status;
	});
});
$(document).ready(function() {
	$('#status').val("<?=$_get['status']?>");
});
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
