<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
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
                        [이태경의 토지와 자유] 윤석열은 부동산 지옥을 만들려는가
                    </h3>
                    <p>
                        윤석열표 부동산 공약은 가격 상승을 전제로 한 폭탄돌리기
                    </p>
                </div>
                <div class="col_12">
                    <div class="row">
                        <div class="col_5 t_center">
                            <strong>관련기사</strong>
                        </div>
                        <div class="col_19">
                            <ul class="list_bullet">
                                <li>채이배 “윤석열 측이 합류 제안? 상식 없는 곳에 바빠서 갈 일 없다”</li>
                                <li>장제원, 윤석열 캠프 총괄실장으로 합류</li>
                                <li>윤석열 ‘저출생 원인은 페미니즘’ 발언 질타한 추미애 “말 같지도 않은 말”</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- exp_box :: end -->
        <div class="t_right writer_info fs_14 mb_40">
            <ul class="row jc_fe">
                <li class="col_"><b class="lb">작성자</b>홍길동</li>
                <li class="col_"><b class="lb">노출이름</b>임꺽정 기자</li>
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
            <form id="" name="" action="" method="post">
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
                                            <img src="/resource/images/no_image.jpg" alt="">
                                        </div>
                                        <p class="subs t_right">
                                            * 800x470 사이즈 권장
                                        </p>
                                    </div>
                                    <div class="in_multy_radio jc_se mt_30 dif_sel">
                                        <label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>유지</label>
                                        <label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>삭제</label>
                                        <label class="fm_rd "><input name="fm_rd_1" type="radio" title=""><span class="_icon"></span>교체</label>
                                    </div>
                                    <div class="file_box jc_c pt_30">
                                        <div class="file_con">
                                            <input type="file" multiple="multiple">
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
                                                        <input name="article_level" id="artLvT" value="" type="radio" class="js_art_lvl lvl_top js_edit_opt" data-target=".js_edit_tg" data-lange="1,3">
                                                        <span class="fs_13">Top</span>
                                                    </label>
                                                    <label for="artLvM" class="fm_rd">
                                                        <input name="article_level" id="artLvM" value="" type="radio" class="js_art_lvl lvl_minor js_edit_opt" data-target=".js_edit_tg" data-lange="4,6">
                                                        <span class="fs_13">Minor</span>
                                                    </label>
                                                    <label for="artLvS" class="fm_rd">
                                                        <input name="article_level" id="artLvS" value="" type="radio" class="js_art_lvl lvl_sub js_edit_opt" data-target=".js_edit_tg" data-lange="7,22">
                                                        <span class="fs_13">Sub</span>
                                                    </label>
                                                </div>
                                                <div class="col_12">
                                                    <span class="sel_box">
                                                        <select name="" id="" disabled class="sel fm_full placeholder disabled __customUi js_edit_tg" data-comm-txt="순위">
                                                            <option value="">선택</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col_12">
                                            <label for="">스타일</label>
                                            <div class="in_multy_radio j_right mt_10">
                                                <label for="artSty1" class="fm_rd">
                                                    <input name="article_style" id="artSty1" value="" type="radio" class="article_style disabled" disabled>
                                                    <span class="fs_13">제목+설명</span>
                                                </label>
                                                <label for="artSty2" class="fm_rd">
                                                    <input name="article_style" id="artSty2" value="" type="radio" class="article_style disabled" disabled>
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
                                                    <input type="radio" name="tag_color" id="tagColorN" checked="true">
                                                    <span class="fs_13">
                                                        사용 안함
                                                    </span>
                                                </label>
                                                <label for="tagColorB" class="fm_rd">
                                                    <!-- 색상 : #369ff8 -->
                                                    <input type="radio" name="tag_color" id="tagColorB">
                                                    <span class="rd_color_box bc_1">
                                                        <i class="text_hide">파란색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorR" class="fm_rd">
                                                    <!-- 색상 : #ed3b31 -->
                                                    <input type="radio" name="tag_color" id="tagColorR">
                                                    <span class="rd_color_box bc_2">
                                                        <i class="text_hide">빨간색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorG" class="fm_rd">
                                                    <!-- 색상 : #238210 -->
                                                    <input type="radio" name="tag_color" id="tagColorG">
                                                    <span class="rd_color_box bc_3">
                                                        <i class="text_hide">초록색</i>
                                                    </span>
                                                </label>
                                                <label for="tagColorBL" class="fm_rd">
                                                    <!-- 색상 : #666666 -->
                                                    <input type="radio" name="tag_color" id="tagColorBL">
                                                    <span class="rd_color_box bc_4">
                                                        <i class="text_hide">검은색</i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col_12">
                                            <label for="">태그명</label>
                                            <input type="text" class="inp inp_sm fm_full mt_10">
                                        </div>
                                        <div class="col_24">
                                            <label for="">노출제목</label>
                                            <input type="text" class="inp inp_sm fm_full mt_10">
                                        </div>
                                        <div class="col_24">
                                            <label for="">기사설명</label>
                                            <textarea name="" class="ft mt_10" style="height:5rem;"></textarea>
                                        </div>
                                        <div class="col_24">
                                            <label for="">관련기사</label>
                                            <ul class="move_inp_box mt_10">
                                                <li class="row lst_item">
                                                    <div class="col_19 inp_box row">
                                                        <div class="col_18">
                                                            <input type="text" value="1" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full">
                                                        </div>
                                                        <div class="col_6">
                                                            <input type="text" value="a" placeholder="시리얼넘버" readonly class="inp inp_sm fm_full read_only">
                                                        </div>
                                                    </div>
                                                    <div class="col_5 cnt_box pl_10 flex ai_c">
                                                        <div class="move_floor">
                                                            <button name="" id="" onclick="moveNode('up');" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                            <button name="" id="" onclick="moveNode('down');" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                        </div>
                                                        <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
                                                        <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
                                                    </div>
                                                </li>
                                                <li class="row lst_item">
                                                    <div class="col_19 inp_box row">
                                                        <div class="col_18">
                                                            <input type="text" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full">
                                                        </div>
                                                        <div class="col_6">
                                                            <input type="text" placeholder="시리얼넘버" readonly class="inp inp_sm fm_full read_only">
                                                        </div>
                                                    </div>
                                                    <div class="col_5 cnt_box pl_10 flex ai_c">
                                                        <div class="move_floor">
                                                            <button name="" id="" onclick="moveNode('up');" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                                                            <button name="" id="" onclick="moveNode('down');" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
                                                        </div>
                                                        <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
                                                        <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
                                                    </div>
                                                </li>
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
            <button class="btn_lg btn">목록으로</button>
            <div class="col_ ml_auto">
                <button onclick="" type="button" class="btn_lg btn_c2 ">편집 완료</button>
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
});
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
