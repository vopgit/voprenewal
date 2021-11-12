<?php
$_menu_code = '0201';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<div class="contain">

    <div class="wrap">
        <form name="frm" id="frm" method="post" onsubmit="return false">

		<input type="hidden" name="mode" id="mode" value="<?=($mode == '') ? 'new' : $mode; ?>">
		<input type="hidden" name="osmu_id" id="osmu_id" value="<?=$rs['id']?>">
		<input type="hidden" name="related" id="related" value="<?=$rs['related']?>">
		<textarea name="contents" id="contents" style="display:none"></textarea>

            <div class="row wp_40 mb_30 ai_stretch">
                <div class="col_15">
                    <h3 class="mb_15">원소스 내용</h3>
                    <div class="editor_writer" >

                        <?php include _ROOT."/resource/lib/editor.html"; ?>

                        <div class="editorWriter_box" id="editorWriterBox">
                            <div id="editorWriter"><?=$rs['contents']?></div>
                        </div>
                    </div>
                    <!--editor }-->
                </div>
                <!--기사내용}-->

                <div class="col_9">
                    <h3 class="mb_15">원소스 입력</h3>
                    <div class="area_box">
                        <div class="area_con_box">
                            <div class="row wp_20">



                                <div class="col_24">
                                    <label for="">제목</label>
                                    <input type="text" name="title" id="title" class="inp inp_sm fm_full mt_5" value="<?=$rs['title']?>" maxlength="250">
                                </div>
                                <div class="col_24">
                                    <label for="">작성자</label>
                                    <input type="text" name="contributor" id="contributor" class="inp inp_sm fm_full mt_5" value="<?=$rs['contributor']?>" maxlength="100">
                                    <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                </div>

                                <div class="col_24">
                                    <div class="flex ai_c">
                                        <span>유관기사</span>
                                        <span class="fs_13 ml_auto mr_5 tc_b5">*순서 Drag & Drop으로 변경</span>
                                        <button class="btn btn_c7 btn_sm" type="button" onclick="js_pop('relate')"><span>찾기</span></button>
                                    </div>
                                    <div class="scroll_box mt_10">

                                        <ul class="serial_wrap t_left sortable" id="relate">
                                            <?php foreach($rs['relate'] as $onesource) { ?>
													<?
														if($str_old_related == ""){
															$str_old_related = $onesource['contents_id'];
														}else{
															$str_old_related .= ",".$onesource['contents_id'];
														}
													?>
                                                <li class="number_item" data-item='<?=$onesource['contents_id']?>'>
                                                    <div class="number_btn ">
                                                        <span class="txt"><?=$onesource['serial']?></span>
                                                        <button class="num_close"><i class="iconFt_round_close"></i></button>
                                                    </div>
                                                </li>
                                            <?php }?>
                                        </ul>

										<input type="hidden" name="old_related" id="old_related" value="<?=$str_old_related?>">

                                    </div>
                                </div>

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
                                            <a href="javascript:void(0);" class="btn btn_sm add_btn" data-max="5" onclick="createFile(this);">추가</a>
                                        </div>
                                    </div>

									<?php //if(count($rs['file']) > 0){ ?>
									<ul class="file_wrap file_contents custom">
										<?php for($i=0; $i<count($rs['file']); $i++) { ?>
										    <li class="file_box mt_5 edit">
                                                <a href="" class="file_name"><?=$rs['file'][$i]['filename']?></a>
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

                                    <?php if(false) { ?>
                                    <!-- 기존 소스입니다. -->
                                    <div class="file_box fm_full create mt_5 st_2" style="display: none; ">
										<div class="file_con">
                                            <input type="file" name="userfile[]" id="userfile[]">
                                            <button type="button" class="btn file">파일선택</button>
                                            <span class="file_name "></span>
                                        </div>
                                        <div class="create_box ">
                                            <button type="button" data-id="<?=$rs['file'][$i]['id']?>" class="btn btn_c6 btn_sm remove_btn btn_del_file">
                                                삭제
                                            </button>
                                        </div>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- area_box :: end -->

                    <div class="row wp_20 pt_40">
                        <div class="col_12">
                            <a href="javascript:;" class="btn_lg btn_full" onclick="js_list()">목록으로</a>
                        </div>
                        <div class="col_12">
                            <button type="button" class="btn_lg btn_full" onclick="js_preview('<?=$osmu_id?>')"><span>미리보기</span></button>
                        </div>
                        <div class="col_24 btn_grp_submit">
                            <?php if($is_allow_modify){ ?>
								<button type="button" class="btn_lg btn_c2 btn_full submit"><span>원소스 <?=($osmu_id == "") ? "입력" : "수정";?> 완료</span></button>
							<?php } ?>
                        </div>

						<div class="col_24 btn_grp_process" style="position:relative; displau:none;">
							<div id="per" style="position:absolute; width:100%; text-align:center;"></div>
							<div id="progressbar"></div>
						</div>

                    </div>
                </div>
                <!--기사 정보}-->
            </div>

            

            <div class="row wp_20 pt_40 pb_30">
                <div class="col_">
                    <a href="javascript:;" onclick="js_list()" class="btn_lg btn_full">목록으로</a>
                </div>
                <div class="col_ ml_auto">
                    <?php if($is_allow_modify){ ?>
						<button type="button" class="btn_lg btn_c2 btn_full submit"><span>원소스 <?=($osmu_id == "") ? "입력" : "수정";?> 완료</span></button>
					<?php } ?>
                </div>
            </div>
            <!--기사종류 : 포토뉴스 : 사진입력 }-->
        </form>
    </div>
</div>
<script>
    //common.js
    //serial_drop('.serial_wrap');

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
	$(document).ready(function() {
		$('.sortable').sortable({
			placeholder: "ui-sortable-placeholder",
	    });
		$('#relate').disableSelection();

		//timerId = setInterval(up, 10);

		$(document).on('click', '.num_close' ,function(e){
			if(confirm('삭제하시겠습니까?')){
				$(this).closest('li').remove();
			}
			return false;
		});

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

		$('.submit').click(function(){
			if($('#title').val().trim().length < 1){
				alert('제목을 입력하여 주세요');
				$('#title').focus();
				return;
			}

			//유관기사 업데이트
			var relate = "";
			$('#relate').find('li').each(function(){
				if(relate == "") relate = $(this).data('item');
				else relate = relate + "," + $(this).data('item');
			});
			$('#related').val(relate);

			//html 업데이트
			getContetHtml();
			if($('#contents').val().trim() == ""){
				alert('내용을 입력하여 주세요');
				$('#editorWriter').focus();
				return;
			}

			if(confirm('저장하시겠습니까?')){

				//save
				var request = new XMLHttpRequest();

				var form = $('#frm');
				var formData = new FormData(form[0]);

				$('.btn_grp_submit').hide();
				$('.btn_grp_process').show();

				upload_flag = 'N';

				$.ajax({
					url:"/osmu/dml",
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

						console.log(result);

						$('#per').text('100%');
						$("#progressbar").progressbar({value: 100});

						if(result.code == "success"){
							var timerId = setInterval(function(){
								 if(upload_flag == "Y"){
									 location.replace('/osmu/list?<?=$param['nopage']?>');
									 clearInterval(timerId);
								 }
							}, 300);

						}else{
							//alert(result.msg);
							$('.btn_grp_submit').show();
							$('.btn_grp_process').hide();
							//console.log(result);
						}
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						alert( textStatus + ", " + errorThrown );
						$('.btn_grp_submit').show();
						$('.btn_grp_process').hide();
					}
				});
			} //confirm
		});
	});

    //editor.js
    editerAni.init();

	function js_list(){
		location.href = "/osmu/list<?=$param['query']?>";
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

	$(document).ready(function() {

		//첨부파일삭제
		$('.btn_del_file').on('click', function(){
			var obj = $(this);
			var id = obj.data('id');
			if(confirm("첨부파일을 삭제하시겠습니까?")){
				$.ajax({
					type: 'post',
					url: '/osmu/dml',
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
	});

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

			//유관기사 업데이트
			var relate = "";
			$('#relate').find('li').each(function(){
				if(relate == "") relate = $(this).data('item');
				else relate = relate + "," + $(this).data('item');
			});
			$('#related').val(relate);

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
		var url = '/preview/osmu/' + id;
		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function close_iframe(){
		alert('미리보기가 지원되지 않습니다');
		act_popup_close();
		$('#popup_iframe').attr('src','about:blank');
	}


</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
