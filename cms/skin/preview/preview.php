<?php
//게시물번호 : $uid
//$_POST : print_r($post);
//$_GET : print_r($get);

//print_r("스킨파일 경로 :: ".$_skin['html']);
//print_r("qry :: ".$qry);

?>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>

<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/common.css"/>
<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/sub.css"/>
<link rel="stylesheet" type="text/css" href="//vop.giringrim.co.kr/resource/css/editor.css"/>
<link rel="stylesheet" type="text/css" href="/resource/css/common.css?v=2"/>

<style media="screen">
    html,body{
        background: #fff;
    }
    .pop_close{
        z-index: 1;
        position: absolute;
        top:0;
        right:0;
        width: 2em;
        height: 2em;
        font-size: 2rem;
        text-align: center;
    }
    @media screen and (max-width: 1280px){
        .view_top .view_top_share_box {display: none;}
    }

</style>

<button class="pop_close">&times;</button>

<section class="con">
<div class="view_top">
	<div class="wrap_980">
		<div class="view_top_cate2">
			<span class="view_top_cate2_txt1">원소스</span>
		</div>
		<h1 class="view_top_tit"><?=$rs["title"]?></h1>

		<div class="flex fw_nowrap">
			<div class="view_top_info_box mr_auto">
				<ul class="view_top_info">
					<li>(<?=$rs["name"]?>)<?=$rs["contributor"]?> <?=$rs["email"]?></li>
					<li>발행 <?=$rs["published_time"]?></li>
					<li>수정 <?=$rs["update_time"]?></li>
				</ul>
			</div>

			<div class="view_top_share_box ml_auto">
				<button type="button"><i class="iconFt_share"></i></button>
				<ul class="view_top_share">
					<li><button type="button"><i class="iconFt_facebook1"></i></button></li>
					<li><button type="button"><i class="iconFt_twitter"></i></button></li>
					<li><button type="button"><i class="iconFt_kakao1"></i></button></li>
					<li><button type="button"><i class="iconFt_link"></i></button></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--view_top}-->

<div class="wrap_980">
	<div class="view_con">
		<div class="view_con_left">
			<div class="editor">
				내용
			</div>

            <!--editor}-->
        </div>
        <!--view_con_left }-->

		<div class="view_con_right mo_hide">
			<!--오른쪽-->
			<div class="vcr_box">
				<h2 class="vcr_tit"><span>관련 기사</span></h2>
				<ul class="vcr_list">
					<li><a href="#">
						<span class="img_box"><span class="img_con"><img src="https://via.placeholder.com/90x52/eeeeee/?text=(1.7:1)" alt="이미지설명"></span></span>
						<span>관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다.</span></a></li>
					<li><a href="#">
						<span>관련 기사가 들어갑니다. 관련 기사가 들어갑니다.</span></a></li>
					<li><a href="#">
						<span class="img_box"><span class="img_con"><img src="https://via.placeholder.com/90x52/eeeeee/?text=(1.7:1)" alt="이미지설명"></span></span>
						<span>관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다. 관련 기사가 들어갑니다.</span></a></li>

					<!--데이터 x-->
					<li class="t_center "> <p class="ptb_10">등록된 관련 기사가 없습니다.</p></li>
				</ul>
			</div>

			<div class="vcr_box bg_wh">
				<h2 class="vcr_tit"><span>첨부파일</span></h2>
				<ul class="vcr_list">
					<li><a href="#"><i class="iconFt_file"></i><span>첨부파일_1.pdf</span></a></li>
					<li><a href="#"><i class="iconFt_file"></i><span>첨부파일_1.pdf</span></a></li>
					<li><a href="#"><i class="iconFt_file"></i><span>첨부파일_1.pdf</span></a></li>
					<!--데이터 x-->
					<li class="t_center"> <p class="ptb_10">등록된 첨부파일이 없습니다.</p></li>
				</ul>
			</div>


            <div class="vcr_box">
               <!--광고-->
               <div class="arcad size_300x250">
                   <div class="dfpAd"></div>
               </div>

               <div class="arcad size_250x250 mt_20 left">
                   <div class="dfpAd"></div>
               </div>

               <div class="arcad size_300x600 mt_20">
                   <div class="dfpAd"></div>
               </div>

               <div class="arcad size_300x250 mt_20">
                   <div class="dfpAd"></div>
               </div>
               <div class="arcad size_300x250 mt_20">
                   <div class="dfpAd"></div>
               </div>
               <!--광고//-->
           </div>
		</div>
        <!--view_con_right  }-->
	</div>
</div>

</section>

<script>
$('.btn_step2').click(function(){
    $('.btn_step2').closest('.step_1').slideUp();
    $('.step_2').slideDown();
 });
 $('.btn_stepBack').click(function(){
    $('.step_2').slideUp();
    $('.step_1').slideDown();
});
</script>
