<?php include "top.php"; ?>
	<section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/minsopick">민소픽</a></h1>
            </div>
            <div class="top_news row">
                <div class="col_ col_md_24 top_news_left_wrap">
                    <div class="top_news_left">
                        <div class="top_news_left_text">
                            <p class="top_news_left_tit"><a href="/<?=$rs[0]['serial']?>.html"><?=$rs[0]['title']?></a></p>
                            <p  class="top_news_left_day"><?=substr($rs[0]['published_time'],0,16)?></p>
                            <p  class="top_news_left_txt"><?=$rs[0]['description']?></p>
                        </div>
                        <?php if($rs[0]['mthumbnail'] != ""){ ?>
						<div class="top_news_left_img">
                            <a href="/<?=$rs[0]['serial']?>.html">
                                <img src="<?=_IMAGE_URL.$rs[0]['mthumbnail']?>" alt="<?=$rs[0]['title']?>" />
                            </a>
                        </div>
						<?php } ?>
                    </div>
                </div>

                <div class="col_ col_md_24 top_news_right_wrap">
                    <div class="top_news_right">
                        <ul>
                            <?php for($i=1; $i<count($rs); $i++) { ?>
							<li>
                                <div class="top_news_right_top">
                                    <p class="top_news_right_top_tit"><a href="/<?=$rs[$i]['serial']?>.html"><?=$rs[$i]['title']?></a></p>
                                    <?php if($rs[$i]['mthumbnail'] != ""){ ?>
									<div class="top_news_right_top_img">
                                        <a href="/<?=$rs[$i]['serial']?>.html">
                                             <img src="<?=_IMAGE_URL.$rs[$i]['mthumbnail']?>" alt="<?=$rs[$i]['title']?>" />
                                        </a>
                                    </div>
									<?php } ?>
                                </div>
                                <p class="top_news_right_txt">
                                    <a href="/<?=$rs[$i]['serial']?>.html"><?=$rs[$i]['description']?></a>
                                </p>
                            </li>
							<?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <h2 class="mt_75">민소픽 기사 목록</h2>
            <div class="mt_15 mb_25"><hr class="line_2"></div>

            <!--cate_box-->
			<?php 
			foreach($rs2 as $rs2) { 
				if($rs2['cnt'] > 0){
				?>
				<div class="cate_box">
					<h3 class="color_pick">
						<span class="box">
							<span class="box_text"><?=$rs2['cnt']?></span>
						</span>
						<span><?=$rs2['title']?></span>
					</h3>
					<ul class="ul_img_box">

						<?php foreach($rs2['data'] as $data) { ?>
						<li class="ul_img_item">
							<div class="ul_img">
								
								<?php if($data['mthumbnail'] != ""){ ?>
								<div class="ul_img_img">
									<a href="/<?=$data['serial']?>.html">
										<img src="<?=_IMAGE_URL.$data['mthumbnail']?>" alt="<?=$data['title']?>" />
									</a>
								</div>
								<?php } ?>
								
								<div class="ul_img_text">
									<div>
										<a href="/<?=$data['serial']?>.html" class="ul_img_tit_box">
											<span class="ul_img_tit"><?=$data['title']?></span>
										</a>
										<div class="ul_img_info_box">
											<ul class="ul_img_info">
												<li><?=($data['contributor'] != '') ? $data['contributor'] : $data['writer_name']." 기자";?></li>
												<li><?=substr($data['published_time'],0,16)?></li>
											</ul>
										</div>
										<p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?></a></p>
									</div>
								</div>
							</div>
						</li>
						<?php } ?>						
					</ul>
					<a href="/minsopick/list?group=<?=$rs2['id']?>&title=<?=urlencode($rs2['title'])?>" class="more">더보기</a>
				</div>
				<?php 
				} 
			}
			?>

            <!--loading-->
            <!-- <div class="loading">
                <div></div>
                <div></div>
                <div></div>
            </div> -->
            <!--loading//-->

            <!-- <a href="javascript:void(0)" class="more_btn">더보기 <i class="iconFt_arrow_d"></i></a> -->

            </div>
    </section>

<?php include "footer.php"; ?>