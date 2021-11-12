<?php
$_menu_cede = "0601";
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<div class="contain">

	<div class="wrap">
		<form name="frm" id="frm" method="post" onsubmit="return false;" enctype="multipart/form-data">

			<input type="hidden" name="mode" id="mode" value="<?=($rs['id'] == '') ? 'new' : 'modify'?>">
			<input type="hidden" name="notice_id" id="notice_id" value="<?=$rs['id']?>">

			<textarea name="contents" id="contents" style="display:none"></textarea>

			

			<div class="row wp_40 mb_30 ai_stretch">
				<div class="col_15">
					<h3 class="mb_15">알림 내용</h3>

					<div class="editor_writer" >

                        <?php include _ROOT."/resource/lib/editor.html"; ?>

                        <div class="editorWriter_box" id="editorWriterBox">
                            <div id="editorWriter">
								<?=(!empty($rs['contents'])) ? $rs['contents'] : "내용";?>
							</div>
                        </div>
                    </div>

					<!--editor }-->
				</div>
				<!--기사내용}-->

				<div class="col_9">
					<h3 class="mb_15">알림 정보</h3>
					<div class="area_box">
						<div class="area_con_box">
							<div class="row wp_30">
								<div class="col_24">
									<p class="mb_5">주요공지</p>
									<label class="fm_rd">
										<input type="radio" name="top_tf" value="Y" <?=($rs['top_tf']=="Y")?"checked":""?>><span class="_icon"></span>
										<span class="fs_13">사용</span>
									</label>

									<label class="fm_rd ml_10">
										<input type="radio" name="top_tf" value="N" <?=($rs['top_tf']!="Y")?"checked":""?>><span class="_icon"></span>
										<span class="fs_13">사용 안 함</span>
									</label>
								</div>
								<!-- 주요공지 } -->

								<div class="col_24">
									<p class="mb_5">카테고리</p>
									<select name="category" id="category" class="sel fm_full mt_10">
										<option value="">- 선택 -</option>
										<option value="공지" <?=($rs['category']=="공지")?"selected":""?>>공지</option>
										<option value="알림" <?=($rs['category']=="알림")?"selected":""?>>알림</option>
										<option value="부고" <?=($rs['category']=="부고")?"selected":""?>>부고</option>
										<option value="채용" <?=($rs['category']=="채용")?"selected":""?>>채용</option>
										<option value="공고" <?=($rs['category']=="공고")?"selected":""?>>공고</option>
                                    </select>

								</div>
								<!-- 카테고리 } -->

								<div class="col_24 ">
									<label for="">제목</label>
									<input type="text" name="title" id="title" class="inp inp_sm fm_full mt_5" value="<?=$rs['title']?>" maxlength="250">
								</div>
								<!--제목 } -->

								<div class="col_24">
									<label for="">작성자</label>
									<input type="text" name="contributor" id="contributor" class="inp inp_sm fm_full mt_5" value="<?=$contributor?>" maxlength="25">
									<span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
								</div>
								<!--작성자 } -->

								<div class="col_24">
                                    <div class="row">
                                        <div class="col_18">
                                            <div class="row ai_c">
                                                <label for="">첨부파일</label>
                                                <?php if(count($rs['file']) >= 1) { ?>
                                                    <li style="padding-left: 5px; font-size:11px; color:#777;"> * 첨부파일 삭제는 즉시 반영됩니다.</li>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col_6 t_right">
                                            <a href="javascript:void(0);" class="btn btn_sm add_btn" data-max="2" onclick="createFile(this);">추가</a>
                                        </div>
                                    </div>

									<?php //if(count($rs['file']) > 0){ ?>
									<ul class="file_wrap file_contents custom">
										<?php for($i=0; $i<count($rs['file']); $i++) { ?>
										    <li class="file_box mt_5 edit">

												<a href="<?=_DOWNLOAD_URL?>?<?=encrypt(time()."||".$rs['file'][$i]['filepath']."||".$rs['file'][$i]['filename'])?>" target="_blank" class="file_name" title="다운로드">
													<?=$rs['file'][$i]['filename']?>
												</a>

                                                <div class="create_box ">
                                                    <button type="button" data-id="<?=$rs['file'][$i]['id']?>" class="btn btn_c6 btn_sm remove_btn btn_del_file">
                                                        삭제
                                                    </button>
                                                </div>
                                            </li>
										<?php } ?>

                                        <?php if(count($rs['file']) < 1) {?>
                                            <li class="file_box mt_5 create">
                                                <div class="file_con fs_13">
                                                    <input type="file" name="userfile[]" id="userfile[]">
                                                    <button type="button" class="btn file">파일선택</button>
                                                    <span class="file_name "></span>
                                                </div>
                                                <div class="create_box ">
                                                    <button type="button" onclick="removeFile();" data-id="<?=$rs['file'][$i]['id']?>" class="btn btn_c6 btn_sm remove_btn">
                                                        삭제
                                                    </button>
                                                </div>
                                            </li>
                                        <?php } ?>

									</ul>
									<?php //} ?>

                                </div>


								<!--
								<div class="col_24">
									<label for="">첨부파일 1</label>
									<div class="file_box fm_full mt_5">
										<div class="file_con fs_13">
											<input type="file" multiple="multiple">
											<button class="btn file" type="button">파일선택</button>
											<span class="file_name "></span>
										</div>
									</div>
								</div>
								-->
								<!--첨부파일 1 } -->

								<!--
								<div class="col_24">
									<label for="">첨부파일 2</label>
									<div class="file_box fm_full mt_5">
										<div class="file_con fs_13">
											<input type="file" multiple="multiple">
											<button class="btn file" type="button">파일선택</button>
											<span class="file_name "></span>
										</div>
									</div>
								</div>
								-->
								<!--첨부파일 2 } -->

								<div class="col_24">
									<p class="mb_5">노출여부</p>
									<label class="fm_rd">
										<input type="radio" name="use_tf" value="Y" <?=($rs['use_tf']!="N")?"checked":""?>><span class="_icon"></span>
										<span class="fs_13">보이기</span>
									</label>

									<label class="fm_rd ml_10">
										<input type="radio" name="use_tf" value="N" <?=($rs['use_tf']=="N")?"checked":""?>><span class="_icon"></span>
										<span class="fs_13">보이지 않기</span>
									</label>
								</div>
								<!-- 노출여부 } -->

								<div class="col_24">
									<p class="mb_5">등록일</p>
									<?=($rs['reg_date']!="")?$rs['reg_date']:$_base['time']?>
								</div>
							</div>
						</div>
					</div>

					<!-- p26 -->
					<div class="row wp_20 pt_40">
						<div class="col_12">
							<a href="javascript:;" onclick="js_list()" class="btn_lg btn_full">목록으로</a>
						</div>
						<div class="col_12">
							<button type="button" class="btn_lg btn_full" onclick="js_preview('<?=$rs['id']?>')"><span>미리보기</span></button>
						</div>
						<div class="col_24">
							<button type="button" class="btn_lg btn_c2 btn_full btn_save"><span>알림 <?=($rs['id'] == "") ? "입력" : "수정";?> 완료</span></button>
						</div>

						<div class="col_24 btn_grp_process" style="position:relative; displau:none;">
							<div id="per" style="position:absolute; width:100%; text-align:center;"></div>
							<div id="progressbar"></div>
						</div>

					</div>
					<!-- p26 -->


				</div>
				<!--기사 정보}-->
			</div>


			<!-- <div class="row wp_20 pt_40 pb_30">
				<div class="col_">
					<a href="#" class="btn_lg btn_full">목록으로</a>
				</div>
				<div class="col_ ml_auto">
					<button type="button" class="btn_lg btn_c2 btn_full btn_save"><span>완료</span></button>
				</div>
			</div> -->
			<!--기사종류 : 포토뉴스 : 사진입력 }-->
		</form>
	</div>
</div>

<div class="progress_round_wrap" id="progress">
	<svg class="progress" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
	  <circle cx="32" cy="32" r="31"/>
	</svg>
	<div class="progress_num">100%</div>
</div>

<style>

</style>
<script>
	

	var dup_submit_flag = 'N';	//2중 클릭 체크

	$(document).ready(function(){

		//editor.js
		$('#editorWriter').attr('contenteditable', true);
		document.execCommand("defaultParagraphSeparator", false, "br");
		$('#editorWriter').focus();

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

		var t = document.getElementById('editorWriter');
		t.addEventListener('paste', function(event) {
			event.preventDefault();
			// 클립보드에서 복사된 텍스트 얻기
			var pastedData = event.clipboardData ||  window.clipboardData;
			var textData = pastedData.getData('Text');
			textData = nl2br(strip_tags(textData));  //edior.js
			window.document.execCommand('insertHTML', false,  textData);
		});


		$('.btn_save').on('click', function(){

			if(dup_submit_flag == 'N'){

				var _notice_id = "<?=$rs['id']?>";

				var top_tf_radioChk = $("input:radio[name=top_tf]").is(':checked');

				if(!top_tf_radioChk){
					alert('주요공지 여부를 선택해 주세요');
					$("input:radio[name=top_tf]").focus();
					return;
				}

				if(isEmpty($('#category').val().trim())){
					alert('카테고리를 입력해 주세요');
					$('#category').focus();
					return;
				}

				if(isEmpty($('#title').val().trim())){
					alert('제목을 입력해 주세요');
					$('#title').focus();
					return;
				}

				if(isEmpty($('#contributor').val().trim())){
					alert('작성자를 입력해 주세요');
					$('#contributor').focus();
					return;
				}

				var use_tf_radioChk = $("input:radio[name=use_tf]").is(':checked');

				if(!use_tf_radioChk){
					alert('노출 여부를 선택해 주세요');
					$("input:radio[name=use_tf]").focus();
					return;
				}

				//html 업데이트
				getContetHtml();
				if($('#contents').val().trim() == ""){
					alert('내용을 입력하여 주세요');
					$('#editorWriter').focus();
					return;
				}

				if(_notice_id == ""){
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

					$('.btn_grp_submit').hide();
					$('.btn_grp_process').show();

					upload_flag = 'N';

					$.ajax({
						url:"/alim/dml",
						data:formData,
						type:'POST',
						enctype:'multipart/form-data',
						processData:false,
						contentType:false,
						//dataType:'json',
						cache:false,
						xhr: function(){
							var xhr = $.ajaxSettings.xhr();
							if (xhr.upload) {
								xhr.upload.addEventListener('progress', function(event) {
									var percent = 0;
									var position = event.loaded || event.position;
									var total = event.total;
									if (event.lengthComputable){
										percent = Math.ceil(position / total * 100);
									}
									$('#per').text(percent + '%');
									$("#progressbar").progressbar({value: percent});

								},
								xhr.upload.addEventListener('load', function(event) {
									upload_flag = 'Y';
								}));
							}
							return xhr;
						},
						success:function(result){
							dup_submit_flag = 'Y';

							console.log(result);

							$('#per').text('100%');
							$("#progressbar").progressbar({value: 100});

							if(result.code == "success"){
								var timerId = setInterval(function(){
									 if(upload_flag == "Y"){
										 location.replace('/alim/list?<?=$param['nopage']?>');
										 clearInterval(timerId);
									 }
								}, 300);

							}else{
								dup_submit_flag = 'N';
								//alert(result.msg);
								$('.btn_grp_submit').show();
								$('.btn_grp_process').hide();
								//console.log(result);
							}
						},
						error: function( jqXHR, textStatus, errorThrown ) {
							dup_submit_flag = 'N';
							alert( textStatus + ", " + errorThrown );
							$('.btn_grp_submit').show();
							$('.btn_grp_process').hide();
						}
					});
				} //confirm

			}else{
				alert("처리중입니다.\n잠시만 기다려 주세요.");
			}

		});

		//첨부파일삭제
		$('.btn_del_file').on('click', function(){
			var obj = $(this);
			var id = obj.data('id');
			if(confirm("첨부파일을 삭제하시겠습니까?")){
				$.ajax({
					type: 'post',
					url: '/alim/dml',
					data: {'mode': 'del_attach', 'id':id},
					success: function(result){
						console.log(result.code);
						if(result.code == "success"){
                            var wrap = obj.closest('.file_wrap');
							obj.closest('.file_box').remove();
                            if(wrap.find('.file_box').length <= 1) {
                                createFile($('.add_btn'))
                            }
						}else{
							alert(result.msg);
						}
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						alert( textStatus + ", " + errorThrown );
					}
				});
			}
		});


	})

	var n = 1;

	function up(){
		if(n > 100){
			clearInterval(timerId);
			return;
		}
		$('#per').text(n + '%');
		$("#progressbar").progressbar({value: n});
		n++;
	}
	
	//common.js
	//serial_drop('.serial_wrap');

	//editor.js
	editerAni.init();

	function js_list(){
		location.href = "/alim/list<?=$param['query']?>";
	}

	function createFile(self) {
        var initLayout = '';
        initLayout += '<li class="file_box  mt_5 create">';
        initLayout += '    <div class="file_con fs_13" style="min-width: 21.230769em; max-width:21.230769em;">';
        initLayout += '        <input type="file" name="userfile[]" id="userfile[]">';
        initLayout += '        <button class="btn file" type="button">파일선택</button>';
        initLayout += '        <span class="file_name"></span>';
        initLayout += '    </div>';
        initLayout += '    <div class="create_box ">';
        initLayout += '        <a href="javascript:void(0);" class="btn btn_c6 btn_sm remove_btn" onclick="removeFile()">삭제</a>';
        initLayout += '    </div>';
        initLayout += '</li>';
        var t = $(self);
        var wrap = t.closest('.row').next('.file_wrap');
        var create = wrap.find('.file_box.create');
        var lng;
        if(wrap.find('.file_box').length >= Number(t.data('max'))) {
            return alert('첨부 파일은 최대 '+t.data('max')+'개 까지 입니다.');
        }
        wrap.append(initLayout);
        act_file.init(initLayout);
    }

    function removeFile() {
        var t = $(event.target);
        var wrap = t.closest('.file_wrap');
        var child = wrap.find('.file_box');
        var create = wrap.find('.file_box.create');
        var box = t.closest('.file_box');
        var lng;
        t.closest('.file_box').remove();
        if(child.length <= 1) {
            createFile(wrap.prev('.row').find('.add_btn'));
        }
    }

	function js_preview(id){		
		if(id == ""){
			if($('#title').val().trim().length < 1){
				alert('제목을 입력하여 주세요');
				$('#title').focus();
				return;
			}

			//console.log(relate);

			//html 업데이트
			getContetHtml();
			if($('#contents').val().trim() == ""){
				alert('내용을 입력하여 주세요');
				$('#editorWriter').focus();
				return;
			}

			js_open_preview('temp');

		}else{
			console.log(id);
			js_open_preview(id);
		}		
	}
    
	function js_open_preview(id){
		var url = '/preview/alim/' + id;
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
