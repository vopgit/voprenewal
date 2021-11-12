<!DOCTYPE html>
<html lang="ko">
<head>

	<title>민중의소리</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="apple-mobile-web-app-title" content="" />
    <meta name="robots" content="index,follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>

    <meta property="og:title" id="meta_og_title" content="">
    <meta property="og:url" id="meta_og_url" content="">
    <meta property="og:image" content="/resource/images/meta.jpg">
    <meta property="og:description" id="meta_og_description" content=""/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:url" content="">
    <meta name="twitter:description" content=""/>

	<!-- font -->
	<link rel="preconnect" href="//fonts.googleapis.com">
	<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
	<link href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=block&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=block&family=Montserrat:wght@100;300;400;500;700;900&display=block&family=Noto+Serif+KR:wght@400;600&display=block" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/sub.css"/>
    <link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/editor.css"/>
	<link rel="stylesheet" type="text/css" href="/resource/css/common.css?v=2"/>
	<link rel="stylesheet" type="text/css" href="/resource/icon/style.css"/>
	<style media="screen">
		html,body{
			background: transparent;
		}
		.popup_wrap{
			max-height:90%;
		}
		.popup_con{
            padding:2em 0 0;
			position: relative;
		}
        .popup_contents {
            padding: 0;
        }
		.pop_close{
			position: absolute;
			top:0;
			right:0;
			width: 2em;
			height: 2em;
			font-size: 2rem;
			text-align: center;
			z-index: 100;
		}
	</style>
</head><!--head //-->

<body>

<div id="container" class="type_review view_container">
<div class="popup_box st_preview">
    <div class="popup_wrap wrap1300">
        <div class="popup_ty1 popup_con">
			<button class="pop_close" type="button">&times;</button>
            <div class="popup_contents">

				<!--미리보기-->
				<div class="view_top" style="height: auto;">
                    <div class="wrap_980">
                        <div class="view_top_cate2">
                            <span class="view_top_cate2_txt1">리뷰</span>
                        </div>

						<h1 class="view_top_tit"><span class="iconFt_review mr_10" style="opacity:0.25;"></span><a href="javascript:;"><?=$rs['writer_print']?></a>님의 리뷰</h1>

                        <div class="flex fw_nowrap">
                            <div class="view_top_info_box mr_auto">
                                <ul class="view_top_info">
                                    <li><a href="/news/source_list3"><?=$rs['writer_print']?></a> <?=$rs['email']?></li>
                                    <li>발행 <?=$rs['published_date']?></li>
									<?php if($rs['modi_date']!= "" && $rs['modi_date']!= "0000-00-00 00:00:00"){ ?>
									<li>수정 <?=$rs['modi_date']?></li>
									<?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

				<div class="wrap_980">
					<div class="view_con">
						<div class="view_con_left">
							<!--왼쪽-->
							<div class="editor">
								<?=$rs['contents']?>
							</div>
						</div>

						<div class="view_con_right">
							<!--오른쪽-->
							<div class="vcr_box">
								<h2 class="vcr_tit"><span>원 기사</span></h2>
								<ul class="vcr_list">
									<li>
										<a href="javascript:;" onclick="alert('미리보기에서는 사용할 수 없습니다.')">
											<?php if($rs['mthumbnail'] != ''){ ?>
												<span class="img_box">
													<span class="img_con"><img src="<?=rtrim(_IMAGE_URL,'/')."/".ltrim($rs['mthumbnail'],'/')?>" alt="<?=$rs['title']?>"></span>
												</span>
											<?php } ?>
											<span><?=$rs['title']?></span>
										</a>
									</li>

								</ul>
							</div>
						</div><!--view_con_right }-->

					</div>
				</div>




            </div>
        </div>
    </div>
</div>
</div>

</body>

</html>
