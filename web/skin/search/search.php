<?php
if(!defined('_HOME_TITLE')) exit;

include_once _ROOT. '/include/head.php';
?>

    <link rel="stylesheet" type="text/css" href="/resource/css/sub.css"/>
    <script src="/resource/js/sub.js"></script>

    <!-- Google ADServer Script(S) -->
    <script type="text/javascript" src="//www.googletagservices.com/tag/js/gpt.js"></script>
    <script type="text/javascript" src="/templates/admanager/google_admanager_head_script_20211103_2.js"></script>
    <!-- Google ADServer Script(E) -->
</head><!--head //-->

<body>
<div id="container"><!--container-->
    <?php
    include_once _ROOT. '/include/headerSub.php';
    ?>

    <section class="con">

        <div class="wrap_820 mt_md_40">
            <form name="frm_s" method="get" action="/search" onsubmit="return formCheck()">
                <div class="search_box2">
                    <input type="text" name="search_q" id="search_q" class="search_box2_inp" placeholder="검색어를 입력해주세요" value="<?=$search_q?>"  maxlength="20">
                    <button type="submit" class="search_box2_button">
                        <span>
                            <i class="iconFt_search"></i>
                        </span>
                    </button>
                </div>
            </form>

            <div class="mt_25 mt_md_40">
                <!--광고 pc mo-->
                <div class="arcad_box arcad_area_pc ptb_25 plr_25">
                    <div id='div-gpt-ad-1350270943364-2' class="mlr_auto t_center">
                        <script type='text/javascript'>
                            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1350270943364-2'); });
                        </script>       
                    </div>
                </div>
                <!--광고//-->
            </div>
        </div>


        <div class="wrap_1180">
            <div class="mt_25 mb_15 mb_sm_15 fs_16 fs_sm_13">
                <span class="va_m fw_700 fs_20 fs_sm_16 mr_10">검색결과</span>
                <span class="va_m tc_b5">총 <?=number_format($result->response->numFound)?>건</span>
            </div>
        </div>

        <div class="search_box3_wrap mb_20">
            <div class="wrap_1180">
                <div class="search_box3">
                    <div class="search_box3_item">
                        <a href="javascript:void(0)">
							<?php 
							if($option == 3) echo "1일";
							else if($option == 4) echo "1주일";
							else if($option == 5) echo "1개월";
							else if($option == 6) echo "1년";
							else echo "전체기간";
							?>
						</a>
                        <ul>
                            <li><a href="/search?search_q=<?=$search_q?>&category=<?=$category?>&option=2">전체기간</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=<?=$category?>&option=3">1일</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=<?=$category?>&option=4">1주일</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=<?=$category?>&option=5">1개월</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=<?=$category?>&option=6">1년</a></li>
                        </ul>
                    </div>
                    <div class="search_box3_item">
                        <a href="javascript:void(0)">
							<?php 
							if($category == "여론광장") echo "사설칼럼";
							else if($category == "전체") echo "기사분류";
							else if($category != "") echo $category;
							else echo "기사분류";
							?>
						</a>
                        <ul>
                            <li><a href="/search?search_q=<?=$search_q?>&category=전체&option=2">전체기사</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=여론광장&option=2">사설칼럼</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=정치&option=2">정치</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=경제&option=2">경제</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=사회&option=2">사회</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=국제&option=2">국제</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=문화&option=2">문화</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=연예&option=2">연예</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=스포츠&option=2">스포츠</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=과학&option=2">과학</a></li>
                            <li><a href="/search?search_q=<?=$search_q?>&category=생활&option=2">생활</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap_1180">

            <ul class="ul_img_box st_2">
				<?php 
				$article_line = $result->response->docs;

				foreach($article_line as $key => $value) {
					$title = str_highlight($search_q, $value->subject);
					$content = reset($value->content);
					if($content != "") $content = str_highlight($search_q, $content);
					$name = $value->writer;
					$published_time = str_replace("T"," ",str_replace("Z","",$value->last_modified));  
					$url = $value->url;
					$category = $value->category;	
					$imgurl = trim($value->imageurl);

					if($imgurl != ''){						
						$imgurl = str_replace("http:", "https:", $imgurl);
						$imgurl_arr = explode("https:", $imgurl);
						$imgurl = "https:".rtrim($imgurl_arr[1]);

						if(strpos($imgurl, '/marked/') > 0){
							$thumb = str_replace('/marked/', '/thumb/', $imgurl);
							if(checkRemoteImage($thumb)) $imgurl = $thumb;
						}
					}
					?>
					<li class="ul_img_item">
						<div class="ul_img">
							<?php if($imgurl != ''){ ?>
							<div class="ul_img_img">
								<a href="<?=$url?>">
									<div class="loading pre_loading_img">
										<div></div>
										<div></div>
										<div></div>
									</div>
									<img src="<?=$imgurl?>" title="<?=strip_tags($title)?> 사진" style="display:none"/>
	                            </a>
		                    </div>
							<?php } ?>
							<div class="ul_img_text">
								<div>
									<a href="<?=$url?>" class="ul_img_tit_box">
										<span class="ul_img_tit">
											<?php if($category != ''){ ?>
												<!-- [<?=$category?>] -->
											<?php } ?>
											<?=$title?>
										</span>
									</a>
									<div class="ul_img_info_box">
										<ul class="ul_img_info">
											<li><?=$name?></li>
											<li><?=$published_time?></li>
										</ul>
									</div>
									<?php if($content != ''){ ?>
										<p class="ul_img_txt"><a href="<?=$url?>"><?=$content?></a></p>
									<?php } ?>
								</div>
							</div>
						</div>
	                </li>
					<?php 
				}
				?>
            </ul>

            <?php if($result->response->numFound < 1){ ?>
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" ></div>
                <p>
					<?php if($search_q != ''){ ?>
						‘<?=$search_q?>’<b> 검색 결과가 없습니다.</b>
					<?php }else{ ?>
						검색어를 입력해 주세요
					<?php } ?>
				</p>
            </div>
			<?php } ?>

            <div class="page_wrap mt_50 mb_35 st_2">
				<?php
				$num_per_page = 20;
				$page_per_block = 10;
				$total_record = $result->response->numFound;

				if($nPage == "") $nPage = 1;
				$start = $num_per_page * ($nPage-1) ;

				$total_page = ceil($total_record/$num_per_page);  // 전체페이지수 구하기
				$total_block = ceil($total_page/$page_per_block);  // 전체 블럭수 구하기
				$block = ceil($nPage/$page_per_block);  // 현재 페이지가 속한 블럭
				$first_page = ($block-1) * $page_per_block;
				$last_page = $block * $page_per_block;

				echo pageList('/search', $nPage, $total_page, $page_per_block, 'search_q='.urlencode($search_q).'&category='.urlencode($category).'&option='.$option);
				?>
            </div>


        </div><!--컬럼-->
    </section>

    <?php include_once _ROOT. '/include/footer.php';?>

</div><!--container//-->


<script>
    $(document).on('click', '.search_box3_item > a', tabEvt);
    function tabEvt(e){
        e.preventDefault();
        $('.search_box3_item ul').stop().slideUp(200);
        $(this).next('ul').stop().slideToggle(200);
    }
	$(document).on('click', function (event) {
		var $li = $('.search_box3_item > ul, .search_box3_item > a');
		if (!$li.is(event.target) && $li.has(event.target).length === 0) {
			$('.search_box3_item ul').stop()
				.slideUp(200);
		}
	});
	window.onload = function(){
		$('.ul_img_box').find('img').each(function(i, ele){
			console.log($(this));
			$(this).css('display','block');
			$(this).siblings('.pre_loading_img').remove();
		});
	}
	function formCheck(){
		if($('#search_q').val().trim() == ""){
			alert("검색어를 입력해 주세요");
			$('#search_q').focus();
			return false;
		} 
		if($('#search_q').val().trim().length < 2){
			alert("검색어를 2자 이상 입력해 주세요");
			$('#search_q').focus();
			return false;
		}
	}
</script>
</body>

</html>
