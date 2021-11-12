<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>
<script type="text/javascript">
function done(){
	if($('#title').val().trim() == ""){
		alert("박스 제목을 입력하여 주세요");
		$('#title').focus();
		return;
	}
	if($('#content').val().trim() == ""){
		alert("내용을 입력하여 주세요");
		$('#content').focus();
		return;
	}

	var data = {
  	     "title" : $('#title').val().trim(),
		 "content" : $('#content').val().trim()
		};

	parent.setEditorHtml('box', JSON.stringify(data));
	return;
}
</script>
<div class="popup_box">
    <div class="popup_wrap">
        <div class="popup_ty1 popup_con">
            <div class="popup tit_box row jc_sb ai_c">
                <span>박스</span>
                <button class="pop_close" type="button">
                    <span class="material-icons" >close</span>
                </button>
            </div>

            <form name="frm" id="frm" onsubmit="return false;">
			<div class="popup_contents">
                <div>
                    <div class="mb_10">
                        <p class="mb_10">박스 제목</p>
                        <input type="text" name="title" id="title" class="inp inp_sm fm_full" maxlength="300">
                    </div>
                    <div class="mb_10">
                        <p class="mb_10">내용</p>
                        <textarea name="content" id="content" class="ft"></textarea>
                    </div>
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