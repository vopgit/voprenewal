<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>


<form name="frmLogin" id="frmLogin" method="post">
	<input type="hidden" name="mode" value="login">
	<input type="hidden" name="rtnUrl" value="<?=($_GET['rtnUrl'] != '') ? urlencode($_GET['rtnUrl']) : '/';?>">
	<div class="wrap">
		<div class="login_con">
			<h1>
				<img src="/resource/images/logo_ty2.png" alt="민중의소리">
			</h1>
			
			<div class="login_box">
				<div class="login_txt">
					<p class="fs_30 fw_600">로그인</p>
					<!-- <p class="fs_16 mt_10 tc_b4">민중의소리 관리자 홈페이지 입니다.</p> -->
				</div>
				<div class="login_inp mt_15">

					<?if(($_SERVER["REMOTE_ADDR"] == "121.190.224.191")||($_SERVER["REMOTE_ADDR"]=="115.68.226.250")||($_SERVER["REMOTE_ADDR"]=="211.226.94.41")){?>
						<div class="mt_10"><input type="text" name="vop_id" id="vop_id" class="inp fm_full" maxlength="20" placeholder="아이디" required value="chohm0113"></div>
						<div class="mt_10"><input type="password" name="vop_pwd" id="vop_pwd" class="inp fm_full" maxlength="20" placeholder="비밀번호"  required value="temp@1234"></div>
					<?}else{?>
						<div class="mt_10"><input type="text" name="vop_id" id="vop_id" class="inp fm_full" maxlength="20" placeholder="아이디" required value=""></div>
						<div class="mt_10"><input type="password" name="vop_pwd" id="vop_pwd" class="inp fm_full" maxlength="20" placeholder="비밀번호"  required value=""></div>
					<?}?>

				</div>
			</div>
			
			<div class="btn_box ">
				<button class="btn btn_full btn_lg btn_c2">로그인</button>
			</div>
		</div>
	</div>

	
</form>
<script>
$("#frmLogin").on("submit", function() {
	
	$('#vop_id').val($('#vop_id').val().trim().replace(/\s/g, ''));
	$('#vop_pwd').val($('#vop_pwd').val().trim().replace(/\s/g, ''));
		
	if($('#vop_id').val().length < 4){
		alert("아이디를 입력하여 주세요.(4자이상)");
		$('#vop_id').focus();
		return false;
	}

	if($('#vop_pwd').val().length < 4){
		alert("비밀번호를 입력하여 주세요.(4자이상)");
		$('#vop_pwd').focus();
		return false;
	}
	
	///member/loginCheck<br>{"code":"success","msg":"\uc131\uacf5"}

	$.ajax({
		type: 'post',
		url: '/member/loginCheck',
		data: $('#frmLogin').serialize(),		
		success: function(result){
			console.log(result);
			if(result.code == "success") location.replace('/');
			else alert(result.msg);
		},
		error: function( jqXHR, textStatus, errorThrown ) { 
			alert( textStatus + ", " + errorThrown ); 
		} 
	});	

	return false;	
});
</script>
