<?php 
$_menu_code = '0501';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">Top 기사 관리</h3>


        <form name="" id="" method="" action="">
            <div class="table_box horizontal ty_tab act_hov">
                <div class="row tab_wrap">
                    <div class="col_12">
                        <ul class="tab_box">
                            <li class="on"><a href="#">노출대기</a></li>
                            <li><a href="#">Top 순위 조정</a></li>
                        </ul>
                    </div>
                    <div class="col_12 flex ai_c pr_30">
                        <button type="button" class="fs_13 flex ai_c ml_auto" onclick="ranking();">
                            <i class="iconFt_icon20 fs_16 mr_5"></i>
                            순위별 노출 위치
                        </button>
                    </div>
                </div>
                <table class="t_center">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="35%">
                        <col width="13%">
                        <col width="15%">
                        <col width="22%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <label class="fm_ch ">
                                    <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                </label>
                            </th>
                            <th>시리얼넘버</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>편집</th>
                            <th>편집내용</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? for($j = 0; $j < 10; $j++) {?>
                        <tr>
                            <td>
                                <label class="fm_ch ">
                                    <input type="checkbox" class="board_chk"><span class="_icon"></span>
                                </label>
                            </td>
                            <td>A00001584957</td>
                            <td class="_subj">
                                <!-- 1줄 제한 입니다. -->
                                기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다.
                                기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다.
                            </td>
                            <td>홍길동1(임꺽정1 기자)</td>
                            <td>
                                <div class="flex jc_c">
                                    <!-- 기사 수정 페이지입니다. -->
                                    <a href="/news/write" class="btn btn_line_c4" type="button ">기사수정</a>
                                    <!-- 노출수정 페이지 입니다. -->
                                    <a href="/top_article/edit" class="btn btn_line_c8" type="button">노출수정</a>
                                </div>
                            </td>
                            <td>
                                <div class="in_multy_radio j_right">
                                    <label class="fm_rd ">
                                        <input name="fm_rd_<?=$j?>" type="radio" title="">
                                        <span class="fs_13">Top</span>
                                    </label>
                                    <label class="fm_rd ">
                                        <input name="fm_rd_<?=$j?>" type="radio" title="">
                                        <span class="fs_13">노출삭제</span>
                                    </label>
                                    <label class="fm_rd ">
                                        <input name="fm_rd_<?=$j?>" type="radio" title="">
                                        <span class="fs_13">노출대기</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>

                </table>

                <div class="page_wrap pt_30 pb_25">
                    <div class="page">
                        <a href="javascript:void(0);" class="first"><i class="icon_prev2">이전10개</i></a>
                        <a href="javascript:void(0);" class="prev"><i class="icon_prev">이전페이지</i></a>
                        <span class="current_m"><span>3</span><span class="total"> / 69</span></span>
                        <span class="page_p">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#" class="act">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">7</a>
                            <a href="#">8</a>
                            <a href="#">9</a>
                        </span>
                        <a href="javascript:void(0);" class="next"><i class="icon_next">다음페이지</i></a>
                        <a href="javascript:void(0);" class="end"><i class="icon_next2">다음10개</i></a>
                    </div>

                </div>
            </div>
        </form>

        <div class="mtb_30 t_right btn_box">
            <button class="btn_lg btn_c7"> 선택 편집 완료</button>
            <button class="btn_lg btn_c2 ml_10"> 전체 편집 완료</button>
        </div>

    </div>

</div>


<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
