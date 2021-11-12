<?php 
$_menu_code = "0801";  //메뉴 default - config.php에 정의
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<script type="text/javascript" >
function js_list(){
	location.href = "list<?=$param['query']?>";
}

function js_delete(){
	if(confirm("삭제 하시겠습니까?")){
		document.frm.mode.value = "del";
		$('#frm').submit();
	}	
}

/*
function chagePwdInput(){
	if($('#passwd_chk').is(':checked') == true) $('#passwd').show();
	else $('#passwd').hide();
}
*/

function js_save(){	

	if($(':checkbox[name=chgPwd]').is(':checked')){
		if($('#pwd').val().trim().length < 4){
			alert('비밀번호를 입력하여 주세요(4자이상)');
			$('#pwd').focus();
			return false;		
		}
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

	if(confirm("수정하시겠습니까?")){
		$('#frm').submit();
	}
}


$(document).ready(function() {
	$('.ps_ch input').change(function(){
		$(this).is(':checked') ?  
		$('.remove_only').removeClass('read_only').removeAttr('readonly') : 
		$('.remove_only').addClass('read_only').attr('readonly',true) ;
	})
	
});
</script>

<div class="contain">

<div class="wrap">
        <div class="row jc_sb mb_20">
            <h3>계정 정보</h3>
        </div>
    <form name="frm" id="frm" method="post" action="/member/dml" autocomplete="off">
	<input type="hidden" name="mode" value="mod">
	<input type="hidden" name="no" id="no" value="<?=$rs['id']?>" >
	<input type="hidden" name="params" value="<?=urlencode($param['query'])?>">
        <div class="row">
            <div class="col_15"> 
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
								<input type="text" name="user_id" id="user_id" class="inp inp_sm fm_full" maxlength="30" value="<?=$rs['user_id']?>" readonly style="background:#f6f6f6">
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">이름</p>
                                <input type="text" name="name" id="name" class="inp inp_sm fm_full" maxlength="30" value="<?=$rs['name']?>">
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">휴대전화</p>
                                <div class="row ai_c">
                                    <input type="text" name="mobile" id="mobile" class="inp inp_sm fm_full" maxlength="30" value="<?=$rs['mobile']?>">
                                </div>
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">회원종류</p>
                                <div class="sel_box col_6">
									<select name="user_type" id="user_type" class="sel fm_full  ">
										<?=getMeberTypeOption($rs['user_type'])?>
									</select>
								</div>
                            </div>
                            <div >
                                <p class="mb_10">최근 회원정보 수정 일시</p>
                                <div class="txt_inp _sm fm_full">
                                    <p><?=$rs['update_time']?></p>
                                 </div>
                            </div>
                        </div>
                        <div class="col_12 pl_15">
                            <div class="mb_10">
                                <div class="row ai_c mb_5">
                                    <div class=" col_8">
                                        <p >비밀번호</p>
                                    </div>                                  
                                    
									<div class="col_16 t_right">
                                        <div class="row ai_c  jc_fe">
                                           <span class="fs_13">  *비밀번호 변경 시 체크해 주세요.</span>
                                            <label class="fm_ch ml_5 mb_5 ps_ch">
                                                <input name="chgPwd" type="checkbox" title="비밀번호 변경" value="Y">
                                            </label>
                                        </div>
                                    </div>
                                </div>
								<input type="password" name="pwd" id="pwd" class="inp inp_sm fm_full read_only remove_only" maxlength="30" readonly="readonly">

                            </div>
                            <div class="mb_10">
                                <p class="mb_10">이메일</p>
                                <div class="row ai_c">
                                    <div class="col_7">
                                        <input type="text" name="email1" id="email1" class="inp inp_sm fm_full" maxlength="50" value="<?=$rs['email1']?>">
                                    </div>
                                    <div class="col_2 t_center">
                                        @
                                    </div>
                                    <div class="col_7">
                                        <input type="text" name="email2" id="email2" class="inp inp_sm fm_full" maxlength="50" value="<?=$rs['email2']?>">
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
                                    <input type="text" name="phone" id="phone" class="inp inp_sm fm_full" maxlength="30" value="<?=$rs['phone']?>">
                                </div>
                            </div>
                            <div class="mb_10">
                                <p class="mb_10">가입일시</p>
                                <div class="txt_inp _sm fm_full">
                                     <p><?=$rs['regist_time']?></p>
                                 </div>
                            </div>
                            <div >
                                <p class="mb_10">최근 로그일 일시</p>
                                <div class="txt_inp _sm fm_full">
                                    <p><?=$rs['last_login']?></p>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col_9 pl_40"> 
                <div class="row info_right">
                    <div class="info_box mb_40">
                        <p class=" fs_16 mb_20">내 기사</p>
                        <div class="row row wp_10">
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c1">
                                            <p class="sta_c2">작성중</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['article']['tempstored'])?></p>
                                        </div>
                                    </div>
                                </a>
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c2">
                                            <p class="sta_c1">대기중</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['article']['standby'])?></p>
                                        </div>
                                    </div>
                                </a>
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c3">
                                            <p class="sta_c3 ">발행중</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['article']['published'])?></p>
                                        </div>
                                    </div>
                                </a>
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c4">
                                            <p >삭제됨</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['article']['deleted'])?></p>
                                        </div>
                                    </div>
                                </a>
                        </div>
                    </div>
                    <div class="info_box">
                        <p class=" fs_16 mb_20">내 사진</p>
                        <div class="row row wp_10">
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c3">
                                            <p class="sta_c3 ">발행중</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['image']['published'])?></p>
                                        </div>
                                    </div>
                                </a>
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c5">
                                            <p class="sta_c5 ">보류중</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['image']['reserved1'] + $mypost['image']['reserved2'])?></p>
                                        </div>
                                    </div>
                                </a>
                            
                            <div class="col_6 plr_10">
                                <a href="">
                                    <div class="t_center stabox stabox_c4">
                                            <p >삭제됨</p>
                                            <p class="fs_24 fw_600"><?=number_format($mypost['image']['deleted'])?></p>
                                        </div>
                                    </div>
                                </a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </form>
    <div class=" mt_30 row jc_sb">
        <a href="javascript:;" onclick="js_list()" class="btn_lg btn"> 목록으로</a>
        <a href="javascript:;" onclick="js_save()" class="btn_lg btn_c2">정보 수정 완료</a>
        <a href="javascript:;" onclick="js_delete()" class="btn_lg btn_c2 btn_line_c14"> 계정 삭제</a>
    </div>
</div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>