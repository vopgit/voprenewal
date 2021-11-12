<?php
if(!defined('_HOME_TITLE')) exit; //상단에 넣어주세요

include_once _ROOT. '/include/company/head.php';
?>
    <link rel="stylesheet" type="text/css" href="/resource/css/company_sub.css"/>

</head><!--head //-->

<body class="sub">




<div id="container" class="container"><!--container-->
    <?php include_once _ROOT. '/include/company/header.php'; ?>

    <div class="con sub">
        <div class="wrap_1180">
            <div class="location">
                <ul class="location_depth1">
                    <li><a href="#">홈</a></li>
                    <li><a href="#">소식</a></li>
                    <li><a href="#">기자가 보내는 편지</a></li>
                </ul>

            </div>



            <h1>기자가 보내는 편지</h1>

            <form>
                <div class="search_wrap type_a mt_95 mb_30">
                    <div class="search_box">
                        <div class="row wp_10 ">
                            <div class="col_24">

                                <div class="search_inp">
                                    <input type="text"  class="inp fm_full search_inp" name="st" id="st" title="검색어" value="" placeholder="검색어를 입력해주세요.">
                                    <button type="submit" class="search_btn"><i class="iconFt_search"></i></button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </form>


            <div class="ng_box">

                <div class="ng_list">

                    <?php for($i=5; $i>0; $i--) {?>

                        <div class="ng_item">
                            <!--이미지 없음-->
                            <div class="ng_img"></div>
                            <!--이미지 있음-->
                            <!-- <div class="ng_img" style="background-image: url('https://placeimg.com/230/130/any');"></div> -->
                            <div class="ng_text">
                                <a href="/company/letter_view">
                                    <span class="ng_top">
                                        <span class="ng_tit ellip_1 font_mts">2021년 7월 14일 뉴스브리핑</span>
                                    </span>
                                    <span class="ng_con ellip_1">
                                        안녕하세요 민중의소리입니다. 전 국민 재난지원금 ‘합의 번복’ 논란을 자초한 국민의힘 이준석 대표가 사태 수습을 위해 안간힘을 썼지만 안녕하세요 민중의소리입니다. 전 국민 재난지원금 ‘합의 번복’ 논란을 자초한 국민의힘 이준석 대표가 사태 수습을 위해 안간힘을 썼지만
                                    </span>
                                    <span class="more">자세히보기</span>
                                </a>
                            </div>
                        </div>

                    <?php }?>

                    <!--게시글 x-->
                    <div class="noData">
                        <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                        <p>‘기자가 보내는 편지’ <b>게시글이 없습니다.</b></p>
                    </div>

                </div>


            </div><!--n_box//-->

            <div class="page_wrap pt_80 pb_50">
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
                    </span>

                    <a href="javascript:void(0);" class="next"><i class="icon_next">다음페이지</i></a>
                    <a href="javascript:void(0);" class="end"><i class="icon_next2">다음10개</i></a>
                </div>
            </div>
        </div>



    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
