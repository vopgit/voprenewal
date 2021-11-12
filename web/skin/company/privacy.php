<?php
if(!defined('_HOME_TITLE')) exit; //상단에 넣어주세요

include_once _ROOT. '/include/company/head.php';
?>
    <link rel="stylesheet" type="text/css" href="/resource/css/company_sub.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/terms.css"/>

</head><!--head //-->

<body class="sub">




<div id="container" class="container"><!--container-->
    <?php include_once _ROOT. '/include/company/header.php'; ?>

    <div class="con sub">
        <div class="wrap_1180">
            <div class="location">
                <ul class="location_depth1">
                    <li><a href="#">홈</a></li>
                    <li><a href="#">개인정보취급방침</a></li>
                </ul>

            </div>



            <h1>개인정보취급방침</h1>


            <div class="mt_95 mb_50">
                <?php include_once _SKINDIR. '/etc/privacy_cont.php'; ?>
            </div>


        </div>
        <!-- wrap :: end -->



    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
