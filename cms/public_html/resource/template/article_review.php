<?php 
include "top.php"; 

//작성자별 보기 링크
if($rs['contributor'] != "") $link = "/review?s_name=".urlencode($rs['contributor'])."&s_no=nick";
else  $link = "/review?s_name=".urlencode($rs['name'])."&s_no=".$rs['member_id'];
?>
	
	<section class="con">
        <div class="view_top">
            <div class="wrap_980">
                <div class="view_top_cate2">
                    <span class="view_top_cate2_txt1">리뷰</span>
                </div>
                <h1 class="view_top_tit"><span class="iconFt_review mr_10" style="opacity:0.25;"></span><a href="<?=$link?>"><?=$support_name?></a>님의 리뷰</h1>

                <div class="flex fw_nowrap">
                    <div class="view_top_info_box mr_auto">
                        <ul class="view_top_info">
                            
							<li><a href="<?=$link?>"><?=$support_name?> <?=$rs['email']?></a></li>
                            <li>발행 <?=$rs['published_date']?></li>
                            <li>
								<?php if($rs['modi_date']!= "" && $rs['modi_date']!= "0000-00-00 00:00:00"){ ?>
									수정 <?=$rs['modi_date']?></li>
								<?php } ?>
							</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap_980">

            <div class="view_con">
                <div class="view_con_left">
                    <!--왼쪽-->
                    <div class="editor">
						<?=$rs['contents']?>
                    </div>
                    <!--응원-->
                    <div class="vi_bner">
                        <div class="vi_bner_wrap">
                            <div class="row ai_c fw_600 vi_bner_txt mb_30">
                                    <i class="iconFt_symbol mr_10"></i>
                                  <span class="tc_cp">민중의 소리</span><span class="tc_w">를 응원해주세요.</span>
                            </div>
                            <p class="fs_18 tc_b5 mb_30 mb_md_40">
                                기사 잘 보셨나요? 독자님의 응원이 기자에게 큰 힘이 됩니다.  <br>
                                후원회원이  되어주세요. 독자님의 후원금은 모두 기자에게  전달됩니다.  <br>
                                정기후원은 모든 기자들에게 전달되고, 기자후원은 해당 기자에게 <br>
                                전달됩니다.
                            </p>
                            <a href="https://www.ihappynanum.com/Nanum/B/ZZWJXPDKGQ" target="_blank" class="btn btn_full btn_cp_c1" target="_blank">정기후원 하기</a>
                        </div>
                    </div>

                    <div class="cheer_box">
                        <div class="cheer_con">
                            <div class="row ai_c">
                                <div class="col_12">
                                    <p class="cheer_tit">
                                        <b class="tc_b">“ <?=$support_name?> ”</b> 응원하기
                                    </p>

                                    <div class="cheer_img">
                                        <div class="img_con">
                                            <img src="<?=$Writer_photo?>" alt="<?=$support_name?> 사진">
                                        </div>
                                    </div>
                                </div>
                                <div class="col_12">
                                    <div class="row wp_10">
                                        <div class="col_12">
                                            <a href="<?=$support_link[1][0]?>" target="_blank" class="cheer_link"><b><span>1</span>만원</b>기자후원</a>
                                        </div>
                                        <div class="col_12">
                                            <a href="<?=$support_link[1][1]?>" target="_blank" class="cheer_link"><b><span>2</span>만원</b>기자후원</a>
                                        </div>
                                        <div class="col_12">
                                            <a href="<?=$support_link[1][2]?>" target="_blank" class="cheer_link"><b><span>5</span>만원</b>기자후원</a>
                                        </div>
                                        <div class="col_12">
                                            <a href="<?=$support_link[1][3]?>" target="_blank" class="cheer_link"><b><span>10</span>만원</b>기자후원</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="cheer_bottom">
                            <p>이번달 <?=$support_name?> 후원액은 <span class="tc_2"><?=number_format($support_name)?></span> 입니다.</p>
                        </div>
                    </div>

                </div>
                <div class="view_con_right">
                    <!--오른쪽-->
                    <div class="vcr_box">
                        <h2 class="vcr_tit"><span>원 기사</span></h2>
                        <ul class="vcr_list">
                            <li>
								<a href="/<?=$rs['osmu_serial']?>.html">
									<?php if($rs['mthumbnail'] != ''){ ?>
										<span class="img_box">
											<span class="img_con"><img src="<?=rtrim(_IMAGE_URL,'/')."/".ltrim($rs['mthumbnail'],'/')?>" alt="<?=$rs['title']?>"></span>
										</span>
									<?php } ?>
									<span><?=$rs['title']?></span>
								</a>
							</li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="view_bottom mt_80 pt_30">
                <!--하단-->
                <div class="row ai_c ai_sm_fs jc_sb">
                <div class="col_7 arrow ar_prev">
                   <!-- <a href="/news/review_view">
                        <i class="iconFt_arrow_bar_l_2"></i>
                        <span class="txt_box">
                           <span class="fw_600 ">PREV</span>
                           <span class="ellip_1">이전 리뷰</span>
                        </span>
                   </a> -->
                </div>
                <div class="col_10 t_center"> <a href="javascript:;" class="btn_md btn_cg2" onclick="history.back()">목록</a></div>
                <div class="col_7 t_right arrow ar_next">
                    <!-- <a href="/news/review_view">
                       <i class="iconFt_arrow_bar_r2"></i>
                       <span class="txt_box">
                           <span class="fw_600 ">NEXT</span>
                           <span class="ellip_1">다음 리뷰</span>
                       </span>
                   </a> -->
                </div>
              </div>
            </div>
        </div>
    </section>
<?php include "footer.php"; ?>