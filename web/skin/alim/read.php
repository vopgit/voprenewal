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
                    <li><a href="/">홈</a></li>
                    <li>소식</li>
                    <li>알림</li>
                </ul>

            </div>

            <h1>알림</h1>

            <div class="board_view type_a mt_75">

            <div class="bv_box ">
                <div class="bv_top">
                    <p class="bv_tit">
						<?php if($rs['top_tf'] == 'Y'){ ?>
							<span class="board_cate">[공지]</span>
						<?php } ?>
						<!-- [<?=$rs['category']?>] -->
						<?=$rs['title']?>
					</p>

                    <div class="bv_info_box">
                        <ul class="bv_info">
                            <li><?=substr($rs['reg_date'],0,16)?></li>                            
                            <li data-tit="작성자"><?=($rs['contributor'] != '') ? $rs['contributor'] : $rs['name']." 기자";?></li>
                        </ul>
                    </div>
                </div>

                <?php if(count($rs['file']) > 0){ ?>
					<div class="bv_bottom">
						<div class="bv_file_wrap">
							<div class="bv_file"><span class="text_hide">첨부파일</span></div>
							<div class="bv_file_box">
								<?php foreach($rs['file'] as $file) { ?>					
									<a href="<?=_DOWNLOAD_URL?>?<?=encrypt(time()."||".$file['filepath']."||".$file['filename'])?>" target="_blank"" class="file" title="다운로드"><?=$file['filename']?></a>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>

                <div class="bv_con">
                    <div class="editor">
                        <?=$rs['contents']?>
                    </div>
                </div>

            </div>

        </div><!--board_view //-->

        <ul class="prev_next_page_box">
            <li class="prev_box">
                <?php if($pre['id'] != ''){ ?>
					<a href="/alim/<?=$pre['serial'].$param['query']?>">
		                <span class="td"><span>이전글</span></span>
			            <span class="td"><span class="ellip_1"><?=$pre['title']?></span></span>
				        <span class="td"><?=substr($pre['reg_date'], 0 ,10)?></span>
					</a>
				<?php }else{ ?>
					<a href="javascript:;">
		                <span class="td"><span>이전글</span></span>
			            <span class="td"><span class="ellip_1">이전글이 없습니다.</span></span>
				        <span class="td"></span>
					</a>
				<?php } ?>
            </li>
            <li class="next_box">
                <?php if($next['id'] != ''){ ?>
					<a href="/alim/<?=$next['serial'].$param['query']?>">
						<span class="td"><span></span>다음글</span>
						<span class="td"><span class="ellip_1"><?=$next['title']?></span></span>
						<span class="td"><?=substr($next['reg_date'], 0 ,10)?></span>
					</a>
				<?php }else{ ?>
					<a href="javascript:;">
						<span class="td"><span></span>다음글</span>
						<span class="td"><span class="ellip_1">다음글이 없습니다.</span></span>
						<span class="td"></span>
					</a>
				<?php } ?>
            </li>
        </ul><!--prev_next_page_box //-->

        <div class="btn_box t_center mt_70 mb_50">
            <a href="/alim<?=$param['query']?>" class="btn btn_line_cb">목록</a>
        </div>

        </div>


    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
