<?php include "preview_main_top.php"; ?>

    <div class="con main"><!--con main-->
        <div class="wrap_1180">
        <section class="news_top">
            <div class="news news1">
                <div class="news_area">
                    <div class="news_text">
                        <h1 class="news_tit">
                            <a href="<?=$top[0]['url']?>">
                                <?php if($top[0]['box_title'] != ''){?>
									<span class="tag <?=$top[0]['box_style']?>"><?=$top[0]['box_title']?></span>
								<?php } ?>
								<?=$top[0]['title']?>
                            </a>
                        </h1>
                        <!--모바일 이미지-->
                        <div class="news_img mo">
                            <a href="<?=$top[0]['url']?>">
                                <img src="<?=$top[0]['photo']?>" alt="<?=fileRename($top[0]['title'])?>" onerror="noImage(this);">
                            </a>
                        </div>
                        <p class="news_txt"><a href="<?=$top[0]['url']?>"><?=$top[0]['description']?></a></p>
                        <ul class="news_list">
                            <?php foreach($top[0]['related'] as $relate){  ?>
								<li><a href="<?=rtrim(_WEB_URL, '/').'/'.ltrim($relate['serial'],'/').".html"?>"><?=$relate['title']?></a></li>
							<?php } ?>
                        </ul>
                    </div>
                    <div class="news_img pc">
                        <!-- pc이미지 이미지 비율 가로 : 세로 (비율 1.7 : 1 ) (px 680 : 400) -->
                        <a href="<?=$top[0]['url']?>">
                            <img src="<?=$top[0]['photo']?>" alt="이미지설명" onerror="noImage(this);">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="news_box">
            <div class="news_left">

                <div class="news news2">
                    <div class="news_area">
                        <div class="news_text">
                            <h2 class="news_tit">
                                <a href="<?=$top[1]['url']?>">
									<?php if($top[1]['box_title'] != ''){?>
										<span class="tag <?=$top[1]['box_style']?>"><?=$top[1]['box_title']?></span>
									<?php } ?>
									<?=$top[1]['title']?>
								</a>
                            </h2>
                            <p class="news_txt"><a href="<?=$top[1]['url']?>"><?=$top[1]['description']?></a></p>
                        </div>
                        <div class="news_img">
                            <a href="<?=$top[1]['url']?>">
                                <img src="<?=$top[1]['photo']?>" alt="<?=fileRename($top[1]['title'])?>" onerror="noImage(this);">
                            </a>
                        </div>
                    </div>
                </div>
                <!--news2//-->

                <div class="news news3">
                    <div class="news_area">
                        <div class="news_text">
                            <h2 class="news_tit">
                                <a href="<?=$top[2]['url']?>">
									<?php if($top[2]['box_title'] != ''){?>
										<span class="tag <?=$top[2]['box_style']?>"><?=$top[2]['box_title']?></span>
									<?php } ?>
									<?=$top[2]['title']?>
								</a>
                            </h2>
                            <p class="news_txt"><a href="<?=$top[2]['url']?>"><?=$top[2]['description']?></a></p>
                        </div>
                        <div class="news_img">
                            <a href="<?=$top[2]['url']?>">
                                 <img src="<?=$top[2]['photo']?>" alt="<?=fileRename($top[2]['title'])?>" onerror="noImage(this);">
                            </a>
                        </div>
                    </div>
                </div>
                <!--news3//-->

				<div class="news news4">
                    <ul class="news_area">
                        <?php for($i=3; $i<=5; $i++) { ?>
						<li class="news4_item">
                            <h2 class="news_tit">
                                <a href="<?=$top[$i]['url']?>">
									<?php if($top[$i]['box_title'] != ''){?>
										<span class="tag <?=$top[$i]['box_style']?>"><?=$top[$i]['box_title']?></span>
									<?php } ?>
									<?=$top[$i]['title']?>
								</a>
                            </h2>
                            <div class="news_text">
                               <p class="news_txt"><a href="<?=$top[$i]['url']?>"><?=$top[$i]['description']?></a></p>

								<?php if($i > 3){ ?>
								<ul class="news_list">
                                    <?php foreach($top[$i]['related'] as $relate){  ?>
										<li><a href="<?=rtrim(_WEB_URL, '/').'/'.ltrim($relate['serial'],'/').".html"?>"><?=$relate['title']?></a></li>
									<?php } ?>
                                </ul>
								<?php } ?>
                            </div>
                            <div class="news_img">
								<a href="<?=$top[$i]['url']?>">
									<img src="<?=$top[$i]['photo']?>" alt="<?=fileRename($top[$i]['title'])?>" onerror="noImage(this);">
								</a>
                            </div>
                        </li>
						<?php } ?>

                    </ul>
                </div>
                <!--news4//-->

                <div class="news news5">
                    <ul class="news_area">
                        <li class="news5_item_size"></li><!--가로값-->
                        <li class="news5_item_gutter_size"></li><!--폭 값-->

						<?php for($i=6; $i< count($top); $i++) { ?>
                        <li class="news5_item">
                            <div class="news5_item_area">
                                <h2 class="news_tit">
                                   <a href="<?=$top[$i]['url']?>">
										<?php if($top[$i]['box_title'] != ''){?>
											<span class="tag <?=$top[$i]['box_style']?>"><?=$top[$i]['box_title']?></span>
										<?php } ?>
										<?=$top[$i]['title']?>
									</a>
                                </h2>
                                <div class="news_text">
                                    <?php if($top[$i]['style'] == 'both' && $top[$i]['description'] != ""){ ?>
										<p class="news_txt"><a href="<?=$top[$i]['url']?>"><?=$top[$i]['description']?></a></p>
									<?php } ?>
                                    <?php if(count($top[$i]['related']) > 0){  ?>
										<ul class="news_list">
											<?php foreach($top[$i]['related'] as $relate){  ?>
												<li><a href="<?=rtrim(_WEB_URL, '/').'/'.ltrim($relate['serial'],'/').".html"?>"><?=$relate['title']?></a></li>
											<?php } ?>
										</ul>
									<?php } ?>
                                </div>
                            </div>
                        </li>
						<?php } ?>
                    </ul>
                </div>
                <!--news5//-->


            </div>

            <div class="news_right">
                <div class="opinion">
                    <h1>오피니언</h1>
                    <ul class="opinion_area">
						<?php 
						$i = 0;
						foreach($opinion as $opinion) {
							$css = "";
							if($opinion['color'] == "blue") $css = "ts_1";
							else if($opinion['color'] == "red") $css = "ts_2";
							?>
							<li class="opinion_item">
								<div class="opinion_img">
									<a href="/<?=$opinion['serial']?>.html">
										<img src="<?=$opinion['photo_opinion_writer']?>" alt="이미지설명" onerror="noImage(this);">
									</a>
								</div>

								<div class="opinion_text">
									<a href="/<?=$opinion['serial']?>.html">
										<span class="<?=$opinion['css']?>"><?=$opinion['description']?></span>
										<span class="opinion_txt"><?=$opinion['title']?></span>
										<span class="opinion_name"><?=$opinion['author']?></span>
									</a>
								</div>

							</li>
							<?php 
							$i++;
							if($i == 3) break;
						}		
						?>
                    </ul>
                    <a href="/opinion" class="more">더보기</a>
                </div>
                <!--opinion//-->


                <div class="ri">
                    <ul class="ri_area">                        
						<?php foreach($editorial as $editorial) { ?>
						<li class="ri_item">
                            <div class="ri_img">
                                <a href="/<?=$editorial['serial']?>.html">
                                    <img src="/resource/images/common/ss_img.jpg" alt="사설">
                                </a>
                            </div>
                            <div class="ri_text">
                                <a href="/<?=$editorial['serial']?>.html">
                                    <span class="ri_txt"><?=$editorial['title']?></span>
                                </a>
                            </div>
                        </li>
						<?php } ?>
                    </ul>
                </div><!--ri//-->

                <div class="cartoon">
                    <h1>만평</h1>
                    <a href="/opinion" class="more">더보기</a>

                    <div class="cartoon_area">
                        <a href="/<?=$cartoon[0]['serial']?>.html">
                            <img src="<?=$cartoon[0]['photo']?>" alt="<?=$cartoon[0]['title']?>" onerror="noImage(this);" data-size="280, 335">
                            <span class="cartoon_txt1"><?=$cartoon[0]['description']?></span>
                            <span class="cartoon_txt2"><?=$cartoon[0]['title']?></span>
                        </a>
                    </div>
                </div>

                <div class="rank">
                    <h1>가장 많이 읽은 기사</h1>
                    <ul class="rank_area">
                        <?php foreach($hit as $hit) { ?>
						<li class="rank_item">
                            <div class="rank_text">
                                <p><a href="/<?=$hit['serial']?>.html"><?=$hit['title']?></a></p>
                            </div>
                        </li>
						<?php } ?>
                    </ul>
                </div><!--rank//-->

            </div>
        </section><!--news_box//-->
        </div>

        <div class="wrap_1180">
            <div class="main_arcad_1">

                <div class="arcad center size_970x250">
                    <div class="dfpAd"></div>
                </div><!--광고-->

            </div>
        </div><!--arcad //-->


		<section class="academy">
            <div class="wrap_1180">
                <div class="academy_box">
                    <h1 class="academy_tit">
                        이산 아카데미
                    </h1>
                    <div class="academy_slider swiper-container">

                        <div class="swiper-wrapper">

                            <?php foreach($academy as $data) { ?>
							<div class="academy_slider_item swiper-slide">
                                <a href="<?=_WEB_URL?>/<?=$data['serial']?>.html" class="academy_slider_area">
                                    <span class="academy_slider_img">
                                    <img src="<?=$data['photo']?>" onerror="noImage(this);" data-size="80, 80">
                                    </span>

                                    <span class="academy_slider_text">
                                        <span class="academy_slider_cate"><?=$data['description']?></span>
                                        <span class="academy_slider_txt"><?=$data['title']?></span>


                                        <span class="academy_slider_list">
                                            <span data-tit="<?=$data['subject_1']?>">
                                            <div class="ellip_2 txt">
                                              <p> <?=$data['content_1']?></p>
                                              </div>
                                            </span>
                											<span data-tit="<?=$data['subject_2']?>">
                                        <div class="ellip_2 txt"> <p><?=$data['content_2']?></p></div>
                                      </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
							<?php } ?>

                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="more"><a href="/academy">더보기</a></div>
                </div>
            </div>
        </section><!--academy-->





        <section class="media">
            <div class="wrap_1180">
                <hr>
                <h1 class="media_tit">
                    포토<span class="mlr_5 fw_700">&middot;</span>영상
                </h1>
                <div class="row ai_stretch wp_40 wp_md_20 media_items photo">                    
					
					<div class="col_12 col_sm_24 media_left">
                        <div class="media_area">
                            <div class="media_img move">
                                <a href="<?=$photo[0]['link']?>" target="<?=$photo[0]['target']?>">
                                    <img src="<?=$photo[0]['photo']?>" alt="<?=$photo[0]['title']?>" onerror="noImage(this);">
                                </a>

                            </div>
                            <div class="media_text">
                                <a href="<?=$photo[0]['link']?>" target="<?=$photo[0]['target']?>">
                                    <span class="media_cate"><?=$photo[0]['description']?></span>
                                    <span class="media_txt"><?=$photo[0]['title']?></span>
                                </a>
                            </div>
                        </div>
                    </div>					
					
                    <div class="col_12 col_sm_24 media_right">
                        <div class="row ai_stretch wp_40 wp_md_20">
                            <?php for($i=1; $i<count($photo); $i++) { ?>
								<div class="col_12">
									<div class="media_area">
										<div class="media_img move">
											<a href="<?=$photo[$i]['link']?>" target="<?=$photo[$i]['target']?>">
												<img src="<?=$photo[$i]['photo']?>" alt="<?=$photo[$i]['title']?>" onerror="noImage(this);">
											</a>
										</div>
										<div class="media_text">
											<a href="<?=$photo[$i]['link']?>" target="<?=$photo[$i]['target']?>">
												<span class="media_cate"><?=$photo[$i]['description']?></span>
												<span class="media_txt"><?=$photo[$i]['title']?></span>
											</a>
										</div>
									</div>
								</div>
							<?php } ?>
                        </div>
                    </div>
                </div>
                <!--포토 영상 //-->

                <div class="row wp_40 media_items2">
                    <div class="col_8 col_md_24 enter">
                        <hr>
                        <h1 class="media_tit">
                            연예
                        </h1>
                        <ul>
                            <?php foreach($entertainment as $data) {?>
							<li>
                                <div class="media_area">
                                    <div class="media_img">
                                        <a href="/<?=$data['serial']?>.html">
                                            <img src="<?=$data['photo']?>" alt="<?=$data['title']?>" onerror="noImage(this);">
                                        </a>
                                    </div>
                                    <div class="media_text">
                                        <a href="/<?=$data['serial']?>.html">
											<span class="media_cate"><?=$data['description']?></span>
											<span class="media_txt"><?=$data['title']?></span>
										</a>
                                    </div>
                                </div>
                            </li>
							<?php } ?>
                           
                        </ul>
                        <a href="/entertainment" class="more">연예뉴스 더보기</a>
                    </div>
                    <div class="col_8 col_md_24 mt_md_20 culture">
                        <hr>
                        <h1 class="media_tit">
                            문화
                        </h1>
                        <ul>
                            <?php foreach($culture as $data) {?>
							<li>
                                <div class="media_area">
                                    <div class="media_img">
                                        <a href="/<?=$data['serial']?>.html">
                                            <img src="<?=$data['photo']?>" alt="<?=$data['title']?>" onerror="noImage(this);">
                                        </a>
                                    </div>
                                    <div class="media_text">
                                        <a href="/<?=$data['serial']?>.html">
											<span class="media_cate"><?=$data['description']?></span>
											<span class="media_txt"><?=$data['title']?></span>
										</a>
                                    </div>
                                </div>
                            </li>
							<?php } ?>
                        </ul>
                        <a href="/culture" class="more">문화뉴스 더보기</a>
                    </div>
                    <div class="col_8 col_md_24 mt_md_20 mb_sm_40 sports">
                        <hr>
                        <h1 class="media_tit">
                            스포츠/헬스
                        </h1>
                        <ul>
                            <?php foreach($sports as $data) {?>
							<li>
                                <div class="media_area">
                                    <div class="media_img">
                                        <a href="/<?=$data['serial']?>.html">
                                            <img src="<?=$data['photo']?>" alt="<?=$data['title']?>" onerror="noImage(this);">
                                        </a>
                                    </div>
                                    <div class="media_text">
                                        <a href="/<?=$data['serial']?>.html">
											<span class="media_cate"><?=$data['description']?></span>
											<span class="media_txt"><?=$data['title']?></span>
										</a>
                                    </div>
                                </div>
                            </li>
							<?php } ?>
                        </ul>
                        <a href="/sports" class="more">스포츠/헬스뉴스 더보기</a>
                    </div>
                </div>
                <!--연예, 문화, 스포츠/헬스-->


                <div class="arcad center size_728x90">
                    <div class="dfpAd"></div>
                </div><!--광고-->

            </div>
        </section>



        <section class="main_bottom mt_md_20">
            <div class="wrap_1180">


                <div class="row ai_stretch jc_sb">
                    <div class="col_24 main_bottom_left" style="padding-right: 0">
                        <h1 class="main_bottom_tit">유튜브 채널</h1>
                        <div class="main_bottom_box youtube">
                            <div class="youtube_slider swiper-container swiper-container-initialized swiper-container-horizontal">

                                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                                    
									<?php foreach($youtube as $data) {?>
									<div class="youtube_slider_item swiper-slide swiper-slide-active" style="width: 206.8px;">
                                        <a href="https://www.youtube.com/user/MediaVop" target="_blank" class="youtube_slider_area">
                                            <span class="youtube_slider_img">
                                            <img src="<?=$data['photo']?>" alt="<?=$data['description']?>" onerror="noImage(this);" data-size="80, 80">
                                            </span>

                                            <span class="youtube_slider_text" style="height:1.5em;">
                                                <i class="iconFt_youtube"></i>
                                                <span><?=$data['title']?></span>
                                            </span>
                                        </a>
                                    </div>
									<?php } ?>

                                </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

                            <button type="button" class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></button>
                            <button type="button" class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></button>
                        </div>
                    </div>

                    <div class="col_24 main_bottom_bottom">
                        <div class="main_bottom_box notice_box">
                            <div class="notice">
                                <div class="notice_tit">알림</div>
                                <div class="notice_txt">
									<?php if($alim['data'][0]['id'] != ''){ ?>
										<a href="/alim/<?=$alim['data'][0]['serial']?>"><span class="fw_400">[<?=$alim['data'][0]['category']?>]</span> <?=$alim['data'][0]['title']?></a></div>
									<?php }else{ ?>
										알림글이 없습니다.
									<?php } ?>
                                <div class="notice_day"><?=str_replace('-', '.', substr($alim['data'][0]['reg_date'],0,10))?></div>
                                <div class="notice_more"><a href="/alim">더보기</a></div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="mo_scroll_top">
                    <a href="#" class="">
                        <i class="iconFt_arrow_middle_u"></i>
                        <span>TOP</span>
                    </a>
                </div>

            </div>
        </section>

        </div><!--main //-->

<?php include "preview_main_footer.php"; ?>
