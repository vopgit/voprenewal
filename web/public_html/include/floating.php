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

<script>
    $('#togoPop, #togoPopMask').hide();
    function togoPopOpen(){
        $('#togoPop, #togoPopMask').fadeIn(300);
        scroll.disable();
    }
</script>
