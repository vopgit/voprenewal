<?php include "top.php"; ?>

    <section class="con">
        <div class="view_top">
            <div class="wrap_980">
                <div class="view_top_cate2">
                    <span class="view_top_cate2_txt1">원소스</span>
                </div>
                <h1 class="view_top_tit"><?=$rs['title']?></h1>

                <div class="flex fw_nowrap">
                    <div class="view_top_info_box mr_auto">
                        <ul class="view_top_info">
                            <li><a href="/journalist/<?=($rs['contributor'] != "") ? urlencode($rs['contributor']) : $rs['member_id'];?>"><?=$rs['writer_print']?></a></li>
                            <li>발행 <?=$rs['published_time']?></li>
                            <li>
								<?php if($rs['update_time']!= ""){ ?>
									수정 <?=$rs['update_time']?></li>
								<?php } ?>
							</li>
                        </ul>
                    </div>

                    <div class="view_top_share_box ml_auto">
                        <button type="button"><i class="iconFt_share"></i></button>
                        <ul class="view_top_share">
                           <li><button type="button"  onclick="window.open('https://www.facebook.com/dialog/share?app_id=388188387943690&amp;display=popup&amp;href=<?=urlencode($og['url'])?>&amp;redirect_uri=<?=urlencode($og['url'])?>', '', 'height=279,width=575'); return false;"><i class="iconFt_facebook1"></i></button></li>
                          <li><button type="button"  onclick="window.open('https://twitter.com/share?text=<?=urlencode($og['title'])?>&amp;url=<?=$og['url']?>', '', 'height=279,width=575'); return false;"><i class="iconFt_twitter"></i></button></li>
                          <li><button type="button" onclick="sendLink()"><i class="iconFt_kakao1"></i></button></li>
                          <li><button type="button" class="act_copyLink" data-clipboard-action="copy" data-clipboard-text="<?=$og['url']?>"><i class="iconFt_link"></i></button></li>
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
                        <h2 class="vcr_tit"><span>관련 기사</span></h2>
                        <ul class="vcr_list">
 							<?php foreach($rs['relate'] as $rdata) { ?>
								<!-- //포토뉴스
								<li><a href="#">
									<span class="img_box">
										<span class="img_con"><img src="https://via.placeholder.com/90x52/eeeeee/?text=(1.7 : 1)" alt="이미지설명"></span>
									</span>
									<span>관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다.</span></a>
								</li> -->
								<li>
									<a href="/<?=$rdata['serial']?>.html">
										<?php if($rdata['mthumbnail'] != ''){ ?>
										<span class="img_box">
											<span class="img_con"><img src="<?=_IMAGE_URL.ltrim($rdata['mthumbnail'], '/')?>" alt="<?=$rdata['title']?>"></span>
										</span>
										<?php } ?>
										<span><?=$rdata['title']?></span>
									</a>
								</li>
							<?php } ?>


							<?php if(count($rs['relate']) < 1){ ?>
								<li class="t_center "> <p class="ptb_10">등록된 관련 기사가 없습니다.</p></li>
							<?php } ?>
                        </ul>
                    </div>

                    <div class="vcr_box bg_wh">
                        <h2 class="vcr_tit"><span>첨부파일</span></h2>
                        <ul class="vcr_list">
							<?php foreach($rs['file'] as $rdata) { ?>
								<li><a href="<?=_DOWNLOAD_URL?>?<?=encrypt(time()."||".$rdata['filepath']."||".$rdata['filename'])?>" target="_blank"><i class="iconFt_file"></i><span><?=$rdata['filename']?> (<?=formatFileSize($rdata['size'])?>)</span></a></li>
							<?php } ?>									
							<?php if(count($rs['file']) < 1){ ?>
									<li class="t_center"> <p class="ptb_10">등록된 첨부파일이 없습니다.</p></li>
							<?php } ?>
                        </ul>

                    </div>

                </div>
            </div>


            <div class="view_bottom mt_80 pt_30">
                <!--하단-->
                <div class="row ai_c ai_sm_fs jc_sb">
                <div class="col_7 arrow ar_prev">
                   <!-- <a href="/news/source_view">
                        <i class="iconFt_arrow_bar_l_2"></i>
                        <span class="txt_box">
                           <span class="fw_600 ">PREV</span>
                           <span class="ellip_1">이전</span>
                        </span>
                   </a> -->
                </div>
                <div class="col_10 t_center"><a href="/onesource/list?page=<?=$nPage?>" class="btn_md btn_cg2">목록</a></div>
                <div class="col_7 t_right arrow ar_next">
                    <!-- <a href="/news/source_view">
                       <i class="iconFt_arrow_bar_r2"></i>
                       <span class="txt_box">
                           <span class="fw_600 ">NEXT</span>
                           <span class="ellip_1">다음</span>
                       </span>
                   </a> -->
                </div>
              </div>
            </div>
        </div>
    </section>

<?php include "footer.php"; ?>