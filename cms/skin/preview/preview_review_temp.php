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
	<script  src="/resource/js/jquery-3.4.1.min.js"></script>
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
						<h1 class="view_top_tit"><span class="iconFt_review mr_10" style="opacity:0.25;"></span><a href="javascript:;" id="title">홍길동</a>님의 리뷰</h1>

                        <div class="flex fw_nowrap">
                            <div class="view_top_info_box mr_auto">
                                <ul class="view_top_info">
                                    <li id="writer"><!-- 글쓴이 --></li>
                                    <li id="time"><!-- 시간 --></li>									
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="wrap_980">


					<div class="view_con">
						<div class="view_con_left">
							<!--왼쪽-->
							<div class="editor" id="contents"><!-- 내용 --></div>

						</div>
						<div class="view_con_right">
							<!--오른쪽-->
							<div class="vcr_box">
								
								<h2 class="vcr_tit"><span>원 기사</span></h2>

								<ul class="vcr_list" id="relate">
									<li>
										<a href="/news/view">
											<span class="img_box"><span class="img_con"><img src="https://via.placeholder.com/90x52/eeeeee/?text=(no image)" alt="이미지설명"></span></span>
											<span>원 기사가 들어갑니다.</span>
										</a>
									</li>
								</ul>

								<!--
								<ul class="vcr_list" id="relate">
									<li class="t_center "> <p class="ptb_10"></p></li>
								</ul>
								-->
							</div>

							<!--
							<div class="vcr_box bg_wh">
								<h2 class="vcr_tit"><span>첨부파일</span></h2>
								<ul class="vcr_list">
									<li class="t_center"> <p class="ptb_10">미리보기시 지원하지 않습니다.</p></li>
								</ul>
							</div>
							-->


						</div><!--view_con_right }-->

					</div>
				</div>

            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

	$(document).ready(function() {
		var parentWin = window.parent.document;
		//var title = $('#title', parentWin).val();	
		var related = $('#osmu_id', parentWin).val();
		var email1 = $('#email1', parentWin).val();
		var email2 = $('#email2', parentWin).val();
		var contents = $('#contents', parentWin).html();

		var contributor = $('#contributor', parentWin).val();

		if(contributor == ""){
			contributor = "<?=$_SESSION['_admin']['name']?> 기자";
		}

		$('#title').html(contributor);	

		if((email1 != "")||(email2 != "")){
			contributor = contributor+" "+email1+"@"+email2;
		}
		
		$('#writer').html(contributor);
		$('#time').html('발행 <?=date('Y-m-d H:i:s')?>');
		
		$.ajax({
			type: 'post',
			url: '/preview/review/temp',
			data: {'mode': 'preview_temp', 'contents': contents, 'related': related},
			
			success: function(msg){
				console.log(msg);
				data = JSON.parse(msg);

				$('#relate').html(data.relate);
				$('#contents').html(restoreHtml(data.content));
				//console.log(msg);
			},
			error: function( jqXHR, textStatus, errorThrown ) { 
				alert( textStatus + ", " + errorThrown ); 
			} 
		});
		
	});

	function restoreHtml(html){
		var findReplace = [[/&amp;/g, "&"], [/&lt;/g, "<"], [/&gt;/g, ">"], [/&quot;/g, '"'], [/\\"/g, '"'], [/\\'/g, "'"]];
		for(var item in findReplace){
			html = html.replace(findReplace[item][0], findReplace[item][1]);
		}
		return html;
	}

	function js_view(v){
		//사용자단 작업 완료 되면 링크 걸어야 됨
		alert("준비중입니다.");
	}

</script>

</script>
</body>

</html>
