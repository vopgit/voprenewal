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


            <ul class="ul_img3_box">
                <?php for($i=0; $i < 12; $i++){ ?>
                <li class="ul_img3_item">
                    <div class="ul_img3">
                        <div class="ul_img3_img">
                            <a href="/news/view">
                            <img src="https://via.placeholder.com/280x320/eeeeee/?text=(280px x 320px)" alt="이미지설명" onerror="noImage(this);" data-size="280, 335">
                            </a>
                        </div>
                        <div class="ul_img3_text">
                            <a href="/news/view" class="ul_img3_tit_box">
                                <span class="ul_img3_tit_sub">최민의 시사만평 </span>
                                <span class="ul_img3_tit">벼량끝</span>
                            </a>
                            <div class="ul_img3_info_box">
                                <ul class="ul_img3_info">
                                    <li>2021.08.24 19:00:23</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </ul>

            <!--게시글 x-->
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘만평’<b> 게시글이 없습니다.</b></p>
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
