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
		<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/editor.css"/>

		<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/company_layout.css"/>
		<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/company_sub.css"/>

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
			.popup_box.st_preview .popup_wrap{
				overflow:visible;
			}
			.popup_con{
				padding:0;
				position: relative;
			}
			.popup_contents {
				padding: 0 !important;
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
			.board_view.type_a{border:0 !important}
		</style>
	</head><!--head //-->

	<body>

		<div id="container" class="type_review view_container">
			<div class="popup_box st_preview">
				<div class="popup_wrap wrap1300">
					<div class="popup_ty1 popup_con">
						<button class="pop_close" type="button">&times;</button>
						<div class="popup_contents">

							<!--미리보기 {-->
							<div class="board_view type_a">

								<div class="bv_box ">
									<div class="bv_top">
										<p class="bv_tit" id="title">
										</p>

										<div class="bv_info_box">
											<ul class="bv_info">
												<li id="time"></li>
												<li data-tit="작성자" id="writer"></li>
											</ul>
										</div>
									</div>

									<div class="bv_bottom">

										<div class="bv_file_wrap">
											<div class="bv_file"><span class="text_hide">첨부파일</span></div>
											<div class="bv_file_box">
												<p class="ptb_10">미리보기시 지원하지 않습니다.</p>
											</div>
										</div>

									</div>

									<div class="bv_con">
										<div class="editor" id="contents">
										</div>
									</div>

								</div>

							</div><!--board_view //-->
							<!--미리보기 }-->
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">

			$(document).ready(function() {

				var parentWin = window.parent.document;
				var title = $('#title', parentWin).val();	
				var category = $('#category', parentWin).val();
				var contents = $('#contents', parentWin).html();

				var contributor = $('#contributor', parentWin).val();
				if(contributor == ""){
					contributor = "<?=$_SESSION['_admin']['name']?>";
				}

				$('#title').html("["+category+"] "+title);	
				$('#writer').html(contributor);
				$('#time').html("<?=date('Y-m-d H:i:s')?>");
				
				$.ajax({
					type: 'post',
					url: '/preview/alim/temp',
					data: {'mode': 'preview_temp', 'contents': contents},
					
					success: function(msg){
						console.log(msg);
						data = JSON.parse(msg);
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

	</body>
</html>
