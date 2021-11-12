<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <div class="row ai_c mb_20">
            <h3>내가 입력한 기사</h3>
            <div class="ml_auto col_3">
                <div class="sel_box">
                    <select name="" id="" class="sel fm_full">
                        <option value="">전체</option>
                        <option value="">대기중</option>
                        <option value="">작성중</option>
                        <option value="">발행중</option>
                        <option value="">삭제됨</option>
                        <option value="">보류</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table_box horizontal">

            <table class="t_center">
                <colgroup>
                    <col data-col-width="70" />
                    <col data-col-width="90" />
                    <col data-col-width="430"/>
                    <col data-col-width="150"/>
                    <col data-col-width="80" />
                    <col data-col-width="190"/>
                    <col data-col-width="160"/>
                    <col data-col-width="100"/>
                </colgroup>
                <thead >
                    <tr>
                        <th >No.</th>
                        <th>기사종류</th>
                        <th>제목</th>
                        <th>조회수(PC/Mobile)</th>
                        <th>상태</th>
                        <th>수정/송고</th>
                        <th>입력시간</th>
                        <th>편집정보</th>
                    </tr>
                </thead>
                <tbody >
                <?php
                    $ftColor = array('대기중','작성중','발행중','삭제됨','보류','대기중','작성중','발행중','삭제됨','보류');
                    foreach($ftColor as $key => $value){
                    ?>
                    <tr>
                        <td><?=100-$key+1?></td>
                        <td>일반기사</td>
                        <td><div class="t_left ellip_1 fs_14"><a href="#" data-url="preview_news"  onclick="act_popup(this); return false;">기사제목이100들어갑니다. 기사제목이100들어갑니다. 기사제목이100들어갑니다. 기사제목이100들어갑니다. 기사제목이100들어갑니다. 기사제목이100들어갑니다. 기사제목이100들어갑니다. </a></div></td>
                        <td>55/391</td>
                        <td><span class="sta_c<?=$key+1?>"><?=$value?></span></td>
                        <td>
                            <div class="btn_box wp_5">
                                <a class="btn btn_line_c4" href="#">
                                    <span>기사수정</span>
                                </a>
                                <a class="btn btn_line_c2" href="#">
                                    <span>송고하기</span>
                                </a>
                            </div>
                        </td>
                        <td>2021/07/19 18:32:31</td>
                        <td>
                            <div class="edit_info_box_wrap">
                                <button class="btn btn_c6" type="button" onclick="$('.edit_info_box').hide(); $(this).next().show();">
                                    <span>보기</span>
                                </button>
                                <div class="edit_info_box" style="display:none">
                                    <ul>
                                        <li><b>편집일시</b><span>2021-07-20 11:51:40(1차)</span></li>
                                        <li><b>대체명의</b><span>조영기</span></li>
                                        <li><b>최근송고</b><span>2021-07-20 12:00:00</span></li>
                                    </ul>
                                    <button class="edit_info_box_close" type="button"  onclick="$(this).closest('.edit_info_box').hide();"><span class="text_hide">닫기</span></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>

            <div class="page_wrap">
                <?php include $_SERVER["DOCUMENT_ROOT"].'/include/page.php'; ?>
            </div>
        </div>

        <div class="btn_box mtb_30">
            <div class="col_4">
                <button class="btn_lg btn"> 목록으로</button>
            </div>
        </div>

    </div>

</div>



<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
