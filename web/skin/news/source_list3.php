<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
</head><!--head //-->

<body>
<div id="container" class="type_source"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1>원소스<span class="ml_10 fs_28 fs_sm_18">김도희 기자</span></h1>
                <!--대체 명의 사용
                <h1>원소스<span class="ml_10 fs_28 fs_sm_18">김도희 민중연구소 대표</span></h1>
                -->
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

            <ul class="ul_img2_box">
                <li class="ul_img2_item">
                    <div class="ul_img2">
                        <div class="ul_img2_text">
                            <div>
                                <a href="/news/source_view" class="ul_img2_tit_box">
                                    <span class="ul_img2_tit">원소스 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다.</span>
                                </a>
                                <p class="ul_img2_txt"><a href="/news/source_view">“아빠와 전날 밤 저녁 먹고 같이 얘기를 나눴어요. 최근에 이런 (산재사망)사고 많았잖아요. 그러니까 아빠도 조심했으면 좋겠다고 했어요.” 쌍용 씨앤비 공장 산재사망사고 화물노동자 故 장창우 씨의 둘째 딸 장 모(21) 씨 지난 5월 26일 쌍용 씨앤비(C&B) 공장에서 컨테이너 문을 열다가 쏟아지는 압축 파지더미에 깔려 숨진 화물 노동자 故장창우 씨 둘째 딸의 말이다. 21살 둘째 딸 장 씨는 2일 기자회견에서 이같이 말했다. ‘평소 우리 가족에게도 이런 </a></p>
                                <div class="ul_img2_info_box">
                                    <ul class="ul_img2_info">
                                        <li>김도희 기자</li>
                                        <li>2021.06.18 11:42</li>
                                        <li><span class="file_button"><i class="iconFt_file"></i></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ul_img2_img_box">
                            <div class="ul_img2_img">
                                <a href="/news/source_view">
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
                                <a href="/news/source_view" class="ul_img2_tit_box">
                                    <span class="ul_img2_tit">원소스 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다. 제목입니다.</span>
                                </a>
                                <p class="ul_img2_txt"><a href="/news/source_view">“아빠와 전날 밤 저녁 먹고 같이 얘기를 나눴어요. 최근에 이런 (산재사망)사고 많았잖아요. 그러니까 아빠도 조심했으면 좋겠다고 했어요.” 쌍용 씨앤비 공장 산재사망사고 화물노동자 故 장창우 씨의 둘째 딸 장 모(21) 씨 지난 5월 26일 쌍용 씨앤비(C&B) 공장에서 컨테이너 문을 열다가 쏟아지는 압축 파지더미에 깔려 숨진 화물 노동자 故장창우 씨 둘째 딸의 말이다. 21살 둘째 딸 장 씨는 2일 기자회견에서 이같이 말했다. ‘평소 우리 가족에게도 이런 </a></p>
                                <div class="ul_img2_info_box">
                                    <ul class="ul_img2_info">
                                        <li>김도희 기자</li>
                                        <li>2021.06.18 11:42</li>
                                        <li><span class="file_button"><i class="iconFt_file"></i></span></li>
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
                <p>‘원소스’<b> 게시글이 없습니다.</b></p>
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
