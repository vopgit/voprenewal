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

            <form name="frmAlim" id="frmAlim" method="get" action="/alim">				
                <div class="search_wrap type_a mt_95 mb_30">
                    <div class="search_box">
                        <div class="row wp_10 ">
                            <div class="col_24">

                                <div class="search_inp">
                                    <input type="text" class="inp fm_full search_inp" name="st" id="st" title="검색어" value="<?=$st?>" placeholder="검색어를 입력해주세요." maxlength="20">
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

                   <?php 
				   if($rs['total'] > 0){
					   	foreach($rs['data'] as $data) { 
							?>
							<li class="tr">
								<div class="board_no">
									<?=$rs['vnum']--;?>
								</div>
								<div class="full_mo">
									<div class="board_tit_box">
										<a href="/alim/<?=$data['serial']?><?=$param['query']?>" class="board_tit">
											<?php if($data['top_tf'] == 'Y'){ ?>
												<span class="board_cate">[공지]</span>
											<?php } ?>
											<!-- [<?=$data['category']?>] --> 
											<?=$data['title']?>
										</a>
										<?php if($data['filecnt'] > 0){	?>
											<span class="board_file"></span>
										<?php } ?>
									</div>
								</div>
								<div class="writer"><?=($data['contributor'] != '') ? $data['contributor'] : $data['name']." 기자";?></div>
								<div><?=substr($data['reg_date'],0,16)?></div>
							</li>
							<?php
						}
					}
					?>
                </ul>


               <?php if($rs['total'] < 1){ ?>
                <div class="noData">
                    <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                    <p>‘알림’ <b>게시글이 없습니다.</b></p>
                </div>
                <?php } ?>
            </div>


            <div class="page_wrap pt_80 pb_50">
                <?=$rs['paging']?>
            </div>
        </div>



    </div>

    <?php include_once _ROOT. '/include/company/footer.php';?>
</div><!--container//-->
</body>

</html>
