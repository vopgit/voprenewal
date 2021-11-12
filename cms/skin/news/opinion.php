<?php
$section = 'opinion';
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

				<input type="hidden" name="str_section_id_editorial" id="str_section_id_editorial" value="<?=$str_section_id_editorial?>">
				<input type="hidden" name="str_section_id_column" id="str_section_id_column" value="<?=$str_section_id_column?>">
				<input type="hidden" name="str_section_id_column_top" id="str_section_id_column_top" value="<?=$str_section_id_column_top?>">

                <div class="area_con_box multy">
                    <h4 class="sq_tit mb_20">
                        사설
                    </h4>

					<?
					for ($j = 0 ; $j < count($rs_editorial); $j++) {
					?>

                    <div class="table_box_editorial table_box horizontal ty_counting t_center">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$j+1?></span>
												<input type="hidden" name="section_id_editorial[]" id="section_id" value="<?=$rs_editorial[$j]['id']?>">
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" onclick="moveSectionBoxs()" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" onclick="moveSectionBoxs()" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">

											<div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_editorial[]" value="<?=$rs_editorial[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_editorial[]" value="<?=$rs_editorial[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>

											<div class="col_24">
                                                <label for="">설명</label>
												<textarea name="description_editorial[]" class="ft mt_10" style="height:5rem;"><?=$rs_editorial[$j]['description']?></textarea>
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

					<? for($i = $j; $i <= 1; $i++) { ?>

                    <div class="table_box_editorial table_box horizontal ty_counting t_center">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <div class="row">
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i+1?></span>
												<input type="hidden" name="section_id_editorial[]" id="section_id" value="">
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
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">

											<div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_editorial[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_editorial[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>

											<div class="col_24">
                                                <label for="">설명</label>
												<textarea name="description_editorial[]" class="ft mt_10" style="height:5rem;"></textarea>
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

                <!-- 칼럼 :: start -->
                <div class="area_con_box multy in_inq">
                    <div class="row ai_c mb_20">
                        <div class="col_">
                            <h4 class="sq_tit">
                                칼럼
                            </h4>
                        </div>
                        <div class="col_ ml_auto tc_3 fs_14">
                            * 2~4번째 칼럼은 <b><u>오피니언 메인과 메인</u></b>에 노출됩니다. 1번째, 5번째 칼럼은 <b><u>오피니언 메인에만</u></b> 노출됩니다.
                        </div>
                    </div>

					<?
					for ($j = 0 ; $j < count($rs_column_top); $j++) {
					?>
                    <div class="table_box_column_top table_box horizontal ty_counting t_center fix">
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
												<input type="hidden" name="section_id_column_top[]" id="section_id" value="<?=$rs_column_top[$j]['id']?>">
												<input type="hidden" name="top_tf[]" id="top_tf" value="Y">
                                                <b class="fw_400 tc_3 is_inq">*</b>
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
												<?php if($rs_column_top[$j]['thumb_filepath'] != ''){ ?>
													<img src="<?=$rs_column_top[$j]['photo_opinion_thumb']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

                                        <div class="row in_multy_radio jc_se mt_30 dif_sel">
											<?php if(($rs_column_top[$j]['thumb_filepath'] != '')&&($rs_column_top[$j]['thumb_filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_column_top[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_column_top[]" value="">
											<?php }?>
                                        </div>

										<div class="file_box jc_c pt_30" <?=(($rs_column_top[$j]['thumb_filepath'] != '')&&($rs_column_top[$j]['thumb_filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_column_top[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>

                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
											<div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_column_top[]" value="<?=$rs_column_top[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_column_top[]" value="<?=$rs_column_top[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>

											<div class="col_24">
                                                <label for="">설명</label>
												<textarea name="description_column_top[]" class="ft mt_10" style="height:5rem;"><?=$rs_column_top[$j]['description']?></textarea>
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

					<? for($i = $j; $i <= 0; $i++) { ?>

					<div class="table_box_column_top table_box horizontal ty_counting t_center fix">
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
												<input type="hidden" name="section_id_column_top[]" id="section_id" value="">
												<input type="hidden" name="top_tf[]" id="top_tf" value="Y">
                                                <b class="fw_400 tc_3 is_inq">*</b>
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

                                        <div class="row in_multy_radio jc_se mt_30 dif_sel">
											<input type="hidden" name="flag_column_top[]" value="">
                                        </div>

										<div class="file_box jc_c pt_30">
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_column_top[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>

                                    </td>
                                    <!-- 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
											<div class="col_12">
                                                <label for="">제목</label>
												<input type="text" name="title_column_top[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_column_top[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
                                            </div>

											<div class="col_24">
                                                <label for="">설명</label>
												<textarea name="description_column_top[]" class="ft mt_10" style="height:5rem;"></textarea>
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




					<?
					for ($j = 0 ; $j < count($rs_column); $j++) {
					?>
                    <div class="table_box_column table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <div class="row">
											<div class="col_8 t_left fs_16">
												<span class="num_count"><?=$j+2?></span>
												<input type="hidden" name="section_id_column[]" id="section_id" value="<?=$rs_column[$j]['id']?>">
												<input type="hidden" name="top_tf_column[]" id="top_tf" value="N">
                                                <b class="fw_400 tc_3 is_inq">*</b>
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
												<?php if($rs_column[$j]['thumb_filepath'] != ''){ ?>
													<img src="<?=$rs_column[$j]['photo_opinion_thumb']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 800x470 사이즈 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">
											<?php if(($rs_column[$j]['thumb_filepath'] != '')&&($rs_column[$j]['thumb_filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_column[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_column[]" value="">
											<?php }?>
                                        </div>

										<div class="file_box jc_c pt_30" <?=(($rs_column[$j]['thumb_filepath'] != '')&&($rs_column[$j]['thumb_filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_column[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td class="td_thumb">
										<div class="photo_thumb_box ty_circle">
                                            <div class="thumb">
												<?php if($rs_column[$j]['writer_filepath'] != ''){ ?>
													<img src="<?=$rs_column[$j]['photo_opinion_writer']?>" alt="">
												<?php }else{?>
													<img src="/resource/images/no_image_c.jpg" alt="">
												<?php }?>

                                            </div>
                                            <p class="subs t_right">
                                                * 1:1 비율 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">
											<?php if(($rs_column[$j]['writer_filepath'] != '')&&($rs_column[$j]['writer_filepath'] != 'NULL')){ ?>
											<div class="col_24">
												<select name="flag_column_writer[]" class="sel fm_full mt_10" onchange="js_fileView(this)">
													<option value="keep">이미지 유지</option>
													<option value="delete">이미지 삭제</option>
													<option value="update">이미지 교체</option>
												</select>
											</div>
											<?php }else{?>
												<input type="hidden" name="flag_column_writer[]" value="">
											<?php }?>
                                        </div>

										<div class="file_box jc_c pt_30" <?=(($rs_column[$j]['writer_filepath'] != '')&&($rs_column[$j]['writer_filepath'] != 'NULL'))?"style='display:none'":"" ?>>
                                            <div class="file_con">

                                                <input type="file" name="input_thumb_column_writer[]" >

                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 필자 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" name="description_column[]" value="<?=$rs_column[$j]['description']?>" maxlength="200" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">색상</label>
                                                <div class="in_multy_radio j_right mt_10">
                                                    <label class="fm_rd">
                                                        <input type="radio" name="rd_color<?=$j?>[]" value="red" <?=($rs_column[$j]['color'] == 'red')?"checked":"" ?> id="fm_color_<?=$j?>_1">
                                                        <span class="fs_13">빨강</span>
                                                    </label>
                                                    <label class="fm_rd">
                                                        <input type="radio" name="rd_color<?=$j?>[]" value="blue" <?=($rs_column[$j]['color'] == 'blue')?"checked":"" ?> id="fm_color_<?=$j?>_2">
                                                        <span class="fs_13">파랑</span>
                                                    </label>

													<input type="hidden" name="color[]" value="<?=$rs_column[$j]['color']?>">
                                                </div>
                                            </div>

                                            <div class="col_24">
                                                <label for="">제목</label>
												<input type="text" name="title_column[]" value="<?=$rs_column[$j]['title']?>" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_24">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_column[]" value="<?=$rs_column[$j]['serial']?>" maxlength="20" class="inp inp_sm fm_full mt_10">
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



					<? for($i = $j; $i <= 3; $i++) { ?>

					<div class="table_box_column table_box horizontal ty_counting t_center">
                        <table>
                            <colgroup>
                                <col style="width: 260px;">
                                <col style="width: 260px;">
                                <col style=" ">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <div class="row">
											<div class="col_8 t_left fs_16">
												<span class="num_count"><?=$i+2?></span>
												<input type="hidden" name="section_id_column[]" id="section_id" value="">
												<input type="hidden" name="top_tf_column[]" id="top_tf" value="N">
                                                <b class="fw_400 tc_3 is_inq">*</b>
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

										<div class="row in_multy_radio jc_se mt_30 dif_sel">
											<input type="hidden" name="flag_column[]" value="">
                                        </div>

										<div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" name="input_thumb_column[]" >
                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 사진 :: end -->
                                    <td class="td_thumb">
										<div class="photo_thumb_box ty_circle">
                                            <div class="thumb">
												<img src="/resource/images/no_image_c.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 1:1 비율 권장
                                            </p>
                                        </div>

										<div class="row in_multy_radio jc_se mt_30 dif_sel">
											<input type="hidden" name="flag_column_writer[]" value="">
										</div>

										<div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" name="input_thumb_column_writer[]" >
                                                <button onclick="act_file.act_click(this.parent)" type="button" class="btn file">파일선택</button>
                                                <span class="file_name "></span>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- 필자 사진 :: end -->
                                    <td>
                                        <div class="row ai_stretch wp_30 wp_st_2 t_left">
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" name="description_column[]" value="" maxlength="200" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_12">
                                                <label for="">색상</label>
                                                <div class="in_multy_radio j_right mt_10">
                                                    <label  class="fm_rd">
                                                        <input type="radio" name="rd_color<?=$i?>[]" value="red" id="fm_color_<?=$i?>_1">
                                                        <span class="fs_13">빨강</span>
                                                    </label>
                                                    <label class="fm_rd">
                                                        <input type="radio" name="rd_color<?=$i?>[]" value="blue" id="fm_color_<?=$i?>_2">
                                                        <span class="fs_13">파랑</span>
                                                    </label>
													<input type="hidden" name="color[]" value="">
                                                </div>
                                            </div>

                                            <div class="col_24">
                                                <label for="">제목</label>
												<input type="text" name="title_column[]" value="" maxlength="80" class="inp inp_sm fm_full mt_10">
                                            </div>

                                            <div class="col_24">
                                                <label for="">시리얼 넘버</label>
												<input type="text" name="serial_column[]" value="" maxlength="20" class="inp inp_sm fm_full mt_10">
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

	var boxHtml = '';
    $(function() {
        boxHtml += '<div class="table_box horizontal ty_counting t_center">';
        boxHtml +=     '<table><colgroup><col style="width: 260px;"><col style=" "></colgroup>';
        boxHtml +=     '<thead><tr><th colspan="2"><div class="row">';
        boxHtml +=         '<div class="col_8 t_left"><span class="num_count"></span></div>';
        boxHtml +=         '<div class="col_16 t_right"><div class="in_multy_btn jc_fe j_right">';
        boxHtml +=             '<button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>';
        boxHtml +=             '<button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>';
        boxHtml +=             '<button onclick="$(this).closest(\'.table_box\').remove(); reNumbering()" name="" id="" class="btn btn_c14 btn_sm" type="button">삭제</button>';
        boxHtml +=         '</div></div></div></th>';
        boxHtml +=     '</tr></thead>';
        // thead :: end
        boxHtml +=     '<tbody><tr>';
        boxHtml +=     '<td class="td_thumb">';
        boxHtml +=         '<div class="photo_thumb_box"><div class="thumb">';
        boxHtml +=             '<img src="/resource/images/no_image_120.jpg" alt="">';
        boxHtml +=         '</div>';
        boxHtml +=         '<p class="subs t_right">* 1.1 비율 권장</p></div>';
        boxHtml +=         '<div class="in_multy_radio jc_se mt_30 dif_sel">';
        boxHtml +=             '<label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>유지</label>';
        boxHtml +=             '<label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>삭제</label>';
        boxHtml +=             '<label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>교체</label>';
        boxHtml +=         '</div>';
        boxHtml +=         '<div class="file_box jc_c pt_30">';
        boxHtml +=             '<div class="file_con">';
        boxHtml +=                 '<input type="file" multiple="multiple">';
        boxHtml +=                 '<button type="button" class="btn file">파일선택</button>';
        boxHtml +=                 '<span class="file_name "></span>';
        boxHtml +=     '</div></div></td>';
        // 사진 :: end
        boxHtml +=     '<td><div class="row ai_stretch wp_30 wp_st_2 t_left">';
        boxHtml +=         '<div class="col_12"><label for="">설명</label>';
        boxHtml +=             '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 설명 :: end
        boxHtml +=         '<div class="col_12"><label for="">항목1</label>';
        boxHtml +=             '<div class="row"><div class="col_5">';
        boxHtml +=                 '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=             '</div>';
        boxHtml +=             '<div class="col_19 pl_10">';
        boxHtml +=                 '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=             '</div>';
        boxHtml +=         '</div></div>';
        // 항목 1 :: end
        boxHtml +=         '<div class="col_12">';
        boxHtml +=             '<label for="">제목</label>';
        boxHtml +=             '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 제목 ::  end
        boxHtml +=         '<div class="col_12"><label for="">항목2</label>';
        boxHtml +=             '<div class="row"><div class="col_5">';
        boxHtml +=                 '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=             '</div>';
        boxHtml +=             '<div class="col_19 pl_10">';
        boxHtml +=                 '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=             '</div>'
        boxHtml +=         '</div></div>';
        // 항목2 :: end
        boxHtml +=         '<div class="col_12"><label for="">시리얼 넘버</label>';
        boxHtml +=             '<input type="text" value="" class="inp inp_sm fm_full mt_10">';
        boxHtml +=     '</div></div></td>';
        // 시리얼 넘버 :: end
        // td :: end
        boxHtml += '</tr></tbody></table></div>';
    })
    function addNewBox() {
        var ary_maxNum = [];
        $(event.target).closest('div').before(boxHtml);
        var newTable = $(event.target).closest('div').prev();
        act_file.act_click(newTable.find('.file_box'));
        reNumbering();
        // $('.area_con_box').append(boxHtml);
    }

    // 번호 재할당
    function reNumbering() {
        $('.area_con_box .table_box').each(function(idx, el) {
            $(this).find('.num_count').text(idx + 1);
            $(this).find('.in_multy_radio input[type=radio]').attr('name','fm_rd'+(idx+1));
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
	}

	var dup_submit_flag = 'N';	//중복 작업 처리

	function js_save() {

		if(dup_submit_flag == 'N'){

			var _description = "";	//설명
			var _title = "";	//제목
			var _serial = "";	//시리얼 넘버
			var _color = "";	//색상
			var _section_id = "";	//고유번호 (수정시 사용)

			var isValid = true;

			//사설
			$('.table_box_editorial').each(function(idx){

				_title = $("input[name='title_editorial[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('사설 부문 제목을 입력해 주세요.');
					$("input[name='title_editorial[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_editorial[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('사설 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_editorial[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_description = $("textarea[name='description_editorial[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('사설 부문 설명을 입력해 주세요.');
					$("textarea[name='description_editorial[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}


			});


			if(!isValid){
				return isValid;
			}

			//칼럼
			$('.table_box_column_top').each(function(idx){

				_title = $("input[name='title_column_top[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('칼럼 부문 제목을 입력해 주세요.');
					$("input[name='title_column_top[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_column_top[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('칼럼 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_column_top[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_description = $("textarea[name='description_column_top[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('칼럼 부문 설명을 입력해 주세요.');
					$("textarea[name='description_column_top[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

			});


			if(!isValid){
				return isValid;
			}

			//칼럼
			$('.table_box_column').each(function(idx){

				_description = $("input[name='description_column[]']:eq("+idx+")").val();

				if(isEmpty(_description)){
					alert('칼럼 부문 설명을 입력해 주세요.');
					$("input[name='description_column[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_color =$(this).find('input:radio[name="rd_color'+idx+'[]"]:checked').val();

				if(isEmpty(_color)){
					alert('색상을 선택해 주세요.');
					$(this).find("input:radio[name='rd_color"+idx+"[]']").focus();
					isValid = false;
					return false;
				}

				$(this).find("input[name='color[]']").val(_color);

				_title = $("input[name='title_column[]']:eq("+idx+")").val();

				if(isEmpty(_title)){
					alert('칼럼 부문 제목을 입력해 주세요.');
					$("input[name='title_column[]']:eq("+idx+")").focus();
					isValid = false;
					return false;
				}

				_serial = $("input[name='serial_column[]']:eq("+idx+")").val();

				if(isEmpty(_serial)){
					alert('칼럼 부문 시리얼 넘버를 입력해 주세요.');
					$("input[name='serial_column[]']:eq("+idx+")").focus();
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
									 location.replace('/news/opinion');
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
