<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
    .poto_con{
        width:100%;
    }
    .popup_contents {
    padding: 1.875em;
    overflow-y: auto;
    height: 644px;
}
</style>
<script>
function done(n){ 
	var obj = $('#_photo_'+n);	
	var data = {
		 "code" : obj.find('.num_code').text().replace(/\[/gi, '(').replace(/\]/gi, ')'),
		 "title" : obj.find('.title').text().replace(/\[/gi, '(').replace(/\]/gi, ')'),
		 "author" : obj.find('.author').data('author').replace(/\[/gi, '(').replace(/\]/gi, ')')
		};
	parent.setEditorHtml('photo', JSON.stringify(data));
	return;
}
</script>

    <div class="popup_box">
        <div class="popup_wrap wrap1300">
            <div class=" popup_con ">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>사진입력</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>
                <div class="popup_contents step_1">

                <!-- search -->	
				<form name='frm' id="frm" action="/photo/pop" method="GET">
					<input type="hidden" name="me" id="me" value="<?=$me?>">
                    <div class="row mb_30  jc_c">
                        <div class="col_13 ">
                            <div class="row plr_20">
                                <div class="col_6 pr_5">
                                    <div class="sel_box">
                                        <select name="sf" id="sf" class="sel sel_md fm_full placeholder __customUi">
											<option value="title" <?=($sf == 'title') ? "selected" :""?>>제목</option>
                                            <option value="serial" <?=($sf == 'serial') ? "selected" :""?>>시리얼번호</option>                                            
                                            <option value="name" <?=($sf == 'name') ? "selected" :""?>>작성자</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col_18 t_right ">
                                    <div class="pop_search ">
                                        <input type="text" name="st" id="st" class="inp fm_full" placeholder="검색어" value="<?=$st?>"  maxlength="30">
                                        <a href="javascript:;" class="btn btn_c7 btn_sm search">검색</a>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
				</form>
                <!-- search -->

                <div class="pop_editro_photo">
                    <ul class="tab_box">
                        <li <?php if($me == ""){ ?>class="on"<?php } ?>><a href="javascript:;" onclick="js_go()">전체사진</a></li>
                        <li <?php if($me == "mine"){ ?>class="on"<?php } ?>><a href="javascript:;" onclick="js_go('mine')">내가 올린 사진</a></li>
                        <li><a href="javascript:;"class="btn btn_md btn_c2 btn_step2" >사진 올리기</a></li>
                    </ul>
                    <div class="editro_photo _wrap">
                        <div class="row ai_c mb_20">
                            <div class=" ">
                                <button type="button" class="top_tab_btn on mr_25" onclick="photoBox.simpleEvt(this, '#eaditPhoto')"><span>사진 간단히</span></button>
                                <button type="button" class="top_tab_btn "    onclick="photoBox.detailEvt(this, '#eaditPhoto')"><span>사진 자세히</span></button>
                            </div>
                        </div>

                        <div class="row wp_20 eadit_photo_box simple" id="eaditPhoto">
                            <?php
						    for ($j = 0 ; $j < count($rs['data']); $j++) {
								$data = $rs['data'][$j];
								?>
								<div class="col_12 eadit_photo_col" id="_photo_<?=$j?>">
									<div class="eadit_photo">
										<div class="ph_wrap">
											<div class="ph_thumbnail">
												<div class="thum_img" data-marked='<?=($data['copyright'] == '') ? 'Y' : 'N'?>' onclick="act_BigImages(this);">
													<img src="<?=$data['photo']?>" alt="">
												</div>
												<div class="thum_txt">
													<div class="fs_14">
														<p class="fw_700 num_code"><?=$data['serial']?></p>
														<p class="sta_c<?=$j?>"><?=$value?></p>
													</div>
													<button type="button" class="btn btn_line_cg" onclick="done('<?=$j?>')"><span>사진입력</span></button>
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
																<td class="author" data-author="<?=($data['copyright'] == '') ? '민중의소리' : $data['copyright']?>">
																	<?=($data['contributor'] != "") ? $data['contributor'] : $data['name']." 기자"?> / 
																	<?=($data['copyright'] == '') ? '민중의소리' : $data['copyright']?>
																</td>
															</tr>
															<tr><th class="t_left" data-simple="none">제목</th> <td ><div class="ellip_1 "><span class="title"><?=$data['title']?></span></div></td></tr>
															<tr><th class="t_left" data-simple="none">태그</th> <td> <div class="ellip_1 "><?=restore_tags($data['tags'])?></div></td></tr>
															<tr data-simple="none"><th class="t_left">입력시간</th> <td><?=$data['regist_time']?></td></tr>
															<tr data-simple="none"><th class="t_left">수정시간</th> <td><?=$data['update_time']?></td></tr>
															<tr data-simple="none"><th class="t_left">설명</th> <td><?=$data['description']?></td></tr>
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

							<?php if($rs['total'] < 1){ ?>
								<div style="width:100%; padding:30px; text-align:center;">
									조회된 사진이 없습니다.
								</div>
							<?php } ?>
                        </div>

                        <div class="popup_pageing">
							<?php if($rs['total'] > 0){ ?>
							<div class="page_wrap  mt_35">
								<?=$rs['paging']?>
							</div>
							<?php } ?>
						</div>

                    </div>
                    
                </div>


                
                </div>

				<form name='frmp' id="frmp" method="post"  enctype="multipart/form-data">
				<input type="hidden" name="mode" value="popin">
				<input type="hidden" name="rtnPage" value="?me=<?=$me?>">

                <div class="popup_contents step_2">

                    <div class=" poto_box">
                        <div class="row">
                            <div class="col_5 ">
                                <div class="poto_con ">
                                    <div class="t_left row">
                                        <span class="fs_14">PC</span>
                                    </div>
                                    <div class="add_img" style>
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" name="userfile_p" id="userfile_p" class="attach" accept=".jpeg, .jpg, .gif, .png">
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_5 border_left">
                                <div class="poto_con">
                                    <div class=" row jc_sb">
                                        <span class="fs_14">MOBILE</span>
                                        <p class="fs_13 tc_b4">
                                            * 모바일 해상도에서 <BR>
                                            자동 교체되는 이미지
                                        </p>

                                    </div>

                                    <div class="add_img">
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file"  name="userfile_m" id="userfile_m" class="attach" accept=".jpeg, .jpg, .gif, .png">
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_14">
                                <div class="row poto_con border_left">
                                    <div class="col_12 pr_15">
                                        <div class="mb_10">
                                            <p class="mb_10">제목</p>
                                            <input type="text" name="title" id="title" class="inp inp_sm fm_full" maxlength="250">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">저작권자</p>
                                            <label class="fm_rd ">
                                                <input type="radio" name="writer" id="writer" value="" checked>
                                                <span class="fs_13">민중의소리 (워터마크 표시)</span>
                                            </label>

                                            <label class="fm_rd ml_10 fs_13">
                                                <input type="radio" name="writer" id="writer" value="etc" class="readChange">
                                                <span class="fs_13"> 기타 (워터마크 없음)</span>
                                            </label>
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">작성자</p>
                                            <input type="text" name="contributor" id="contributor" class="inp inp_sm fm_full">
                                            <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                        </div>
                                    </div>
                                    <div class="col_12 pl_15">
                                        <div class="mb_10">
                                            <p class="mb_10">설명</p>
                                            <input type="text" name="description" id="description" class="inp inp_sm fm_full" maxlength="255">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">&nbsp;</p>
                                            <input type="text" name="copyright" id="copyright" class="inp inp_sm fm_full read_only act_read" readonly  maxlength="100">
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">태그</p>
                                            <input type="text" name="tags" id="tags" class="inp inp_sm fm_full" maxlength="255">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <p class="tc_b4 fs_13 mt_10">
                            * (PC/MOBILE)  800x470 사이즈 권장
                        </p>
                    <div class=" mt_30 t_center">
                        <a href="javascript:;"class="btn_md btn btn_stepBack"  >돌아가기</a>
                        <a class="btn_md btn_c2 btn_photo_submit" href="javascript:;">사진 입력 완료</a>
                        
                    </div>
                </div>
            </div>
			</form>

            <div class="popBig" onclick="$(this).hide();">
                <div class="popBig_wrap">
                      <img src="" class="popBig_img">       
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>

</div>


<script>

    $(document).ready(function(){
		act_readOnly();

		$('.search').click(function(){
			$('#frm').submit();
		});
    })

	$(document).on('click', '.btn_photo_submit', function(){

		$('#title').val($('#title').val().replace(/\[/gi, '(').replace(/\]/gi, ')'));
		$('#description').val($('#description').val().replace(/\[/gi, '(').replace(/\]/gi, ')'));
		$('#contributor').val($('#contributor').val().replace(/\[/gi, '(').replace(/\]/gi, ')'));
		
		if($("input:radio[name=writer]:checked").val() == 'etc'){
			if($('#copyright').val() == ""){
				alert('저작권자를 입력하여 주세요');
				$('#copyright').focus();
				return false;
			}
		}
	
		if($('#userfile_p').val() == ""){
			alert('사진을 선택하여 주세요');
			$('#userfile_p').parent().find('.btn').click();
			return false;
		}

		if($('#title').val() == ""){
			alert('제목을 입력하여 주세요');
			$('#title').focus();
			return false;
		}

		//copyright

		if(confirm('등록하시겠습니까?')){
			$('#frmp').attr('action','/photo/dml');
			$('#frmp').submit();				
		}
	});

    $('.btn_step2').click(function(){
        $('.btn_step2').closest('.step_1').slideUp();
        $('.step_2').slideDown(); 
    });
    $('.btn_stepBack').click(function(){
        $('.step_2').slideUp(); 
        $('.step_1').slideDown();
    });

    function act_BigImages(el){
		var marked = ($(el).data('marked'));
		if(marked == 'Y') var src = $(el).find('img').attr('src').replace('/thumb','/marked');
        else var src = $(el).find('img').attr('src').replace('/thumb','');
        $('.popBig').show();
        $('.popBig').find('img').attr('src',src).css('max-height', '100%');
    }

	function js_go(str){
		$('#me').val(str);
		$('#frm').submit();
	}

</script>