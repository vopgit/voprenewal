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
                    <li><a href="/editorial">사설</a></li>
                    <li><a href="/column" class="on">칼럼</a></li>
                </ul>
            </div>

            <!-- 연재 칼럼 경우 보임 -->
            <h3 class="flex ai_c mt_30 mb_10 color_opinion">
                <span class="box">
                    <span class="box_text">10</span>
                </span>
                <span>강환욱의 뚝딱뚝딱 학교</span>
            </h3>
            <!-- box //-->

            <ul class="ul_img_box">
                <?php for($i=0; $i < 10; $i++){ ?>
                <li class="ul_img_item">
                    <div class="ul_img">
                        <div class="ul_img_img">
                            <a href="/opinion/view">
                                <img src="https://via.placeholder.com/520x320/eeeeee/?text=(1.7 : 1)" alt="샘플이미지" />
                            </a>
                        </div>
                        <div class="ul_img_text">
                            <div>
                                <a href="/opinion/view" class="ul_img_tit_box">
                                    <span class="ul_img_tit">‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’ 최재형 “생각 정리해 조만간 말하겠다”‘대선 출마설’</span>
                                </a>
                                <div class="ul_img_info_box">
                                    <ul class="ul_img_info">
                                        <li>홍길동기자</li>
                                        <li>2021.06.18 11:42</li>
                                    </ul>
                                </div>
                                <p class="ul_img_txt"><a href="/opinion/view">“아빠와 전날 밤 저녁 먹고 같이 얘기를 나눴어요. 최근에 이런 (산재사망)사고 많았잖아요. 그러니까 아빠도 조심했으면 좋겠다고 했어요.” 쌍용 씨앤비 공장 산재사망사고 화물노동자 故 장창우 씨의 둘째 딸 장 모(21) 씨 지난 5월 26일 쌍용 씨앤비(C&B) 공장에서 컨테이너 문을 열다가 쏟아지는 압축 파지더미에 깔려 숨진 화물 노동자 故장창우 씨 둘째 딸의 말이다. 21살 둘째 딸 장 씨는 2일 기자회견에서 이같이 말했다. ‘평소 우리 가족에게도 이런 </a></p>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>

            <!--게시글 x-->
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘오피니언’<b> 게시글이 없습니다.</b></p>
            </div>

            <div class="btn_page_box mt_20 mb_5">


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
                <div class="btn_box ">
                    <a href="/opinion/index" class="btn_md btn_cg2">목록으로</a>
                </div>
            </div>

        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>
</div><!--container//-->
</body>

</html>
