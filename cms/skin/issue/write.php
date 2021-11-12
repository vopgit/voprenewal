<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <form action="">


            <div class="row wp_40 mb_30 ai_stretch">
                <div class="col_15">
                    <h3 class="mb_15">알림 내용</h3>
                    <div class="editor_writer" >

                        <!--floating left-->
                        <div class="ew_m_btn_box">
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuText" title="텍스트" class="act">
                                    <span><i class="iconFt_txt"></i></span>
                                </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuGallery" title="사진" data-url="popup_ty5" onclick="act_popup(this)">
                                    <span><i class="iconFt_gallery"></i></span>
                                </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuLink"   data-url="link" onclick="act_popup(this)" title="링크" >
                                <span><i class="iconFt_link"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuPlayer" data-url="youtube" onclick="act_popup(this)" title="유튜브영상">
                                <span><i class="iconFt_player"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuQuotes" data-url="blockquote" onclick="act_popup(this)" title="인용문">
                                <span><i class="iconFt_Edit_icon09"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuLine" title="점선">
                                    <span><i class="iconFt_line_type"><span class="iconFt_line_type"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span></i></span>
                                </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuMemo" data-url="editroBox" onclick="act_popup(this)" title="박스">
                                <span><i class="iconFt_Edit_icon06"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuQ" data-url="question" onclick="act_popup(this)" title="질문">
                                <span><i class="iconFt_Edit_icon07"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuA" data-url="answer" onclick="act_popup(this)" title="답변">
                                <span><i class="iconFt_Edit_icon08"></i></span>
                            </button>
                            </div>
                            <div class="ew_m_btn">
                                <button type="button" id="btnMenuF" data-url="embed" onclick="act_popup(this)" title="외부컨텐츠">
                                    <span><i class="iconFt_sns"></i></span>
                                </button>
                            </div>
                        </div>


                        <!--floating menu-->
                        <div class="ew_f_btn_box" id="floatingBtns" style="display:block; transform:translate(0, 0)">
                            <div class="ew_f_btn"><button type="button" id="btnTxtBold" title="글자굵기"><span><i class="iconFt_ft-weight"></i></span></button></div>
                            <div class="ew_f_btn" id="btnColorsBox" title="글자기우림">
                                <button type="button" id="btnColor" title="글자컬러"><span><i class="iconFt_ft-color"></i></span></button>
                                <div class="__font_color_wrap">
                                    <button type="button" class="__font_color" data-color="#3c3e40" style="background-color:#3c3e40;"></button>
                                    <button type="button" class="__font_color" data-color="#888888" style="background-color:#888888;"></button>
                                    <button type="button" class="__font_color" data-color="#50a1c3" style="background-color:#50a1c3;"></button>
                                    <button type="button" class="__font_color" data-color="#e68849" style="background-color:#e68849;"></button>
                                    <button type="button" class="__font_color" data-color="#569e72" style="background-color:#569e72;"></button>
                                    <button type="button" class="__font_color" data-color="#a97857" style="background-color:#a97857;"></button>
                                </div>
                            </div>
                            <div class="ew_f_btn"><button type="button" id="btnTxtUnderline" title="밑줄"><span><i class="iconFt_ft-decoration"></i></span></button></div>
                            <div class="ew_f_btn"><button type="button" id="btnTxtTit" title="서브타이틀"><span><i class="iconFt_txt-tit"></i></span></button></div>
                            <div class="ew_f_btn"><button type="button" id="btnTxtHead" title="중간헤드라인"><span><i class="iconFt_txt-head"></i></span></button></div>
                            <div class="ew_f_btn"><button type="button" id="btnTxtUnordered" title="목록"><span><i class="iconFt_Text_icon06"></i></span></button></div>
                            <div class="ew_f_btn"><button type="button" id="btnTxtOrdered" title="숫자목록"><span><i class="iconFt_Text_icon07"></i></span></button></div>
                        </div>


                        <div class="editorWriter_box" id="editorWriterBox">
                            <div id="editorWriter">
                                <b>텍스트를 굵게 표시합니다.</b>
                                <br><br>
                                <u>텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다.</u>
                                <br><br>

                                <h2>
                                    서브타이틀 들어갑니다. 서브타이틀 들어갑니다.
                                </h2>

                                <br><br>
                                <h1>중간 헤드라인을 표시합니다.</h1>

                                <br><br>
                                <blockquote>
                                    인용문을 표시합니다. 인용문을 표시합니다. 인용문을 표시합니다. 인용문
                                    을 표시합니다. 인용문을 표시합니다. 인용문을 표시합니다.
                                </blockquote>


                                <br><br>
                                <ul>
                                    <li>리스트(점) 입니다.</li>
                                    <li>리스트(점) 입니다.</li>
                                </ul>
                                <br><br>
                                <ol>
                                    <li>리스트(숫자) 입니다.</li>
                                    <li>리스트(숫자) 입니다.</li>
                                    <li>리스트(숫자) 입니다.</li>
                                </ol>

                                <br><br>
                                <figure>
                                    <img src="http://placehold.it/400x400/eeeeee/?text=(1 : 1)" alt="이미지설명">
                                    <figcaption>[사진_사진의 제목이 들어갑니다.]</figcaption>
                                </figure>

                                <br><br>
                                <a href="#">링크를 삽입합니다.</a>

                                <br><br>
                                <div>[동영상_유튜브 URL의 v값이 들어갑니다.]</div>

                                <br><br>
                                <div class="editor_box">
                                    <h3>일반박스의 제목입니다.</h3>
                                    <p>일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다.</p>
                                </div>


                                <br><br>
                                <div class="editor_q">
                                    <p>질문박스입니다.</p>
                                </div>

                                <div class="editor_a">
                                    <p>답변박스입니다. 글이 왼쪽으로 정렬됩니다.<br> 질문박스를 사용한 뒤 사용할 것을 권장합니다.</p>
                                </div>

                                <hr>




                            </div>
                        </div>
                    </div>
                    <!--editor }-->
                </div>
                <!--기사내용}-->

                <div class="col_9">
                    <h3 class="mb_15">알림 정보</h3>
                    <div class="area_box">
                        <div class="area_con_box">
                            <div class="row wp_30">
                                <div class="col_24">
                                    <p class="mb_5">주요공지</p>
                                    <label class="fm_rd">
                                        <input type="radio" name="radio"><span class="_icon"></span>
                                        <span class="fs_13">주요공지</span>
                                    </label>

                                    <label class="fm_rd ml_10">
                                        <input type="radio" name="radio"><span class="_icon"></span>
                                        <span class="fs_13">사용 안 함</span>
                                    </label>
                                </div>
                                <!-- 주요공지 } -->

                                <div class="col_24 ">
                                    <label for="">제목</label>
                                    <input type="text" class="inp inp_sm fm_full mt_5" value="">
                                </div>
                                <!--제목 } -->

                                <div class="col_24">
                                    <label for="">작성자</label>
                                    <input type="text" class="inp inp_sm fm_full mt_5" value="">
                                    <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                </div>
                                <!--작성자 } -->


                                <!-- p26 -->
                                <div class="col_24">
                                    <div class="row">
                                        <div class="col_24 flex">
                                            <label for="">유관기사</label>
                                            
                                        </div>
                                        <div class="col_24 flex ai_c fw_nowrap mt_5">
                                            <div class="find_btn_box">
                                                <button class="btn btn_c7 btn_sm btn_full" type="button" data-url="popup_ty4" onclick="act_popup(this)"><span>기사 검색</span></button>
                                                <input type="text" class="inp inp_sm fm_full" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!--유관기사 }-->

                                <div class="col_24">
                                    <label for="">첨부파일</label>
                                    <div class="file_box  mt_5 create">
                                        <div class="file_con fs_13" style="min-width: 21.230769em; max-width:21.230769em;">
                                            <input type="file" multiple="multiple">
                                            <button class="btn file" type="button">파일선택</button>
                                            <span class="file_name"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--첨부파일 } -->

                               
                                <!-- p26 -->


                                <div class="col_24">
                                    <label for="">첨부파일 1</label>
                                    <div class="file_box fm_full mt_5">
                                        <div class="file_con fs_13">
                                            <input type="file" multiple="multiple">
                                            <button class="btn file" type="button">파일선택</button>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                                <!--첨부파일 1 } -->

                                <div class="col_24">
                                    <label for="">첨부파일 2</label>
                                    <div class="file_box fm_full mt_5">
                                        <div class="file_con fs_13">
                                            <input type="file" multiple="multiple">
                                            <button class="btn file" type="button">파일선택</button>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                                <!--첨부파일 2 } -->

                                <div class="col_24">
                                    <p class="mb_5">노출여부</p>
                                    <label class="fm_rd">
                                        <input type="radio" name="radio"><span class="_icon"></span>
                                        <span class="fs_13">보이기</span>
                                    </label>

                                    <label class="fm_rd ml_10">
                                        <input type="radio" name="radio"><span class="_icon"></span>
                                        <span class="fs_13">보이지 않기</span>
                                    </label>
                                </div>
                                <!-- 노출여부 } -->

                                <div class="col_24">
                                    <p class="mb_5">등록일</p>
                                    2021-07-27
                                    <input type="hidden" name="" value="">
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- p26 -->
                    <div class="row wp_20 pt_40">
                        <div class="col_12">
                            <a href="#" class="btn_lg btn_full">목록으로</a>
                        </div>
                        <div class="col_12">
                            <button type="button" class="btn_lg btn_full"><span>미리보기</span></button>
                        </div>
                        <div class="col_24">
                            <button type="button" class="btn_lg btn_c2 btn_full"><span>기사 입력 완료</span></button>
                        </div>
                    </div>
                    <!-- p26 -->


                </div>
                <!--기사 정보}-->
            </div>


            <div class="row wp_20 pt_40 pb_30">
                <div class="col_">
                    <a href="#" class="btn_lg btn_full">목록으로</a>
                </div>
                <div class="col_ ml_auto">
                    <button type="button" class="btn_lg btn_c2 btn_full"><span>완료</span></button>
                </div>
            </div>
            <!--기사종류 : 포토뉴스 : 사진입력 }-->
        </form>
    </div>
</div>
<script>
    //common.js
    serial_drop('.serial_wrap');

    //editor.js
    editerAni.init();
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
