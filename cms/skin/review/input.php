<?php
$_menu_code = '0401';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <form name="frm" id="frm" method="post">
			<input type="hidden" name="mode" id="mode" class="inp inp_sm fm_full"  value="<?=($rs['id'] == '') ? 'INSERT_REVIEW' : 'MODIFY_REVIEW'; ?>">
			<input type="hidden" name="review_id" id="review_id" class="inp inp_sm fm_full"  value="<?=$rs['id']?>">
			<input type="hidden" name="n_status" value="<?=$rs['status']?>">
			<!--<input type="hidden" name="related" id="related" class="inp inp_sm fm_full"  value="<?=$rs['related']?>">-->
			<textarea name="contents" id="contents" style="display:none"></textarea>

            <div class="row wp_40 mb_30 ai_stretch">
                <div class="col_15">
                    <h3 class="mb_15">리뷰 내용</h3>
                    <div class="editor_writer" >

                       <?php include _ROOT."/resource/lib/editor.html"; ?>

                        <div class="editorWriter_box" id="editorWriterBox">
                            <div id="editorWriter">
								<?=(!empty($rs['contents'])) ? $rs['contents'] : "";?>
                            </div>
                        </div>
                    </div>
                    <!--editor }-->
                </div>
                <!--기사내용}-->

                <div class="col_9">
                    <h3 class="mb_15">리뷰 입력</h3>
                    <div class="area_box">
                        <div class="area_con_box">
                            <div class="row wp_30">

								<div class="col_24">
                                    <div class="flex ai_c">
                                        <span>원기사</span>
                                        <span class="fs_13 ml_auto mr_5 tc_b5"><!--*순서 Drag & Drop으로 변경--></span>
                                        <button class="btn btn_c7 btn_sm" type="button" onclick="js_pop('published_contents')"><span>찾기</span></button>
                                    </div>
                                    <div class="scroll_box mt_10">
                                        <ul class="serial_wrap t_left sortable" id="relate">
											<?if($rs['osmu_id'] != ""){?>
												<li class="number_item" data-item='<?=$rs['osmu_id']?>'>
													<div class="number_btn ">
														<span class="txt"><?=$rs['osmu_serial']?></span>
														<button class="num_close"><i class="iconFt_round_close"></i></button>
													</div>
												</li>
											<?}?>
                                        </ul>

										<input type="hidden" name="osmu_id" id="osmu_id" class="inp inp_sm fm_full"  value="<?=$rs['osmu_id']?>">

                                    </div>
                                </div>

								<!--
                                <div class="col_24">
                                    <label for="">원기사</label>
                                    <div class="flex ai_c fw_nowrap mt_5">
                                        <div class="find_btn_box">
                                            <button class="btn btn_c7 btn_sm btn_full act_popup" data-url="popup_ty3" onclick="act_popup(this)" type="button"><span>기사 검색</span></button>
                                            <input type="text" class="inp inp_sm fm_full" value="">
                                        </div>
                                    </div>
                                </div>
								-->


                                <div class="col_24">
                                    <label for="">작성자</label>
                                    <input type="text" name="contributor" id="contributor" maxlength="25" class="inp inp_sm fm_full mt_5" value="<?=$rs['contributor']?>">
                                    <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                </div>
                                <!--작성자 } -->

                                <div class="col_24">
                                    <label>이메일 주소</label>

                                    <div class="row ai_c mt_10">
                                        <div class="col_7">
											<input type="text" name="email1" id="email1" class="inp inp_sm fm_full" maxlength="50" value="<?=$email_arr[0]?>">
                                        </div>

                                        <div class="col_2 t_center">
                                            @
                                        </div>

                                        <div class="col_7">
											<input type="text" name="email2" id="email2" class="inp inp_sm fm_full" maxlength="50" value="<?=$email_arr[1]?>">
                                        </div>

                                        <div class="sel_box col_7 offset_1">
											<select class="sel fm_full placeholder __customUi" onchange="$('#email2').val(this.value);" >
												<option value="">직접입력</option>
												<option value="naver.com" <?=($email_arr[1]=="naver.com")?"selected":""?>>naver.com</option>
												<option value="hanmail.net" <?=($email_arr[1]=="hanmail.net")?"selected":""?>>hanmail.net</option>
												<option value="gmail.com" <?=($email_arr[1]=="gmail.com")?"selected":""?>>gmail.com</option>
												<option value="hotmail.com" <?=($email_arr[1]=="hotmail.com")?"selected":""?>>hotmail.com</option>
												<option value="nate.com" <?=($email_arr[1]=="nate.com")?"selected":""?>>nate.com</option>
												<option value="paran.com" <?=($email_arr[1]=="paran.com")?"selected":""?>>paran.com</option>
											</select>
                                        </div>
                                    </div>

									<input type="hidden" name="email" id="email" value="<?=$rs['email']?>">

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- area_box :: end -->

                    <div class="row wp_20 pt_40">
                        <div class="col_12">
                            <a href="javascript:;" onclick="js_list()" class="btn_lg btn_full">목록으로</a>
                        </div>
                        <div class="col_12">
                            <button type="button" onclick="js_preview('<?=$rs['id']?>')" class="btn_lg btn_full"><span>미리보기</span></button>
                        </div>
                        <div class="col_24">
                            <button type="button" class="btn_lg btn_c2 btn_full" onclick="js_save()"><span>리뷰 <?=($rs['id'] == "") ? "입력" : "수정";?> 완료</span></button>
                        </div>
                    </div>
                </div>
                <!--기사 정보}-->
            </div>

            <!--기사종류 : 포토뉴스 : 사진입력 }-->
        </form>
    </div>
</div>
<script>

	$(document).ready(function(){

		$(document).on('click', '.num_close' ,function(e){
			if(confirm('삭제하시겠습니까?')){
				$(this).closest('li').remove();
			}
			return false;
		});

		<?php if($is_allow_modify){ ?>
			//editor.js
			$('#editorWriter').attr('contenteditable', true);
			document.execCommand("defaultParagraphSeparator", false, "br");
		   //$('#editorWriter').focus();

			var position = null;
			$('#editorWriter').on('keyup',function(){
				var a=document.activeElement;
				if( a.lastChild && a.lastChild.nodeName!="BR" ){
					a.appendChild(document.createElement("br"));
				}
			});

			$('#editorWriter').on('keypress', function(e){
				if( e.keyCode==13 ){
					var selection=window.getSelection(),
					range=selection.getRangeAt(0),
					br=document.createElement("br");
					range.deleteContents();
					range.insertNode(br);
					range.setStartAfter(br);
					range.setEndAfter(br);
					range.collapse(false);
					selection.removeAllRanges();
					selection.addRange(range);
					return false;
				}
			});
		<?php } ?>


	})

    //common.js
    serial_drop('.serial_wrap');

    //editor.js
    editerAni.init();

	function js_list(){
		var _next = "<?=$next?>";

		if(_next == ""){
			_next="standby";
		}

		location.href = "/review/"+_next+"<?=$param['query']?>";
	}

	function js_pop(tgt){
		var param = "";
		$('#'+tgt).find('li').each(function(){
			if(param == "") param = $(this).data('item');
			else param = param + "|" + $(this).data('item');
		});
		if(	param != "") param = "?relate_id=" + param;
		
		var url = '/pop/' + tgt + param;
		$('#popup_iframe').attr('src',url);
	    $('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function js_set_relate_data(str){
		var html = '';
	
		var data = JSON.parse(str);
		$.each(data, function(index, item){
			html += '<li class="number_item"  data-item=\''+ item.id +'\'>';
			html += '<div class="number_btn">';
			html += '<span class="txt">'+ item.serial +'</span>';
			html += '<button class="num_close"><i class="iconFt_round_close"></i></button>';
			html += '</div>';
			html += '</li>';
		});
		$('#relate').html(html);
	}

	var dup_submit_flag = 'N';	//2중 클릭 체크

	function js_save() {
		<?php if(!$is_allow_modify){ ?>
			alert("수정 할 수 없습니다.");
			return;
		<?}?>

		if(dup_submit_flag == 'N'){
			var frm = document.frm;
			var review_id = frm.review_id.value;
			var _next = "<?=$next?>";

			if(_next == ""){
				_next="standby";
			}

			var str_category = "";
			var chk_cnt = 0;

//			if(isEmpty(frm.contributor.value)){
//				alert('작성자명을 입력해 주세요.');
//				frm.contributor.focus();
//				return;
//			}

			if(isEmpty(frm.email1.value)){
				alert('이메일을 입력해 주세요.');
				frm.email1.focus();
				return;
			}

			if(isEmpty(frm.email2.value)){
				alert('이메일을 입력해 주세요.');
				frm.email2.focus();
				return;
			}

			var _email = frm.email1.value.trim()+"@"+frm.email2.value.trim();

			if(!CheckEmail(_email)){
				alert('유효한 이메일 주소가 아닙니다.\n다시 확인해 주세요.');
				frm.email1.focus();
				return;
			}

			frm.email.value = _email;

			//html 업데이트
			getContetHtml();

			if($('#contents').val().trim() == ""){
				alert('내용을 입력하여 주세요');
				$('#editorWriter').focus();
				return;
			}

			//유관기사 업데이트
			var relate = "";

			$('#relate').find('li').each(function(){
				if(relate == "") relate = $(this).data('item');
				else relate = relate + "," + $(this).data('item');
			});

			if(relate == ""){
				alert('원기사를 입력하여 주세요');
				$('#relate').focus();
				return;
			}

			$('#osmu_id').val(relate);

			if(review_id == ""){
				var _msg = "저장 하시겠습니까?";
			}else{
				var _msg = "수정 하시겠습니까?";
			}

			if(confirm(_msg)){

				dup_submit_flag = 'Y';

				//save 
				var request = new XMLHttpRequest();

				var form = $('#frm');
				var formData = new FormData(form[0]);

				upload_flag = 'N';

				$.ajax({
					url:"/review/dml",
					data:formData,
					type:'POST',
					enctype:'multipart/form-data',
					processData:false,
					contentType:false,
					//dataType:'json',
					cache:false,

					success:function(result){

						console.log(result);

						if(result.code == "success"){
							dup_submit_flag = 'Y';

							if(review_id == ""){
								var replace_url = "/review/standby";
							}else{
								var replace_url = "/review/"+_next+"<?=$param['query']?>";
							}

							location.replace(replace_url);
						}else{
							dup_submit_flag = 'N';
							alert(result.msg);
							return;
						}
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						dup_submit_flag = 'N';
						alert( textStatus + ", " + errorThrown );
					}			
				});
			} //confirm
		}else{
			alert("처리중입니다.\n잠시만 기다려 주세요.");
		}

	}


	function js_preview(id){		
		var frm = document.frm;

		/*
		if(isEmpty(frm.contributor.value)){
			alert('작성자명을 입력해 주세요.');
			frm.contributor.focus();
			return;
		}
		*/

		//원기사 업데이트
		var relate = "";

		$('#relate').find('li').each(function(){
			if(relate == "") relate = $(this).data('item');
			else relate = relate + "," + $(this).data('item');
		});

		if(relate == ""){
			alert('원기사를 입력하여 주세요');
			$('#relate').focus();
			return;
		}

		$('#osmu_id').val(relate);

		//html 업데이트
		getContetHtml();
		if($('#contents').val().trim() == ""){
			alert('내용을 입력하여 주세요');
			$('#editorWriter').focus();
			return;
		}

		js_open_preview('temp');

	}

	function js_open_preview(id){
		
		var url = '/preview/review/' + id;

		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function close_iframe(){
		alert('미리보기가 지원되지 않습니다');
		act_popup_close();
	}




</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
