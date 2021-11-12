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

            <div class="board_list type_a font_mts">
                <!--공지 o-->
                <ul>
                    <li class="tr t_head">
                        <div style="width:8%;" class="board_no">No</div>
                        <div style="width:60%">제목</div>
                        <div style="width:15%;">작성자</div>
                        <div style="width:17%;">등록일</div>
                    </li>


                    <!--게시글 o-->
                    <?php for($i=10; $i>0; $i--) {?>
                    <li class="tr">
                        <div class="board_no">
                            <?=$i?>
                        </div>
                        <div class="full_mo">
                            <div class="board_tit_box">
                                <a href="/company/board_view" class="board_tit">
                                    <span class="board_cate">[공지]</span>
                                    “‘제값 받기’ 위한 중기 협동조합 교섭권 보장법 발의 환영”
                                </a>
                                <span class="board_file"></span>
                            </div>
                        </div>
                        <div class="writer">김도희 기자</div>
                        <div>2021.06.03:16:47</div>
                    </li>
                    <?php }?>
                    <!--게시글 o //-->
                </ul>


                <!--게시글 x-->
                <div class="noData">
                    <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                    <p>‘알림’ <b>게시글이 없습니다.</b></p>
                </div>
                <!--게시글 x//-->
            </div>


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
