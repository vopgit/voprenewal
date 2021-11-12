<?php include "top.php"; ?>

    <section class="con">
        <div class="wrap_1180">
            <div class="tit_box">
                <h1><a href="/opinion/index">오피니언</a></h1>
                <ul class="tit_tab_box">
                    <li><a href="/editorial" target="_blank">사설</a></li>
                    <li><a href="/column" target="_blank">칼럼</a></li>
                </ul>
            </div>

            <div class="editorial mt_35 mb_40">
                <h2 class="mb_15">민중의 소리 사설</h2>
                <ul class="row wp_40">
					<?
					for ($j = 0 ; $j < count($rs_editorial); $j++) {
					?>

					<li class="col_12 col_md_24">
                        <a href="/<?=$rs_editorial[$j]['serial']?>.html" class="editorial_area">
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
                <a href="/editorial" class="more">더보기</a>
            </div>

            <div class="sec">

				<?php 
				for ($j = 0 ; $j < count($rs_column_top); $j++) {
					if($rs_column_top[$j]['serial'] != "") $link_url = "/".$rs_column_top[$j]['serial'].".html";
					else $link_url = "javascript:alert('준비중입니다');";
					?>
					<div class="sec_left">
						<div class="news st_1">
							<div class="news_img">
								<?php if($rs_column_top[$j]['thumb_filepath'] != ''){ ?>
									<a href="<?=$link_url?>">
										<img src="<?=$rs_column_top[$j]['photo_opinion_thumb']?>" alt="">
									</a>
								<?php }else{?>
									<a href="<?=$link_url?>">
										<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
									</a>
								<?php }?>
							</div>
							<div class="news_text">
								<p class="news_tit">
									<a href="<?=$link_url?>"><?=$rs_column_top[$j]['title']?></a>
								</p>
								<p class="news_txt">
									<a href="<?=$link_url?>">
										<?= nl2br($rs_column_top[$j]['description'])?>
									</a>
								</p>
							</div>
						</div>
					</div>
					<?php 
					} 
				?>

				<? for($i = $j; $i <= 0; $i++) { ?>
				<div class="sec_left">
                    <div class="news st_1">
                        <div class="news_img">
							<a href="javascript:;" onclick="alert('준비중입니다.')">
								<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
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
                            <?php foreach($hit as $hit) { ?>
							<li class="rank_item">
                                <div class="rank_text">
                                    <p><a href="/<?=$hit['serial']?>.html"><?=$hit['title']?></a></p>
                                </div>
                            </li>
							<?php } ?>
                        </ul>
                    </div><!--rank//-->
                </div>
            </div>
        </div>

        <div class="today_box mt_40 mt_md_80">
            <div class="wrap_1180">
                <div class="today">
                    <h2>오늘의 칼럼</h2>
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
									$writer_name = "";
								}
								
							}
					   ?>

                       <li class="col_6 col_md_12">
                            <div class="today_item">
                                <div class="today_img">
									<?php if($rs_column[$j]['thumb_filepath'] != ''){ ?>
										<a href="/<?=$rs_column[$j]['serial']?>.html">
											<img src="<?=$rs_column[$j]['photo_opinion_thumb']?>" alt="">
										</a>
									<?php }else{?>
										<a href="javascript:;" onclick="alert('준비중입니다.')">
											<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
										</a>
									<?php }?>
                                </div>
                                <div class="today_text">
                                    <!--기자수첩만 color : tc_2-->
                                    <span class="today_cate <?=($rs_column[$j]['color']=="red")?"tc_2":""?>"><?=$rs_column[$j]['description']?></span>
                                    <p class="today_tit">
                                        <a href="/<?=$rs_column[$j]['serial']?>.html"><span><?=$rs_column[$j]['title']?></span></a>
                                    </p>
                                    <div class="today_reporter">
                                        <div class="today_reporter_img">
											<?php if($rs_column[$j]['writer_filepath'] != ''){ ?>
												<a href="/<?=$rs_column[$j]['serial']?>.html">
													<img src="<?=$rs_column[$j]['photo_opinion_writer']?>" alt="">
												</a>
											<?php }else{?>
												<a href="javascript:;" onclick="alert('준비중입니다.')">
													<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
												</a>
											<?php }?>
                                        </div>
                                        <div class="today_reporter_txt">
                                            <a href="/<?=$rs_column[$j]['serial']?>.html"><span><?=$writer_name?> <?=$writer_role?></span></a>
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
										<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
									</a>
                                </div>
                                <div class="today_text">
                                    <!--기자수첩만 color : tc_2-->
                                    <span class="today_cate"></span>
                                    <p class="today_tit">
                                    </p>
                                    <div class="today_reporter">
                                        <div class="today_reporter_img">
											<img src="/resource/images/no_image.jpg" alt="이미지가 없습니다" />
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
                    <a href="/opinion/list" class="more">더보기</a>
                </div>
            </div>
        </div><!--오늘의 칼럼-->

        <div class="wrap_1180">
            <div class="tab_box mt_45 mb_40">
                <ul>
					<li><a href="javascript:;" onclick="js_ChangeColumnType('ing')" class="on">연재칼럼</a></li>
                    <li><a href="javascript:;" onclick="js_ChangeColumnType('end')">휴재&middot;마감 칼럼</a></li>
                </ul>
            </div>

			<?if(count($rs_column_group) > 0){?>
				<ul class="img_list_box ing_list">
					<?
					for ($j = 0 ; $j < count($rs_column_group); $j++) {
						$data = $rs_column_group[$j];
					?>
					<li>
						<div class="img_list_item">
							<div class="img_list_img">
								<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')">
									<img src="<?=$data['photo']?>" alt="이미지가 없습니다" />
								</a>
							</div>
							<div class="img_list_text">
								<p class="img_list_tit ellip_1">
									<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')"><span><?=$data['description']?></span></a>
								</p>
							</div>
						</div>
					</li>
					<?}?>
				</ul>
			<?}else{?>
				<div class="noData ing_list">
					<div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
					<p>연재중인 칼럼이 없습니다.</b></p>
				</div>
			<?}?>

			<?if(count($rs_column_group_end) > 0){?>
				<ul class="img_list_box end_list" style='display:none'>
					<?
					for ($j = 0 ; $j < count($rs_column_group_end); $j++) {
						$data = $rs_column_group_end[$j];
					?>
					<li>
						<div class="img_list_item">
							<div class="img_list_img">
								<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')">
									<img src="<?=$data['photo']?>" alt="이미지가 없습니다" />
								</a>
							</div>
							<div class="img_list_text">
								<p class="img_list_tit ellip_1">
									<a href="javascript:;" onclick="js_column_list('<?=$data['id']?>')"><span><?=$data['description']?></span></a>
								</p>
							</div>
						</div>
					</li>
					<?}?>
				</ul>
			<?}else{?>
				<div class="noData end_list" style='display:none'>
					<div class="noData_img"><img src="/resource/images/company/logo_on.svg" alt="민중의 소리" onerror="noDataImage(this)"></div>
					<p>휴재·마감된 칼럼이 없습니다.</b></p>
				</div>
			<?}?>

        </div><!--칼럼-->
    </section>

<script>
    $('.tab_box a').on('click', function(e){
        e.preventDefault();
        $('.tab_box a').removeClass('on');
        $(this).addClass('on');
    });

	function js_view(type,serial){
		//var _url = "/preview/opinion_view/"+serial;
		//location.href = _url;
		//window.open(_url);
	}

	function js_column_list(column_group_id){
		var _url = "/column?group="+column_group_id;
		//location.href = _url;
		window.open(_url);
	}

	function js_ChangeColumnType(str){

		if(str == "ing"){
			$('.ing_list').show();
			$('.end_list').hide();

		}else{
			$('.ing_list').hide();
			$('.end_list').show();
		}

	}

</script>

<?php include "footer.php"; ?>