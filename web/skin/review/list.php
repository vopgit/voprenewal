<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container" class="type_review"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/review">
					<?php if($s_name != ''){ ?>
						<?=$s_name?>님의 
					<?php } ?>
					리뷰</a>
				</h1>

                <div class="search_box">
                    <form name="frmsub" id="frmsub" method="get" action="/review">
						<input type="hidden" name="s_no" value="<?=$s_no?>">
						<input type="hidden" name="s_name" value="<?=urldecode($s_name)?>">
						<input type="hidden" name="article" value="<?=$article?>">
                        <input type="text" name="st" id="st" value="<?=$st?>" class="search_box_inp" placeholder="검색어를 입력해주세요">
                        <button type="submit" class="search_box_button">
                            <span>
                                <i class="iconFt_search"></i>
                            </span>
                        </button>
                    </form>
                </div>
            </div>

			<?php if($article != ""){ ?>
			<div class="info_box">
                <a href="/<?=$article?>.html" class="info_link">
                    <span class="info_tit">원기사</span>
                    <span class="info_txt"><?=$otitle?></span>
                </a>
                <a href="/review" class="info_button">돌아가기</a>
            </div>
			<?php } ?>

            <?php if(count($rs['data']) > 0){ ?>
			<ul class="ul_img2_box">            
				<?php foreach($rs['data'] as $data){ ?>
					<li class="ul_img2_item">
						<div class="ul_img2">
							<div class="ul_img2_text">
								<div>
									<a href="<?=$data['writer_url']?>" class="ul_img2_tit_box">
										<span class="ul_img2_tit">“<?=$data['writer']?>”님의 리뷰</span>
									</a>
									<p class="ul_img2_txt"><a href="/<?=$data['serial']?>.html"><?=$data['contents']?></a></p>
									<div class="ul_img2_info_box">
										<ul class="ul_img2_info">
											<li><?=substr($data['published_date'],0,10)?></li>
											<li>
												<div class="ul_img2_info_item">
													<span class="ul_img2_info_item_tit">원기사</span>
													<p class="ul_img2_info_item_txt">
														<a href="/review?article=<?=$data['osmu_serial']?>"><?=$data['osmu_title']?></a>
													</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<?php if($data['photo'] != '' && getimagesize($data['photo'])){ ?>
							<div class="ul_img2_img_box">
								<div class="ul_img2_img">
									<a href="/news/review_view">
										<img src="<?=$data['photo']?>" alt="이미지" />
									</a>
								</div>
							</div>
							<?php } ?>
						</div>
					</li>
				<?php } ?>
            </ul>
			<?php } ?>

            <?php if(count($rs['data']) < 1){ ?>
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘리뷰’<b> 게시글이 없습니다.</b></p>
            </div>
			<?php } ?>

            <div class="page_wrap mt_50 mb_35 st_2">
                <?=$rs['paging']?>
            </div>


        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>

</div><!--container//-->
</body>

</html>
