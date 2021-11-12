<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">메인 섹션 관리</h3>

        <div class="area_box">
            <?php include $_SERVER["DOCUMENT_ROOT"].'/section/tab_menu.php'; ?>
            <form id="" name="" action="" method="post">
                <div class="area_con_box">
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
                                                <span class="num_count">1</span>
                                            </div>
                                            <div class="col_16 t_right">
                                                <div class="in_multy_btn jc_fe j_right">
                                                    <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                    <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                    <button onclick="$(this).closest('.table_box').remove(); reNumbering();" name="" id="" class="btn btn_c14 btn_sm" type="button">삭제</button>
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
                                            <!--
                                            권장 사이즈 영역
                                            <p class="subs t_right">

                                            </p>
                                            -->
                                        </div>
                                        <div class="in_multy_radio jc_se mt_30 dif_sel">
                                            <label class="fm_rd "><input name="fm_rd_1_1" type="radio" title="">유지</label>
                                            <label class="fm_rd "><input name="fm_rd_1_1" type="radio" title="">삭제</label>
                                            <label class="fm_rd "><input name="fm_rd_1_1" type="radio" title="">교체</label>
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
                                            <div class="col_24">
                                                <label for="">종류</label>
                                                <div class="in_multy_radio j_right mt_10">
                                                    <!-- ### ====================== ### -->
                                                    <!--  영상은 기본값으로 선택됩니다.   -->
                                                    <!-- ### ====================== ### -->
                                                    <label class="fm_rd">
                                                        <input type="radio" name="fm_rd_1_2" checked="true" class="act_type_chg"><span class="_icon"></span>
                                                        <span class="fs_13">영상</span>
                                                    </label>
                                                    <label class="fm_rd">
                                                        <input type="radio" name="fm_rd_1_2" class="act_type_chg"><span class="_icon"></span>
                                                        <span class="fs_13">포토</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col_12">
                                                <label for="">설명</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_12">
                                                <label for="">제목</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_24 is_type_chg">
                                                <label for="">유튜브 URL</label>
                                                <input type="text" class="inp inp_sm fm_full mt_10">
                                            </div>
                                            <div class="col_24 is_type_chg" style="display: none; ">
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
                <button onclick="" type="button" class="btn_lg btn_c2 ">편집 완료</button>
            </div>
        </div>

    </div>

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
        boxHtml +=         '<div class="photo_thumb_box ty_ract"><div class="thumb">';
        boxHtml +=             '<img src="/resource/images/no_image.jpg" alt="">';
        boxHtml +=         '</div>';
        // 권장 사이즈 영역
        //boxHtml +=         '<p class="subs t_right"></p>';
        boxHtml +=         '</div>';
        boxHtml +=         '<div class="file_box jc_c pt_30">';
        boxHtml +=             '<div class="file_con">';
        boxHtml +=                 '<input type="file" multiple="multiple">';
        boxHtml +=                 '<button type="button" class="btn file">파일선택</button>';
        boxHtml +=                 '<span class="file_name "></span>';
        boxHtml +=     '</div></div></td>';
        // 사진 :: end
        boxHtml +=     '<td><div class="row ai_stretch wp_30 wp_st_2 t_left">';
        boxHtml +=         '<div class="col_24"><label for="">종류</label>';
        boxHtml +=             '<div class="in_multy_radio j_right mt_10"><label class="fm_rd">'
        boxHtml +=             '<input type="radio" name="" id="" checked="true" class="act_type_chg"><span class="_icon"></span>\n'
        boxHtml +=             '<span class="fs_13">영상</span></label>'
        boxHtml +=             '<label class="fm_rd">'
        boxHtml +=             '<input type="radio" name="" id="" class="act_type_chg"><span class="_icon"></span>\n'
        boxHtml +=             '<span class="fs_13">포토</span></label></div>'
        boxHtml +=         '</div>';
        // 종류 :: end
        boxHtml +=         '<div class="col_12"><label for="">설명</label>';
        boxHtml +=             '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 설명 :: end
        boxHtml +=         '<div class="col_12">';
        boxHtml +=             '<label for="">제목</label>';
        boxHtml +=             '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 제목 ::  end
        boxHtml +=         '<div class="col_24 is_type_chg"><label for="">유튜브 URL</label>';
        boxHtml +=             '<input type="text" class="inp inp_sm fm_full mt_10">';
        boxHtml +=         '</div>';
        // 유튜브 URL :: end
        boxHtml +=         '<div class="col_24 is_type_chg" style="display: none; "><label for="">시리얼 넘버</label>';
        boxHtml +=             '<input type="text" value="" class="inp inp_sm fm_full mt_10">';
        boxHtml +=     '</div></div></td>';
        // 시리얼 넘버 :: end
        // td :: end
        boxHtml += '</tr></tbody></table></div>';


        chgInpRd();
        $(document).on('change', '.act_type_chg', chgInpRd);
    })
    function chgInpRd() {
        var t, idx, par, tg;
        try {
            // change 이벤트로 실행시
            t = $(event.target);
            idx = t.closest('label').index();
            par = t.closest('.table_box');
            tg = par.find('.is_type_chg');
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
        reNumbering();
        // $('.area_con_box').append(boxHtml);
    }

    // 번호 재할당
    function reNumbering() {
        $('.area_con_box .table_box').each(function(idx, el) {
            $(this).find('.num_count').text(idx + 1);
            $(this).find('.in_multy_radio').each(function(sec_idx, el) {
                $(this).find('input[type=radio]').attr('name','fm_rd_'+(idx+1)+'_'+(sec_idx+1));
            })
        })
    }

</script>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
