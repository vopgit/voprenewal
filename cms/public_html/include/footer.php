


<?php include $_SERVER["DOCUMENT_ROOT"].'/include/popup/popup.php'; ?>


<style>
#popup_mask_layer { position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color:#000; opacity: 0.6; z-index:9998; }
#popupDiv { position: fixed; background: #fff; width: 500px; height: 500px; display: none; z-index:9999;  left: 50%; margin-left: -250px; /* half of width */ top: 50%; margin-top: -250px; /* half of height */}

#popupDiv .title {width:100%; background:#000; color:#fff; font-size:14px; padding:10px;box-sizing: border-box;}
#popupDiv .div_update_result {margin:10px; border:1px solid #eee; width:480px !important; height:400px !important;; overflow-y:scroll; word-break:break-all; padding:10px;box-sizing: border-box; line-height:150%;}
#popupDiv .popupDivBtn {width:100%; height:35px; line-height:35px; text-align:center;}
.kpf_text{color:#999; font-weight: 300; padding:1em 0 1em; font-size:0.85em}
.kpf_text img{vertical-align:bottom;}
</style>
<div class="t_center kpf_text">본 시스템은 <img src="/resource/images/common/kpf_logo.png" alt="한국언론진흥재단">의 지원을 받아 개발되었습니다.</div>
<div id="popupDiv"> 
	<div class="title" style="">
		<span id="pop_div_title">기사/오피니언 엎기를 진행중...</span>
		<span style="float:right; cursor:pointer;" class="popCloseBtn">X</span>
	</div>
	
	<iframe name="ifrm_modal" id="ifrm_modal" src="about:blank" frameborder=0 class="div_update_result"></iframe>

	<div class="popupDivBtn">
		<button class="popCloseBtn" style="cursor:pointer">닫기</button>
	</div>
</div>

<script type="text/javascript">
function js_published_all(){
	if(confirm('기사/오피니언 엎기를 진행하시겠습니까?')){
		$('body').prepend('<div id ="popup_mask_layer"></div>');
		$("#popup_mask_layer").css("display","block"); 
		$("#popupDiv").css("display","block");
		$("body").css("overflow","hidden"); //스크롤바 제거

		document.frmHiddenForIfr.action = '/publish/dml';
		document.frmHiddenForIfr.target = 'ifrm_modal';
		document.frmHiddenForIfr.submit();
	}
}

$(document).on('click','.popCloseBtn', function(){
	$("#popup_mask_layer").remove(); 

	$("#popupDiv").css("display","none"); 
	$("body").css("overflow","auto");//스크롤바 복원
});
</script>

<form name='frmHiddenForIfr' name='frmHiddenForIfr' method="POST">
	<input type="hidden" name="mode" value="make_main">
</form>

</body>
</html>
