<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container" class="type_review"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/news/review_list2">리뷰</a></h1>

                <div class="search_box">
                    <form action="#">
                        <input type="text" class="search_box_inp" placeholder="검색어를 입력해주세요">
                        <button type="submit" class="search_box_button">
                            <span>
                                <i class="iconFt_search"></i>
                            </span>
                        </button>
                    </form>
                </div>
            </div>



            <div class="info_box">
                <a href="/news/source_view" class="info_link">
                    <span class="info_tit">원기사</span>
                    <span class="info_txt">아프가니스탄 국민에게 미군 점령은 무도한 탈레반만큼 끔찍했다 무도한 탈레반만큼 끔찍했다 아프가니스탄 국민에게 미...</span>
                </a>
                <a href="/news/view" class="info_button">돌아가기</a>
            </div>

            <ul class="ul_img2_box">
                <li class="ul_img2_item">
                    <div class="ul_img2">
                        <div class="ul_img2_text">
                            <div>
                                <a href="/news/review_view" class="ul_img2_tit_box">
                                    <span class="ul_img2_tit">“홍길동”님의 리뷰</span>
                                </a>
                                <p class="ul_img2_txt"><a href="/news/review_view">리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이  </a></p>
                                <div class="ul_img2_info_box">
                                    <ul class="ul_img2_info">
                                        <li>2021.06.18 11:42</li>
                                        <li>
                                            <div class="ul_img2_info_item">
                                                <span class="ul_img2_info_item_tit">원기사</span>
                                                <p class="ul_img2_info_item_txt">
                                                    <a href="/news/view">원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ul_img2_img_box">
                            <div class="ul_img2_img">
                                <a href="/news/review_view">
                                    <img src="https://via.placeholder.com/150x150/eeeeee/?text=(1 : 1)" alt="샘플이미지" />
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <?php for($i=0; $i < 4; $i++){ ?>
                <li class="ul_img2_item">
                    <div class="ul_img2">
                        <div class="ul_img2_text">
                            <div>
                                <a href="/news/review_view" class="ul_img2_tit_box">
                                    <span class="ul_img2_tit">“홍길동<?=$i + 1?>”님의 리뷰</span>
                                </a>
                                <p class="ul_img2_txt"><a href="/news/review_view">들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이 들어갑니다. 리뷰 내용이  </a></p>
                                <div class="ul_img2_info_box">
                                    <ul class="ul_img2_info">
                                        <li>2021.06.18 11:42</li>
                                        <li>
                                            <div class="ul_img2_info_item">
                                                <span class="ul_img2_info_item_tit">원기사</span>
                                                <p class="ul_img2_info_item_txt">
                                                    <a href="/news/view">원기사 타이틀이 들어갑니다. 원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.원기사 타이틀이 들어갑니다.</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <!--게시글 x-->
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘리뷰’<b> 게시글이 없습니다.</b></p>
            </div>

            <div class="page_wrap mt_50 mb_35 st_2">
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


        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>

</div><!--container//-->
</body>

</html>
