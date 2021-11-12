<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<script type="text/javascript">
	function js_write() {
		document.location.href = "write_news_category<?=$param['query']?>";
	}

	//조회
	function js_view(no) {
		var frm = document.frm;
		var param = "<?=$param['query']?>";
		param = param.replace('?', '&');
		href = '/category/write_news_category?seq=' + no + param;
		location.href = href;
		return;
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
			frm.action = "/category/dml_NewsCategory";
			frm.submit();
		}
	}

	//선택삭제
	function js_delete(){
		var cnt = $("input:checkbox[name='chk[]']:checked").length;
		if(cnt < 1){
			alert('선택내역이 없습니다');
		}else{
			if(confirm('선택하신 항목을 삭제하시겠습니까?')){
				frm.mode.value = "selDelete";
				frm.target = "";
				frm.action = "/category/dml_NewsCategory";
				frm.submit();
			}
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
			<input type="hidden" name="seq" id="seq" value="" >
			<input type="hidden" name="adm_no" id="adm_no" value="<?=$_SESSION['_admin']['no']?>" >
			<input type="hidden" name="nPage" value="<?=$nPage?>">
			<input type="hidden" name="use_tf" id="use_tf" value="">

			<div class="row ai_c mb_20">
				<h3>기사분류</h3>
				<!--
				<div class="ml_auto col_3">
					<div class="sel_box">
						<select name="status" id="status" class="sel fm_full">
							<option value="">전체</option>
							<option value="standby">대기중</option>
							<option value="tempstored">작성중</option>
							<option value="published">발행중</option>
							<option value="deleted">삭제됨</option>
							<option value="reserved">보류</option>
						</select>
					</div>
				</div>
				-->
			</div>

			<div class="table_box horizontal">
				<table class="t_center">
					<colgroup>
						<col data-col-width="30" />
						<col data-col-width="60" />
						<col data-col-width="170" />
						<col data-col-width="140" />
						<col data-col-width="120"/>
						<col data-col-width="120"/>
						<col data-col-width="120"/>
						<col data-col-width="120"/>
						<col data-col-width="170"/>
						<col data-col-width="100"/>
					</colgroup>
					<thead >
						<tr>
							<th>
								<label class="fm_ch ">
                                    <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                </label>
							</th>
							<th >No.</th>
							<th>기사 분류명 (한글)</th>
							<th>기사 분류명 (영어)</th>
							<th>네이버 카테고리<br>코드</th>
							<th>네이버<br>카테고리명</th>
							<th>다움 카테고리<br>코드</th>
							<th>다움<br>카테고리명</th>
							<th>기사 분류명(구)</th>
							<th>노출유무</th>
						</tr>
					</thead>
					<tbody >
					<?php
						// $_post_status  config 정의
						for ($j = 0 ; $j < count($rs['data']); $j++) {
							$data = $rs['data'][$j];
							$str_category ="";


							?>
							<tr>
								<td>
	                                <label class="fm_ch">
	                                    <input type="checkbox" class="board_chk" name="chk[]" value="<?=$data['id']?>"><span class="_icon"></span>
	                                </label>
	                            </td>
								<td><?=$rs['vNum']-$j?></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['name']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['english_name']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['naver_cateory_code']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['naver_cateory']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['daum_categery_code']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['daum_categery']?></a></div></td>
								<td><div class="t_center ellip_1 fs_14"><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['old_name']?></a></div></td>

								<td>
									<div class="btn_box wp_5">
										<a class="btn <?=($data['use_tf'] == 'Y')? 'btn_line_c4':'btn_line_c8' ?>" href="javascript:;" onclick="js_ChangeUseTf('<?=$data['id']?>', '<?=$data['use_tf']?>');">
											<span><?=($data['use_tf'] == 'Y')? "노출":"비노출"?></span>
										</a>
									</div>
								</td>
							</tr>
							<?php
						}
						?>
						<?php if($rs['total'] < 1){ ?>
							<tr>
								<td colspan="6">조회된 정보가 없습니다.</td>
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

			<div class="row wp_20 pt_40 pb_30">
				<div class="col_ ml_auto btn_box">
					<button type="button" class="btn_lg btn btn_line_c14" onclick="js_delete()"> 선택 삭제</button>
					<button type="button" class="btn_lg btn_c2 ml_10" onclick="js_write()"><span>등록</span></button>
				</div>
			</div>

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
