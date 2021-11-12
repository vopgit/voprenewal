<?php include "top.php"; ?>
	<section class="con">
        <div class="view_top">
            <div class="wrap_980">
                <div class="view_top_cate2">
                    <span class="view_top_cate2_txt1">민소픽</span>
                    <span class="view_top_cate2_txt2"><a href="/minsopick/list?group=<?=$rs['minsopick_id']?>&title=<?=urlencode($rs['minsopick_title'])?>"><?=$rs['minsopick_title']?></a></span>
                </div>
                <h1 class="view_top_tit"><?=$rs['title']?></h1>
                <p class="view_top_sub_tit"><?=$rs['description']?></p>

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
        <div class="wrap_640">

            <div class="view_con_left pt_60">
                <div class="editor">
					<?=$rs['content']?>
				</div>

                <!-- <div class="mt_50 mt_sm_5"> -->

                    <div class="vcr_box bg_wh ">
						<h2 class="vcr_tit bor_bt_111">
							<span>기사 원소스 보기</span>
							<?php if(count($rs['osmu']) > 0){ ?>
								<span class="vcr_count"><?=(count($rs['osmu']) > 999) ? '999+' : count($rs['osmu']);?></span>
							<?php } ?>
						</h2>                       
						<?php if(count($rs['osmu']) > 0){ ?>
							<ul class="vcr_list list_dot dst_1  tc_b4">
								<?php foreach($rs['osmu'] as $rdata) { ?>
									<li><a href="/<?=$rdata['serial']?>.html"><span><?=$rdata['title']?></span></a></li>
								<?php } ?>
							</ul>
						<?php }else{ ?>
							<ul class="vcr_list dst_1 tc_b5">
								<li class="t_center "> <p class="ptb_10">등록된 원소스가 없습니다.</p></li>
							</ul>
						<?php } ?>
						<?php if(count($rs['osmu']) > 0){ ?>
							<a href="/onesource?article=<?=$rs['serial']?>" class="more">더보기</a>
						<?php } ?>
                    </div>

                    <?php /***리뷰 주석은 제거하지 마세요***/ ?>
					<div class="vcr_box bg_wh">
						<!--리뷰하단시작-->
						<h2 class="vcr_tit bor_bt_111">
							<span>기사 리뷰 보기</span>
							<span class="vcr_count"><?=($rs['review']['total'] > 999) ? '999+' : $rs['review']['total'];?></span>
						</h2>
						<?php if($rs['review']['total'] > 0){ ?>
							<ul class="vcr_list dst_1 tc_b4">
								<?php 
								for ($j = 0 ; $j < count($rs['review']['data']); $j++) {
									$data = $rs['review']['data'][$j];
									$data['contents'] = preg_replace('/\r\n|\r|\n/', '', strip_tags($data['contents']));
									?>									
									<li><a href="/<?=$data['serial']?>.html"><i class="iconFt_review"></i><span><?=$data['contents']?></span></a></li>
									<?php 
								}
								?>
							</ul>
						<?php } ?>

						<?php if($rs['review']['total'] < 1){ ?>
							<ul class="vcr_list dst_1 tc_b5">
								<li class="t_center row ai_c jc_c"> <i class="iconFt_bubble mr_5"></i><p class="ptb_10 "> 첫번째 리뷰를 작성해 보세요.</p></li>
							</ul>
						<?php } ?>

						<button type="button" class="vcr_review_button"  onclick="popupOpen()"><span><i class="iconFt_pen tc_2 mr_5"></i><span>기사 리뷰 쓰기</span></span></button>
						<a href="/review" class="more">더보기</a>
						<!--리뷰하단끝-->
                    </div>

                    <div class="vcr_box bg_wh">                       					
						<h2 class="vcr_tit bor_bt_111"><span>관련 기사</span></h2>
						<ul class="vcr_list dst_1">
							<?php foreach($rs['relate'] as $rdata) { ?>
								<li><a href="<?=$rdata['serial']?>.html">
									<?php if($rdata['thumb'] != ''){ ?>
									<span class="img_box">
										<span class="img_con"><img src="<?=rtrim(_IMAGE_URL,'/')."/".ltrim($rdata['thumb'], '/')?>" alt="사진"></span>
									</span>
									<?php } ?>
									<span><?=$rdata['title']?></span></a>
								</li>
							<?php } ?>
							<?php if(count($rs['relate'])< 1){ ?>
								<li class="t_center "> <p class="ptb_10">등록된 관련 기사가 없습니다.</p></li>
							<?php } ?>
						</ul>
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
                                        <b class="tc_b">“ <?=$support_name?> ”</b> <span class="dp_inb"> 응원하기</span>
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

                <!-- </div> -->
            </div>
        </div>

        <!--광고  --->
        <div class="arcad mt_80 wrap_1180">
            <script type="text/javascript" src="/templates/adv/2021_renew/minsopick_bottom_ad.js"></script>
        </div>
    </section>

<?php include "footer.php"; ?>