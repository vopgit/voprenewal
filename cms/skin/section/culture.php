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

			<form id="" name="" action="" method="post">
                <div class="area_con_box">
                    <h4 class="sq_tit mb_20">
                        연애
                    </h4>
                    <? for($i = 1; $i <= 3; $i++) { ?>
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
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i?></span>
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td_thumb">
                                        <div class="photo_thumb_box">
                                            <div class="thumb">
                                                <img src="/resource/images/no_image_120.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 1.1 비율 권장
                                            </p>
                                        </div>
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" multiple="multiple">
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
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
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
                    <? for($i = 1; $i <= 3; $i++) { ?>
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
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i?></span>
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td_thumb">
                                        <div class="photo_thumb_box">
                                            <div class="thumb">
                                                <img src="/resource/images/no_image_120.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 1.1 비율 권장
                                            </p>
                                        </div>
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" multiple="multiple">
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
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
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
                    <? for($i = 1; $i <= 3; $i++) { ?>
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
                                            <div class="col_8 t_left fs_16">
                                                <span class="num_count"><?=$i?></span>
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td_thumb">
                                        <div class="photo_thumb_box">
                                            <div class="thumb">
                                                <img src="/resource/images/no_image_120.jpg" alt="">
                                            </div>
                                            <p class="subs t_right">
                                                * 1.1 비율 권장
                                            </p>
                                        </div>
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1" type="radio" title="">교체</label>
                                        </div>
                                        <div class="file_box jc_c pt_30">
                                            <div class="file_con">
                                                <input type="file" multiple="multiple">
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
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">시리얼 넘버</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
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
                <button onclick="" type="button" class="btn_lg btn_c2 ">편집 완료</button>
            </div>
        </div>

    </div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
