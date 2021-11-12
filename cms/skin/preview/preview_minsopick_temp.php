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
	<script  src="/resource/js/jquery-3.4.1.min.js"></script>
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

<div id="container" class="type_pick view_container">
	<div class="popup_box">
		<div class="popup_wrap wrap1300">
			<div class="popup_ty1 popup_con">
				<button class="pop_close" type="button">&times;</button>
				<div class="popup_contents">
					<div class="view_top">
						<div class="wrap_980">
							<div class="view_top_cate2">
								<span class="view_top_cate2_txt1">민소픽</span>
							</div>
							<h1 class="view_top_tit"><?=$rs["title"]?></h1>

							<div class="flex fw_nowrap">
								<div class="view_top_info_box mr_auto">
									<ul class="view_top_info">
										<li>(<?=$rs["name"]?>)<?=$rs["contributor"]?> <?=$rs["email"]?></li>
										<li>발행 <?=$rs["published_time"]?></li>
										<li>수정 <?=$rs["update_time"]?></li>
									</ul>
								</div>

								<div class="view_top_share_box ml_auto">
									<button type="button"><i class="iconFt_share"></i></button>
									<ul class="view_top_share">
										<li><button type="button"><i class="iconFt_facebook1"></i></button></li>
										<li><button type="button"><i class="iconFt_twitter"></i></button></li>
										<li><button type="button"><i class="iconFt_kakao1"></i></button></li>
										<li><button type="button"><i class="iconFt_link"></i></button></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--view_top}-->

					<div class="wrap_980">
						<div class="view_con">
							<div class="view_con_left">
								<div class="editor">
									내용
								</div>

								<!--editor}-->
							</div>
							<!--view_con_left }-->
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


</section>

<script>
$('.btn_step2').click(function(){
    $('.btn_step2').closest('.step_1').slideUp();
    $('.step_2').slideDown();
 });
 $('.btn_stepBack').click(function(){
    $('.step_2').slideUp();
    $('.step_1').slideDown();
});
</script>
