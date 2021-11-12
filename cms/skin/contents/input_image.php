<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>

<link rel="stylesheet" type="text/css" media="screen" href="/resource/css/demo.html5imageupload.css" />

<div class="contain">

    <div class="wrap">
        <form method="post" onsubmit="return false;">

            <h3 class="mb_15">기사 입력</h3>
            
            <!--기사종류 : 포토뉴스 : 사진입력 -->
            <div class="row ">
                <div class="col_24">
                    <div class=" poto_box">
                        <div class="row">
                            <div class="col_5 ">
                                <div class="poto_con ">
                                    <div class="t_left row">
                                        <span class="fs_14">PC</span>
                                    </div>
                                    <div class="add_img" style>
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" name="list_photo" id="list_photo" accept="image/*">
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_5 border_left">
                                <div class="poto_con">
                                    <div class=" row jc_sb">
                                        <span class="fs_14">MOBILE</span>
                                        <p class="fs_13 tc_b4">
                                            * 모바일 해상도에서 <BR>
                                            자동 교체되는 이미지
                                        </p>

                                    </div>

                                    <div class="add_img">
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" name="list_photo_m" id="list_photo_m" accept="image/*">
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_14">
                                <div class="row poto_con border_left">
                                    <div class="col_12 pr_15">
                                        <div class="mb_10">
                                            <p class="mb_10">제목</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                        <div class="mb_15 tc_b4">
                                            <p class="mb_10">저작권자</p>
                                            <label class="fm_rd ">
                                                <input type="radio" name="radio">
                                                <span class="fs_13">민중의소리 (워터마크 표시)</span>
                                            </label>

                                            <label class="fm_rd ml_10 fs_13">
                                                <input type="radio" name="radio" class="readChange">
                                                <span class="fs_13"> 기타 (워터마크 없음)</span>
                                            </label>
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">작성자</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                    </div>
                                    <div class="col_12 pl_15">
                                        <div class="mb_10">
                                            <p class="mb_10">설명</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">&nbsp;</p>
                                            <input type="text" class="inp inp_sm fm_full read_only act_read" readonly >
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">태그</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p class="tc_b4 fs_13 mt_10"> * (PC/MOBILE)  800x470 사이즈 권장</p>
                    <!--사진올리기-->
                </div>
            </div>

            <div class="row wp_20 pt_40 pb_30">
                <div class="col_">
                    <a href="javascript:;" onclick="js_list()" class="btn_lg btn_full">목록으로</a>
                </div>
                <div class="col_ ml_auto">
                    <?php if($is_allow_modify){ ?>
						<button type="button" class="btn_lg btn_c2 btn_full"><span>기사 입력 완료</span></button>
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
		location.href = "/contents/list<?=$param['query']?>";
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
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
