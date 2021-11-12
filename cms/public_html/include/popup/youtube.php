<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>
<script type="text/javascript">
function done(){
	if($('#id').val().trim() == ""){
		alert("유튜브 URL을 입력하여 주세요");
		$('#id').focus();
		return;
	}

	var data = {
  	     "id" : $('#id').val().trim(),
		 "title" : $('#title').val().trim()
		};

	parent.setEditorHtml('youtube', JSON.stringify(data));
	return;
}
</script>
<div class="popup_box">
    <div class="popup_wrap">
        <div class="popup_ty1 popup_con">
            <div class="popup tit_box row jc_sb ai_c">
                <span>유튜브</span>
                <button class="pop_close">
                    <span class="material-icons" >close</span>
                </button>
            </div>

            <form name="frm" id="frm" onsubmit="return false;">
			<div class="popup_contents">
                <div>
                    <div class="mb_10">
                        <p class="mb_10">유튜브 URL</p>

                    </div>
                    <div class="row wp_5 fw_nowrap">
                        <div class="col_">
                            <span>https://www.youtube.com/watch?v=</span>
                        </div>
                        <div class="col_8">
                            <input type="text" name="id" id="id" class="inp inp_sm fm_full" placeholder=""  maxlength="20">
                        </div>
                    </div>
                    <div class="mt_5">
                        <p class="mb_10">설명</p>
						<input type="text" name="title" id="title" class="inp inp_sm fm_full" placeholder="미 입력시 출력되지 않습니다."  maxlength="300">
                    </div>

                </div>
                <div class="t_center mt_30">
                    <button class="btn_md btn_c2" onclick="done()">등록</button>
                </div>
            </div>
			</form>

        </div>

    </div>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
