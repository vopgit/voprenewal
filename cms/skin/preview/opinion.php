<?php include "preview_header.php"; ?>


    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/preview/opinion">오피니언</a></h1>
                <ul class="tit_tab_box">
                    <li><a href="<?=_WEB_URL?>/editorial" target="_blank">사설</a></li>
                    <li><a href="<?=_WEB_URL?>/column" target="_blank">칼럼</a></li>
                </ul>
            </div>

            <div class="editorial mt_35 mb_40">
                <h2 class="mb_15">민중의 소리 사설</h2>
                <ul class="row wp_40">
					<?
					for ($j = 0 ; $j < count($rs_editorial); $j++) {
					?>

					<li class="col_12 col_md_24">
                        <a href="javascript:;" onclick="js_view('editorial','<?=$rs_editorial[$j]['serial']?>')" class="editorial_area">
                            <span class="editorial_cate">사설</span>
                            <span class="editorial_tit"><?=$rs_editorial[$j]['title']?></span>
                            <span class="editorial_txt">
                                <?= nl2br($rs_editorial[$j]['description'])?>
                            </span>
                        </a>
                    </li>

					<? } ?>

					<? for($i = $j; $i <= 1; $i++) { ?>

					<li class="col_12 col_md_24">
                        <a href="javascript:;" onclick="alert('준비중입니다.')" class="editorial_area">
                            <span class="editorial_cate">사설</span>
                            <span class="editorial_tit"></span>
                            <span class="editorial_txt">
                            </span>
                        </a>
                    </li>

					<? } ?>


                  </ul>
                <a href="#" class="more">더보기</a>
            </div>

            <div class="sec">

				<?
				for ($j = 0 ; $j < count($rs_column_top); $j++) {
				?>
                <div class="sec_left">
                    <div class="news st_1">
                        <div class="news_img">
							<?php if($rs_column_top[$j]['thumb_filepath'] != ''){ ?>
								<a href="javascript:;" onclick="js_view('column','<?=$rs_column_top[$j]['serial']?>')">
									<img src="<?=$rs_column_top[$j]['photo_opinion_thumb']?>" alt="">
								</a>
							<?php }else{?>
								<a href="javascript:;" onclick="alert('준비중입니다.')">
									<img src="https://via.placeholder.com/435x255/eeeeee/?text=(no_image)" alt="샘플이미지" />
								</a>
							<?php }?>
                        </div>
                        <div class="news_text">
                            <p class="news_tit">
                                <a href="javascript:;" onclick="js_view('column','<?=$rs_column_top[$j]['serial']?>')"><?=$rs_column_top[$j]['title']?></a>
                            </p>
                            <p class="news_txt">
                                <a href="javascript:;" onclick="js_view('column','<?=$rs_column_top[$j]['serial']?>')">
                                    <?= nl2br($rs_column_top[$j]['description'])?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

				<? } ?>

				<? for($i = $j; $i <= 0; $i++) { ?>

				<div class="sec_left">
                    <div class="news st_1">
                        <div class="news_img">
							<a href="javascript:;" onclick="alert('준비중입니다.')">
								<img src="https://via.placeholder.com/435x255/eeeeee/?text=(no_image)" alt="샘플이미지" />
							</a>
                        </div>
                        <div class="news_text">
                            <p class="news_tit">
                                <a href="javascript:;" onclick="alert('준비중입니다.')"></a>
                            </p>
                            <p class="news_txt">
                                <a href="javascript:;" onclick="alert('준비중입니다.')">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
				<? } ?>

                <div class="sec_right">
                    <div class="rank">
                        <h2 class="line pr_0">오피니언 가장 많이 읽은 기사</h2>
                        <ul class="rank_area">
                            <li class="rank_item">
                                <div class="rank_text">
                                    <p><a href="#">오랜만에 등판했지만…지지율 ‘휘청’ 윤석열에 쏟아진 아픈 질문들 </a></p>
                                </div>
                            </li>
                            <li class="rank_item">
                                <div class="rank_text">
                                    <p><a href="#">오랜만에 등판했지만…지지율 ‘휘청’ 윤석열에 쏟아진 아픈 질문들 </a></p>
                                </div>
                            </li>
                            <li class="rank_item">
                                <div class="rank_text">
                                    <p><a href="#">오랜만에 등판했지만…지지율 ‘휘청’ 윤석열에 쏟아진 아픈 질문들 </a></p>
                                </div>
                            </li>
                        </ul>
                    </div><!--rank//-->
                </div>
            </div>
        </div>

        <div class="today_box mt_40 mt_md_80">
            <div class="wrap_1180">
                <div class="today">
                    <h2>오늘의 컬럼</h2>
                    <ul class="row wp_40 pt_20">

					<?php 
						for ($j = 0 ; $j < count($rs_column); $j++) {
							$writer_name = "";
							$writer_role = $writer_name = $rs_column[$j]['company'];

							if($rs_column[$j]['contributor'] != ""){
								$writer_name = $rs_column[$j]['contributor'];
							}else{
								if($rs_column[$j]['name'] != ""){
									$writer_name = $rs_column[$j]['name'];
								}else{
									$writer_name = "DB 업데이트 후 정상 작동합니다";
								}
								
							}

					?>

                       <li class="col_6 col_md_12">
                            <div class="today_item">
                                <div class="today_img">
									<?php if($rs_column[$j]['thumb_filepath'] != ''){ ?>
										<a href="javascript:;" onclick="js_view('column','<?=$rs_column[$j]['serial']?>')">
											<img src="<?=$rs_column[$j]['photo_opinion_thumb']?>" alt="">
										</a>
									<?php }else{?>
										<a href="javascript:;" onclick="alert('준비중입니다.')">
											<img src="https://via.placeholder.com/345x255/bbbbbb/?text=(no_image)" alt="샘플이미지" />
										</a>
									<?php }?>
                                </div>
                                <div class="today_text">
                                    <!--기자수첩만 color : tc_2-->
                                    <span class="today_cate <?=($rs_column[$j]['color']=="red")?"tc_2":""?>"><?=$rs_column[$j]['description']?></span>
                                    <p class="today_tit">
                                        <a href="javascript:;" onclick="js_view('column','<?=$rs_column[$j]['serial']?>')"><span><?=$rs_column[$j]['title']?></span></a>
                                    </p>
                                    <div class="today_reporter">
                                        <div class="today_reporter_img">
											<?php if($rs_column[$j]['writer_filepath'] != ''){ ?>
												<a href="javascript:;" onclick="js_view('column','<?=$rs_column[$j]['serial']?>')">
													<img src="<?=$rs_column[$j]['photo_opinion_writer']?>" alt="">
												</a>
											<?php }else{?>
												<a href="javascript:;" onclick="alert('준비중입니다.')">
													<img src="https://via.placeholder.com/60x60/bbbbbb/?text=(no_image)" alt="샘플이미지" />
												</a>
											<?php }?>
                                        </div>
                                        <div class="today_reporter_txt">
                                            <a href="javascript:;" onclick="js_view('column','<?=$rs_column[$j]['serial']?>')"><span><?=$writer_name?> <?=$writer_role?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
					<?php } ?>

					<?php for($i = $j; $i <= 3; $i++) { ?>
						<li class="col_6 col_md_12">
                            <div class="today_item">
                                <div class="today_img">
									<a href="javascript:;" onclick="alert('준비중입니다.')">
										<img src="https://via.placeholder.com/345x255/bbbbbb/?text=(no_image)" alt="샘플이미지" />
									</a>
                                </div>
                                <div class="today_text">
                                    <!--기자수첩만 color : tc_2-->
                                    <span class="today_cate"></span>
                                    <p class="today_tit">
                                    </p>
                                    <div class="today_reporter">
                                        <div class="today_reporter_img">
											<img src="https://via.placeholder.com/60x60/bbbbbb/?text=(no_image)" alt="샘플이미지" />
                                        </div>
                                        <div class="today_reporter_txt">
                                            <a href="javascript:;" onclick="alert('준비중입니다.')"><span></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
					<?php } ?>
                    </ul>

                    <a href="#" class="more">더보기</a>
                </div>
            </div>
        </div><!--오늘의 컬럼-->

        <div class="wrap_1180">
            <div class="tab_box mt_45 mb_40">
                <ul>
                    <li><a href="javascript:;" onclick="js_ChangeColumnType(this, 'Y')" class="on">연재컬럼</a></li>
                    <li><a href="javascript:;" onclick="js_ChangeColumnType(this, 'N')">휴재&middot;마감 칼럼</a></li>
                </ul>
            </div>

			<?if(count($rs_column_group) > 0){?>
            <ul class="img_list_box" id="cloumn_list">
				<?
				for ($j = 0 ; $j < count($rs_column_group); $j++) {
					$data = $rs_column_group[$j];
				?>
				<li>
					<div class="img_list_item">
						<div class="img_list_img">
							<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')">
								<img src="<?=$data['photo']?>" alt="샘플이미지" />
							</a>
						</div>
						<div class="img_list_text">
							<p class="img_list_tit">
								<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')"><span><?=$data['description']?></span></a>
							</p>
						</div>
					</div>
				</li>
				<?}?>
			</ul>

			<?}else{?>
			 <!--게시글 x-->
            <div class="noData">
                <div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
                <p>‘오피니언’<b> 게시글이 없습니다.</b></p>
            </div>

			<?}?>

			<!--
            <div class="page_wrap pt_50 st_2">
                <div class="page">
                    <a href="javascript:void(0);" class="first"><i class="icon_prev2">이전10개</i></a>
                    <a href="javascript:void(0);" class="prev"><i class="icon_prev">이전페이지</i></a>
                    <span class="current_m"><span>3</span><span class="total"> / 69</span></span>


                    <span class="page_p">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#" class="act">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">7</a>
                        <a href="#">8</a>
                        <a href="#">9</a>
                        <a href="#">10</a>
                    </span>

                    <a href="javascript:void(0);" class="next"><i class="icon_next">다음페이지</i></a>
                    <a href="javascript:void(0);" class="end"><i class="icon_next2">다음10개</i></a>
                </div>
            </div>
			-->
        </div><!--컬럼-->
    </section>


<script>

	function js_view(type,serial){
		//var _url = "/preview/opinion_view/"+serial;
		//location.href = _url;
		//window.open(_url);
	}

	function js_column_list(column_group_id){
		var _url = "<?=_WEB_URL?>/column?type=column&group="+column_group_id;
		//location.href = _url;
		//window.open(_url);
	}

	function js_ChangeColumnType(e, use_tf){

		$(e).closest("ul").find("a").removeClass("on");
		$(e).addClass("on");

		$.ajax({
			type: 'post',
			url: '/preview/ajax_getColumn',
			data : {mode:'CHANGE_STATUS_VIEW', 'use_tf' : use_tf},
			success: function(msg){
				//console.log(msg);
				$('#cloumn_list').html(msg);

			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( textStatus + ", " + errorThrown );
			}
		});

	}

</script>

<?php include "preview_footer.php"; ?>
