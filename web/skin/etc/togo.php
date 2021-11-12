
<!DOCTYPE html>
<html lang="ko">
<head>

	<?php include_once _ROOT. '/include/mata.php'; ?>

	<link rel="icon" type="image/png" sizes="196x196" href="/resource/images/favicon-196x196.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/resource/images/favicon-16x16.png">

	<!-- font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

	<!--icon-->
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>


	<!--style -->
	<link rel="stylesheet" type="text/css" href="/resource/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/layout.css"/>

	<!--js -->
	<script  src="/resource/js/jquery-3.4.1.min.js"></script>
	<script  src="/resource/js/common.js?v=1"></script>
	<script  src="/resource/js/ui.js"></script>
</head><!--head //-->
<body>

<div class="popup mw_640">
    <div class="popup_box">
        <div class="popup_tit">
            <h1><i class="iconFt_pen_2 mr_5"></i> 독자투고</h1>
        </div>
        <div class="popup_con">
            <ul class="togoPop">
                <li>
                    <div class="togoPop_img"><img src="/resource/images/company/main/main_icon_1.svg" alt="아이콘1"></div>
                    <div class="togoPop_txt">민중의소리에 원고를 게재하고 싶으신 분은 <a href="mailto:vop3@vop.co.kr" class="tc_2 fw_500">vop3@vop.co.kr</a>로 보내주세요.</div>
                </li>
                <li>
                    <div class="togoPop_img"><img src="/resource/images/company/main/main_icon_2.svg" alt="아이콘2"></div>
                    <div class="togoPop_txt">메일에는 성함과 연락처를 정확하게 기재해주세요.</div>
                </li>
                <li>
                    <div class="togoPop_img"><img src="/resource/images/company/main/main_icon_3.svg" alt="아이콘3"></div>
                    <div class="togoPop_txt">원고를 검토한 후 게재 가능할 경우 연락을 드리겠습니다.</div>
                </li>
                <li>
                    <div class="togoPop_img"><img src="/resource/images/company/main/main_icon_4.svg" alt="아이콘4"></div>
                    <div class="togoPop_txt">원고가 채택되면 소액의 고료를 드립니다.</div>
                </li>
                <li>
                    <div class="togoPop_img"><img src="/resource/images/company/main/main_icon_5.svg" alt="아이콘5"></div>
                    <div class="togoPop_txt">독자후원금이 들어올 경우 서비스 대행사 수수료를 제외하고 필자에게 보내드립니다.</div>
                </li>
            </ul>
            <div class="t_center mt_20 mt_sm_20">
                <a href="mailto:vop3@vop.co.kr"  class="btn_md btn_cb btn_full_sm"><span>투고하기</span></a>
            </div>
        </div>

        <div class="popup_close">
            <button type="button" class="popup_close_button"><span><i class="iconFt_close"></i></span></button>
        </div>
    </div>
</div>

<script>
    $('.popup_close_button').click(function(){
        $('#togoPop', parent.document).hide();
        $('#togoPopMask', parent.document).hide();
        $('body', parent.document).css('overflow', 'visible');
    });
</script>

</body>
</html>
