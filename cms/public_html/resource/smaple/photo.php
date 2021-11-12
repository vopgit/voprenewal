
<div class="row ai_c mb_20">
    <h3> 테이블 토글 (eadit_photo_box : toggleClass - simple )</h3>
    <div class=" top_tab_btns">
        <button type="button" class="top_tab_btn on" onclick="photoBox.simpleEvt(this, '#eaditPhoto')"><span>사진 간단히</span></button>
        <button type="button" class="top_tab_btn"    onclick="photoBox.detailEvt(this, '#eaditPhoto')"><span>사진 자세히</span></button>
    </div>
    <a href="" class="more_link ml_auto">
        <span>더 많이 보기</span>
        <i class="iconFt_arrow_right"></i>
    </a>
</div>

<div class="row wp_10 eadit_photo_box simple" id="eaditPhoto">
    <?php
    $ftColor = array('대기중','작성중','발행중','삭제됨');
    foreach($ftColor as $key => $value){
    ?>
    <div class="col_12 eadit_photo_col">
        <div class="eadit_photo">
            <div class="ph_wrap">
                <div class="ph_thumbnail">
                    <div class="thum_img" data-url="preview" onclick="act_popup(this)">
                        <img src="http://placehold.it/110x110/eeeeee/" alt="110*110 이미지">
                    </div>
                    <div class="thum_txt">
                        <div class="fs_14">
                            <p class="fw_700 num_code">P00001584957</p>
                            <p class="sta_c<?=$key+1?>"><?=$value?></p>
                        </div>
                        <button type="button" class="btn btn_line_cg"><span>사진수정</span></button>
                    </div>
                </div>
                <div class="ph_text">
                    <div class="table_box vertical ">
                        <table>
                            <colgroup>
                                <col width="130" data-simple="none" />
                                <col />
                            </colgroup>
                            <tbody>
                                <tr data-simple="none"><th class="t_left">입력자/저작권자</th> <td>홍길동 기자/홍길도</td></tr>
                                <tr><th class="t_left" data-simple="none">제목</th> <td>사진에 제목이 들어갑니다.</td></tr>
                                <tr><th class="t_left" data-simple="none">태그</th> <td>tag1, tag2, tag3, tag4</td></tr>
                                <tr data-simple="none"><th class="t_left">입력시간</th> <td>2021-07-20 17:50:21</td></tr>
                                <tr data-simple="none"><th class="t_left">수정시간</th> <td>2021-07-20 17:50:21</td></tr>
                                <tr data-simple="none"><th class="t_left">설명</th> <td>내가 입력한 사진내가 입력한 사진 내가 입력한 사진 내가 입력한 사진 내가 입력한 사진</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<br>
<br>
