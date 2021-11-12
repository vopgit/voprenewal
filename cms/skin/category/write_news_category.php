<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<script type="text/javascript">
	function js_write() {
		document.location.href = "write_news_kind<?=$param['query']?>";
	}

	function js_list() {
		document.location.href = "list_news_category<?=$param['query']?>";
	}

	//조회
	function js_save() {
		var frm = document.frm;
		var seq = "<?=$seq?>";
		var str_category = "";
		var chk_cnt = 0;

		if(frm.news_category_name_kor.value==""){
			alert('기사 분류명 (한글)을 입력해 주세요.');
			frm.news_category_name_kor.focus();
			return;
		}

		if(frm.news_category_name_eng.value==""){
			alert('기사 분류명 (영어)을 입력해 주세요.');
			frm.news_category_name_eng.focus();
			return;
		}

//		if(frm.news_category_name_naver.value==""){
//			alert('네이버 카테고리명을 입력해 주세요.');
//			frm.news_category_name_naver.focus();
//			return;
//		}
//
//		if(frm.news_category_name_daum.value==""){
//			alert('다움 카테고리명을 입력해 주세요.');
//			frm.news_category_name_daum.focus();
//			return;
//		}

		if(seq == ""){
			var _msg = "등록 하시겠습니까?";
		}else{
			var _msg = "수정 하시겠습니까?";
		}

		if(confirm(_msg)){
			$('#frm').attr('action', '/category/dml_NewsCategory');
			$('#frm').submit();
		}

	}

	function js_del(){
		if(confirm('삭제하시겠습니까?')){
			frm.mode.value = "Delete";
			frm.target = "";
			frm.action = "/category/dml_NewsCategory";
			frm.submit();
		}
	}

</script>


<div class="contain">

    <div class="wrap">
        <form  name="frm" id="frm" method="post">
			<input type="hidden" name="mode" id="mode" value="<?=($seq != "") ?"modify" : "insert";?>">
			<input type="hidden" name="adm_no" id="adm_no" value="<?=$_SESSION['_admin']['no']?>" >
			<input type="hidden" name="seq" id="seq" value="<?=$seq?>" >
			<input type="hidden" name="nPage" value="<?=$nPage?>">

            <h3 class="mb_15">기사 분류명 등록</h3>
            <div class="row wp_40 mb_40 ai_stretch">
                <div class="col_24">
                    <div class="area_box">
                        <div class="area_con_box">

                            <div class="row ai_stretch wp_30 wp_st_2">

								<div class="col_24">
                                    <div class="row wp_30">
                                        <div class="col_24">
                                            <label for="">기사 분류명 (한글)</label>
                                            <input type="text" name="news_category_name_kor" maxlength="30" value="<?=$rs["name"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
                                        </div>
                                    </div>
                                </div>

								<div class="col_24">
                                    <div class="row wp_30">
                                        <div class="col_24">
                                            <label for="">기사 분류명 (영어)</label>
                                            <input type="text" name="news_category_name_eng" maxlength="60" value="<?=$rs["english_name"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
                                        </div>
                                    </div>
                                </div>

								<div class="col_24">
									<div class="row wp_30">
										<div class="col_24">
											<label for="">네이버 카테고리 코드</label>
											<input type="text" name="news_category_code_naver" maxlength="50" value="<?=$rs["naver_cateory_code"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
										</div>
									</div>
								</div>

								<div class="col_24">
									<div class="row wp_30">
										<div class="col_24">
											<label for="">네이버 카테고리명</label>
											<input type="text" name="news_category_name_naver" maxlength="50" value="<?=$rs["naver_cateory"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
										</div>
									</div>
								</div>

								<div class="col_24">
									<div class="row wp_30">
										<div class="col_24">
											<label for="">다움 카테고리 코드</label>
											<input type="text" name="news_category_code_daum" maxlength="50" value="<?=$rs["daum_categery_code"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
										</div>
									</div>
								</div>

								<div class="col_24">
									<div class="row wp_30">
										<div class="col_24">
											<label for="">다움 카테고리명</label>
											<input type="text" name="news_category_name_daum" maxlength="50" value="<?=$rs["daum_categery"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
										</div>
									</div>
								</div>
                                <!--기사 분류}-->

                            </div>
                        </div>
                    </div>
                </div>
                <!--기사입력1}-->
            </div>



            <div class="row wp_20 pt_40 pb_30">
                <div class="col_">
                    <a href="javascript:;" onclick="history.back()" class="btn_lg btn_full">취소</a>
                </div>
                <div class="col_ ml_auto btn_box">
					<?if($seq != "") {?>
						<button type="button" class="btn_lg btn btn_line_c14" onclick="js_del()">삭제</button>
					<?}?>
                    <button type="button" class="btn_lg btn_c2 ml_10" onclick="js_save()"><span><?=($seq != "") ?"수정" : "등록";?></span></button>
                </div>
            </div>


        </form>
    </div>
</div>
<script>
     $(document).ready(function(){
        act_readOnly();
    })
    //common.js
    serial_drop('.serial_wrap');

    //editor.js
    editerAni.init();
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
