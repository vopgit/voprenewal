<!DOCTYPE html>
<html lang="ko">
<head>
<title>민중의소리</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">

<meta name="apple-mobile-web-app-title" content="" />
<meta name="robots" content="index,follow"/>
<meta name="keywords" content=""/>
<meta name="description" content=""/>

<meta property="og:title" id="meta_og_title" content="">
<meta property="og:url" id="meta_og_url" content="">
<meta property="og:image" content="<?=_WEB_URL?>/resource/images/meta.jpg">
<meta property="og:description" id="meta_og_description" content=""/>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="">
<meta name="twitter:url" content="">
<meta name="twitter:image" content="<?=_WEB_URL?>/resource/images/meta.jpg">
<meta name="twitter:description" content=""/>
	<link rel="icon" type="image/png" sizes="196x196" href="<?=_WEB_URL?>/resource/images/favicon-196x196.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=_WEB_URL?>/resource/images/favicon-16x16.png">

	<!-- font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

	<!--icon-->
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>


	<!--style -->
	<link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/css/layout.css"/>

	<!--js -->
	<script  src="<?=_WEB_URL?>/resource/js/jquery-3.4.1.min.js"></script>
	<script  src="<?=_WEB_URL?>/resource/js/common.js?v=1"></script>
	<script  src="<?=_WEB_URL?>/resource/js/layout.js?v=1"></script>
	<script  src="<?=_WEB_URL?>/resource/js/ui.js"></script>

	<!--lib / gsap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>


	<!--lib / aos-->
	<!-- <link rel="stylesheet" type="text/css" href="/resource/lib/aos/aos.css"/>
	<script  src="/resource/lib/aos/aos.js"></script> -->



    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <!--lib / swiper-->
    <link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/lib/swiper/swiper.min_453.css"/>
    <script src="<?=_WEB_URL?>/resource/lib/swiper/swiper.min_453.js"></script>

	<?if($_action == 'main'){?>
	    <link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/css/main.css"/>
	    <script src="<?=_WEB_URL?>/resource/js/main.js"></script>
	<?}else{?>
		<link rel="stylesheet" type="text/css" href="<?=_WEB_URL?>/resource/css/sub.css"/>
	    <script src="<?=_WEB_URL?>/resource/js/sub.js"></script>
	<?}?>
</head><!--head //-->

<body>

<div id="container" class="type_<?=$_action?>"><!--container-->

<div class="header">
	<?if($_action == 'main'){?>
	<!--main-->
    <div class="header_wrap wrap_1180">
        <div class="header_mid">
            <div class="arcad left size_167x50 screen_md_none">
                <div class="dfpAd"></div>
            </div><!--광고-->
            <div class="logo">
                <a href="#"><img src="<?=_WEB_URL?>/resource/images/company/logo_on.svg" alt="민중의 소리"></a>
            </div>
            <div class="arcad right size_167x50 screen_md_none">
                <div class="dfpAd"></div>
            </div><!--광고-->
        </div>
        <div class="header_bottom">
            <div class="header_buttons">
                <button type="button" class="header_button_menu">
                    <svg viewBox="0 0 40 35">
                        <path class="line_1" fill="#101010" d="M0.0,29.999 L39.999,29.999 L39.999,34.999 L0.0,34.999 L0.0,29.999 Z"/>
                        <path class="line_2" fill="#101010" d="M0.0,14.999 L39.999,14.999 L39.999,19.999 L0.0,19.999 L0.0,14.999 Z"/>
                        <path class="line_3" fill="#101010" d="M0.0,0.0 L39.999,0.0 L39.999,4.999 L0.0,4.999 L0.0,0.0 Z"/>
                    </svg>
                </button>
                <button type="button" class="header_button_search"><i class="iconFt_search"></i></button>
            </div>
            <div class="gnb">
			    <ul class="gnb1">
			        <li><a href="#">오피니언</a></li>
			        <li><a href="#">민소픽</a></li>
			        <li><a href="#">이산아카데미</a></li>
			        <li><a target="_blank" href="https://www.youtube.com/channel/UC6dM99DofLDsfodmxHsIh5w">Vstar</a></li>
			    </ul>
			    <ul class="gnb2">
			        <li><a href="#">정치</a></li>
			        <li><a href="#">경제</a></li>
			        <li><a href="#">사회</a></li>
			        <li><a href="#">국제</a></li>
			        <li><a href="#">문화</a></li>
			        <li><a href="#">연예</a></li>
			        <li><a href="#">스포츠</a></li>
			        <li><a href="#">IT/과학</a></li>
			        <li><a href="#">사설/칼럼</a></li>
			        <li><a href="/news/cartoon_list">만평</a></li>
			        <li><a target="_blank" href="https://photo.vop.co.kr/">포토</a></li>
			    </ul>
			    <ul class="gnb3">
			        <li><a href="#">원소스</a></li>
			        <li><a href="#">리뷰</a></li>
			    </ul>
			</div><!--gnb //-->
		</div>
    </div>
	<?}else{?>
		<!--SUB-->
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
                <a href="/"><img src="<?=_WEB_URL?>/resource/images/company/logo_on.svg" alt="민중의 소리"></a>
            </div>
            <ul class="header_top_gnb">
                <li><a href="#">오피니언</a></li>
                <li><a href="#">민소픽</a></li>
                <li><a href="#">이산아카데미</a></li>
                <li><a target="_blank" href="#">Vstar</a></li>
            </ul>
            <div class="header_buttons ml_auto">
                <button type="button" class="header_button_search"><i class="iconFt_search"></i></button>
            </div>
        </div>
    </div>
	<?}?>

    <div class="header_search_wrap">
        <div class="wrap_1180">
            <div class="header_search_por">
                <div class="header_search_box">
                    <input type="text" class="header_search_inp" placeholder="검색어를 입력해주세요" value="">
                    <button type="submit" class="header_search_button">
                        <span>
                            <i class="iconFt_search"></i>
                        </span>
                    </button>
                </div>

                <button class="header_search_close" type="button" >
                    <span class="fs_14 tc_b5"> <span class="mr_5">Close</span> <i class="iconFt_close fs_12"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="amb_mask"></div>

<div class="amb_wrap">
    <div class="amb_box">
        <div class="amb_top">
            <a href="#">후원회원 되기 <i class="iconFt_arrow_middle_r"></i></a>
        </div>
        <div class="ambs">
            <ul class="amb1">
                <li><a href="#">오피니언</a></li>
                <li><a href="#">민소픽</a></li>
                <li><a href="#">이산아카데미</a></li>
                <li><a href="#">Vstar</a></li>
            </ul>
            <ul class="amb2">
                <li><a href="#">정치</a></li>
                <li><a href="#">경제</a></li>
                <li><a href="#">사회</a></li>
                <li><a href="#">국제</a></li>
                <li><a href="#">문화</a></li>
                <li><a href="#">연예</a></li>
                <li><a href="#">스포츠</a></li>
                <li><a href="#">IT/과학</a></li>
                <li><a href="#">사설/칼럼</a></li>
                <li><a href="#">만평</a></li>
                <li><a href="#">포토</a></li>
            </ul>
            <ul class="amb2">
                <li><a href="#">원소스</a></li>
                <li><a href="#">리뷰</a></li>
            </ul>
            <ul class="amb_youtube">
                <li><a href="#" class="amb_youtube_btn">유튜브채널 바로가기 <i class="iconFt_arrow_ty1_r ml_auto"></i></a>
                    <ul>
                        <li><a href="#">&bullet; Media vop</a></li>
                        <li><a href="#">Vstar</a></li>
                        <li><a href="#">곰곰이</a></li>
                        <li><a href="#">디액터</a></li>
                        <li><a href="#">정아나</a></li>
                        <li><a href="#">클래식데이트</a></li>
                        <li><a href="#">현PD</a></li>
                        <li><a href="#">왕수다황당구라</a></li>
                        <li><a href="#">소중한조선희</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <button type="button" class="amb_togo_buttton"><span><i class="iconFt_pen_2"></i>독자투고</span></button>
        <button type="button" class="amb_close_buttton"><span><i class="iconFt_close"></i></span></button>
    </div>
</div>
