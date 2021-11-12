<?php
$_menu_code = '0301';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <form name="frm" id="frm" method="post" enctype="multipart/form-data">

			<input type="hidden" name="mode" value="modify">
			<input type="hidden" name="photo_id" value="<?=$photo_id?>">
			<input type="hidden" name="old_photo" id="old_photo" value="<?=$rs['file_name']?>">
			<input type="hidden" name="old_photo_m" value="<?=$rs['file_name_m']?>">
			<input type="hidden" name="old_tags" value="<?=$rs['tags']?>">
			<input type="hidden" name="old_tags_str" value="<?=$rs['tag_str']?>">

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
                                        <img src="<?=$rs['photo']?>" alt="" onerror="this.src.value='/resource/images/no_image.jpg'">
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
										 <img src="<?=$rs['photo_m']?>" alt="" onerror="this.src.value='/resource/images/no_image.jpg'">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file"  name="userfile_m" id="userfile_m" class="attach" accept=".jpeg, .jpg, .gif, .png">
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>

										<?php if($rs['file_name_m'] != ''){ ?>
										<div class="modify_chk_box">
											<label class="fm_ch">
												<input type="checkbox" name="photo_m_del" value="Y">
												<span class="_icon"></span>
                                                삭제시 체크하세요
											</label>
										</div>
										<?php } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col_14">
                                <div class="row poto_con border_left">
                                    <div class="col_12 pr_15">
                                        <div class="mb_10">
                                            <p class="mb_10">제목</p>
                                            <input type="text" name="title" id="title" class="inp inp_sm fm_full" maxlength="250" value="<?=$rs['title']?>">
                                        </div>
                                        <div class="mb_15 tc_b4">
                                            <p class="mb_10">저작권자</p>
                                            <label class="fm_rd ">
                                                <input type="radio" name="writer" id="writer" value="" <?=($copyright == "") ? "checked" :"";?>>
                                                <span class="fs_13">민중의소리 (워터마크 표시)</span>
                                            </label>

                                            <label class="fm_rd ml_10 fs_13">
                                                <input type="radio" name="writer" id="writer" value="etc" class="readChange" <?=($copyright != "") ? "checked" :"";?>>
                                                <span class="fs_13"> 기타 (워터마크 없음)</span>
                                            </label>
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">작성자</p>
                                            <input type="text" name="contributor" id="contributor" class="inp inp_sm fm_full" value="<?=$rs['contributor']?>">
                                            <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                        </div>
                                    </div>
                                    <div class="col_12 pl_15">
                                        <div class="mb_10">
                                            <p class="mb_10">설명</p>
                                            <input type="text" name="description" id="description" class="inp inp_sm fm_full" maxlength="255" value="<?=$rs['description']?>">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">&nbsp;</p>
                                            <input type="text" name="copyright" id="copyright" class="inp inp_sm fm_full read_only act_read" <?=($copyright == "") ? "readonly" :"";?>  maxlength="100" value="<?=$rs['copyright']?>">
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">태그</p>
                                            <input type="text" name="tags" id="tags" class="inp inp_sm fm_full" maxlength="255" value="<?=$rs['tag_str']?>">
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
            </div>

            <div class="row wp_20 pb_30">
                <div class="col_">
                    <a href="javascript:;" class="btn_lg " onclick="js_list()">목록으로</a> &nbsp;
					<a href="javascript:;" class="btn_lg " onclick="js_list()">삭제</a>
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

	$(document).on('click', '.btn_submit', function(){

		if($('#old_photo').val() == ""){
			if($('#userfile_p').val() == ""){
				alert('사진을 선택하여 주세요');
				$('#userfile_p').parent().find('.btn').click();
				return false;
			}
		}

		if($('#title').val() == ""){
			alert('제목을 입력하여 주세요');
			$('#title').focus();
			return false;
		}

		if($("input:radio[name=writer]:checked").val() == 'etc'){
			alert('저작권자를 입력하여 주세요');
			$('#copyright').focus();
			return false;
		}

		if(confirm('수정하시겠습니까?')){
			$('#frm').attr('action','/photo/dml');
			$('#frm').submit();
		}

	});

	function js_list(){
		location.href = "/photo/list<?=$param['query']?>";
	}

</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
