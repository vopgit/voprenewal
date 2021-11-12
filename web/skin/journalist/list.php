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
<div id="container"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><?=$name_print?></h1> 
            </div>

            <div class="sub_arcad ptb_35 mb_10 flex jc_c line">
                <!--광고 pc mo-->
                <div class="arcad center arcad_area_pc size_728x90">
                    <!-- <div class="dfpAd"></div> -->
                    <div id='div-gpt-ad-1350270943364-2'>
                        <script type='text/javascript'>
                            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1350270943364-2'); });
                        </script>       
                    </div>
                </div>
                <!--광고//-->
            </div>

            <ul class="ul_img_box">
                <?php 
				foreach($rs['data'] as $data) {
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
										<span class="ul_img_tit">
											<!-- <span style="color:#999;font-size:0.8em;">[<?=$data['kind_name']?>]</span> <br> -->
											<?=$data['title']?>
										</span>
									</a>
									<div class="ul_img_info_box">
										<ul class="ul_img_info">
											<li><?=$name_print?></li>
											<li><?=substr($data['published_time'],0,16)?></li>
										</ul>
									</div>
									<p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?></a></p>
								</div>
							</div>
						</div>
					</li>
					<?php 
					} 
				?>
            </ul>
            
			<?php if($rs['total'] < 1){ ?>
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p><b>발행된 기사가 없습니다.</b></p>
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
