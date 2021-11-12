<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>

    <!-- Google ADServer Script(S) -->
    <script type="text/javascript" src="//www.googletagservices.com/tag/js/gpt.js"></script>
    <script type="text/javascript" src="/templates/admanager/google_admanager_head_script_20211103_2.js"></script>
    <!-- Google ADServer Script(E) -->

</head><!--head //-->

<body>
<script type="text/javascript">
$(document).ready(function() {
	var page = <?=($nPage == "") ? '1' : $nPage;?>;
	var totpage = <?=($rs['tot_page'] > 0) ? $rs['tot_page'] : '0';?>;
	
	$('.more_btn').on('click', function(){
		
		var next_page = page + 1;

		$('.more_btn').hide();
		$('.pre_loading_img').show();

		if(next_page > totpage){
			alert('마지막 페이지 입니다');
			return;
		}else{
			$.ajax({
				type: 'post',
				url: '/<?=$_base['url'][1]?>',
				data: {'mode': 'next_page', 'nPage': next_page},
				success: function(msg){
					$('.article_list').append(msg);
					
					$('.pre_loading_img').hide();
					if(next_page < totpage) $('.more_btn').show();
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
					$('.pre_loading_img').hide();
					$('.more_btn').show();
				} 				
			});			
			page++;
		}
	});
});
</script>
<div id="container"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
           

            <div class="tit_box">
                <h1><?=$_page_title?></h1>
            </div>

            <div class="top_news fd_md_col_re">
                <div class="top_news_text">
                    <p class="top_news_tit"><a href="/<?=$rs['data'][0]['serial']?>.html"><?=$rs['data'][0]['title']?></a></p>
                    <p class="top_news_day">
						<a href="/<?=$rs['data'][0]['serial']?>.html"><?=($rs['data'][0]['contributor'] != '') ? $rs['data'][0]['contributor'] : $rs['data'][0]['name']." 기자";?> 
						<span class="mlr_10 fw_100">I</span> <?=substr($rs['data'][0]['published_time'],0,16)?></a>
					</p>
                    <?php if($rs['data'][0]['description'] != ''){ ?>
						<p class="top_news_txt"><a href="/<?=$rs['data'][0]['serial']?>.html"><?=$rs['data'][0]['description']?></a></p>
					<?php } ?>
                </div>
                <?php 
				if($rs['data'][0]['mthumbnail'] != ''){ 
					$f = getimagesize(_IMAGE_URL.ltrim($rs['data'][0]['mthumbnail'],'/'));
					if($f[0] > 0){
						?>
						<div class="top_news_img">
							<a href="/<?=$rs['data'][0]['serial']?>.html">
								<img src="<?=_IMAGE_URL.ltrim($rs['data'][0]['mthumbnail'],'/')?>" alt="<?=$rs['data'][0]['title']?>" onerror="noImage(this);" />
							</a>
						</div>
						<?php 
					} 
				}
				?>
            </div>

            <!--광고 pc mo-->
            <div id='div-gpt-ad-1350270943364-2' class="mt_40 mlr_auto t_center">
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1350270943364-2'); });
                </script>       
            </div>

            <div class="sec st_2 line_top mt_40 pt_35">
                <div class="sec_left">
					
                    <h2 class="font_esm">최신기사</h2>
                    <ul class="ul_img_box article_list">
                        <?php 
						for($i=1; $i<count($rs['data']) ; $i++) {
							$data = $rs['data'][$i];
							?>
							<li class="ul_img_item">
								<div class="ul_img">
									<?php 
									if($data['mthumbnail'] != ''){ 
										$f = getimagesize(_IMAGE_URL.ltrim($data['mthumbnail'],'/'));
										if($f[0] > 0){
											?>
											<div class="ul_img_img">
												<a href="/<?=$data['serial']?>.html">
													<img src="<?=_IMAGE_URL.ltrim($data['mthumbnail'],'/')?>" alt="<?=$data['title']?>" onerror="noImage(this);"/>
												</a>
											</div>
											<?php 
										} 
									}
									?>
									<div class="ul_img_text">
										<div>
											<a href="/<?=$data['serial']?>.html" class="ul_img_tit_box">
												<span class="ul_img_tit"><?=$data['title']?></span>
											</a>
											<div class="ul_img_info_box">
												<ul class="ul_img_info">
													<li><?=($data['contributor'] != '') ? $data['contributor'] : $data['name']." 기자";?></li>
													<li><?=substr($data['published_time'],0,16)?></li>
												</ul>
											</div>
											<?php if($data['description'] != ''){ ?>
												<p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?> </a></p>
											<?php } ?>
										</div>
									</div>
								</div>
							</li>
							<?php 
							} 
						?>
                    </ul>
					
					<div class="loading pre_loading_img" style="display:none">
						<div></div><div></div><div></div>
					</div>
                    <a href="javascript:void(0)" class="more_btn">더보기 <i class="iconFt_arrow_d"></i></a>
                </div>

                <div class="sec_right">
                    <div class="rank">
                        <h3 class="line font_esm"><?=$_page_title?> 가장 많이 읽은 기사</h3>
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


                    <div class="opinion">
                        <h3 class="line font_esm mb_15 mb_md_30">오피니언</h3>
                        <ul class="opinion_area">
							<?php 
							$i = 0;
							foreach($opinion as $opinion) {
								?>
								<li class="opinion_item">
									<div class="opinion_img">
										<a href="/<?=$opinion['serial']?>.html">
											<img src="<?=_IMAGE_URL.$opinion['thumb_filepath']?>" alt="<?=$opinion['author']?>" onerror="noImage(this);">
										</a>
									</div>
									<div class="opinion_text">
										<a href="/<?=$opinion['serial']?>.html">
											<span class="<?=($opinion['color'] == "blue") ? "tc_1" : "tc_2";?>"><?=$opinion['description']?></span>
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
                        <h3 class="line font_esm mb_15 mb_md_30">만평</h3>
                        <div class="cartoon_area">
                            <a href="/<?=$cartoon[0]['serial']?>.html">
								<img src="<?=_IMAGE_URL.$cartoon[0]['filepath']?>" alt="<?=$cartoon[0]['title']?>" onerror="noImage(this);" data-size="280, 335">
								<span class="cartoon_txt1"><?=$cartoon[0]['description']?></span>
								<span class="cartoon_txt2"><?=$cartoon[0]['title']?></span>
							</a>
                        </div>
                        <a href="/cartoon" class="more">더보기</a>
                    </div>
                </div>
            </div>
        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>

</div><!--container//-->
</body>

</html>
