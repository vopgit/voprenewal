<!DOCTYPE html>
<html lang="ko">
<head>

	<title>민중의소리</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="apple-mobile-web-app-title" content="" />
    <meta name="robots" content="index,follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>

    <meta property="og:title" id="meta_og_title" content="">
    <meta property="og:url" id="meta_og_url" content="">
    <meta property="og:image" content="/resource/images/meta.jpg">
    <meta property="og:description" id="meta_og_description" content=""/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:url" content="">
    <meta name="twitter:description" content=""/>

	<!-- font -->
	<link rel="preconnect" href="//fonts.googleapis.com">
	<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
	<link href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/sub.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/editor.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/common.css?v=2"/>
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>
	<style media="screen">
		html,body{
			background: transparent;
		}
		.popup_wrap{
			max-height:90%;
		}
		.popup_con{
            padding:2em 0 0;
			position: relative;
		}
        .popup_contents {
            padding: 0;
        }
		.pop_close{
			position: absolute;
			top:0;
			right:0;
			width: 2em;
			height: 2em;
			font-size: 2rem;
			text-align: center;
			z-index: 100;
		}
	</style>
</head><!--head //-->

<body>

<div class="popup_box st_preview">
    <div class="popup_wrap wrap1300">
        <div class="popup_ty1 popup_con">
			<button class="pop_close" type="button">&times;</button>
            <div class="popup_contents">

				<!--미리보기-->
				<div class="view_top">
					<div class="wrap_980">
						<h1 class="view_top_tit"><span class="view_top_cate"><?=$rs['category_name']?></span> <?=$rs['title']?></h1>
						<p class="view_top_sub_tit"><?=$rs['description']?></p>

						<div class="flex fw_nowrap">
							<div class="view_top_info_box mr_auto">
								<ul class="view_top_info">
									<li><?=$rs['writer_print']?></li>
									<li>발행 <?=$rs['published_time']?></li>
									<li>
										<?php if($rs['update_time']!= ""){ ?>
											수정 <?=$rs['update_time']?></li>
										<?php } ?>
									</li>
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
								<?=$rs['body']?>
							</div>
						</div>
						<div class="view_con_right">
							<!--오른쪽-->
							<div class="vcr_box">
								<h2 class="vcr_tit"><span>관련 기사</span></h2>
								<ul class="vcr_list">
									
									<?php foreach($rs['relate'] as $rdata) { ?>
										<li>
											<a href="#<?=$rdata['serial']?>">
												<span><?=$rdata['title']?></span>
											</a>
										</li>
									<?php } ?>


									<?php if(count($rs['relate']) < 1){ ?>
										<li class="t_center "> <p class="ptb_10">등록된 관련 기사가 없습니다.</p></li>
									<?php } ?>
								</ul>
							</div>

							<div class="vcr_box">
								<h2 class="vcr_tit"><span>원소스</span></h2>
								<ul class="vcr_list">
									<?php foreach($rs['osmu'] as $rdata) { ?>
										<li>
											<a href="#<?=$rdata['serial']?>">
												<span><?=$rdata['title']?></span>
											</a>
										</li>
									<?php } ?>


									<?php if(count($rs['osmu']) < 1){ ?>
										<li class="t_center "> <p class="ptb_10">등록된 원소스가 없습니다.</p></li>
									<?php } ?>
								</ul>
							</div>

						</div>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>

</body>

</html>
