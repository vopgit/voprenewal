<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>
<script>
function done(n){
	var obj = $('#_photo_'+n);	
	var data = {
		 "code" : obj.find('.num_code').text(),
		 "title" : obj.find('.title').text(),
		 "author" : obj.find('.author').data('author')
		};
	parent.setEditorHtml('photo', JSON.stringify(data));
	return;
}
</script>
<form action="">
    <div class="popup_box">
        <div class="popup_wrap wrap1300">
            <div class=" popup_con ">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>사진입력</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>
                <div class="popup_contents step_1">

                <!-- search -->
                    <div class="row mb_30  jc_c">
                        <div class="col_13 ">
                            <div class="row plr_20">
                                <div class="col_6 pr_5">
                                    <div class="sel_box">
                                        <select name="" id="" class="sel sel_md fm_full placeholder __customUi">
                                            <option value="">전체</option>
                                            <option value="">sample select2</option>
                                            <option value="">sample select3</option>
                                            <option value="">sample select4</option>
                                            <option value="">sample select5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col_18 t_right ">
                                    <div class="pop_search ">
                                        <input type="text" class="inp fm_full" placeholder="작성자">
                                        <a href="" class="btn btn_c7 btn_sm search">검색</a>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <!-- search -->

                <div class="pop_editro_photo">
                    <ul class="tab_box">
                        <li class="on"><a href="#">전체사진</a></li>
                        <li><a href="#">내가 올린 사진</a></li>
                        <li><a href="javascript:;"class="btn btn_md btn_c2 btn_step2" >사진 올리기</a></li>
                    </ul>
                    <div class="editro_photo _wrap">
                        <div class="row ai_c mb_20">
                            <div class=" ">
                                <button type="button" class="top_tab_btn on mr_25" onclick="photoBox.simpleEvt(this, '#eaditPhoto')"><span>사진 간단히</span></button>
                                <button type="button" class="top_tab_btn "    onclick="photoBox.detailEvt(this, '#eaditPhoto')"><span>사진 자세히</span></button>
                            </div>
                        </div>

                        <div class="row wp_20 eadit_photo_box simple" id="eaditPhoto">
                            <?php
                            $ftColor = array('대기중','작성중','발행중','삭제됨');
                            foreach($ftColor as $key => $value){
                            ?>
                            <div class="col_12 eadit_photo_col" id="_photo_<?=$key+1?>">
                                <div class="eadit_photo">
                                    <div class="ph_wrap">
                                        <div class="ph_thumbnail">
                                            <div class="thum_img" onclick="act_BigImages(this);">
                                                <img src="http://placehold.it/110x110/eeeeee/" alt="110*110 이미지">
                                            </div>
                                            <div class="thum_txt">
                                                <div class="fs_14">
                                                    <p class="fw_700 num_code">P0000158495<?=$key+1?></p>
                                                    <p class="sta_c<?=$key+1?>"><?=$value?></p>
                                                </div>
                                                <button type="button" class="btn btn_line_cg" onclick="done('<?=$key+1?>')"><span>사진입력</span></button>
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
                                                        <tr data-simple="none">
															<th class="t_left">입력자/저작권자</th>
															<td class="author" data-author="홍길동">홍길동 기자/홍길도</td>
														</tr>
                                                        <tr><th class="t_left" data-simple="none">제목</th> <td ><div class="ellip_1 "><span class="title">사진에 제목이 들어갑니다<?=$key+1?>.</span></div></td></tr>
                                                        <tr><th class="t_left" data-simple="none">태그</th> <td> <div class="ellip_1 "> tag1, tag2, tag3, tag4 </div></td></tr>
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
                        <div class="popup_pageing">
                            <div class="page_wrap  mt_35">
                            <?php include $_SERVER["DOCUMENT_ROOT"].'/include/page.php'; ?>
                                    
                            </div>
                    </div>

                    </div>
                    
                </div>


                
                </div>

                <div class="popup_contents step_2">

                    <div class=" poto_box">
                        <div class="row">
                            <div class="col_5 ">
                                <div class="poto_con ">
                                    <div class="t_left row">
                                        <span class="fs_14">PC</span>
                                    </div>
                                    <div class="add_img" style>
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" multiple="multiple" >
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_5 border_left">
                                <div class="poto_con">
                                    <div class=" row jc_sb">
                                        <span class="fs_14">MOBILE</span>
                                        <p class="fs_13 tc_b4">
                                            * 모바일 해상도에서 <BR>
                                            자동 교체되는 이미지
                                        </p>

                                    </div>

                                    <div class="add_img">
                                        <img src="/resource/images/no_image.jpg" alt="">
                                    </div>
                                    <div class="file_box fm_full">
                                        <div class="file_con ">
                                            <input type="file" multiple="multiple" >
                                            <a class="btn file">파일선택</a>
                                            <span class="file_name "></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col_14">
                                <div class="row poto_con border_left">
                                    <div class="col_12 pr_15">
                                        <div class="mb_10">
                                            <p class="mb_10">제목</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">저작권자</p>
                                            <label class="fm_rd ">
                                                <input type="radio" name="radio">
                                                <span class="fs_13">민중의소리 (워터마크 표시)</span>
                                            </label>

                                            <label class="fm_rd ml_10 fs_13">
                                                <input type="radio" name="radio" class="readChange">
                                                <span class="fs_13"> 기타 (워터마크 없음)</span>
                                            </label>
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">작성자</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                            <span class="tc_b4 fs_13 mt_10">* 본인이 아닐 때 수정하세요.</span>
                                        </div>
                                    </div>
                                    <div class="col_12 pl_15">
                                        <div class="mb_10">
                                            <p class="mb_10">설명</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                        <div class="mb_10 tc_b4">
                                            <p class="mb_10">&nbsp;</p>
                                            <input type="text" class="inp inp_sm fm_full read_only act_read" readonly >
                                        </div>
                                        <div class="mb_10">
                                            <p class="mb_10">태그</p>
                                            <input type="text" class="inp inp_sm fm_full">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <p class="tc_b4 fs_13 mt_10">
                            * (PC/MOBILE)  800x470 사이즈 권장
                        </p>
                    <div class=" mt_30 t_center">
                        <a href="javascript:;"class="btn_md btn btn_stepBack"  >돌아가기</a>
                        <a class="btn_md btn_c2 " href="#">사진 입력 완료</a>
                        
                    </div>
                </div>
            </div>

            <div class="popBig" onclick="$(this).hide();">
                <div class="popBig_wrap">
                      <img src="" class="popBig_img">       
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>


<script>

    $(document).ready(function(){
            act_readOnly();
        })

    $('.btn_step2').click(function(){
        $('.btn_step2').closest('.step_1').slideUp();
        $('.step_2').slideDown(); 
    });
    $('.btn_stepBack').click(function(){
        $('.step_2').slideUp(); 
        $('.step_1').slideDown();
    });

    function act_BigImages(el){
        var src = $(el).find('img').attr('src');
        $('.popBig').show();
        $('.popBig').find('img').attr('src',src);
    }

</script>