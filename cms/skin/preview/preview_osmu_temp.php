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

<div id="container" class="type_source view_container">
<div class="popup_box">
    <div class="popup_wrap wrap1300">
        <div class="popup_ty1 popup_con">
			<button class="pop_close" type="button">&times;</button>
            <div class="popup_contents">

				<!--미리보기-->
				<div class="view_top" style="height: auto;">
                    <div class="wrap_980">
                        <div class="view_top_cate2">
                            <span class="view_top_cate2_txt1">원소스</span>
                        </div>
                        <h1 class="view_top_tit" id="title"><!--제목--></h1>

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
								<h2 class="vcr_tit"><span>관련 기사</span></h2>
								<ul class="vcr_list" id="relate">
									<li class="t_center "> <p class="ptb_10"><!--관련기사--></p></li>
								</ul>
							</div>

							<div class="vcr_box bg_wh">
								<h2 class="vcr_tit"><span>첨부파일</span></h2>
								<ul class="vcr_list">
									<li class="t_center"> <p class="ptb_10">미리보기시 지원하지 않습니다.</p></li>
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
<script type="text/javascript">
$(document).ready(function() {
	var parentWin = window.parent.document;
	var title = $('#title', parentWin).val();	
	var related = $('#related', parentWin).val();
	var contents = $('#contents', parentWin).html();

	var contributor = $('#contributor', parentWin).val();
	if(contributor == ""){
		contributor = "<?=$_SESSION['_admin']['name']?> 기자 <?=$_SESSION['_admin']['email']?>";
	}

	$('#title').html(title);	
	$('#writer').html(contributor);
	$('#time').html('<?=date('Y-m-d H:i:s')?>');
	
	$.ajax({
		type: 'post',
		url: '/preview/osmu/temp',
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

</script>

</script>
</body>

</html>
