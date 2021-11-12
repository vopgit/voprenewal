<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap mb_100">
        <div class="row ai_c mb_20">
            <h3>내가 입력한 기사</h3>
            <div class="ml_auto col_3">
                <div class="sel_box">
                    <select name="status" id="status" class="sel fm_full">
                        <option value="">전체</option>
                        <option value="standby">대기중</option>
                        <option value="tempstored">작성중</option>
                        <option value="published">발행중</option>
						<option value="reserved">보류중</option>
                        <option value="deleted">삭제됨</option>                        
                    </select>
                </div>
            </div>
        </div>
        <div class="table_box horizontal">
            <table class="t_center">
                <colgroup>
                    <col data-col-width="100" />
                    <col data-col-width="90" />
                    <col data-col-width="400"/>
                    <col data-col-width="150"/>
                    <col data-col-width="80" />
                    <col data-col-width="190"/>
                    <col data-col-width="160"/>
                    <col data-col-width="100"/>
                </colgroup>
                <thead >
                    <tr>
                        <th >No.</th>
                        <th>기사종류</th>
                        <th>제목</th>
                        <th>조회수(PC/Mobile)</th>
                        <th>상태</th>
                        <th>수정/송고</th>
                        <th>입력시간</th>
                        <th>편집정보</th>
                    </tr>
                </thead>
                <tbody >
                <?php
					// $_post_status  config 정의					
					for ($j = 0 ; $j < count($rs['data']); $j++) {
						$data = $rs['data'][$j];
						?>
						<tr>
							<td><?=($rs['vnum'] - $j)?></td>
							<td><?=$data['kind_name']?>
								<?php 
								/* //old								
								if($data['author']['copyright'] == '민중의소리') echo '일반기사';
								else if($data['author']['copyright'] == '민소검색') echo '다음검색';
								else if($data['author']['copyright'] == '매거진검색') echo '페북기사';
								else if($data['author']['copyright'] == '매거진일반') echo '네이버이슈';
								else echo $data['author']['copyright'];
								*/
								?>
							</td>
							<td><div class="t_left ellip_1 fs_14"><a href="javascript:;" class="pv_article" data-id="<?=$data['id']?>"><?=$data['title']?></a></div></td>
							<td><?=number_format($data['count']['pc'])?>/<?=number_format($data['count']['mobile'])?></td>
							<td><span class="<?=$_post_status[$data['status']]['color']?>"><?=$_post_status[$data['status']]['title']?></span></td>
							<td>
								<div class="btn_box wp_5">
									<?php if(in_array($data['status'], array('tempstored', 'reserved1', 'reserved2'))){ ?>
									<a class="btn btn_line_c4" href="javascript:;" onclick="js_view('<?=$data['id']?>')">
										<span>기사수정</span>
									</a>
									<a class="btn btn_line_c2 btn_standby" href="javascript:;" data-id='<?=$data['id']?>' data-status='<?=$data['status']?>'>
										<span>송고하기</span>
									</a>
									<?php } ?>									
								</div>
							</td>
							<td><?=$data['regist_time']?></td>
							<td>
								<div class="edit_info_box_wrap">
									<button class="btn btn_c6" type="button" onclick="$('.edit_info_box').hide(); $(this).next().show();">
										<span>보기</span>
									</button>
									<div class="edit_info_box" style="display:none">
										<ul>
											<?php if($data['status'] == 'published'){ ?>
											<li><b>발행일시</b><span><?=$data['published_time']?></span></li>
											<?php } ?>

											<li>
												<b>편집일시</b>
												<span><?=$data['update_time']?>
													<?php if($data['mod_cnt'] > 0){ ?>
														(<?=$data['mod_cnt']?>차)
													<?php } ?>
												</span>
											</li>

											<?php if(!empty($data['contributor'])){ ?>
											<li><b>대체명의</b><span><?=$data['contributor']?></span></li>
											<?php } ?>

											<?php if(!empty($data['request_from'])){ ?>
											<li><b>최근송고</b><span><?=str_replace('고쳤습니다.', '고쳤습니다.<br>', $data['request_from'])?></span></li>
											<?php } ?>
										</ul>
										<button class="edit_info_box_close" type="button"  onclick="$(this).closest('.edit_info_box').hide();"><span class="text_hide">닫기</span></button>
									</div>
								</div>
							</td>
						</tr>
						<?php
					}
					?>
					<?php if($rs['total'] < 1){ ?>
						<tr>
							<td colspan="8">조회된 기사가 없습니다.</td>
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

    </div>

</div>

<script type="text/javascript">
function js_view(n){
	var url = "<?=$param['query']?>";
	location.href = "/contents/input?contents_id=" + n + url.replace("?", "&", url);
}
function js_preview(n){
	alert(n);
}

$(function(){
	$('#status').change(function(){
		var status = ($(this).val() == "") ? "" : "&status=" + $(this).val();
		location.href = "/contents/list?type=<?=$type?>" + status;
	});
});
$(document).ready(function() {
	$('#status').val("<?=$status?>");

	$('.pv_article').on('click',function(){
		var id = $(this).data('id');
		js_preview('article', id);
	});

	//송고하기
	$('.btn_standby').on('click',function(){
		var id = $(this).data('id');
		var status = $(this).data('status');

		if(confirm('송고하시겠읍니까?')){
			$.ajax({
				type: 'post',
				url: '/contents/dml',
				data: {'mode':'send', 'contents_id': id, 'status':status},
				success: function(msg){
					if(msg == 'success') location.reload();
					else alert(msg);			
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});	
		}

	});
});

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

