<?php
$_menu_code = '0706';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>



<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">네이버/다음 전송</h3>

            <div class="area_box mb_30">

                <div class="area_con_box ptbl_0">
                    <div class="table_box horizontal ty_tab act_hov t_center">

                        <form name="frm_s" id="frm_s" method="get" action="/publish/portal">
						<div class="row plr_30 ptb_25 search_box">
                            <div class="col_7 pr_10">
                                <input type="text" name="s_serial" id="s_serial" class="inp fm_full enter" placeholder="시리얼 넘버" value="<?=$s_serial?>" maxlength="12">
                            </div>
                            <div class="col_10 pr_10">
                                <input type="text" name="s_title" id="s_title" class="inp fm_full enter" placeholder="제목" value="<?=$s_title?>" maxlength="50">
                            </div>
                            <div class="col_7 ">
                                <div class="row">
                                    <div class="col_19 t_right">
                                        <input type="text" name="s_name" id="s_name" class="inp fm_full enter" placeholder="작성자" value="<?=$s_name?>" maxlength="20">
                                    </div>
                                    <div class="col_5 t_right">
                                        <a href="" class="btn btn_c7 btn_sm search btn_search">검색</a>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>


                        <table class="t_center">

                            <colgroup>
                                <col data-col-width="80"  />
                                <col data-col-width="" />
                                <col data-col-width="110" />
                                <col data-col-width="220" />
                                <col data-col-width="110" />
                                <col data-col-width="220" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>제목/시리얼넘버</th>
                                    <th>작성자</th>
                                    <th>보내기</th>
                                    <th>SNS 도구</th>
                                    <th>전송일시(카테고리)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								for ($j = 0 ; $j < count($rs['data']); $j++) {
									$data = $rs['data'][$j];						
									?>
									<tr data-id="<?=$data['id']?>">
										<td><?=($rs['vnum'] - $j)?></td>
										<td class="_subj"><a href="javascript:;" class="pv_article"><?=$data['title']?></a></td>
										<td>
											<?=$data['name']?> 기자
											<?php if($data['contributor'] != ""){ //대체명의 ?>
												<br>(<?=$data['contributor']?>) 
											<?php } ?>
										</td>										
										<td>
											<div class="row mb_5 ai_c">
												<div class="col_13 ">
													네이버
													<!--
													<select name="" id="" class="sel fm_full">
														<option value="">네이버</option>
														<option value="">다음</option>
													</select>
													-->
												</div>
												<div class="col_11  t_right ">
													<a href="javascript:;" class="btn_c14 btn_sm" onclick="js_sendSns('naver', '<?=$data['id']?>')">전송</a>
													<a href="javascript:;" class="btn_sm naver_cancel_<?=$data['id']?>" onclick="js_sendSnsCancel('naver', '<?=$data['id']?>')" style="display:none">삭제</a>
												</div>
											</div>


											<div class="row ai_c">
												<div class="col_13 ">
													다음
													<!-- <select name="" id="" class="sel fm_full">
														<option value="">다음</option>
														<option value="">네이버</option>
													</select> -->
												</div>
												<div class="col_11  t_right ">
													<a href="javascript:;" class="btn_c14 btn_sm" onclick="js_sendSns('daum', '<?=$data['id']?>')">전송</a>
													<a href="javascript:;" class="btn_sm daum_cancel_<?=$data['id']?>" onclick="js_sendSnsCancel('daum', '<?=$data['id']?>')" style="display:none">삭제</a>
												</div>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="btn btn_line_c12 mb_5 btn_full"  onclick="js_sendSns('twitter', '<?=$data['id']?>')">트위터 전송</a>
											<a href="javascript:;" class="btn btn_line_c13 btn_full" style="margin-left:0;">페북 노출 정보</a>
										</td>
										<td >
											<p class="msg_naver_<?=$data['id']?>"><!-- 네이버: 2021-09-04 19:22:21 (정치) --></p>
											<p class="msg_daum_<?=$data['id']?>"><!-- 다음: 2021-09-04 19:22:21 (사회) --></p>
										</td>
									</tr>
									<?php 
								} 
								?>
								<?php if($rs['total'] < 1){ ?>
								<tr>
									<td colspan="6">조회된 내역이 없습니다.</td>
								</tr>
								<?php } ?>
                            </tbody>
                        </table>



                        <div class="page_wrap pt_30 pb_25">
                            <?=$rs['paging']?>
                        </div>
                    </div>
                </div>
            </div>


        </form>

    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#s_grp').val("<?=$s_grp?>");
	
	//검색
	$('.btn_search').on('click', function(){
		$('#frm_s').submit();
	});

	//검색 엔터 처리
	$('.enter').on('keydown', function(e){
		if(e.keyCode == 13){
			$('#frm_s').submit();
		}
	});

	//기사보기
	$('.pv_article').on('click',function(){
		var id = $(this).closest('tr').data('id');
		js_preview('article', id);
	});

	//기사수정
	$('.btn_modify').click(function(){
		var id = $(this).closest('tr').data('id');
		if(id != ''){
			location.href = "/publish/input?contents_id=" + id + "&refer=portal<?=str_replace('?', '&', $param['query'])?>";
		}		
	});
});

function js_sendSns(sns, id){

	var title = "";
	if(sns == "naver") title = "네이버";
	else if(sns == "daum") title = "다음";
	else if(sns == "twitter") title = "트위터";

	if(confirm(title + '로 전송하시겠습니까?')){

		if(sns == "twitter"){
			
			alert('전송이 완료되었습니다');

		}else{
			$('.'+sns+'_cancel_'+id).show();
			$('.msg_'+sns+'_'+ id).html(title + ":" + get_now() + "(정치)");
		}
	}
}

function get_now(){
	var today = new Date();

	var year = today.getFullYear();
	var month = ('0' + (today.getMonth() + 1)).slice(-2);
	var day = ('0' + today.getDate()).slice(-2);

	var dateString = year + '-' + month  + '-' + day;

	var hours = ('0' + today.getHours()).slice(-2); 
	var minutes = ('0' + today.getMinutes()).slice(-2);
	var seconds = ('0' + today.getSeconds()).slice(-2); 

	var timeString = hours + ':' + minutes  + ':' + seconds;

	return dateString + " " + timeString;
}


function js_sendSnsCancel(sns, id){
	var title = "";
	if(sns == "naver") title = "네이버";
	else if(sns == "daum") title = "다음";

	if(confirm(title + ' 송부를 삭제 하시겠습니까?')){
		$('.'+sns+'_cancel_'+id).hide();
		$('.msg_'+sns+'_'+ id).html('');
	}
}


function js_preview(type, id){		
	var url = '/preview/'+type+'/' + id;
	$('#popup_iframe').attr('src',url);
	$('#popup_iframe').stop().fadeIn().css('visibility','visible');
	$('body,html').css('overflow','hidden');
}    
function close_iframe(){
	act_popup_close();
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
