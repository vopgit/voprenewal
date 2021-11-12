<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?=$og['title']?> - 민중의소리</title>
<link rel="canonical" href="<?=$og['url']?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">

<meta name="apple-mobile-web-app-title" content="<?=$og['title']?>" />
<meta name="robots" content="index,follow"/>
<meta name="keywords" content="<?=$og['keywords']?>"/>
<meta name="description" content="<?=$og['description']?>"/>

<meta property="fb:pages" content="109848225769421" />
<meta property="fb:app_id" content="388188387943690">

<meta property="og:type" content="article">
<meta property="og:site_name" content="민중의소리" />
<meta property="og:title" content="<?=$og['title']?>">
<meta property="og:image" content="<?=$og['image']?>">
<meta property="og:description" content="<?=$og['description']?>"/>

<meta property="article:published" content="<?=$og['pub_date']?>" />
<meta property="article:modified" content="<?=$og['mode_date']?>" />
<meta property="article:publisher" content="https://www.facebook.com/newsvop" />
<meta property="og:locale" content="ko_KR" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?=$og['title']?>">
<meta name="twitter:url" content="<?=$og['url']?>">
<meta name="twitter:image" content="<?=$og['image']?>">
<meta name="twitter:description" content="<?=$og['description']?>"/>

<!-- Dable 정보수집 메타테그(S)-->
<meta property="dable:item_id" content="VOPdable1601980">
<meta property="dable:author" content="<?=$og['author']?>">
<meta property="article:section" content="<?=$og['category']?>">
<meta property="article:published_time" content="<?=str_replace(" ", "T", $og['pub_date'])?>+09:00">
<!-- Dable 정보수집 메타테그(E)-->


	<!-- font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

	<!--favicon-->
	<link rel="icon" type="image/png" sizes="32x32" href="/resource/images/favicon_32.png" />
	<link rel="icon" type="image/png" sizes="196x196" href="resource/images/favicon_196.png" />

	<!--icon-->
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>


	<!--style -->
	<link rel="stylesheet" type="text/css" href="/resource/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/layout.css"/>

	<!--js -->
	<script  src="/resource/js/jquery-3.4.1.min.js"></script>
	<script  src="/resource/js/common.js?v=1"></script>
	<script  src="/resource/js/layout.js?v=1"></script>
	<script  src="/resource/js/ui.js"></script>

	<!--lib / gsap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollToPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.6.3/smooth-scrollbar.js" ></script>

	<!--lib / aos-->
	<!-- <link rel="stylesheet" type="text/css" href="/resource/lib/aos/aos.css"/>
	<script  src="/resource/lib/aos/aos.js"></script> -->

	<!-- clipboard -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/resource/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <link rel="stylesheet" type="text/css" href="/resource/css/editor.css"/>

    <script src="/resource/lib/slick/slick.min.js"></script>
    <script src="/resource/js/sub.js"></script>

    <!-- Google ADServer Script(S) -->
    <script type="text/javascript" src="//www.googletagservices.com/tag/js/gpt.js"></script>
    <script type="text/javascript" src="/templates/admanager/google_admanager_head_script_20211103.js"></script>
    <!-- Google ADServer Script(E) -->
    <!-- Dable 스크립트 시작 / 문의 support@dable.io -->
    <script type="text/javascript" src="/templates/js_2019/dable_head.js"></script>
    <!-- Dable 스크립트 종료 / 문의 support@dable.io -->
    <!-- Criteo Header Code / 인라이플 메타태그 삽입  -->
    <script type="text/javascript" src="/templates/js_2016/criteo_header_code.js"></script>
    <!-- Criteo Header Code -->
    <!-- ADOP 헤더 스크립트(S) -->
    <script type="text/javascript" src="/templates/js_2021/adop_header_scr_202102.js"></script>
    <!-- ADOP 헤더 스크립트(E) -->
</head><!--head //-->

<body>
<!--
 type_pick
 type_opinion
 type_review
 type_sourcec
-->
<div id="container" class="<?=$top_style_css?> <?=($hide_view_container_css == 'Y') ? "" : "view_container";?>"><!--container-->
    
<div class="header">
    <div class="header_wrap">
        <div class="header_top">
            <div class="header_buttons">
                <button type="button" class="header_button_menu">
                    <svg viewBox="0 0 40 35">
                        <path class="line_1" fill="#101010" d="M0.0,29.999 L39.999,29.999 L39.999,34.999 L0.0,34.999 L0.0,29.999 Z"/>
                        <path class="line_2" fill="#101010" d="M0.0,14.999 L39.999,14.999 L39.999,19.999 L0.0,19.999 L0.0,14.999 Z"/>
                        <path class="line_3" fill="#101010" d="M0.0,0.0 L39.999,0.0 L39.999,4.999 L0.0,4.999 L0.0,0.0 Z"/>
                    </svg>
                </button>
            </div>
            <div class="logo">
                <a href="/"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리"></a>
            </div>
            <ul class="header_top_gnb">
                <li><a href="/opinion">오피니언</a></li>
				<li><a href="/minsopick">민소픽</a></li>
				<li><a href="/academy">이산아카데미</a></li>
				<li><a href="https://www.youtube.com/channel/UC6dM99DofLDsfodmxHsIh5w" target="_blank">Vstar</a></li>
            </ul>
            <div class="header_buttons ml_auto">
                <button type="button" class="header_button_search"><i class="iconFt_search"></i></button>
            </div>
        </div>
    </div>
    <div class="header_search_wrap">
		<div class="wrap_1180">
			<div class="header_search_por">
				<div class="header_search_box">
					<input type="text" id="header_search_input" class="header_search_inp" placeholder="검색어를 입력해주세요" value="" maxlength="20">
					<button type="submit" class="header_search_button">
						<span>
							<i class="iconFt_search"></i>
						</span>
					</button>
				</div>

				<button class="header_search_close" type="button" >
					<span class="fs_14 tc_b5"> <span class="mr_5">Close</span> <i class="iconFt_close_2 fs_12"></i></span>
				</button>
			</div>
		</div>
    </div>
</div>


<div class="amb_mask"></div>
<div class="amb_wrap">
    <div class="amb_box">
        <div class="amb_top">
            <a href="https://www.ihappynanum.com/Nanum/B/ZZWJXPDKGQ" target="_blank">후원회원 되기 <i class="iconFt_arrow_middle_r"></i></a>
        </div>
        <div class="ambs">
            <ul class="amb1">
                <?php include "top_gnb1.php"; ?>
            </ul>
            <ul class="amb2">
                <?php include "top_gnb2.php"; ?>
            </ul>
            <ul class="amb2">
                <?php include "top_gnb3.php"; ?>
            </ul>
            <ul class="amb_youtube">
                <li><a href="#" class="amb_youtube_btn">유튜브채널 바로가기 <i class="iconFt_arrow_ty1_r ml_auto"></i></a>
                    <ul>
                        <li><a target="_blank" href="https://www.youtube.com/user/MediaVop">&bullet; Media vop</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UC6dM99DofLDsfodmxHsIh5w">Vstar</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCY6CTAvBZ6B1j4UOIOwLWEg">곰곰이</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCcS0qc-6mkZduJ52H6cN5PQ">디액터</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCEx-zOsI1PWh5um70Woq85A">정아나</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCLv7EU6neDZpElebJcaZKgA">클래식데이트</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UC5jiTrHiQEY64L-8DBUv6Vg">현PD</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCWMwtqDalhk2ELoRAsMOD5A">왕수다황당구라</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCKe9BOWlnXSyCTuqhXU0i9w">소중한조선희</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <button type="button" class="amb_togo_buttton"  onclick="togoPopOpen();"><span><i class="iconFt_pen_2"></i>독자투고</span></button>
        <button type="button" class="amb_close_buttton"><span><i class="iconFt_close"></i></span></button>
    </div>
</div>