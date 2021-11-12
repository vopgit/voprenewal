<?php
$_menu_code = '0403';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>

<script type="text/javascript">

	//조회
	function js_view(no) {
		var frm = document.frm;
		var param = "<?=$param['query']?>";
		param = param.replace('?', '&');
		href = '/review/input?review_id=' + no + param;
		location.href = href;
		return;
	}

	var dup_submit_flag = 'N';	//2중 클릭 체크

	function js_del(id) {
		<?php if(!$is_allow_delete){ ?>
			alert("삭제 할 수 없습니다.");
			return false;
		<?}?>

		if(dup_submit_flag == 'N'){

			var frm = document.frm;
			var review_id = id;

			var str_category = "";
			var chk_cnt = 0;

			if(isEmpty(review_id)){
				alert('삭제할 수 없습니다.');
				return;
			}

			var _msg = "삭제 하시겠습니까?";

			if(confirm(_msg)){

				dup_submit_flag = 'Y';

				$.ajax({
					type: 'post',
					url:"/review/dml",
					data: {mode: 'DEL_SEL_ID', review_id:review_id, from_page:'list'},
					success: function(result){
						console.log(result.code);
						if(result.code == "success"){
							dup_submit_flag = 'Y';
							alert("삭제 되었습니다.");
							location.replace("/review/list<?=$param['query']?>");
						}else{
							dup_submit_flag = 'N';
							alert(result.msg);
						}
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						dup_submit_flag = 'N';
						alert( textStatus + ", " + errorThrown );
					}
				});
			} //confirm

		}else{
			alert("처리중입니다.\n잠시만 기다려 주세요.");
		}

	}

	//선택삭제
	function js_sel_delete(){
		var cnt = $("input:checkbox[name='chk[]']:checked").length;
		if(cnt < 1){
			alert('선택내역이 없습니다');
		}else{

			if(dup_submit_flag == 'N'){

				if(confirm('선택하신 항목을 삭제하시겠습니까?')){
					dup_submit_flag = 'Y';

					$('#mode').val('selDelete');

					$.ajax({
						type: 'post',
						url: '/review/dml',
						data: $('#frm').serialize(),
						success: function(result){

							console.log(result.code);

							if(result.code == "success"){
								dup_submit_flag = 'Y';
								alert("삭제 되었습니다.");
								location.replace("/review/list<?=$param['query']?>");
							}else{
								dup_submit_flag = 'N';
								alert(result.msg);
							}

						},
						error: function( jqXHR, textStatus, errorThrown ) {
							alert( textStatus + ", " + errorThrown );
							dup_submit_flag = "N";
						}
					});
				}

			}else{
				alert("처리중입니다.\n잠시만 기다려 주세요.");
			}
		}
	}


	function js_sel_update(){

		var arr_id_status = new Array();
		var param = "";
		var _id = "";
		var _status = "";

		if ( $('tbody#tbody_id tr').length > 0 ) {

			$('#tbody_id').find('tr').each(function(index){

				_id = $(this).data('item');
				_status = $("input[name='fm_rd_"+index+"']:checked").val();

				if(param == "") param = _id+"|"+_status;
				else param = param + ","+_id+"|"+_status;
			});
		}

		if(dup_submit_flag == 'N'){

			if(isEmpty(param)){
				alert('대상이 없으므로 상태를 일괄 변경할 수 없습니다.');
				return;
			}

			var _msg = "상태를 일괄 변경 하시겠습니까?";

			if(confirm(_msg)){

				dup_submit_flag = 'Y';

				$.ajax({
					type: 'post',
					url:"/review/dml",
					data: {mode: 'UPDATE_STATUS_SEL_ID', status:param, from_page:'list'},
					success: function(result){
						console.log(result.code);

						if(result.code == "success"){
							dup_submit_flag = 'Y';
							alert("전체 편집 완료 되었습니다.");
							location.replace("/review/list<?=$param['query']?>");
						}else{
							dup_submit_flag = 'N';
							alert(result.msg);
						}
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						dup_submit_flag = 'N';
						alert( textStatus + ", " + errorThrown );
					}
				});
			} //confirm

		}else{
			alert("처리중입니다.\n잠시만 기다려 주세요.");
		}
	}


	//선택삭제
	function js_search(){

		var frm = document.frm;

		if(dup_submit_flag == 'N'){

			dup_submit_flag = 'Y';

			frm.mode.value = "SEARCH_REVIEW";
			frm.target = "";
			frm.action = "/review/list";
			frm.submit();

		}else{
			alert("처리중입니다.\n잠시만 기다려 주세요.");
		}
	}



</script>


<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">발행된 리뷰</h3>


        <form name="frm" id="frm" method="post">
			<input type="hidden" name="mode" id="mode" class="inp inp_sm fm_full"  value="">
			<input type="hidden" name="review_id" id="review_id" class="inp inp_sm fm_full" value="">
			<input type="hidden" name="adm_no" id="adm_no" value="<?=$_SESSION['_admin']['no']?>" >
			<input type="hidden" name="from_page" value="list">
			<input type="hidden" name="nPage" value="<?=$nPage?>">

            <div class="area_box mb_30">

                <div class="area_con_box ptbl_0">
                    <div class="table_box horizontal ty_tab act_hov t_center">

                        <div class="row plr_30 ptb_25 search_box">
							<!--
                            <div class="col_4 pr_10">
                                <div class="sel_box">
									<select name="status" id="status" class="sel sel_md fm_full">
                                        <option value="" >상태</option>
										<option value="published" <?=($param_data['status']=="published")?"selected":""?>>발행</option>
										<option value="standby" <?=($param_data['status']=="standby")?"selected":""?>>대기</option>
                                    </select>
                                </div>
                            </div>
							-->
                            <div class="col_6 pr_10">
                                <div class="sel_box">
									<select name="sf_1" id="sf_1" class="sel sel_md fm_full">
										<option value="">전체</option>
                                        <option value="contributor" <?=($param_data['sf_1']=="contributor")?"selected":""?>>작성자</option>
                                        <option value="email" <?=($param_data['sf_1']=="email")?"selected":""?>>이메일</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col_6 pr_10">
                                <div class="sel_box">
									<input type="text" name="st_1" id="st_1" maxlength="50" class="inp fm_full" value="<?=$param_data['st_1']?>">
                                </div>
                            </div>
                            <div class="col_12">
                                <div class="row wp_10 fs_nowrap">
                                    <div class="col_11">
										<select name="sf_2" id="sf_2" class="sel sel_md fm_full">
											<option value="">전체</option>
                                            <option value="serial" <?=($param_data['sf_2']=="serial")?"selected":""?>>리뷰 시리얼넘버</option>
                                            <option value="osmu_id" <?=($param_data['sf_2']=="osmu_id")?"selected":""?>>원기사 시리얼넘버</option>
                                        </select>
                                    </div>
                                    <div class="col_9">
										<input type="text" name="st_2" id="st_2" maxlength="20" class="inp fm_full" value="<?=$param_data['st_2']?>">
                                    </div>
                                    <div class="col_4">
										<a href="javascript:;" onclick="js_search()" class="btn btn_c7 btn_sm search btn_full">검색</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <table class="t_center">

                            <colgroup>
                                <col data-col-width="60" />
                                <col data-col-width="60" />
                                <col data-col-width="100" />
                                <col data-col-width="120" />
                                <col data-col-width="80" />
                                <col data-col-width="120" />
                                <col data-col-width="160" />
								<col data-col-width="130" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>
                                        <label class="fm_ch ">
                                            <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                        </label>
                                    </th>
                                    <th>No.</th>
                                    <th>리뷰 시리얼넘버</th>
                                    <th>원기사 시리얼넘버</th>
                                    <th>작성자</th>
                                    <th>입력시간</th>
                                    <th>편집</th>
									<th>상태</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_id">
								<?if(count($rs['data']) > 0){?>
									<?
									// $_post_status  config 정의
									for ($j = 0 ; $j < count($rs['data']); $j++) {
										$data = $rs['data'][$j];

										$contributor = "";

										if($data['contributor']!=""){
											$contributor = $data['contributor'];
										}else{
											$contributor = $data['name'];
										}
									?>

										<tr data-item='<?=$data['id']?>'>
											<td>
											<?if($data['del_tf']!='Y'){?>
												<label class="fm_ch ">
													<input type="checkbox" name="chk[]" value="<?=$data['id']?>" class="board_chk"><span class="_icon"></span>
												</label>
											<?}?>
											</td>
											<td><?=$rs['vNum']-$j?></td>
											<td><?=$data['serial']?></td>
											<td><?=$data['osmu_serial']?></td>
											<td><?=$contributor?></td>
											<td><?=$data['reg_date']?></td>
											<?if($data['del_tf']=='Y'){?>
												<td colspan="2">
													삭제됨 (<?=$data['del_date']?>)
													<input type="hidden" name="fm_rd_<?=$j?>" value="">
												</td>
											<?}else{?>
												<td>
													<?php if(($data['member_id'] == $_SESSION['_admin']['no'])||($_SESSION['_admin']['role']=="editor")){ ?>
														<a href="javascript:;" onclick="js_preview('<?=$data['id']?>')"  class="btn btn_line_c4">미리보기</a>
														<a href="javascript:;" onclick="js_view('<?=$data['id']?>')" class="btn btn_line_c8">리뷰 수정</a>
														<a href="javascript:;" onclick="js_del('<?=$data['id']?>')" class="btn btn_line_cg">리뷰 삭제</a>
													<?php }else{ ?>
														-
													<?php } ?>
												</td>
												<td>
													<?php if(($data['member_id'] == $_SESSION['_admin']['no'])||($_SESSION['_admin']['role']=="editor")){ ?>
														<label class="fm_rd">
															<input type="radio" value="published" name="fm_rd_<?=$j?>" <?=($data['status']=="published")?'checked':''?> title="발행">
															<span class="_icon"></span>
															<span class="fs_13">발행</span>
														</label>
														<label class="fm_rd ml_10">
															<input type="radio" value="standby" name="fm_rd_<?=$j?>" <?=($data['status']=="standby")?'checked':''?> title="대기">
															<span class="_icon"></span>
															<span class="fs_13">대기</span>
														</label>
													<?php }else{ ?>
														-
													<?php } ?>
												</td>
											<?}?>
										</tr>

									<?}?>

								<?}else{ ?>

									<td colspan="8">조회된 게시글이 없습니다.</td>

								<?} ?>

                            </tbody>
                        </table>

						<?php if($rs['total'] > 0){ ?>
							<div class="page_wrap pt_30 pb_25"">
								<?=$rs['paging']?>
							</div>
						<?php } ?>

                    </div>
                </div>
            </div>
            <div class="mtb_30 btn_box flex">
				<button type="button" onclick="js_sel_delete()" class="btn_lg btn btn_line_c14">선택삭제</button>
                <button type="button" onclick="js_sel_update()" class="btn_lg ml_auto btn_c2 ml_10"> 전체 편집 완료</button>
            </div>


        </form>



    </div>

</div>

<script>

	function js_preview(id){
		var url = '/preview/review/' + id;

		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');

	}

	function close_iframe(){
		alert('미리보기가 지원되지 않습니다');
		act_popup_close();
	}

</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
