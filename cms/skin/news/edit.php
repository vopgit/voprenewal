<?php
$_menu_code = '0501';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <div class="row mb_20">
            <div class="col_12"><h3 class="">노출수정</h3></div>
            <div class="col_12 t_right">
                <button type="button" class="fs_13 flex ai_c ml_auto" onclick="ranking();">
                    <i class="iconFt_icon20 fs_16 mr_5"></i>
                    순위별 노출 위치
                </button>
            </div>
        </div>
        <div class="exp_box mb_15">
            <div class="row wp_30">
                <div class="col_12">
                    <h3 class="fs_18 mb_15">
                        <?=$rs2['title']?>
                    </h3>
                    <p>
                        <?=$rs2['description']?>
                    </p>
                </div>
                <div class="col_12">
                    <div class="row">
                        <div class="col_5 t_center">
                            <strong>관련기사</strong>
                        </div>
                        <div class="col_19">
                            <ul class="list_bullet">
								<?php foreach($rs2['relate'] as $relate) { ?>
									<?php //id, serial, title; ?>	
									<li><!-- <font style="color:#999">[<?=$relate['serial']?>]</font>&nbsp;  --><?=$relate['title']?></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- exp_box :: end -->
        <div class="t_right writer_info fs_14 mb_40">
            <ul class="row jc_fe">
                <li class="col_"><b class="lb">작성자</b><?=$rs2['writer_name']?></li>
                <?php if($rs2['contributor'] != ''){ ?>
					<li class="col_"><b class="lb">노출이름</b><?=$rs2['contributor']?></li>
				<?php } ?>
            </ul>
        </div>

        <?
        ### -------------------------- ###
        # 임시로 입력한 name값 입니다.
        # 기사등급          - article_level
        # 스타일            - article_style
        # 태그 색상         - tag_color
        # 사용자 색상 class - tag + c1 ~ c4
        ### -------------------------- ###
        ?>


        <div class="area_box">
            <form name="frm" id="frm" method="post" enctype="multipart/form-data">
	
				<input type="hidden" name="mode" id="mode" value="modify">
				<input type="hidden" name="top_id" value="<?=$top_id?>">
				<input type="hidden" name="old_photo" value="<?=$rs['thumbnail1']?>">
				<input type="hidden" name="refer" value="<?=$refer?>">
				<input type="hidden" name="nPage" value="<?=$nPage?>">
                
				<div class="table_box horizontal ty_counting t_center border0">
                    <table>
                        <colgroup>
                            <col style="width: 260px;">
                            <col style=" ">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="td_thumb va_t">
                                    <div class="photo_thumb_box ty_ract">
                                        <div class="thumb">
                                            <img src="<?=$rs['photo']?>" alt="">
                                        </div>
                                        <p class="subs t_right">
                                            * 800x470 사이즈 권장
                                        </p>
                                    </div>
									<?php if($rs['thumbnail1'] != ''){ ?>
                                    <div class="in_multy_radio jc_se mt_30 dif_sel">
                                        <label class="fm_ch "><input name="del_img" type="checkbox" title="" value="Y"><span class="_icon"></span>삭제시 체크하세요</label>
                                    </div>
									<?php } ?>
                                    <div class="file_box jc_c pt_30">
                                        <div class="file_con">
                                            <input type="file" name="userfile" id="user_file">
                                            <button onclick="act_file.act_click(this)" type="button" class="btn file">파일선택</button>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </td>
                                <!-- 사진 :: end -->
                                <td class="p_30">
                                    <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                        <div class="col_12">
                                            <div class="flex ai_c">
                                                <label for="">기사등급</label>
                                                <span class="fs_13 ml_auto mr_5 tc_b5">*  Top : 1~3순위 / Minor : 4~6순위 / Sub : 7~22순위</span>
                                            </div>

                                            <div class="row mt_10">
                                                <div class="col_12 in_multy_radio j_right">
                                                    <label for="artLvT" class="fm_rd">
                                                        <input name="article_level" id="artLvT" value="TOP" type="radio" class="js_art_lvl lvl_top js_edit_opt" data-target=".js_edit_tg" data-lange="1,3" <?=($rs['grade'] == "TOP") ? "checked" :""; ?>>
                                                        <span class="fs_13">Top</span>
                                                    </label>
                                                    <label for="artLvM" class="fm_rd">
                                                        <input name="article_level" id="artLvM" value="MINOR" type="radio" class="js_art_lvl lvl_minor js_edit_opt" data-target=".js_edit_tg" data-lange="4,6" <?=($rs['grade'] == "MINOR") ? "checked" :""; ?>>
                                                        <span class="fs_13">Minor</span>
                                                    </label>
                                                    <label for="artLvS" class="fm_rd">
                                                        <input name="article_level" id="artLvS" value="SUB" type="radio" class="js_art_lvl lvl_sub js_edit_opt" data-target=".js_edit_tg" data-lange="7,22" <?=($rs['grade'] == "SUB") ? "checked" :""; ?>>
                                                        <span class="fs_13">Sub</span>
                                                    </label>
                                                </div>
                                                <div class="col_12">
                                                    <span class="sel_box">
                                                        <select name="priority" id="priority" <?=($rs['priority'] < 1 && $rs['grade'] != "SUB") ? "disabled" :""; ?>  class="sel fm_full placeholder <?=($rs['priority'] < 1 && $rs['grade'] != "SUB") ? "disabled" :""; ?>  __customUi js_edit_tg" data-comm-txt="순위">
                                                            <option value="">선택</option>
															<?php for($i=$option_start; $i<=$option_end; $i++) { ?>
															<option value="<?=$i?>" <?=($i == $rs['priority']) ? "selected" : "";?>><?=$i?> 순위</option>
															<?php } ?>
														</select>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col_12">
                                            <label for="">스타일</label>
                                            <div class="in_multy_radio j_right mt_10">
                                                <label for="artSty1" class="fm_rd">
                                                    <input name="article_style" id="artSty1" value="both" type="radio" class="article_style disabled" <?=($rs['priority'] < 7 && $rs['grade'] != "SUB") ? "disabled" :""; ?> <?=($rs['style'] == "both") ? "checked" :""; ?>>
                                                    <span class="fs_13">제목+설명</span>
                                                </label>
                                                <label for="artSty2" class="fm_rd">
                                                    <input name="article_style" id="artSty2" value="title" type="radio" class="article_style disabled" <?=($rs['priority'] < 7 && $rs['grade'] != "SUB") ? "disabled" :""; ?> <?=($rs['style'] == "title") ? "checked" :""; ?>>
                                                    <span class="fs_13">제목</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col_12">
                                            <label for="">태그 색상</label>
                                            <!-- ### ======================= ### -->
                                            <!-- ### 사용자단 class           ###-->
                                            <!-- ### tag + c1 ~ c4           ### -->
                                            <!-- ### ex) class="tag c1"      ### -->
                                            <!-- ### ======================= ### -->
                                            <div class="flex ai_c jc_sb in_multy_radio j_right mt_10">
                                                <label for="tagColorN" class="fm_rd">
                                                    <input type="radio" name="tag_color" id="tagColorN" value="" <?=($rs['box_style'] == "") ? "checked" :""; ?>>
                                                    <span class="fs_13">
                                                        사용 안함
                                                    </span>
                                                </label>
                                                <label for="tagColorB" class="fm_rd">
                                                    <!-- 색상 : #369ff8 -->
                                                    <input type="radio" name="tag_color" id="tagColorB" value="tagColorB" <?=($rs['box_style'] == "tagColorB") ? "checked" :""; ?>>
                                                    <span class="rd_color_box bc_1">
                                                        <i class="text_hide">파란색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorR" class="fm_rd">
                                                    <!-- 색상 : #ed3b31 -->
                                                    <input type="radio" name="tag_color" id="tagColorR" value="tagColorR" <?=($rs['box_style'] == "tagColorR") ? "checked" :""; ?>>
                                                    <span class="rd_color_box bc_2">
                                                        <i class="text_hide">빨간색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorG" class="fm_rd">
                                                    <!-- 색상 : #238210 -->
                                                    <input type="radio" name="tag_color" id="tagColorG" value="tagColorG" <?=($rs['box_style'] == "tagColorG") ? "checked" :""; ?>>
                                                    <span class="rd_color_box bc_3">
                                                        <i class="text_hide">초록색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorBL" class="fm_rd">
                                                    <!-- 색상 : #666666 -->
                                                    <input type="radio" name="tag_color" id="tagColorBL" value="tagColorBL" <?=($rs['box_style'] == "tagColorBL") ? "checked" :""; ?>>
                                                    <span class="rd_color_box bc_4">
                                                        <i class="text_hide">검은색</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col_12">
                                            <label for="">태그명</label>
                                            <input type="text" name="box_title" id="box_title" value="<?=$rs['box_title']?>" class="inp inp_sm fm_full mt_10" maxlength="30">
                                        </div>
                                        <div class="col_24">
                                            <label for="">노출제목</label>
                                            <input type="text" name="title" id="title" value="<?=$rs['title']?>" class="inp inp_sm fm_full mt_10" maxlength="250" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)">
                                        </div>
                                        <div class="col_24">
                                            <label for="">기사설명</label>
                                            <textarea name="description" id="description" class="ft mt_10" style="height:5rem;" placeholder="기사설명 (미 입력 시 기사 원 기사설명을 사용합니다.)"><?=$rs['description']?></textarea>
                                        </div>
                                        <div class="col_24">
                                            <label for="">관련기사</label>
                                            <ul class="move_inp_box mt_10">
                                                <li class="row lst_item">
                                                    <div class="col_19 inp_box row">
                                                        <div class="col_18">
                                                            <input type="text" name="relate_title[]" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full" maxlength="250" value="<?=$related[0]->title?>">
                                                        </div>
                                                        <div class="col_6">
                                                            <input type="text" name="relate_serial[]" placeholder="시리얼넘버" class="inp inp_sm fm_full" maxlength="12" value="<?=$related[0]->serial?>">
                                                        </div>
                                                    </div>
                                                    <div class="col_5 cnt_box pl_10 flex ai_c">
                                                        <div class="move_floor">
                                                            <button onclick="moveNode('up')" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                            <button onclick="moveNode('down')" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                        </div>
                                                        <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
                                                        <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
                                                    </div>
                                                </li>
												<?php for($i=1; $i<count($related); $i++) { ?>
                                                <li class="row lst_item">
                                                    <div class="col_19 inp_box row">
                                                        <div class="col_18">
                                                            <input name="relate_title[]" type="text" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full" maxlength="250" value="<?=$related[$i]->title?>">
                                                        </div>
                                                        <div class="col_6">
                                                            <input name="relate_serial[]" type="text" placeholder="시리얼넘버" class="inp inp_sm fm_full" maxlength="12" value="<?=$related[$i]->serial?>">
                                                        </div>
                                                    </div>
                                                    <div class="col_5 cnt_box pl_10 flex ai_c">
                                                        <div class="move_floor">
                                                            <button onclick="moveNode('up')" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                            <button onclick="moveNode('down')" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                        </div>
                                                        <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
                                                        <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
                                                    </div>
                                                </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- row :: end -->
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <!-- table_box :: end -->
            </form>
        </div>


        <div class="row mtb_30">
            <button class="btn_lg btn" onclick="js_list()">목록으로</button>
            <div class="col_ ml_auto">
                <button onclick="" type="button" class="btn_lg btn_c2 btn_submit">편집 완료</button>
            </div>
        </div>

    </div>

</div>

<script>
$(function() {
    // 기사등급 선택에 따른 select박스 변경
    js_edit_opt();

    // Sub 선택에 따른 스타일 radio버튼 disabled
    chg_articleStyle();

	$('.btn_submit').on('click', function(){

		var level = $(":radio[name='article_level']:checked").val();
		if(level == '' || level == undefined){
			alert('기사 등급을 선택하여 주세요');
			return false;
		}
		if($("#priority").val() == "" || $("#priority").val() == "선택"){
			alert('기사 순위를 선택하여 주세요');
			return false;
		}

		if(level == "SUB"){		
			var style = $(":radio[name='article_style']:checked").val();
			if(style == '' || style == undefined){
				alert('스타일을 선택하여 주세요');
				return false;
			}
		}

		var tag_color = $(":radio[name='tag_color']:checked").val();
		if(tag_color != ''){
			if($('#box_title').val().trim() == ""){
				alert('태그명을 입력하여 주세요');
				$('#box_title').focus();
				return false;
			}
		}

		//관련기사 제목 및 시리얼 체크
		var isValid = true;
		$(":text[name='relate_title[]']").each(function(index){
			var r_title = $(this).val().trim();
			var r_serial = $(":text[name='relate_serial[]']").eq(index).val().trim();

			//if(r_title != '' || r_serial != ''){
			if(r_serial != ''){				
				/*
				if(r_title == ''){
					isValid = false;
					alert('관련기사 제목을 입력하여 주세요');
					$(this).focus();
					return false;
				}
				*/
				if(r_serial == '' || r_serial.length != 12){
					isValid = false;
					alert('관련기사 시리얼을 바르게 입력하여 주세요');
					$(":text[name='relate_serial[]']").eq(index).focus();
					return false;
				}
			}
		});


		if(isValid){
			if(confirm('저장하시겠습니까?')){			
				$('#frm').attr('action', '/news/dml');
				$('#frm').submit();
			}
		}
	});
});

$(document).ready(function() {

});

function js_list(){
	location.href = "/news/<?=$refer?><?=$param['query']?>";
}
function chg_articleStyle() {
    $('.js_art_lvl').on('change', function() {
        if($(this).hasClass('lvl_sub')) {
            $('.article_style').removeClass('disabled').prop('disabled',false);
        }else {
            $('.article_style').addClass('disabled').prop('disabled',true);
            $('.article_style:checked').prop('checked',false);
        }
    })
}
function js_edit_opt() {
    if($('.js_edit_opt').length < 1) return;
    $('.js_edit_opt').on('change', function(e) {
        var opt_lng = $(this).data('lange').split(',');
        var tg = $($(this).data('target'));
        if(tg.hasClass('disabled')) {
            tg.removeClass('disabled').removeAttr('disabled');
        }
        var comm_txt = '';
        if(tg.data('comm-txt') != '') {
            comm_txt = tg.data('comm-txt');
        }
        var MIN = parseInt(opt_lng[0]);
        var MAX = parseInt(opt_lng[1]);
        var docFrag = document.createDocumentFragment();
        for(var i = MIN; i <= MAX; i++) {
            if(i == MIN) {
                var sel_opt = document.createElement('option');
                sel_opt.innerText = '선택';
                docFrag.appendChild(sel_opt);
            }
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerText = String(i+' '+comm_txt);
            docFrag.appendChild(opt);
        }
        tg[0].innerHTML = '';
        tg[0].appendChild(docFrag);
    })
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
