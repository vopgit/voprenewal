/* form validate */
function formValidate(form){
	var errCnt = 0;
	var targetForm = $("#"+form+" .required");
	$.each(targetForm, function(index, value){        

		var thisType = $(this).prop("type");  //select = select-one
		var thisName = $(this).attr("name");
		var thisId = $(this).attr("id");
		var thisTitle = $(this).attr("title");
		var thisMin  = $(this).attr("minlength");
		var thisData  = $(this).attr("data");
		if(thisMin == undefined || parseInt(thisMin) < 1 ) thisMin = 1;

		if($(this).css('display') != "none"){

			if(thisType == "radio"){
				
				if($(':radio[name="'+ thisName +'"]:checked').length < 1){
					alert(thisTitle);
					//$(this).closest('div').append('<p class="fm_error">'+thisTitle+'</p>');
					errCnt++;
					return false;
				}
				
			}else if(thisType == "checkbox"){

				if($(':checkbox[name="'+ thisName +'"]:checked').length < thisMin){
					if(thisMin > 1) alert(thisTitle);
					else alert(thisTitle);
					//$(this).closest('div').append('<p class="fm_error">'+thisTitle+'</p>');					
					errCnt++;
					return false;
				}

			}else if(thisType == "select-one"){
			
				if($(this).val() == ""){
					//alert(thisTitle + "을(를) 선택해 주세요");
					$(this).closest('div').append('<p class="fm_error">'+thisTitle+'</p>');				
					$(this).focus();
					errCnt++;
					return false;
				}
			
			}else if(thisType != "button" && thisType != "submit"){
				
				var str = $(this).val().trim();
				$(this).val(str);

				if(str.replace(/(\s*)/g, "") == "") {
					//alert(thisTitle + "을(를) 입력해 주세요");
					$(this).closest('div').append('<p class="fm_error">'+thisTitle+'</p>');
					$(this).focus();
					errCnt++;
					return false;		
				}

				if(thisMin > 1){
					if(str.length < thisMin){
						//alert(thisTitle + "을(를) "+thisMin+"자 이상 입력해 주세요");
						$(this).closest('div').append('<p class="fm_error">'+thisMin+'자 이상 입력해 주세요</p>');
						$(this).focus();
						errCnt++;
						return false;	
					}
				}

				//데이터타입 검증
				if($(this).hasClass('id')){ //아이디(영문+숫자)
					var regExp = /^[a-z]+[a-z0-9]{4,20}$/g;
					if( !regExp.test(str) ) {
						//alert("아이디는 영소문자로 시작하는 4~20자 영소문자 또는 숫자이어야 합니다.");
						$(this).closest('div').append('<p class="fm_error">아이디는 영소문자로 시작하는 4~20자 영소문자 또는 숫자이어야 합니다</p>');
						$(this).focus();
						errCnt++;
						return false;
					}
				}

				if($(this).hasClass('pass')){ //비밀번호
					//특수문자는 "!, @, #, $, %, ^, &, *"
					var regExp =  /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*^#&])[A-Za-z\d$@$!%*^#&]{8,}$/i;
					if( !regExp.test(str) ){
						//alert("유효하지 않은 비밀번호 입니다.\n비밀번호는 6~20자내 숫자, 영문, 특수문자(@,$,!,%,*,^,#,&,)를 포함해야 합니다.");
						$(this).closest('div').append('<p class="fm_error">유효하지 않은 비밀번호 입니다</p>');
						$(this).focus();
						errCnt++;
						return false;
					}
				}

				if($(this).hasClass('pass-confirm')){ //비밀번호
					if($(this).val() != $('#'+thisData).val()){
						//alert("비밀번호가 일치하지 않습니다.");
						$(this).closest('div').append('<p class="fm_error">비밀번호가 일치하지 않습니다</p>');
						$(this).focus();
						errCnt++;
						return false;
					}					
				}


				if($(this).hasClass('tel')){ //전화번호(숫자+하이픈)
					var regExp =  /^[0-9-]+$/;
					if( !regExp.test(str) ){
						//alert("숫자와 하이픈(-)만 입력가능합니다");
						$(this).closest('div').append('<p class="fm_error">숫자와 하이픈(-)만 입력가능합니다</p>');
						$(this).focus();
						errCnt++;
						return false;		
					}
				}

				if($(this).hasClass('email')){ //이메일 일체형
					var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
					if(!regExp.test(str)){
						//alert("유효하지 않은 이메일입니다. 이메일을 확인하여 주세요");
						$(this).closest('div').append('<p class="fm_error">유효하지 않은 이메일입니다. 이메일을 확인하여 주세요</p>');
						$(this).focus();
						errCnt++;
						return false;
					}
				}


				if($(this).hasClass('checkEmail')){ //이메일 분리형

					var em = thisData.split('|');
					var email = $('#'+em[0]).val() + "@" + $('#'+em[1]).val();				
					
					var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
					if(!regExp.test(email)){
						//alert("유효하지 않은 이메일입니다. 이메일을 확인하여 주세요");
						$(this).closest('div').append('<p class="fm_error">유효하지 않은 이메일입니다.'+email+' 이메일을 확인하여 주세요</p>');
						$(this).focus();
						errCnt++;
						return false;
					}
				}

				if($(this).hasClass('checkJumin')){ //주민번호
					
					var em = thisData.split('|');

					var ssn = $('#'+em[0]).val() +''+  $('#'+em[1]).val(), 
						sum = 0,
						compare = [2,3,4,5,6,7,8,9,2,3,4,5],
						arr_ssn = [];
					if(ssn.length != 13) return false;
					for (var i = 0; i<13; i++){ 
						arr_ssn[i] = ssn.substring(i,i+1); 
					}
					for (var i = 0; i<12; i++){
						sum = sum + (arr_ssn[i] * compare[i]); 
					}
					sum = (11 - (sum % 11)) % 10;
					if (sum != arr_ssn[12]){
						//alert("유효하지 않은 주민등록번호 입니다.");
						$(this).closest('div').append('<p class="fm_error">유효하지 않은 주민등록번호 입니다.</p>');
						$(this).focus();
						errCnt++;
						return false;
					}
				}

				if($(this).hasClass('num')){ //숫자
					// var regExp = /^[0-9]+$/
					if(isNaN($(this).val())){  
						//alert("숫자만 입력가능합니다");
						$(this).closest('div').append('<p class="fm_error">숫자만 입력가능합니다</p>');
						$(this).focus();
						errCnt++;
						return false;	
					}
				}

				if($(this).hasClass('han')){ //한글
					var regExp =  /^[가-힣]+$/;
					if( !regExp.test(str) ){
						//alert("한글만 입력가능합니다.");
						$(this).closest('div').append('<p class="fm_error">한글만 입력가능합니다</p>');
						$(this).focus();
						errCnt++;
						return false;		
					}
				}

				if($(this).hasClass('alpha')){ //영문					
					var regExp =  /^[a-zA-Z\s]+$/;
					if( !regExp.test(str) ){
						//alert("영문만 입력가능합니다");
						$(this).closest('div').append('<p class="fm_error">영문만 입력가능합니다</p>');
						$(this).focus();
						errCnt++;
						return false;		
					}
				}

				if($(this).hasClass('alpha_num')){ //영문+숫자					
					var regExp =  /^[a-zA-Z0-9]+$/;;
					if( !regExp.test(str) ){
						//alert("영문 또는 숫자만 입력가능합니다");
						$(this).closest('div').append('<p class="fm_error">영문 또는 숫자만 입력가능합니다</p>');
						$(this).focus();
						errCnt++;
						return false;		
					}
				}

			}
		}
    });

	if(errCnt == 0) return true;
	else return false;
}