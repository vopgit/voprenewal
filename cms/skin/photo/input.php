<?php
$_menu_code = '0301';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <form name="frm" id="frm" method="post" enctype="multipart/form-data">

			<input type="hidden" name="mode" id="mode" value="<?=($photo_id == "")? "new" : "modify";?>">
			<input type="hidden" name="photo_id" id="photo_id" value="<?=$photo_id?>">
			
            <h3 class="mb_15">사진 입력</h3>

            <div class="row wp_40 mb_40 act_clone">

                <div class="col_24">
                    <div class=" poto_box" >
                        <div class="row">
                            <div class="col_5 ">
                                <div class="poto_con ">
                                    <div class="t_left row">
                                        <span class="fs_14">PC</span>
                                    </div>
                                    <div class="add_img mt_15" >
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" name="userfile_p[]" id="userfile_p[]" class="attach" accept=".jpeg, .jpg, .gif, .png">
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
                                            <input type="file"  name="userfile_m[]" id="userfile_m[]" class="attach" accept=".jpeg, .jpg, .gif, .png">
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
                                            <input type="text" name="title[]" id="title[]" class="inp inp_sm fm_full" maxlength="250">
                                        </div>
                                        <div class="mb_15 tc_b4">
                                            <p class="mb_10">저작권자</p>
                                            <label class="fm_rd ">
                                                <input type="radio" name="writer_0" id="writer" value="" checked>
                                                <span class="fs_13">민중의소리 (워터마크 표시)</span>
                                            </label>

                                            <label class="fm_rd ml_10 fs_13">
                                                <input type="radio" name="writer_0" id="writer" value="etc" class="readChange">
                                                <span class="fs_13"> 기타 (워터마크 없음)</span>
                                            </label>
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">작성자</p>
                                            <input type="text" name="contributor[]" id="contributor[]" class="inp inp_sm fm_full">
                                            <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                        </div>
                                    </div>
                                    <div class="col_12 pl_15">
                                        <div class="mb_10">
                                            <p class="mb_10">설명</p>
                                            <input type="text" name="description[]" id="description[]" class="inp inp_sm fm_full" maxlength="255">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">&nbsp;</p>
                                            <input type="text" name="copyright[]" id="copyright[]" class="inp inp_sm fm_full read_only act_read" readonly  maxlength="100">
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">태그</p>
                                            <input type="text" name="tags[]" id="tags[]" class="inp inp_sm fm_full" maxlength="255">
                                        </div>
                                    </div>

                                    <div class="col_12 pr_15">
                                        <div class="mb_10">
                                            <p class="">기타</p>
                                            <label class="fm_ch ">
  											  <input type="hidden" name="photo_news[]" value="N">
                                              <input type="checkbox" id="chk_news" value="Y" title="">
                                              <span class="fs_13 tc_b4 ">  포토뉴스 동시 입력</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col_12">
                    <p class="tc_b4 fs_13 "> * (PC/MOBILE)  800x470 사이즈 권장</p>
                 </div>
                 <div class="col_12 t_right">
                    <button type="button" class="btn_lg btn_c2" onclick="act_clone(this,'.act_clone');"><span> 사진 추가</span></button>
                    <button type="button" class="btn btn_lg btn_line_c14 ml_20 elRemove_btn" onclick="act_elRemove(this,'.act_clone')" style="display:none;"><span> 사진 삭제</span></button>
                </div>
            </div>




            <div class="row wp_20 pt_40 pb_30">
                <div class="col_">
                    <a href="javascript:;" class="btn_lg btn_full" onclick="js_list()">목록으로</a>
                </div>
                <div class="col_ ml_auto">
                    <button type="button" class="btn_lg btn_c2 btn_full btn_submit"><span>사진 입력 완료</span></button>
                </div>

            </div>
            <!--기사종류 : 포토뉴스 : 사진입력 }-->
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        act_readOnly();
    })
    var num = 1;

    function act_clone(el,clone){

		if(num >= 5){
			alert(num +'개까지 등록하실 수 있습니다');
			return false;
		}

     var el_clone = '<div class="row wp_40 mb_40 act_clone">'
                    +'<div class="col_24">'
                    +'    <div class=" poto_box" >'
                    +'        <div class="row">'
                    +'            <div class="col_5 ">'
                    +'                <div class="poto_con ">'
                    +'                    <div class="t_left row">'
                    +'                        <span class="fs_14">PC</span>'
                    +'                    </div>'
                    +'                    <div class="add_img mt_15" >'
                    +'                        <img src="/resource/images/no_image.jpg" alt="">'
                    +'                    </div>'
                    +'                    <div class="file_box fm_full">'
                    +'                        <div class="file_con ">'
                    +'                            <input type="file" name="userfile_p[]" id="userfile_p[]" class="attach" accept=".jpeg, .jpg, .gif, .png">'
                    +'                            <a class="btn file">파일선택</a>'
                    +'                            <span class="file_name "></span>'
                    +'                        </div>'
                    +'                    </div>'
                    +'                </div>'
                    +'            </div>'
                    +'            <div class="col_5 border_left">'
                    +'                <div class="poto_con">'
                    +'                    <div class=" row jc_sb">'
                    +'                        <span class="fs_14">MOBILE</span>'
                    +'                        <p class="fs_13 tc_b4">'
                    +'                            * 모바일 해상도에서 <BR>'
                    +'                            자동 교체되는 이미지'
                    +'                        </p>'
                    +'                    </div>'
                    +'                    <div class="add_img">'
                    +'                        <img src="/resource/images/no_image.jpg" alt="">'
                    +'                    </div>'
                    +'                    <div class="file_box fm_full">'
                    +'                        <div class="file_con ">'
                    +'                            <input type="file"  name="userfile_m[]" id="userfile_m[]" class="attach" accept=".jpeg, .jpg, .gif, .png">'
                    +'                            <a class="btn file">파일선택</a>'
                    +'                            <span class="file_name "></span>'
                    +'                        </div>'
                    +'                    </div>'
                    +'                </div>'
                    +'            </div>'
                    +'            <div class="col_14">'
                    +'                <div class="row poto_con border_left">'
                    +'                    <div class="col_12 pr_15">'
                    +'                        <div class="mb_10">'
                    +'                            <p class="mb_10">제목</p>'
                    +'                            <input type="text" name="title[]" id="title[]" class="inp inp_sm fm_full" maxlength="250">'
                    +'                        </div>'
                    +'                        <div class="mb_15 tc_b4">'
                    +'                            <p class="mb_10">저작권자</p>'
                    +'                            <label class="fm_rd ">'
                    +'                              <input type="radio" name="writer_'+num+'" id="writer" value="" checked>'
                    +'<span class="_icon"></span>'
                    +'                                <span class="fs_13">민중의소리 (워터마크 표시)</span>'
                    +'                            </label>'
                    +'                            <label class="fm_rd ml_10 fs_13">'
                    +'                                <input type="radio" name="writer_'+num+'" id="writer" value="etc" class="readChange">'
                    +'<span class="_icon"></span>'
                    +'                                <span class="fs_13 " > 기타 (워터마크 없음)</span>'
                    +'                            </label>'
                    +'                        </div>'
                    +'                        <div class="mb_10">'
                    +'                            <p class="mb_10">작성자</p>'
                    +'                            <input type="text" name="contributor[]" id="contributor[]" class="inp inp_sm fm_full">'
                    +'                            <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>'
                    +'                        </div>'
                    +'                    </div>'
                    +'                    <div class="col_12 pl_15">'
                    +'                        <div class="mb_10">'
                    +'                            <p class="mb_10">설명</p>'
                    +'                            <input type="text" name="description[]" id="description[]" class="inp inp_sm fm_full" maxlength="255">'
                    +'                        </div>'
                    +'                        <div class="mb_10 tc_b4">'
                    +'                            <p class="mb_10">&nbsp;</p>'
                    +'                            <input type="text" name="copyright[]" id="copyright[]" class="inp inp_sm fm_full read_only act_read" readonly  maxlength="100">'
                    +'                        </div>'
                    +'                        <div class="mb_10">'
                    +'                            <p class="mb_10">태그</p>'
                    +'                            <input type="text" name="tags[]" id="tags[]" class="inp inp_sm fm_full" maxlength="255">'
                    +'                        </div>'
                    +'                    </div>'
                    +'                    <div class="col_12 pr_15">'
                    +'                        <div class="mb_10">'
                    +'                            <p class="">기타</p>'
                    +'                            <label class="fm_ch ">'
					+'								   <input type="hidden" name="photo_news[]" value="N">'
					+'								   <input type="checkbox" id="chk_news" value="Y" title="">'
                    +'                                <span class="_icon"></span>'
                    +'                            <span class="fs_13 tc_b4 ">  포토뉴스 동시 입력</span>'
                    +'                            </label>'
                    +'                        </div>'
                    +'                    </div>'
                    +'                </div>'
                    +'            </div>'
                    +'        </div>'
                    +'    </div>'
                    +'</div>'
                    +'<div class="col_12">'
                    +'    <p class="tc_b4 fs_13 "> * (PC/MOBILE)  800x470 사이즈 권장</p>'
                    +'</div>'
                    +'<div class="col_12 t_right">'
                    +'    <button type="button" class="btn_lg btn_c2" onclick="act_clone(this,\'.act_clone\');"><span> 사진 추가</span></button>'
                    +'    <button type="button" class="btn btn_lg btn_line_c14 ml_20 elRemove_btn" onclick="act_elRemove(this,\'.act_clone\')" style="display:none;"><span> 사진 삭제</span></button>'
                    +'</div>'
                    +'</div>';

        // var el_clone =   $(el).closest(clone).clone();
        $(el).closest(clone).after(el_clone);
        act_file.init();
        act_readOnly();
        if(num >= 0){
            $('.elRemove_btn').show();
            $('.elRemove_btn').eq(0).hide();
        }
        num ++;
    }

    function act_elRemove(el,clone){
        var el_clone =   $(el).closest(clone).remove();
        if(num <= 0){
            $('.elRemove_btn').hide();
        }
        //num --;
    }

	//저작권자 민중의소리 선택시 저작권 내용 초기화 <- 배열로 넘어가지 않음
	$(document).on('click', '#writer', function(){
		if($(this).val() == ""){
			$(this).closest('.act_clone').find("input[name='copyright[]']").val('');
		}
	});

	$(document).on('click', '#chk_news', function(){
		if($(this).is(':checked')) $(this).parent().find("input[name='photo_news[]']").val('Y');
		else $(this).parent().find("input[name='photo_news[]']").val('N');
	});

	$(document).on('click', '.btn_submit', function(){
		
		var str = "";
		var err = 0;

		$('.act_clone').each(function(){			
			
			if($(this).find("input[name='userfile_p[]']").val().trim() == ""){
				alert('사진을 선택하여 주세요');
				$(this).find("input[name='userfile_p[]']").parent().find('.btn').click();
				err++;
				return false;
			}

			if($(this).find("input[name='title[]']").val().trim() == ""){
				alert('제목을 입력하여 주세요');
				$(this).find("input[name='title[]']").focus();
				err++;
				return false;
			}

			//저작권자 - 기타 선택시
			if($(this).find("input[name^=writer_]:checked").val() == 'etc'){
				if($(this).find("input[name='copyright[]']").val().trim() == ""){
					alert('저작권자를 입력하여 주세요');
					$(this).find("input[name='copyright[]']").focus();
					err++;
					return false;
				}
			}

		});
		
		if(err > 0) return false;

		
		if(confirm('등록하시겠습니까?')){
			$('#frm').attr('action','/photo/dml');
			$('#frm').submit();				
		}	
		
	});

	function js_list(){
		location.href = "/photo/list<?=$param['query']?>";
	}

</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
