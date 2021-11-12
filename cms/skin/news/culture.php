<?php
$section = 'culture';
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

				<input type="hidden" name="str_section_id_entertainment" id="str_section_id_entertainment" value="<?=$str_section_id_entertainment?>">
				<input type="hidden" name="str_culture_section_id_culture" id="str_culture_section_id_culture" value="<?=$str_culture_section_id_culture?>">
				<input type="hidden" name="str_sports_section_id_sports" id="str_sports_section_id_sports" value="<?=$str_sports_section_id_sports?>">

                <div class="area_con_box">
                    <h4 class="sq_tit mb_20">
                        연예
                    </h4>

					<?
					for ($j = 0 ; $j < count($rs_entertainment); $j++) {
					?>

					<div class="table_box_entertainment table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$j+1?></span>
												<input type="hidden" name="section_id_entertainment[]" id="section_id" value="<?=$rs_entertainment[$j]['id']?>">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
												<?php if($rs_entertainment[$j]['filepath'] != ''){ ?>
													<img src="<?=$rs_entertainment[$j]['photo']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">

											<?php if(($rs_entertainment[$j]['filepath'] != '')&&($rs_entertainment[$j]['filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_entertainment[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_entertainment[]" value="">
											<?php }?>
                                        </div>

                                        <div class="file_box jc_c pt_30" <?=(($rs_entertainment[$j]['filepath'] != '')&&($rs_entertainment[$j]['filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_entertainment[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
												<input type="text" name="description_entertainment[]" value="<?=$rs_entertainment[$j]['description']?>" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_entertainment[]" value="<?=$rs_entertainment[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_entertainment[]" value="<?=$rs_entertainment[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>


                    <? for($i = $j; $i <= 2; $i++) { ?>
                    <div class="table_box_entertainment table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i+1?></span>
												<input type="hidden" name="section_id_entertainment[]" id="section_id" value="">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
                                                <img src="/resource/images/no_image.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<!--
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
										-->

                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" name="input_thumb_entertainment[]">
                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
												<input type="hidden" name="flag_entertainment[]" value="">
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" name="description_entertainment[]" value="" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_entertainment[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_entertainment[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>
                </div>
                <!-- area_con_box :: end -->





                <div class="area_con_box">
                    <h4 class="sq_tit mb_20">
                        문화
                    </h4>

					<?
					for ($j = 0 ; $j < count($rs_culture); $j++) {
					?>

					<div class="table_box_culture table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$j+1?></span>
												<input type="hidden" name="section_id_culture[]" id="section_id" value="<?=$rs_culture[$j]['id']?>">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
												<?php if($rs_culture[$j]['filepath'] != ''){ ?>
													<img src="<?=$rs_culture[$j]['photo']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">

											<?php if(($rs_culture[$j]['filepath'] != '')&&($rs_culture[$j]['filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_culture[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_culture[]" value="">
											<?php }?>
                                        </div>

                                        <div class="file_box jc_c pt_30" <?=(($rs_culture[$j]['filepath'] != '')&&($rs_culture[$j]['filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_culture[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
												<input type="text" name="description_culture[]" value="<?=$rs_culture[$j]['description']?>" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_culture[]" value="<?=$rs_culture[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_culture[]" value="<?=$rs_culture[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>


                    <? for($i = $j; $i <= 2; $i++) { ?>
                    <div class="table_box_culture table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i+1?></span>
												<input type="hidden" name="section_id_culture[]" id="section_id" value="">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
                                                <img src="/resource/images/no_image.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<!--
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
										-->

                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" name="input_thumb_culture[]">
                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
												<input type="hidden" name="flag_culture[]" value="">
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" name="description_culture[]" value="" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_culture[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_culture[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>
                </div>
                <!-- area_con_box :: end -->





                <div class="area_con_box">
                    <h4 class="sq_tit mb_20">
                        스포츠/헬스
                    </h4>

					<?
					for ($j = 0 ; $j < count($rs_sports); $j++) {
					?>

					<div class="table_box_sports table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$j+1?></span>
												<input type="hidden" name="section_id_sports[]" id="section_id" value="<?=$rs_sports[$j]['id']?>">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
												<?php if($rs_sports[$j]['filepath'] != ''){ ?>
													<img src="<?=$rs_sports[$j]['photo']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">

											<?php if(($rs_sports[$j]['filepath'] != '')&&($rs_sports[$j]['filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_sports[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_sports[]" value="">
											<?php }?>
                                        </div>

                                        <div class="file_box jc_c pt_30" <?=(($rs_sports[$j]['filepath'] != '')&&($rs_sports[$j]['filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_sports[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
												<input type="text" name="description_sports[]" value="<?=$rs_sports[$j]['description']?>" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_sports[]" value="<?=$rs_sports[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_sports[]" value="<?=$rs_sports[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>


                    <? for($i = $j; $i <= 2; $i++) { ?>
                    <div class="table_box_sports table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i+1?></span>
												<input type="hidden" name="section_id_sports[]" id="section_id" value="">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" onclick="moveSectionBoxs()" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
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
                                                <img src="/resource/images/no_image.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<!--
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
										-->

                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" name="input_thumb_sports[]">
                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
												<input type="hidden" name="flag_sports[]" value="">
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" name="description_sports[]" value="" maxlength="250" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_sports[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_sports[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>
                                        </div>
                                        <!-- row :: end -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- table_box :: end -->
                    <? } ?>
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
			var _title = "";	//제목
			var _serial = "";	//시리얼 넘버
			var _section_id = "";	//고유번호 (수정시 사용)


			var isValid = true;

			//연예
			$('.table_box_entertainment').each(function(idx){

				_description = $("input[name='description_entertainment[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('연예 부문 설명을 입력해 주세요.');
					$("input[name='description_entertainment[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_title = $("input[name='title_entertainment[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('연예 부문 제목을 입력해 주세요.');
					$("input[name='title_entertainment[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_entertainment[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('연예 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_entertainment[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

			});

			
			if(!isValid){
				return isValid;
			}

			//문화
			$('.table_box_culture').each(function(idx){

				_description = $("input[name='description_culture[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('문화 부문 설명을 입력해 주세요.');
					$("input[name='description_culture[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_title = $("input[name='title_culture[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('문화 부문 제목을 입력해 주세요.');
					$("input[name='title_culture[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_culture[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('문화 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_culture[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

			});

			
			if(!isValid){
				return isValid;
			}

			//스포츠
			$('.table_box_sports').each(function(idx){

				_description = $("input[name='description_sports[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('스포츠 부문 설명을 입력해 주세요.');
					$("input[name='description_sports[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_title = $("input[name='title_sports[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('스포츠 부문 제목을 입력해 주세요.');
					$("input[name='title_sports[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_sports[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('스포츠 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_sports[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

			});


			if(!isValid){
				return isValid;
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
									 location.replace('/news/culture');
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
