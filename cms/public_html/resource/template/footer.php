<div class="footer">
    <div class="footer_top">
        <div class="wrap_1180">
            <div class="footer_info_link">
                <span class="footer_info_link_item"><a href="/company/main" target="_blank">회사소개</a></span>
                <span class="footer_info_link_item"><a href="/etc/ethics">보도윤리</a></span>
                <span class="footer_info_link_item"><a href="/company/main#link2" target="_blank">광고안내</a></span>
                <span class="footer_info_link_item"><a href="/company/main#link2" target="_blank">업무문의</a></span>
                <span class="footer_info_link_item"><a href="https://www.ihappynanum.com/Nanum/B/ZZWJXPDKGQ" target="_blank">후원하기</a></span>
                <span class="footer_info_link_line"></span>
                <span class="footer_info_link_item" class="strong"><a href="/etc/privacy">개인정보취급방침</a></span>
                <span class="footer_info_link_item"><a href="/etc/terms">서비스약관</a></span>
                <span class="footer_info_link_item"><a href="/etc/mail_policy">이메일무단수집거부</a></span>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="wrap_1180">
            <div class="footer_bottom_wrap row">
                <div class="footer_logo col_">
                    <img src="/resource/images/company/logo_on.svg" alt="민중의 소리">
                </div>
                <div class="footer_info_box col_">
                    <div class="footer_info">
                        <span class="footer_info_item"><span class="fw_400">주소</span> 서울시 종로구 삼일대로 469 서원빌딩 11층</span><br class="md">
                        <span class="footer_info_item"><span class="fw_400">등록번호</span> 서울아00104 (2005년 11월 7일)</span><br class="md">
                        <span class="footer_info_item"><span class="fw_400">발행인</span> 윤원석</span>
                        <span class="footer_info_item"><span class="fw_400">편집인</span> 고희철</span>
                        <span class="footer_info_item"><span class="fw_400">청소년보호책임자</span> 김동현</span><br class="md">
                        <span class="footer_info_item"><span class="fw_400">발행일자</span> 2000년05월15일</span>
                        <span class="footer_info_item"><span class="fw_400">전화</span> 02-723-4266</span>
                    </div>
                    <p class="footer_copy">copyrightⓒ since 2000 Voice of the people. All Rights Reserved.</p>
                </div>

                <div class="footer_btn col_">
                    <a href="https://www.ihappynanum.com/Nanum/B/ZZWJXPDKGQ" class="btn btn_cp_c1" target="_blank"><i class=" iconFt_symbol"></i> 민중의소리 후원하기</a>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="floating_box">
<div class="floating">
    <div class="floating_left">
        <div class="support_box" style="display: none;">
            <div class="support_top">
                <span class="support_tit">
                    <b>민중의 소리</b>
                    <span>손을 잡아주세요.</span>
                </span>
                <span class="support_txt">
                    진실과 정의가 살아있음을<br>
                    알리겠습니다.
                </span>
            </div>
            <div class="support_bottom">
                <a href="https://www.ihappynanum.com/Nanum/B/ZZWJXPDKGQ" target="_blank">
                    <i class="iconFt_icon_1"></i>
                    <span>
                        민중의 소리 <br>후원하기
                        <i class="iconFt_arrow_ty1_r"></i>
                    </span>
                </a>
            </div>
            <button type="button" class="support_close" onclick="$('.support_box').hide()"><i class="iconFt_close_2"></i></button>
        </div>
    </div>
    <div class="floating_right">
        <div>
            <button type="button" class="floating_button first" onclick="$('.support_box').toggle()"><i class="iconFt_symbol"></i><span>후원하기</span></button>
            <button type="button"  href="javascript:void(0)" class="floating_button" onclick="togoPopOpen();"><i class="iconFt_pen_2"></i><span>독자투고</span></button>
            <a href="#container" class="floating_top">
                <i class="iconFt_arrow_middle_u"></i>
                <span>TOP</span>
            </a>
        </div>
    </div>
</div>
</div>

<div class="mask" id="togoPopMask"></div>
<div class="popup_wrap" id="togoPop">
    <iframe src="/etc/togo" frameborder="0"></iframe>
</div>

<div class="mask" id="reviewMask"></div>
<div class="popup_wrap" id="reviewPopup">
	<iframe src="/news/popup_review" frameborder="0"></iframe>
</div>

<div class="mask" id="reviewMask"></div>
<div class="popup_wrap" id="reviewPopup">
	<iframe src="/news/popup_review/<?=$rs['serial']?>" frameborder="0"></iframe>
</div>

<script>
	$('#reviewPopup, #reviewMask').hide();
	function popupOpen(){
		$('#reviewPopup, #reviewMask').fadeIn(300);
		scroll.disable();
	}
	$('body').css('overflowX', 'hidden');
</script>
<script type="application/ld+json">
	{
		"@context":"https://schema.org",
		"@type":"NewsArticle",
		"@id":"<?=$og['url']?>",
		"mainEntityOfPage":{
			"@type":"WebPage",
			"@id":"<?=$og['url']?>"
		},
		"headline":"<?=$og['title']?>",
		"description":"<?=$og['description']?>",
		"image": {
			"@type": "ImageObject",
			"url": "<?=$og['image']?>",
			"height": 420,
			"width": 800
		},
		"datePublished": "<?=$og['pub_date']?>",
		"dateModified": "<?=$og['mod_date']?>",
		"author": {
			"@type": "Person",
			"name": "<?=$og['author']?>"
		},
		"publisher": {
			"@type": "NewsMediaOrganization",
			"@id": "https://vop.co.kr",
			"name": "민중의소리",
			"logo": {
				"@type": "ImageObject",
				"url": "https://www.vop.co.kr/templates/2017/images/logo-black.png",
				"width": 205,
				"height" : 45
			},
			"foundingDate":"2000-05-15",
			"sameAs":["https://www.facebook.com/newsvop","https://twitter.com/newsvop"]
		}
	}
</script>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
    Kakao.init('4dd2658e0a6481db9bd8540d4300c933');
    function sendLink() {
      Kakao.Link.sendDefault({
        objectType: 'feed',
        content: {
          title: '<?=$og['title']?>',
          description: '',
          imageUrl: '<?=$og['image']?>',
          link: {
            mobileWebUrl: '<?=$og['url']?>',
            webUrl: '<?=$og['url']?>'
          }
        },
        buttons: [
          {
            title: '민중의소리에서 확인',
            link: {
              mobileWebUrl: '<?=$og['url']?>',
              webUrl: '<?=$og['url']?>'
            }
          }
        ]
      });
    }
</script>

<script>
    $('#togoPop, #togoPopMask').hide();
    function togoPopOpen(){
        $('#togoPop, #togoPopMask').fadeIn(300);
        scroll.disable();
    }
    var imgs = document.querySelectorAll('img');
    imgs.forEach(function(img){
        img.addEventListener("error", function(event) {
            console.log('error');
            event.target.src = "/resource/images/no_image.jpg"
            event.onerror = null
        })
    })
</script>

    <script type="text/javascript" src="/templates/adv/2021_renew/mobile_fixed_daumadfit_32050.js"></script><!-- 모바일 하단 고정배너 320x50 -->
    <script type="text/javascript" src="/templates/adv/2021_renew/priel_m_inside_300250.js"></script><!-- 모바일광고 프리엘 inside -->
    <!-- <script type="text/javascript" src="/templates/adv/2021_renew/adop_pc_hybridvideo.js"></script> --><!-- PC광고 애드오피 하이브리드비디오광고 -->
    <!-- <script type="text/javascript" src="/templates/adv/2021_renew/adop_mobile_hybridvideo.js"></script> --><!-- 모바일광고 애드오피 하이브리드비디오광고 -->
    <!-- <script type="text/javascript" src="/templates/adv/2021_renew/realclick_fullscrine.js"></script> --><!-- PC광고 리얼클릭 풀스크린 광고 -->
</div><!--container//-->
</body>

</html>