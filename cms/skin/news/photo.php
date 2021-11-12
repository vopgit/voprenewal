<?php
$section = 'photo';
$_menu_code = '0502';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">메인 섹션 관리</h3>

        <div class="area_box">

			<?php include $_SERVER["DOCUMENT_ROOT"].'/skin/news/tab_menu.php'; ?>

			<form name="frm" id="frm" method="post" onsubmit="return false;" enctype="multipart/form-data">

				<input type="hidden" name="section_category" id="section_category" value="<?=$section?>">
				<input type="hidden" name="returnUrl" value="<?=urlencode($param['query'])?>">

				<input type="hidden" name="str_section_id" id="str_section_id" value="<?=$str_section_id?>">
				<input type="hidden" name="str_del_section_id" id="str_del_section_id" value="">

                <div class="area_con_box">
					<?
					for ($j = 0 ; $j < count($rs); $j++) {

						$type_info = "";

						if($rs[$j]['type'] == 'photo'){
							$type_info = $rs[$j]['serial'];
						}else{
							$type_info = $rs[$j]['youtube'];
						}
					?>
                    <div class="table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left">
                                                <span class="num_count"><?=$j+1?></span>
												<input type="hidden" name="section_id[]" id="section_id" value="<?=$rs[$j]['id']?>">
                                            </div>

											<div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs_type()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs_type()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                    <button onclick="delBox(this, '<?=$rs[$j]['id']?>')" name="" id="" class="btn btn_c14 btn_sm" type="button">삭제</button>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td class="td_thumb">
                                        <div class="photo_thumb_box ty_ract">
                                            <div class="thumb">
												<?php if($rs[$j]['filepath'] != ''){ ?>
													<img src="<?=$rs[$j]['photo']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>
                                            </div>

											<input type="hidden" name="old_input_thumb[]" value="<?=$rs[$j]['file_real_name']?>">

                                        </div>
                                        <div class="row jc_se mt_30 dif_sel">

											<?php if(($rs[$j]['filepath'] != '')&&($rs[$j]['filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag[]" id="flag" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag[]" value="">
											<?php }?>

											<!--
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" value="" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" value="delete" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" value="update" title="">교체</label>
											-->
                                        </div>

                                        <div class="file_box jc_c pt_30" <?=(($rs[$j]['filepath'] != '')&&($rs[$j]['filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->

                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_24">
                                                <label for="">종류</label>
                                                <div class="in_multy_radio j_right mt_10">
                                                    <!-- ### ====================== ### -->
                                                    <!--  영상은 기본값으로 선택됩니다.   -->
                                                    <!-- ### ====================== ### -->
                                                    <label class="fm_rd">
                                                        <input type="radio" name="rd_type<?=$j?>[]" value="video" <?=(($rs[$j]['type'] == 'video')||($rs[$j]['type'] != 'photo'))?"checked":"" ?> class="act_type_chg"><span class="_icon"></span>
                                                        <span class="fs_13">영상</span>
                                                    </label>
                                                    <label class="fm_rd">
                                                        <input type="radio" name="rd_type<?=$j?>[]" value="photo" <?=($rs[$j]['type'] == 'photo')?"checked":"" ?> class="act_type_chg"><span class="_icon"></span>
                                                        <span class="fs_13">포토</span>
                                                    </label>

													<input type="hidden" name="type[]" value="<?=$rs[$j]['type']?>">
                                                </div>
                                            </div>
                                            <div class="col_12">
                                                <label for="">설명</label>
												<input type="text" name="description[]" value="<?=$rs[$j]['description']?>" maxlength="200" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title[]" value="<?=$rs[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
<!--
											<div class="col_24">
                                                <label for="">
                                                    <span class="is_type_chg">유튜브 URL</span>
                                                    <span class="is_type_chg">시리얼 넘버</span>
                                                </label>
												<input type="text" name="type_info[]" value="<?=$type_info?>" maxlength="150" class="inp inp_sm fm_full mt_10">
                                            </div>
-->

                                            <div class="col_24 is_type_chg">
                                                <label for="">유튜브 URL</label>
												<input type="text" name="youtube[]" value="<?=$rs[$j]['youtube']?>" maxlength="150" class="inp inp_sm fm_full mt_10">
                                                <input type="hidden" name="serial[]" disabled>
                                            </div>
                                            <div class="col_24 is_type_chg" style="display: none; ">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial[]" value="<?=$rs[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                                <input type="hidden" name="youtube[]" disabled>
                                            </div>

                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

					<?}?>
                    <!-- table_box :: end -->

                    <div class="add_box_lap mt_30">
                        <button onclick="addNewBox()" type="button" class="t_center">
                            박스 추가
                        </button>
                    </div>
                </div>
                <!-- area_con_box :: end -->
            </form>
        </div>


        <div class="row mtb_30">
            <div class="col_ ml_auto">
				<button onclick="js_save()" type="button" class="btn_lg btn_c2 ">편집 완료</button>
            </div>
        </div>

    </div>

</div>

<div class="progress_round_wrap" id="progress">
	<svg class="progress" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
	  <circle cx="32" cy="32" r="31"/>
	</svg>
	<div class="progress_num">100%</div>
</div>


<script>
    var boxHtml = '';
    $(function() {
        boxHtml += '<div class="table_box horizontal ty_counting t_center">';
        boxHtml +=     '<table><colgroup><col style="width: 260px;"><col style=" "></colgroup>';
        boxHtml +=     '<thead><tr><th colspan="2"><div class="row">';
        boxHtml +=         '<div class="col_8 t_left"><span class="num_count"></span><input type="hidden" name="section_id[]" id="section_id" value=""></div>';
        boxHtml +=         '<div class="col_16 t_right"><div class="in_multy_btn jc_fe j_right">';
        boxHtml +=             '<button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>';
        boxHtml +=             '<button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>';
        boxHtml +=             '<button onclick="$(this).closest(\'.table_box\').remove(); reNumbering()" name="" id="" class="btn btn_c14 btn_sm" type="button">삭제</button>';
        boxHtml +=         '</div></div></div></th>';
        boxHtml +=     '</tr></thead>';
        // thead :: end
        boxHtml +=     '<tbody><tr>';
        boxHtml +=     '<td class="td_thumb">';
        boxHtml +=         '<div class="photo_thumb_box ty_ract"><div class="thumb">';
        boxHtml +=             '<img src="/resource/images/no_image.jpg" alt="">';
        boxHtml +=         '</div>';
        // 권장 사이즈 영역
        boxHtml +=         '</div>';
        boxHtml +=         '<div class="file_box jc_c pt_30">';
        boxHtml +=             '<div class="file_con">';
		boxHtml +=					'<input type="hidden" name="flag[]" value="">';
		boxHtml +=                 '<input type="file" multiple="multiple" name="input_thumb[]">';
		boxHtml +=                 '<button type="button" onclick="act_file.act_click(this.parent)" class="btn file">파일선택</button>';
        boxHtml +=                 '<span class="file_name "></span>';
        boxHtml +=     '</div></div></td>';
        // 사진 :: end
        boxHtml +=     '<td><div class="row ai_stretch wp_30 wp_st_2 t_left">';
        boxHtml +=         '<div class="col_24"><label for="">종류</label>';
        boxHtml +=             '<div class="in_multy_radio j_right mt_10"><label class="fm_rd">'
        boxHtml +=             '<input type="radio" name="rd_type[]" value="video" checked="true" class="act_type_chg"><span class="_icon"></span>\n'
        boxHtml +=             '<span class="fs_13">영상</span></label>'
        boxHtml +=             '<label class="fm_rd">'
        boxHtml +=             '<input type="radio" name="rd_type[]" value="photo" class="act_type_chg"><span class="_icon"></span>\n'
        boxHtml +=             '<span class="fs_13">포토</span></label></div>'
		boxHtml +=             '<input type="hidden" name="type[]" value="">\n'
        boxHtml +=         '</div>';

        // 종류 :: end
        boxHtml +=         '<div class="col_12"><label for="">설명</label>';
        boxHtml +=             '<input type="text" name="description[]" maxlength="200" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 설명 :: end
        boxHtml +=         '<div class="col_12">';
        boxHtml +=             '<label for="">제목</label>';
        boxHtml +=             '<input type="text" name="title[]" maxlength="80" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';

		// 제목 ::  end
//        boxHtml +=         '<div class="col_24"><label for="">';
//		boxHtml +=              '<span class="is_type_chg">유튜브 URL</span>';
//		boxHtml +=              '<span class="is_type_chg" style="display: none;">시리얼 넘버</span>';
//		boxHtml +=            '</label>';
//        boxHtml +=            '<input type="text" name="type_info[]" value="" maxlength="150" class="inp inp_sm fm_full mt_10">';
//        boxHtml +=         '</div>';

        // 제목 ::  end
        boxHtml +=         '<div class="col_24 is_type_chg"><label for="">유튜브 URL</label>';
        boxHtml +=             '<input type="text" name="youtube[]" maxlength="150" class="inp inp_sm fm_full mt_10">';
		boxHtml +=             '<input type="hidden" name="serial[]" disabled>';
        boxHtml +=         '</div>';
        // 유튜브 URL :: end
        boxHtml +=         '<div class="col_24 is_type_chg" style="display: none; "><label for="">시리얼 넘버</label>';
        boxHtml +=             '<input type="text" name="serial[]" maxlength="20" class="inp inp_sm fm_full mt_10">';
		boxHtml +=             '<input type="hidden" name="youtube[]" disabled>';
        boxHtml +=     '</div></div></td>';

		boxHtml +=     '</div></td>';

        // 시리얼 넘버 :: end
        // td :: end
        boxHtml += '</tr></tbody></table></div>';


        chgInpRd();	//video, photo 선택 이벤트 처리
        $(document).on('change', '.act_type_chg', chgInpRd);
    })

    function chgInpRd() {
        var t, idx, par, tg;
        try {
            // change 이벤트로 실행시
//            t = $(event.target);
//            idx = t.closest('label').index();
//            par = t.closest('.table_box');
//            tg = par.find('.is_type_chg');
//            tg.hide().eq(idx).show();

			t = $(event.target);
            idx = t.closest('label').index();
            par = t.closest('.table_box');
            tg = par.find('.is_type_chg');

			tg.find("input[name='youtube[]']").val("");
			tg.find("input[name='serial[]']").val("");

            tg.hide().eq(idx).show();

        }catch(err) {

            // window 이벤트(수정 페이지)시 실행
            var getChkAry = $('.act_type_chg:checked');
            getChkAry.each(function(idx, el) {
                t = $(this);
                idx = t.closest('label').index();
                par = t.closest('.table_box');
                tg = par.find('.is_type_chg');
                tg.hide().eq(idx).show();
            })
        }
    }

    function addNewBox() {
        var ary_maxNum = [];
        $(event.target).closest('div').before(boxHtml);
        var newTable = $(event.target).closest('div').prev();
        act_file.act_click(newTable.find('.file_box'));

		initNumbering($('.table_box'));

        //reNumbering();
        // $('.area_con_box').append(boxHtml);
    }

	var arr_del_section_id = new Array();

	function delBox(obj, idx){

		var _idx = idx;

		if($("#str_section_id").val() != ""){
			var arr_section_id = $("#str_section_id").val().split(",");

			if((_idx != "")&&(arr_section_id.indexOf(_idx) >= 0)){
				arr_del_section_id.push(_idx);
				//var str_del_section_id = arr_del_section_id.toString();
				//$("#str_del_section_id").val(str_del_section_id);
			}
		}

		//alert($("#str_del_section_id").val());

		$(obj).closest('.table_box').remove();
		//reNumbering();
		initNumbering($('.table_box'));
	}

    // 번호 재할당
    function reNumbering() {
        $('.area_con_box .table_box').each(function(idx, el) {
            $(this).find('.num_count').text(idx + 1);
            $(this).find('.in_multy_radio').each(function(sec_idx, el) {
                $(this).find('input[type=radio]').attr('name','rd_type'+(idx)+'[]');
            })
        })
    }


	// 박스 이동
	function moveSectionBoxs_type() {
		var tg = $(event.target);
		var direct = tg.attr('class').indexOf('up') != -1 ? 'up' : 'down';
		var tbl = tg.closest('.table_box');
		var sibAry = tbl.parent().find('.table_box:not(".fix")');
		var idx;
		// area_con_box 가 없으면 return;
		if($('.table_box').closest('.area_con_box').length < 1) return;
		idx = sibAry.index(tbl);

		if(idx == 0 && direct == 'up') {
			return alert('최상위 입니다.');
		}else if(idx + 1 == sibAry.length  && direct == 'down') {
			return alert('최하위 입니다.');
		}
		if(direct == 'up') {
			tbl.prev().before(tbl);
		}else {
			tbl.next().after(tbl);
		}
		initNumbering(tbl);
	}


	// 번호 재할당

//	function initNumbering() {
//        $('.area_con_box .table_box').each(function(idx, el) {
//            $(this).find('.num_count').text(idx + 1);
//
//			_type =$(this).find('.in_multy_radio input[type=radio]:checked').val();
//
//			alert(_type);
//
//            $(this).find('.in_multy_radio').each(function(sec_idx, el) {
//                $(this).find('input[type=radio]').prop('name','rd_type'+(idx)+'[]');
//            })
//        })
//    }

	function initNumbering(tbl) {
		var par = tbl.closest('.area_con_box');

        var befAry = par.find('.in_multy_radio input[type=radio]:checked');

		par.find('.table_box').each(function(idx, el) {
			$(this).find('.num_count').text(idx + 1);

			$(this).find('.in_multy_radio input[type=radio]').attr('name','rd_type'+idx+'[]');
            //if(!$(befAry[idx]).is(':checked')) $(befAry[idx]).prop('checked',true);
			$(befAry[idx]).prop('checked',true);
		})
	}



	function js_fileView(obj) {

		//var frm = document.frm;
		var t = event.target;
		console.log(t.value);


		if(t.value == 'update') {
			$(t).parent().parent().parent().parent().find('.file_box').css("display", "block");
		}else {
			$(t).parent().parent().parent().parent().find('.file_box').css("display", "none");
		}

//		if (obj.selectedIndex == 2) {
//			$('.file_change').css("display", "block");
//		} else {
//			$('.file_change').css("display", "none");
//		}

	}

	var dup_submit_flag = 'N';	//중복 작업 처리

	function js_save() {

		if(dup_submit_flag == 'N'){

			var _description = "";	//설명
			var _type = "";	//영상, 포토
			var _title = "";	//제목
			var _serial = "";	//시리얼 넘버
			var _youtube = "";	//유튜브 URL
			var _section_id = "";	//고유번호 (수정시 사용)

			if ( $('div.table_box').length > 0 ) {

				var isValid = true;

				$('.table_box').each(function(idx){

					_type =$(this).find('input:radio[name="rd_type'+idx+'[]"]:checked').val();

					if(isEmpty(_type)){
						alert('종류를 선택해 주세요.');
						$(this).find("input:radio[name='rd_type"+idx+"[]']").focus();
						isValid = false;
						return false;
					}

					$(this).find("input[name='type[]']").val(_type);

					//_description = $("input[name='description[]']:eq("+idx+")").val();
					_description = $(this).find("input[name='description[]']").val();

					if(isEmpty(_description)){
						alert('설명을 입력해 주세요.');
						$(this).find("input[name='description[]']").focus();
						isValid = false;
						return false;
					}

					//_title = $("input[name='title[]']:eq("+idx+")").val();
					_title = $(this).find("input[name='title[]']").val();

					if(isEmpty(_title)){
						alert('제목을 입력해 주세요.');
						$(this).find("input[name='title[]']").focus();
						isValid = false;
						return false;
					}

					if(_type == "photo"){

						_serial = $(this).find("input[name='serial[]']:eq(1)").val();

						console.log(_serial);

						if(isEmpty(_serial)){
							alert('시리얼 넘버를 입력해 주세요.');
							$(this).find("input[name='serial[]']:eq(1)").focus();
							isValid = false;
							return false;
						}
					}else{

						_youtube = $(this).find("input[name='youtube[]']:eq(0)").val();

						console.log(_youtube);

						if(isEmpty(_youtube)){
							alert('유튜브 URL을 입력해 주세요.');
							$(this).find("input[name='youtube[]']:eq(0)").focus();
							isValid = false;
							return false;
						}
					}

				});

				if(arr_del_section_id.length > 0){
					var str_del_section_id = arr_del_section_id.toString();
					$("#str_del_section_id").val(str_del_section_id);

					//alert($("#str_del_section_id").val());
				}

				if(!isValid){
					return isValid;
				}

			}else{
				alert("최소 한개 이상의 섹션 정보를 입력해 주세요.");
				return false;
			}

			var _msg = "편집 완료 하시겠습니까?";

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
					url:"/news/dml",
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

						//console.log("aaaaaaaa :: "+result);

						$('#per').text('100%');
						$("#progressbar").progressbar({value: 100});

						if(result.code == "success"){
							var timerId = setInterval(function(){
								 //if(upload_flag == "Y"){
									 alert("편집 완료 됬습니다.");
									 location.replace('/news/photo');
									 //location.reload();
									 clearInterval(timerId);
								 //}
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

	}



</script>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
