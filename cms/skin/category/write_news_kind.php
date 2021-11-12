<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<script type="text/javascript">
	function js_write() {
		document.location.href = "write_news_kind<?=$param['query']?>";
	}

	function js_list() {
		document.location.href = "list_news_kind<?=$param['query']?>";
	}

	//조회
	function js_save() {
		var frm = document.frm;
		var seq = "<?=$seq?>";
		var str_category = "";
		var chk_cnt = 0;

		if(frm.news_kind_name.value==""){
			alert('기사종류명을 입력해 주세요.');
			frm.news_kind_name.focus();
			return;
		}

		$("input[name=category]:checked").each(function(){
			chk_cnt ++;
			str_category = str_category+"|"+$(this).val();
		})

		if(chk_cnt <= 0){
			alert('기사분류를 최소 한개 이상 선택해 주세요.');
			frm.category.focus();
			return;
		}

		$("#str_category").val(str_category.substring(1));


		if(seq == ""){
			var _msg = "등록 하시겠습니까?";
		}else{
			var _msg = "수정 하시겠습니까?";
		}

		if(confirm(_msg)){
			$('#frm').attr('action', '/category/dml_NewsKind');
			$('#frm').submit();
		}

	}

	function js_del(){
		if(confirm('삭제하시겠습니까?')){
			frm.mode.value = "Delete";
			frm.target = "";
			frm.action = "/category/dml_NewsKind";
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

            <h3 class="mb_15">기사 종류명 등록</h3>
            <div class="row wp_40 mb_40 ai_stretch">
                <div class="col_24">
                    <div class="area_box">
                        <div class="area_con_box">

                            <div class="row ai_stretch wp_30 wp_st_2">

								<div class="col_24">
                                    <div class="row wp_30">
                                        <div class="col_24">
                                            <label for="">기사 종류명</label>
                                            <input type="text" name="news_kind_name" maxlength="30" value="<?=$rs["name"]?>" class="inp inp_sm fm_full mt_10 mb_20" >
                                        </div>
                                    </div>
                                </div>
                                <!--제목, 작성자, 부제/설명 }-->


                                <div class="col_24">
                                    <label for="">기사 분류</label>
									<div class="mt_10 row flex fw_wrap">
										<?
										for ($j = 0 ; $j < count($rs_cateory); $j++) {
											?>
											<label class="fm_ch col_4">
												<input type="checkbox" name="category" value="<?=$rs_cateory[$j]['id']?>" <?=(in_array($rs_cateory[$j]['id'], $arr_category))?"checked":"";?>>
												<span class="fs_13 tc_b4 ">  <?=$rs_cateory[$j]['name']?></span>
											</label>
											<?
										}
										?>
										<input type="hidden" name="str_category" id="str_category" value="">
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
