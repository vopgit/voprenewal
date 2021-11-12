<?php include _ROOT.'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <div class="row jc_sb ai_c mb_20">
            <h3>내가 입력한 기사</h3>
            <a href="/contents/list?type=article" class="more_link ml_auto">
                <span>더 많이 보기</span>
                <i class="iconFt_arrow_right"></i>
            </a>
        </div>
        <div class="table_box horizontal mb_80">

            <table class="t_center">
            <colgroup>
              <col data-col-width="70" />
              <col data-col-width="90" />
              <col data-col-width="420"/>
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
					//$_post_status - config 정의				
					for ($j = 0 ; $j < count($article['data']); $j++) {
						$data = $article['data'][$j];	
						?>
						<tr>
							<td><?=($article['total'] - $j)?></td>
							<td><?=$data['kind_name']?></td>
							<td><div class="t_left ellip_1 fs_14"><a href="javascript:;" class="pv_article" data-id="<?=$data['id']?>" ><?=$data['title']?></a></div></td>
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

                </tbody>
            </table>
        </div>

        <!--내가입력한 사진-->
        <div class="row ai_c mb_20">
            <h3>내가 입력한 사진</h3>
            <div class=" top_tab_btns">
                <button type="button" class="top_tab_btn on" onclick="photoBox.simpleEvt(this, '#eaditPhoto')"><span>사진 간단히</span></button>
                <button type="button" class="top_tab_btn"    onclick="photoBox.detailEvt(this, '#eaditPhoto')"><span>사진 자세히</span></button>
            </div>
            <a href="/contents/list?type=image" class="more_link ml_auto">
                <span>더 많이 보기</span>
                <i class="iconFt_arrow_right"></i>
            </a>
        </div>


        <!--사진 간단히 .eadit_photo_box .simple-->
        <!--사진 자세히 .eadit_photo_box -->

        <div class="row wp_10 mb_50 eadit_photo_box simple" id="eaditPhoto">
            <?php
			//$_post_status <- config 정의			
			for ($j = 0 ; $j < count($photo['data']); $j++) {
				$data = $photo['data'][$j];
				?>
				<div class="col_12 eadit_photo_col">
					<div class="eadit_photo">
						<div class="ph_wrap">
							<div class="ph_thumbnail">
							<div class="thum_img" onclick="js_preview('image','<?=$data['id']?>')">
									<img src="<?=$data['photo']?>" alt="<?=$data['title']?>">
								</div>
								<div class="thum_txt">
									<div class="fs_14">
										<p class="fw_700 num_code"><?=$data['serial']?></p>
										<p class="<?=$_post_status[$data['status']]['color']?>"><?=$_post_status[$data['status']]['title']?></p>
									</div>
									<?php if($data['status'] == "published"){ ?>
										<button type="button" class="btn btn_line_cg" onclick="js_modify('<?=$data['id']?>')" ><span>사진수정</span></button>
									<?php } ?>
								</div>
							</div>
							<div class="ph_text">
								<div class="table_box vertical ">
									<table>
										<colgroup>
											<col width="130" data-simple="none" />
											<col />
										</colgroup>
										<tbody>
											<tr data-simple="none">
												<th class="t_left">입력자/저작권자</th>
												<td><?=$data['name']?> / <?=$data['copyright']?></td>
											</tr>
											<tr>
												<th class="t_left" data-simple="none">제목</th>
												<td>
												  <div class="t_left ellip_1 fs_14">
												   <span><?=$data['title']?></span>
												  </div>
												</td>
											</tr>
											<tr>
												<th class="t_left" data-simple="none">태그</th>
												<td><?=$data['tags_print']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">입력시간</th>
												<td><?=$data['regist_time']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">수정시간</th>
												<td><?=$data['update_time']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">설명</th>
												<td><?=($data['description'] != "") ? $data['description'] : '설명없슴'; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
        </div>
        <!--내가입력한 사진//-->
    </div>



</div>
<script type="text/javascript">
$(document).ready(function() {
	$('.pv_article').on('click',function(){
		var id = $(this).data('id');
		js_preview('article', id);
	});

	//송고하기
	$('.btn_standby').on('click',function(){
		var id = $(this).data('id');
		var status = $(this).data('status');

		if(confirm('송고하시겠습니까?')){
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

function js_modify(id){
	location.href = '/photo/modify?photo_id=' + id;
}

function js_view(n){
	var url = "<?=$param['query']?>";
	location.href = "/contents/input?contents_id=" + n + url.replace("?", "&", url);
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
