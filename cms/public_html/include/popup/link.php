<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>
<script type="text/javascript">
function done(){
	if($('#link').val().trim() == ""){
		alert("링크 URL을 입력하여 주세요");
		$('#link').focus();
		return;
	}

	var data = {
  	     "link" : $('#link').val().trim(),
		 "target" : $(":input:radio[name=target]:checked").val()
		};

	parent.setEditorHtml('link', JSON.stringify(data));
	return;
}
</script>
<div class="popup_box">
    <div class="popup_wrap">
        <div class="popup_ty1 popup_con">
            <div class="popup tit_box row jc_sb ai_c">
                <span>링크입력</span>
                <button class="pop_close" type="button">
                    <span class="material-icons" >close</span>
                </button>
            </div>
			
            <form name="frm" id="frm" onsubmit="return false;">
			<div class="popup_contents">                
				<div>
                    <div class="mb_10">
                        <p class="mb_10">링크 URL</p>
                        <input type="text" name="link" id="link" class="inp inp_sm fm_full" maxlength="300">
                    </div>
					<div class="mb_10">
                        <p class="mb_10">창열림</p>
						<label class="fm_rd ml_10 fs_13">
							<input type="radio" name="target" class="readChange" value="_self"><span class="_icon"></span>
                            <span class="fs_13"> 현재창</span>
                        </label>
						<label class="fm_rd ml_10 fs_13">
							<input type="radio" name="target" class="readChange" value="_blank" checked><span class="_icon"></span>
                            <span class="fs_13"> 새창</span>
                        </label>
                    </div>
                    <!--<div class="mb_10">
                        <p class="mb_10">텍스트</p>
                        <input type="text" class="inp inp_sm fm_full">
                    </div>-->
                </div>
				
                <div class="t_center mt_30">
                    <button class="btn_md btn_c2" onclick="done()">등록</button>
                </div>
            </div>
			</form>

        </div>

    </div>
    <span class="popbg"></span>
</div>

</body>
</html>
