<?php 
$_menu_code = "0802";  //메뉴 default - config.php에 정의
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<script type="text/javascript" >
function js_list(){
	location.href = "list<?=$param['query']?>";
}

var checkId = false;

function js_save(){
	if(!checkId){
		alert('아이디를 바르게 입력하여 주세요(영문자시작 4자이상)');
		return false;
	}
	if($('#user_id').val().trim().length < 4){
		alert('아이디를 입력하여 주세요(영문자시작 4자이상)');
		//$('#user_id').focus();
		return false;
	}
	if($('#id_result').html() != '사용가능한 아이디입니다.'){
		alert('아이디를 바르게 입력하여 주세요(영문자시작 4자이상)');
		return false;
	}

	if($('#pwd').val().trim().length < 4){
		alert('비밀번호를 입력하여 주세요(4자이상)');
		$('#pwd').focus();
		return false;		
	}

	if($('#name').val().trim().length < 2){
		alert('이름을 입력하여 주세요');
		$('#name').focus();
		return false;
	}

	if($('#user_type').val() == ""){
		alert('회원종류를 선택하여 주세요');
		$('#user_type').focus();
		return false;
	}

	if(confirm("등록 하시겠습니까?")){
		$('#frm').submit();
	}
}


$(document).ready(function() {
	
	$('#user_id').on("blur", function(){
		var id = $('#user_id').val().trim();
		$('#user_id').val(id);
		var regExp = /^[a-z]+[a-z0-9]{3,20}$/g;
		if( !regExp.test(id)) {
			checkId = false;
			alert("아이디를 입력하여 주세요.\n아이디는 영문자로 시작하는 4~20자 영문자 또는 숫자이어야 합니다.");			
			return false;
		}else{
			$.ajax({
				type: 'post',
				url: '/member/id_dup_check',
				data: {'id': id},
				dataType : 'json',
				success: function(result){
					if(result.code == "error"){
						checkId = false;
						$('#id_result').css('color','#ff0000');
					}else{
						checkId = true;
						$('#id_result').css('color','#777');
					}
					$('#id_result').html(result.msg).show();
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					alert( textStatus + ", " + errorThrown );
				}
			});
		}
	});
});
</script>

<div class="contain">

<div class="wrap">
        <div class="row jc_sb mb_20">
            <h3>계정 등록</h3>
        </div>
    <form name="frm" id="frm" method="post" action="/member/dml" autocomplete="off">
	<input type="hidden" name="mode" value="new">
	<input type="hidden" name="no" id="no" value="<?=$no?>" >
	<input type="hidden" name="grp" value="<?=$grp?>">
	<input type="hidden" name="sf" value="<?=$sf?>">
	<input type="hidden" name="st" value="<?=$st?>">
	<input type="hidden" name="nPage" value="<?=$nPage?>">
        <div class="row">
            <div class="col_24">
                <div class="info_box">
                    <div class="info_wrap row">
                        <div class="col_12 pr_15 ">
                            <div class="mb_10">
								<div class="row ai_c mb_5">
                                    <div class=" col_8">
                                        <p>아이디</p>
                                    </div>

                                    <div class="col_16 t_right">
                                        <div class="row ai_c  jc_fe">
                                           <span id="id_result" class="fs_13"></span>
                                        </div>
                                    </div>
                                </div>
								<input type="text" name="user_id" id="user_id" class="inp inp_sm fm_full" maxlength="20" value="">
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">이름</p>
                                <input type="text" name="name" id="name" class="inp inp_sm fm_full" maxlength="30" value="">
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">휴대전화</p>
                                <div class="row ai_c">
                                    <input type="text" name="mobile" id="mobile" class="inp inp_sm fm_full" maxlength="30" value="">
                                </div>
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">회원종류</p>
                                <div class="sel_box col_6">
									<select name="user_type" id="user_type" class="sel fm_full  ">
										<?=getMeberTypeOption($grp)?>
									</select>
								</div>
                            </div>

                        </div>
                        <div class="col_12 pl_15">
                            <div class="mb_10">
                                <div class="row ai_c mb_5">
                                    <div class=" col_8">
                                        <p >비밀번호</p>
                                    </div>
                                </div>
                                <input type="password" name="pwd" id="pwd" class="inp inp_sm fm_full" maxlength="30">
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">이메일</p>
                                <div class="row ai_c">
                                    <div class="col_7">
                                        <input type="text" name="email1" id="email1" class="inp inp_sm fm_full" maxlength="50" value="">
                                    </div>
                                    <div class="col_2 t_center">
                                        @
                                    </div>
                                    <div class="col_7">
                                        <input type="text" name="email2" id="email2" class="inp inp_sm fm_full" maxlength="50" value="">
                                    </div>
                                    <div class="sel_box col_7 offset_1">
                                        <select class="sel fm_full" onchange="$('#email2').val(this.value);" >
                                           <option value="">직접입력</option>
										   <option value="naver.com">naver.com</option>
										   <option value="hanmail.net">hanmail.net</option>
										   <option value="gmail.com">gmail.com</option>
										   <option value="hotmail.com">hotmail.com</option>
										   <option value="nate.com">nate.com</option>
										   <option value="paran.com">paran.com</option>
                                        </select>
									</div>
                                </div>
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">일반전화</p>
                                <div class="row ai_c">
                                    <input type="text" name="phone" id="phone" class="inp inp_sm fm_full" maxlength="30" value="">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <div class=" mt_30 row">
		<div class="col_10">
			<a href="javascript:;" onclick="js_list()" class="btn_lg btn"> 목록으로</a>
		</div>
		<div class="col_12">
			<a href="javascript:;" onclick="js_save()" class="btn_lg btn_c2">등록</a>
		</div>
    </div>
</div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
