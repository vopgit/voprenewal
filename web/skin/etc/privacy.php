<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>
    <link rel="stylesheet" type="text/css" href="/resource/css/terms.css"/>
</head><!--head //-->

<body>
<div id="container"><!--container-->  
    <?php 
    include_once _ROOT. '/include/headerSub.php'; 
    ?>
    
    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box mb_20 line_none">
                <h1>개인정보취급방침</h1>
            </div>
            <?php include_once _SKINDIR. '/etc/privacy_cont.php'; ?>
        </div>
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>
</div><!--container//-->
</body>

</html>
