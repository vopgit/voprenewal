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
                    <li><a href="#">알림</a></li>
                </ul>

            </div>



            <h1>알림</h1>

            <div class="board_view type_a mt_75">

            <div class="bv_box ">
                <div class="bv_top">
                    <p class="bv_tit">[공고] 민중의소리 공론형기사시스템 개발용역</p>

                    <div class="bv_info_box">
                        <ul class="bv_info">
                            <li>2021.03.03</li>
                            <li>00코멘트</li>
                            <li data-tit="작성자">홍길동</li>
                        </ul>
                    </div>
                </div>
                <div class="bv_bottom">

                    <div class="bv_file_wrap">
                        <div class="bv_file"><span class="text_hide">첨부파일</span></div>
                        <div class="bv_file_box">
                            <a href="/download/" class="file" title="다운로드">download.png</a>
                            <a href="/download/" class="file" title="다운로드">download2.png</a>
                        </div>
                    </div>

                </div>



                <div class="bv_con">
                    <div class="editor">
                        <figure>
                            <img src="/resource/images/common/no_img.svg" onerror="noImage(this);">
                        </figure>
                        알림 내용이 들어갑니다.  알림 내용이 들어갑니다.  알림 내용이 들어갑니다.  알림 내용이 들어갑니다.  알림 내용이 들어갑니다.  알림 내용이 들어갑니다.
                        알림 내용이 들어갑니다.  알림 내용이 들어갑니다.  알림 내용이 들어갑니다.
                    </div>
                </div>

            </div>

        </div><!--board_view //-->

        <ul class="prev_next_page_box">
            <li class="prev_box">
                <a href="/company/board_view">
                    <span class="td"><span>이전글</span></span>
                    <span class="td"><span class="ellip_1">이전글이전글이전글이전글</span></span>
                    <span class="td">2020.12.21</span>
                </a>
            </li>
            <li class="next_box">
                <a href="/company/board_view">
                    <span class="td"><span>다음글</span></span>
                    <span class="td"><span class="ellip_1">다음글다음글다음글다음글다음글</span></span>
                    <span class="td">2020.12.21</span>
                </a>
            </li>
        </ul><!--prev_next_page_box //-->

        <div class="btn_box t_center mt_70 mb_50">
            <a href="/company/board_list" class="btn btn_line_cb">목록</a>
        </div>

        </div>


    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
