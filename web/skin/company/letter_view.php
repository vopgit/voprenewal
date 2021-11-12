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

            <div class="lv">

                <div class="lv_top">
                    <h2 class="lv_top_tit">오늘의 이슈</h2>
                    <p class="lv_top_tit_sub">2021년 7월 14일 뉴스브리핑</p>
                </div>

                <div class="lv_tit_box">
                    <p>
                        안녕하세요 민중의소리입니다.  최근 ‘택배노동자 과로사 방지를 위한 사회적 합의기구’가 최종 합의를 이뤘습니다.
                        과연 택배사들은 합의를 제대로 이행할까요? 민소Pick에서 업계 현황을 살펴보고 전문가 진단을 통해 미래를 전망해 봤습니다.
                        최재형 전 감사원장이 직을 내던진 지 17일 만에 국민의힘에 입당해 감사원의 ‘정치적 중립’을 훼손했다는 비판을 받고 있습니다.
                        윤석열 전 검찰총장이 며칠만의 공개 일정에서, 취재진들에게 ‘지지율 급락’ 등 아픈 질문만 받았습니다.
                    </p>
                    <div class="lv_arrows">
                        <a href="#" class="lv_arrow_left"></a>
                        <a href="#" class="lv_arrow_right"></a>
                    </div>
                </div>

                <div class="lv_con">
                    <ul class="lv_item_box">
                        <?php for($i=1; $i<4; $i++) {?>
                        <li class="lv_item">
                            <p>‘정치적 중립성’ 논란 외면한 최재형에 “헌정사에 안 좋은 사례”  비판 쇄도 </p>
                            <figure>
                                <img src="/resource/images/common/no_img.svg" alt="이미지설명">
                            </figure>
                            <a href="/news/view" class="lv_item_more" target="_blank">자세히보기</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>


            </div><!--lv//-->


            <div class="btn_box t_center mb_50">
                <a href="/company/letter_list" class="btn btn_line_cb">목록</a>
            </div>



        </div>



    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
