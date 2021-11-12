<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1>최민의 시사만평</h1>
            </div>


            <?php if(count($rs['data']) > 0){ ?>
			<ul class="ul_img3_box">
                <?php 
				for($i=0; $i<count($rs['data']) ; $i++) {
					$data = $rs['data'][$i];
					?>
					<li class="ul_img3_item">
						<div class="ul_img3">
							<div class="ul_img3_img">
								<a href="/<?=$data['serial']?>.html">
								<img src="<?=_IMAGE_URL.ltrim($data['mthumbnail'],'/')?>" alt="<?=$data['title']?>" onerror="noImage(this);" data-size="280, 335">
								</a>
							</div>
							<div class="ul_img3_text">
								<a href="/<?=$data['serial']?>.html" class="ul_img3_tit_box">
									<span class="ul_img3_tit_sub"><?=$data['description']?> </span>
									<span class="ul_img3_tit"><?=$data['title']?></span>
								</a>
								<div class="ul_img3_info_box">
									<ul class="ul_img3_info">
										<li><?=substr($data['published_time'],0,16)?></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
					<?php 
					} 
				?>
            </ul>
			<?php } ?>

            <!--게시글 x-->
			<?php if(count($rs['data']) < 1){ ?>
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘만평’<b> 게시글이 없습니다.</b></p>
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
