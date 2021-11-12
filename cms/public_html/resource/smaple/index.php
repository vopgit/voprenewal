<?php  include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
    <div class="wrap">
    <div class="popup_sample">
        <button class="btn act_popup mtb_20" data-url="popup_ty1" onclick="act_popup(this)">  링크입력 : class -> act_popup / data-url="popup_ty1" </button>
        <button class="btn act_popup mtb_20" data-url="popup_ty2" onclick="act_popup(this)">  칼럼명 관리 : class -> act_popup / data-url="popup_ty2" </button>
        <button class="btn act_popup mtb_20" data-url="popup_ty3" onclick="act_popup(this)">  기사검색 : class -> act_popup / data-url="popup_ty3" </button>
        <button class="btn act_popup mtb_20" data-url="popup_ty4" onclick="act_popup(this)">  연재 칼럼 선택 : class -> act_popup / data-url="popup_ty4" </button>
        <button class="btn act_popup mtb_20" data-url="popup_ty5" onclick="act_popup(this)">  사진입력 : class -> act_popup / data-url="popup_ty5" </button>
    </div>

        <?php 
        include $_SERVER["DOCUMENT_ROOT"].'/include/popup/popup.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/tab.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/box.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/page.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/photo.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/txt.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/form.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/btn.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/table.php'; 
        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/poto.php'; 
        

        include $_SERVER["DOCUMENT_ROOT"].'/resource/smaple/editor.php';
        ?>
    </div>
   
</body>


</html>
