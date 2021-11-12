<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container" class="type_opinion"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box mb_20">
                <h1><a href="/opinion/index">오피니언</a></h1>
                <ul class="tit_tab_box">
                    <li><a href="/editorial" class="on">사설</a></li>
                    <li><a href="/column">칼럼</a></li>
                </ul>
            </div>

			<?if(count($rs_editorial_list['data']) > 0){?>
            <ul class="ul_img_box">
                <?
				for ($j = 0 ; $j < count($rs_editorial_list['data']); $j++) {
					$data = $rs_editorial_list['data'][$j];

					$img = '/resource/images/no_image.jpg';
					$fpath = ltrim($data['mthumbnail'], '/');

					if(_IMAGE_ROOT != '' && $fpath != ''){
						
						$root_path = rtrim(_IMAGE_ROOT, '/');
						$fpath = ltrim($fpath, '/');				

						$filename = end(explode("/", $fpath));

						$thumb_path = str_replace($filename, "thumb/".$filename, $fpath);

						if(file_exists($root_path."/".$thumb_path)){
							$img = rtrim(_IMAGE_URL, '/')."/".$thumb_path;
						}else if(file_exists($root_path."/".$fpath)){
							$img = rtrim(_IMAGE_URL, '/')."/".$fpath;
						}	
					}

					$writer_name = "";
					$writer_role = $data['company'];

					if($data['contributor'] != ""){
						$writer_name = $data['contributor'];
					}else{
						if($data['name'] != ""){
							$writer_name = $data['name']." ".$writer_role;
						}else{
							$writer_name = "DB 업데이트 후 정상 작동합니다";
						}
						
					}

				?>
                <li class="ul_img_item">
                    <div class="ul_img">
                        <div class="ul_img_img">
							<a href="/<?=$data['serial']?>.html">
								<img src="<?=$img?>" alt="<?=$data['title']?> 사진"/>
							</a>
                        </div>
                        <div class="ul_img_text">
                            <div>
								<a href="/<?=$data['serial']?>.html" class="ul_img_tit_box">
									<span class="ul_img_tit"><?=$data['title']?></span>
								</a>
                                <div class="ul_img_info_box">
                                    <ul class="ul_img_info">
                                        <li><?=$writer_name?></li>
										<li><?=$data['published_time']?></li>
                                    </ul>
                                </div>

								<p class="ul_img_txt"><a href="/<?=$data['serial']?>.html"><?=$data['description']?></a></p>

                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
			<?php }else{ ?>

				<!--게시글 x-->
				<div class="noData">
					<div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
					<p>‘오피니언’<b> 게시글이 없습니다.</b></p>
				</div>

			<?php } ?>



            <div class="btn_page_box mt_20 mb_5">
				<?php if($rs_editorial_list['total'] > 0){ ?>
					<div class="page_wrap st_2">
						<?=$rs_editorial_list['paging']?>
					</div>
				<?php } ?>

				<!--
                <div class="page_wrap st_2">
                    <div class="page">
                        <a href="javascript:void(0);" class="first"><i class="icon_prev2">이전10개</i></a>
                        <a href="javascript:void(0);" class="prev"><i class="icon_prev">이전페이지</i></a>
                        <span class="current_m"><span>3</span><span class="total"> / 69</span></span>


                        <span class="page_p">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#" class="act">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">7</a>
                            <a href="#">8</a>
                            <a href="#">9</a>
                            <a href="#">10</a>
                        </span>

                        <a href="javascript:void(0);" class="next"><i class="icon_next">다음페이지</i></a>
                        <a href="javascript:void(0);" class="end"><i class="icon_next2">다음10개</i></a>
                    </div>
                </div>
				-->
            </div>

        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>
</div><!--container//-->
</body>

</html>
