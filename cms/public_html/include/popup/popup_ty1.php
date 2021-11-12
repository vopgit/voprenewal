<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>

<style>
    html,body{
        background: none;
    }
</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>링크입력</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">
                    <div>
                        <div class="mb_10">
                            <p class="mb_10">링크 URL</p>
                            <input type="text" class="inp inp_sm fm_full">
                        </div>
                        <div class="mb_10">
                            <p class="mb_10">텍스트</p>
                            <input type="text" class="inp inp_sm fm_full">
                        </div>
                    </div>
                    <div class="t_center mt_60">
                        <button class="btn_md btn_c2">등록</button>
                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>


</body>
</html>