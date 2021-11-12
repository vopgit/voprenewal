
<!DOCTYPE html>
<html lang="ko">
<head>
	
	<?php include_once _ROOT. '/include/mata.php'; ?>

	<link rel="icon" type="image/png" sizes="196x196" href="/resource/images/favicon-196x196.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/resource/images/favicon-16x16.png">

	<!-- font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

	<!--icon-->
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>


	<!--style -->
	<link rel="stylesheet" type="text/css" href="/resource/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/layout.css"/>

	<!--js -->
	<script  src="/resource/js/jquery-3.4.1.min.js"></script>
	<script  src="/resource/js/common.js?v=1"></script>
	<script  src="/resource/js/ui.js"></script>
</head><!--head //-->
<body>

<div class="popup mw_640">
    <div class="popup_box">
        <div class="popup_tit">
            <h1><i class="iconFt_pen mr_5"></i> 리뷰쓰기</h1>
        </div>
        <div class="popup_con">
            <form name="frmReview" id="frmReview">
				<input type="hidden" name="serial" value="<?=$_page?>">
                <div class="row wp_30">
                    <div class="col_24">
                        <div class="fm_wrap">
                            <textarea name="contents" id="contents" class="ft h_300" maxlength="2000"></textarea>
                        </div>
                    </div>

                    <div class="col_24">
                        <label class="fs_sm_13">필명(작성자 이름)</label>
                        <input type="text" name="name" id="name" class="inp fm_full mt_10" maxlength="30">
                    </div>

                    <div class="col_24">
                        <label class="fs_sm_13">이메일 주소</label>

                        <div class="row fw_nowrap fw_md_wrap wp_10 ai_c pt_10">
                            <div class="col_8 col_md_11">
                                <input type="text" name="email1" id="email1" class="inp fm_full" maxlength="50">
                            </div>

                            <span class="col_1 col_md_2 t_center fs_sm_13">@</span>
                            <div class="col_8 col_md_11">
                                <input type="text" name="email2" id="email2" class="inp fm_full" maxlength="50">
                            </div>
                            
                            <div class="col_7 col_md_24">
                                <div class="sel_box">
                                    <select class="sel fm_full" onchange="document.frmReview.email2.value=this.value">
                                        <option value="">직접입력하기</option>
										<option value="naver.com">naver.com</option>
										<option value="hanmail.com">hanmail.com</option>
										<option value="hotmail.com">hotmail.com</option>
										<option value="gmail.com">gmail.com</option>
										<option value="nate.com">nate.com</option>								        
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col_24">
                        <div class="flex ai_c mb_20">
                            <label class="fm_ch cb">
                                <input type="checkbox" name="agree" id="agree" value="y">
                                <span class="ml_10">개인정보 수집 및 이용에 관한 동의</span>
                            </label>
                            <button type="button" class="privacy_button"><i class="iconFt_round_arrow_down ml_10"></i></button>
                        </div>
                        <div class="table  mb_30 fs_14 fs_sm_12" id="privacyArea" style="display:none;">
                            <table>
                                <colgroup>
                                    <col style="width:30%">
                                    <col style="width:70%">
                                </colgroup>
                                <tr>
                                    <th>수집&bullet;이용 목적</th>
                                    <td>
                                        리뷰 작성 및 관리
                                    </td>
                                </tr>
                                <tr>
                                    <th>수집 항목</th>
                                    <td>
                                        필명, 이메일주소
                                    </td>
                                </tr>
                                <tr>
                                    <th>보유&bullet;이용 기간</th>
                                    <td>
                                        수집이용에 관한 동의일로부터 위 이용목적을 위해 보유(사용)됩니다. 다만 작성자 본인의 요청이 있는 경우를 제외하고는 리뷰 관리를 위해  지속적으로 보유(사용)할 수 있습니다.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
				</form>

                <div class="t_center mt_20">
                    <button type="button" class="btn_md btn_cb btn_review_submit"><span>작성완료</span></button>
                </div>
            
        </div>

        <div class="popup_close">
            <button type="button" class="popup_close_button"><span><i class="iconFt_close"></i></span></button>
        </div>
    </div>
</div>
<style>
    .privacy_button i{
        display:block;
        text-align:center;
    }
    .privacy_button.on i{
        transform:rotate(-180deg);
        transform-origin:center center;
    }
</style>
<script>
    $('.popup_close_button').click(function(){
        $('.popup_wrap', parent.document).hide();
        $('.mask', parent.document).hide();
        $('body', parent.document).css('overflow', 'visible');
    });
    $('.privacy_button').click(function(){
        $(this).toggleClass('on');
        $("#privacyArea").slideToggle(300);
    });

	$('.btn_review_submit').click(function(){

		if($('#contents').val().trim().length < 2){
			alert("리뷰를 입력하여 주세요");
			$('#contents').focus();
			return false;
		}
		if($('#name').val().trim().length < 2){
			alert("작성자 이름을 입력하여 주세요");
			$('#name').focus();
			return false;
		}
		if($('#email1').val().trim().length < 3){
			alert("이메일을 입력하여 주세요");
			$('#email1').focus();
			return false;
		}
		if($('#email2').val().trim().length < 5){
			alert("이메일을 입력하여 주세요");
			$('#email2').focus();
			return false;
		}
		var email = $('#email1').val().trim() + '@' + $('#email2').val().trim();
		if(!validateEmail(email)){
			alert("유효한 이메일이 아닙니다.");
			$('#email2').focus();
			return false;
		}

		if(!$('input:checkbox[name=agree]').is(':checked')){
			alert("개인정보 수집 및 이용에 관한 동의하여 주세요");
			return false;
		}

		if(confirm("리뷰를 등록하시겠습니까?")){
			$.ajax({
				type: 'post',
				url: '/news/send',
				data: $('#frmReview').serialize(),
				success: function(msg){
					if(msg == "success"){
						alert("정상적으로 등록되었습니다.\n작성하여 주신 리뷰는 편집자 확인 후 등록이 됩니다.\n소중한 리뷰작성에 감사드립니다.");
						$('.popup_close_button').click();
						location.reload();
					}else{
						alert(msg);			
					}
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert('등록이 되지 않았습니다. 잠시 후 이용하여 주세요'); 
					console.log( textStatus + ", " + errorThrown ); 
				} 
			});
		}
	});
	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}
</script>

</body>
</html>



