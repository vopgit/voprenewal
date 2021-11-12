<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container" class="type_pick"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/minsopick">민소픽</a></h1>
            </div>

            <h3 class="flex ai_c mt_30 mb_10 color_pick">
                <span class="box">
                    <span class="box_text"><?=$rs['total']?></span>
                </span>
                <span><?=($title == "미지정") ? "민소픽" : $title;?></span>
            </h3>
            <!-- box //-->


            <ul class="ul_img_box">
                <?php foreach($rs['data'] as $data){ ?>
                <li class="ul_img_item">
                    <div class="ul_img">
                        <?php 
						if($data['mthumbnail'] != ""){ 
							$f = getimagesize(_IMAGE_URL.ltrim($data['mthumbnail'],'/'));
							if($f[0] > 0){								
								?>
								<div class="ul_img_img">
									<a href="/<?=$data['serial']?>.html">
										<img src="<?=_IMAGE_URL.ltrim($data['mthumbnail'],'/')?>" alt="<?=$data['title']?>" onerror="noDataImage(this)" />
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
                                <p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?></a></p>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>

            <?php if($rs['total'] < 1){ ?>
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘민소픽’<b> 게시글이 없습니다.</b></p>
            </div>
			<?php } ?>

            <div class="btn_page_box mt_20 mb_5">
                <div class="page_wrap st_2">
                    <?=$rs['paging']?>
                </div>
            </div>

        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>
</div><!--container//-->
</body>

</html>
