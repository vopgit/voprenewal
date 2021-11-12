<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<link rel="stylesheet" type="text/css" media="screen" href="/resource/css/demo.html5imageupload.css" />

<div class="contain">

    <div class="wrap">
        <form name="frm" id="frm" method="post" onsubmit="return false;" enctype="multipart/form-data">

			<input type="hidden" name="mode" id="mode" value="<?=($contents_id == '') ? 'new' : 'modify'; ?>">
			<input type="hidden" name="contents_id" id="contents_id" value="<?=$contents_id?>">
			<input type="hidden" name="fromUrl" value="<?=urlencode('/news/'.$refer.$param['query'])?>">
			<input type="hidden" name="request_from" id="request_from" value="Y">

            <h3 class="mb_15">기사 입력</h3>
            <div class="row wp_40 mb_40 ai_stretch">
                <div class="col_15">
                    <div class="area_box">
                        <div class="area_con_box">

                            <div class="row ai_stretch wp_30 wp_st_2">
                                <div class="col_12">
                                    <label for="">기사 종류</label>
                                    <select name="news_kind" id="news_kind" class="sel fm_full mt_10" onchange="js_changeKind(this.value)">
										<option value="">- 선택 -</option>
									<?php 
									for ($j = 0 ; $j < count($rs_newsKind); $j++) {
										?>
										<option value="<?=$rs_newsKind[$j]['id']?>"><?=$rs_newsKind[$j]['name']?></option>
										<?
									}
									?>
                                    </select>
                                </div>
                                <!--기사 종류}-->

                                <div class="col_12">
                                    <div class="row">
                                        <label for="">기사분류</label>
                                        <div class="sel_box col_24">
                                            <select name="news_category" id="news_category" class="sel fm_full mt_10">
                                                <option value="">- 선택 -</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--기사분류 }-->


                                <div class="col_24 div_part div_part_3" style="display:none">
                                    <div class="row">
                                        <div class="col_24 flex">
                                            <label for="">연재 컬럼</label>
                                            <button class="btn btn_c7 btn_sm ml_auto" type="button" data-url="popup_ty2" onclick="act_popup(this)"><span>컬럼명 관리</span></button>
                                        </div>
                                        <div class="col_24 flex ai_c fw_nowrap mt_5">
                                            <div class="find_btn_box">
                                                <button class="btn btn_c7 btn_sm btn_full" type="button" onclick="js_open_pop('pop_column')"><span>찾기</span></button>
                                                <input type="text" id="column_title" class="inp inp_sm fm_full" value="<?=$rs['column_title']?>" readonly>
												<input type="hidden" name="column_id" id="column_id" value="<?=$rs['column_id']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--연재 컬럼}-->

                                <div class="col_24 div_part div_part_5" style="display:none">
                                    <div class="row">
                                        <div class="col_24 flex">
                                            <label for="">민소픽</label>
                                            <button class="btn btn_c7 btn_sm ml_auto" type="button" data-url="popup_ty6" onclick="act_popup(this)"><span>민소픽 그룹 관리</span></button>
                                        </div>
                                        <div class="col_24 mt_5">
                                            <div class="find_btn_box">
                                                <button class="btn btn_c7 btn_sm btn_full" type="button" onclick="js_open_pop('pop_minsopick')"><span>찾기</span></button>
                                                <input type="text" id="minsopick_title" class="inp inp_sm fm_full" value="<?=$rs['minsopick_title']?>" readonly>
												<input type="hidden" name="minsopick_id" id="minsopick_id" value="<?=$rs['minsopick_id']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--민소픽}-->

                                <div class="col_24">
                                    <div class=" row wp_30">
                                        <div class="col_12">
                                            <label for="">제목</label>
                                            <input type="text" class="inp inp_sm fm_full mt_10 mb_20" name="title" id="title" value="<?=$rs['title']?>" maxlength="255">

                                            <div class="flex">
                                                <label for="">작성자</label>
                                                <span class="ml_auto tc_b5">* 본인이 아닐 때 수정하세요.</span>
                                            </div>
                                            <input type="text" class="inp inp_sm fm_full mt_10" name="contributor" id="contributor" value="<?=$rs['contributor']?>" maxlength="255">
                                        </div>

                                        <div class="col_12">
                                            <label for="">부제/설명</label>
                                            <textarea name="description" id="description" class="ft mt_10"><?=$rs['description']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--제목, 작성자, 부제/설명 }-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--기사입력1}-->

                <div class="col_9">
                    <div class="area_box">
                        <div class="area_con_box">
                            <div class="row wp_30">

								<input type="hidden" name="related" id="related" value="">

                                <div class="col_24 ">
                                    <div class="flex ai_c">
                                        <span>관련기사</span>
                                        <span class="fs_13 ml_auto mr_5 tc_b5">*순서 Drag & Drop으로 변경</span>
                                        <button class="btn btn_c7 btn_sm" type="button"  onclick="js_pop('relate')"><span>찾기</span></button>
                                    </div>
                                    <div class="scroll_box mt_10">
                                        <ul class="serial_wrap t_left sortable" id="relate">
                                            <?php foreach($rs['relate'] as $relate) { ?>
                                                <li class="number_item" data-item='<?=$relate['id']?>'>
                                                    <div class="number_btn ">
                                                        <span class="txt"><?=$relate['serial']?></span>
                                                        <button class="num_close"><i class="iconFt_round_close"></i></button>
                                                    </div>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                                <!--관련기사 } -->

                                <div class="col_24">

									<input type="hidden" name="osmu" id="osmu" value="">

                                    <div class="flex ai_c">
                                        <span>원소스</span>
                                        <span class="fs_13 ml_auto mr_5 tc_b5">*순서 Drag & Drop으로 변경</span>
                                        <button class="btn btn_c7 btn_sm" type="button" onclick="js_pop('onesource')"><span>찾기</span></button>
                                    </div>
                                    <div class="scroll_box mt_10">
                                        <ul class="serial_wrap t_left sortable" id="onesource">
                                            <?php foreach($rs['one'] as $onesource) { ?>
                                                <li class="number_item" data-item='<?=$onesource['id']?>'>
                                                    <div class="number_btn ">
                                                        <span class="txt"><?=$onesource['serial']?></span>
                                                        <button class="num_close"><i class="iconFt_round_close"></i></button>
                                                    </div>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                                <!--원소스 } -->
                            </div>
                        </div>
                    </div>                   
                </div>
                <!--기사입력2}-->
            </div>
			
			<textarea name="contents" id="contents" style="display:none"></textarea>

            <div class="row wp_40 mb_30 ai_stretch">
                <div class="col_15">
                    <h3 class="mb_15">기사 내용</h3>
                    <div class="editor_writer" >

                       <?php include _ROOT."/resource/lib/editor.html"; ?>

                        <div class="editorWriter_box" id="editorWriterBox">
                            <div id="editorWriter">
								<?=(!empty($rs['content'])) ? $rs['content'] : "[광고1]";?>
                            </div>
                        </div>
                    </div>
                    <!--editor }-->
                </div>

                <!--기사내용}-->
                <div class="col_9">
                    <h3 class="mb_15">기사 정보</h3>
                    <div class="area_box">
                        <div class="area_con_box">
                            <div class="row wp_30">

								<input type="hidden" name="mid" value="<?=$rs['mid']?>">

                                <div class="col_24 ">
                                    <label for="">제목</label>
                                    <input type="text" class="inp inp_sm fm_full mt_5" name="mtitle" id="mtitle" value="<?=$rs['mtitle']?>" maxlength='255'>
                                </div>
                                <!--제목 } -->

                                <div class="col_24">
                                    <label for="">부제목</label>
                                    <input type="text" class="inp inp_sm fm_full mt_5" name="mdescription" id="mdescription" value="<?=$rs['mdescription']?>">
                                </div>
                                <!--부제목 } -->

                                <div class="col_24">
                                    <!--<label for="">클릭해서 모바일 섬네일을 업로드하세요.</label>-->
									<!--
                                    <div class="file_upload_click_box mt_5"></div>
									-->
									<div class="file_upload_click_box mt_5 dropzone" data-width="800" data-height="420" data-ajax="false" data-originalsave="true" data-image="<?=($rs['mthumbnail'] != '') ? _IMAGE_URL.$rs['mthumbnail'] : '';?>" >
    									<input type="file" name="input_thumb" />
                                    </div>
                                </div>
                                <!--모바일 썸네일 } -->

                                <div class="col_24">
                                    <label for="">태그</label>
                                    <input type="text" class="inp inp_sm fm_full mt_5" name="tags" id="tags" value="<?=$rs['tags_print']?>" placeholder="">
                                </div>
                                <!--태그 } -->
                            </div>
                        </div>
                    </div>

                    <div class="row wp_20 pt_40">
                        <div class="col_12">
                            <a href="javascript:;" onclick="js_list()" class="btn_lg btn_full">목록으로</a>
                        </div>
                        <div class="col_12">
                            <button type="button" class="btn_lg btn_full" onclick="js_preview()"><span>미리보기</span></button>
                        </div>
                        <div class="col_24">
                            <?php if($is_allow_modify){ ?>
								<button type="button" class="btn_lg btn_c2 btn_full btn_save"><span>기사 <?=($contents_id == "") ? "입력" : "수정";?> 완료</span></button>
							<?php } ?>
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
						<button type="button" class="btn_lg btn_c2 btn_full btn_save"><span>기사 <?=($contents_id == "") ? "입력" : "수정";?> 완료</span></button>
					<?php } ?>
                </div>
            </div>
            <!--기사종류 : 포토뉴스 : 사진입력 }-->
        </form>
    </div>
</div>

<script src="/resource/js/html5imageupload.js"></script>
<script>

	$('.dropzone').html5imageupload();

     $(document).ready(function(){
        
		act_readOnly();

		//기사종류, 분류 디폴트
		<?php if($contents_id != ''){ ?>		
		$('#news_kind').val('<?=$rs['kind']?>');
		js_changeKind('<?=$rs['kind']?>', '<?=$rs['category_id']?>'); 		
		<?php }else{ ?>
		$('#news_kind').val('<?=$default_kind?>');
		js_changeKind('<?=$default_kind?>', ''); 
		console.log(<?=$default_kind?>);
		<?php } ?>


		$('.sortable').sortable({
			placeholder: "ui-sortable-placeholder",
	    });
		$('#relate').disableSelection();

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
			/*
			var target = this;
			var selection = window.getSelection();
			var range = selection.getRangeAt(0);
			var startOffset = range.startOffset;
			var endOffset = range.endOffset;
			var html = $(target).html();
			var newHtml = html.replace(/'\b/g, "\u2018") // opening single
			.replace(/\b'/g, "\u2019") // closing single
			.replace(/"\b/g, "\u201c") // opening double
			.replace(/\b"/g, "\u201d") // closing double
			.replace(/--/g, "\u2014") // em-dash
			.replace(/\b\u2018\b/g, "'"); // handle conjunctions
			var delta = html.length - newHtml.length;
			$(target).html(newHtml);

			console.log(newHtml);

			var newRange = document.createRange();
			newRange.setStart(range.startContainer, startOffset - delta);
			newRange.setEnd(range.startContainer, endOffset - delta);
			selection.removeAllRanges();
			selection.addRange(newRange);
			return false;
			*/

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

		$('.btn_save').on('click', function(){

			if($('#news_kind').val() == ""){
				alert("기사종류를 선택하여 주세요");
				$('#news_kind').focus();
				return;
			}

			if($('#news_category').val() == ""){
				alert("기사분류를 선택하여 주세요");
				$('#news_category').focus();
				return;
			}

			if($('#title').val().trim().length < 2){
				alert("제목을 입력하여 주세요");
				$('#title').focus();
				return;
			}

			//관련기사 
			var relate = "";
			$('#relate').find('li').each(function(){
				if(relate == "") relate = $(this).data('item');
				else relate = relate + "," + $(this).data('item');
			});
			$('#related').val(relate);

			//원소스
			var osmu = "";
			$('#onesource').find('li').each(function(){
				if(osmu == "") osmu = $(this).data('item');
				else osmu = osmu + "," + $(this).data('item');
			});
			$('#osmu').val(osmu);

			//html 업데이트
			getContetHtml();

			if(confirm("저장하시겠습니까?")){
				document.frm.target = '_self';
				document.frm.action = "/contents/dml";
				document.frm.submit();

			}
		});

    })
    //common.js
    //serial_drop('.serial_wrap');

    //editor.js
    editerAni.init();

	function js_changeKind(v, n=''){
		$('.div_part').hide()
		if(v == 2 || v == 3 || v == 5 ){ //사설, 칼럼, 민소픽
			$('.div_part_' + v ).show();
		}
		$.ajax({
			type: 'post',
			url: '/contents/ajax_getCategory',
			data : {'seq' : v, 'default' : n},
			success: function(msg){
				//console.log(msg);
				$('#news_category').html(msg);
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( textStatus + ", " + errorThrown );
			}
		});
	}

	function js_list(){

		var _refer = "<?=$refer?>";
		if(_refer == "published"){
			location.href = "/publish/<?=$refer?><?=$param['query']?>";
		}else if(_refer == "top_rank"){
			location.href = "/news/<?=$refer?><?=$param['query']?>";
		}else{
			location.href = "/publish/<?=$refer?><?=$param['query']?>";
		}
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

	function js_set_osmu_data(str){
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
		$('#onesource').html(html);
	}

	function js_preview(){
		if(js_from_check()){			
			document.frm.target = 'popup_iframe';
			document.frm.action = "/contents/preview";
			document.frm.submit();
			$('#popup_iframe').stop().fadeIn().css('visibility','visible');
			$('body,html').css('overflow','hidden');

		}		
	}

	function js_from_check(){

		if($('#title').val().trim().length < 1){
			alert('제목을 입력하여 주세요');
			$('#title').focus();
			return false;
		}

		//유관기사 업데이트
		var relate = "";
		$('#relate').find('li').each(function(){
			if(relate == "") relate = $(this).data('item');
			else relate = relate + "," + $(this).data('item');
		});
		$('#related').val(relate);

		//원소스
		var osmu = "";
		$('#onesource').find('li').each(function(){
			if(osmu == "") osmu = $(this).data('item');
			else osmu = osmu + "," + $(this).data('item');
		});
		$('#osmu').val(osmu);

		//html 업데이트
		getContetHtml();
		if($('#contents').val().trim() == ""){
			alert('내용을 입력하여 주세요');
			$('#editorWriter').focus();
			return false;
		}

		return true;
	}

	function js_open_pop(type){
		var url = '/contents/' + type;
		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function js_set_column(id, title){
		$('#column_id').val(id);
		$('#column_title').val(title);
		close_iframe();						
	}
	function js_set_minsopick(id, title){
		$('#minsopick_id').val(id);
		$('#minsopick_title').val(title);
		close_iframe();						
	}


	function js_open_preview(){
		var url = '/preview/contents/temp';
		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function close_iframe(){
		//alert('미리보기가 지원되지 않습니다');
		act_popup_close();
		$('#popup_iframe').attr('src','about:blank');
	}

</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
