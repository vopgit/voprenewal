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

<script>
    var imgs = document.querySelectorAll('img');
    imgs.forEach(function(img){
        img.addEventListener("error", function(event) {
            console.log('error');
            event.target.src = "/resource/images/no_image.jpg"
            event.onerror = null
        })
    })
</script>

<?php include_once _ROOT. '/include/floating.php'; ?>
