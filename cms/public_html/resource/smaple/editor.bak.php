<h2>에디터 작성</h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">




<div class="editor_writer" >

    <!--floating left-->
    <div class="ew_m_btn_box">
        <div class="ew_m_btn"><button type="button" id="btnMenuText" title="텍스트"><span><i class="iconFt_txt"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuGallery" title="사진"><span><i class="iconFt_gallery"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuLink" title="링크"><span><i class="iconFt_link"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuPlayer" title="유튜브영상"><span><i class="iconFt_player"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuQuotes" title="인용문"><span><i class="iconFt_Edit_icon09"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuLine" title="점선"><span><i class="iconFt_line_type"><span class="iconFt_line_type"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuMemo" title=""><span><i class="iconFt_Edit_icon06"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuQ" title="질문"><span><i class="iconFt_Edit_icon07"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuA" title="답변"><span><i class="iconFt_Edit_icon08"></i></span></button></div>
        <div class="ew_m_btn"><button type="button" id="btnMenuF" title="페이스북"><span><i class="iconFt_sns"></i></span></button></div>
    </div>


    <!--floating menu-->
    <div class="ew_f_btn_box" id="floatingBtns">
        <div class="ew_f_btn"><button type="button" id="btnTxtBold"><span><i class="iconFt_ft-weight"></i></span></button></div>
        <div class="ew_f_btn" id="btnColorsBox">
            <button type="button" id="btnColor"><span><i class="iconFt_ft-color"></i></span></button>
            <div class="__font_color_wrap">
                <button type="button" class="__font_color" data-color="#3c3e40" style="background-color:#3c3e40;"></button>
                <button type="button" class="__font_color" data-color="#888888" style="background-color:#888888;"></button>
                <button type="button" class="__font_color" data-color="#50a1c3" style="background-color:#50a1c3;"></button>
                <button type="button" class="__font_color" data-color="#e68849" style="background-color:#e68849;"></button>
                <button type="button" class="__font_color" data-color="#569e72" style="background-color:#569e72;"></button>
                <button type="button" class="__font_color" data-color="#a97857" style="background-color:#a97857;"></button>
            </div>
        </div>
        <div class="ew_f_btn"><button type="button" id="btnTxtUnderline"><span><i class="iconFt_ft-decoration"></i></span></button></div>
        <div class="ew_f_btn"><button type="button" id="btnTxtTit"><span><i class="iconFt_txt-tit"></i></span></button></div>
        <div class="ew_f_btn"><button type="button" id="btnTxtHead"><span><i class="iconFt_txt-head"></i></span></button></div>
        <div class="ew_f_btn"><button type="button" id="btnTxtUnordered"><span><i class="iconFt_Text_icon06"></i></span></button></div>
        <div class="ew_f_btn"><button type="button" id="btnTxtOrdered"><span><i class="iconFt_Text_icon07"></i></span></button></div>
    </div>

    
    <div class="editorWriter_box" id="editorWriterBox">
        <div id="editorWriter" contenteditable="true">
            <b>텍스트를 굵게 표시합니다.</b>
            <br><br>
            <u>텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다. 텍스트를 강조합니다.</u>
            <br><br>

            <h2>
                서브타이틀 들어갑니다. 서브타이틀 들어갑니다.
            </h2>
            
            <br><br>
            <h1>중간 헤드라인을 표시합니다.</h1>

            <br><br>
            <blockquote>
                인용문을 표시합니다. 인용문을 표시합니다. 인용문을 표시합니다. 인용문
                을 표시합니다. 인용문을 표시합니다. 인용문을 표시합니다.
            </blockquote>


            <br><br>
            <ul>
                <li>리스트(점) 입니다.</li>
                <li>리스트(점) 입니다.</li>
            </ul>
            <br><br>
            <ol>
                <li>리스트(숫자) 입니다.</li>
                <li>리스트(숫자) 입니다.</li>
                <li>리스트(숫자) 입니다.</li>
            </ol>

            <br><br>
            <figure>
                <img src="http://placehold.it/400x400/eeeeee/?text=(1 : 1)" alt="이미지설명">
                <figcaption>[사진_사진의 제목이 들어갑니다.]</figcaption>
            </figure>

            <br><br>
            <a href="#">링크를 삽입합니다.</a>

            <br><br>
            <div>[동영상_유튜브 URL의 v값이 들어갑니다.]</div>

            <br><br>
            <div class="editor_box">
                <h3>일반박스의 제목입니다.</h3>
                <p>일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다. 일반박스의 내용이 들어갑니다.</p>
            </div>


            <br><br>
            <div class="editor_q">

            </div>
            <div class="editor_a">

            </div>

            <hr>




        </div>
    </div>
</div>


<script>

    var editor           = document.querySelector('#editorWriter'); 
    var editorBox        = document.querySelector('#editorWriterBox'); 
    var floatingBtns     = document.querySelector('#floatingBtns'); 

    //text btns
    var btnTxtBold       = document.querySelector('#btnTxtBold');       //굵기
    var btnTxtUnderline  = document.querySelector('#btnTxtUnderline');  //언더라인
    var btnColor         = document.querySelector('#btnColor');         //컬러 버튼 show, hide
    var btnTxtColors     = document.querySelectorAll('.__font_color');  //컬러 변경 
    var btnTxtTit        = document.querySelector('#btnTxtTit');        //서브타이틀
    var btnTxtHead       = document.querySelector('#btnTxtHead');       //중간헤드라인
    var btnTxtUnordered  = document.querySelector('#btnTxtUnordered');  //ul
    var btnTxtOrdered    = document.querySelector('#btnTxtOrdered');    //ol

    //editor btns
    var btnMenuText      = document.querySelector('#btnMenuText');      //text btns 활성화버튼
    var btnMenuGallery   = document.querySelector('#btnMenuGallery');   //사진
    var btnMenuLink      = document.querySelector('#btnMenuLink');      //링크
    var btnMenuPlayer    = document.querySelector('#btnMenuPlayer');    //동영상(유튜브)
    var btnMenuQuotes    = document.querySelector('#btnMenuQuotes');    //따옴표
    var btnMenuLine      = document.querySelector('#btnMenuLine');      //리인
    var btnMenuMemo      = document.querySelector('#btnMenuMemo');      //인용
    var btnMenuQ         = document.querySelector('#btnMenuQ');         //질문
    var btnMenuA         = document.querySelector('#btnMenuA');         //답변
    var btnMenuF         = document.querySelector('#btnMenuF');         //페이스북

    
    var focusEd = false;

    
    editorBox.addEventListener('click', function (e) {
        if(!focusEd) focusEd = true;
        if(!btnMenuText.classList.contains('act')){
            floatingBtns.style.display   = 'none';
        }
    });

    editorBox.addEventListener('contextmenu', function (e) {
        e.preventDefault();
        if(!focusEd) return false;

        if(btnMenuText.classList.contains('act')){
            btnMenuText.classList.remove('act');
        }
        var endX = e.clientX;
        var endY = e.clientY;
        var showIs = false;

        var x2 = editorBox.getBoundingClientRect().left;
        var y2 = editorBox.getBoundingClientRect().top;

        floatingBtns.style.left      = endX - x2+'px';
        floatingBtns.style.top       = endY - (y2 -20)  +'px';
        floatingBtns.style.transform = 'translate(-50%)';
        floatingBtns.style.display   = 'block';

    });

   
    btnMenuText.addEventListener('click', function () {
        var _el = this;
        if(_el.classList.contains('act')){
            _el.classList.remove('act');
            floatingBtns.style.display = 'none';
        }else{
            _el.classList.add('act');
            floatingBtns.style.left    = '0px';
            floatingBtns.style.top     = '0px';
            floatingBtns.style.transform = 'translate(0%)';
            floatingBtns.style.display   = 'block';
        }
    });

    btnMenuLine.addEventListener('click', function () {
        if(!focusEd) return false;
         document.execCommand('insertHorizontalRule');
         focusEditor();
    });




   
    btnTxtBold.addEventListener('click', function () {
        if(!focusEd) return false;
        document.execCommand('bold');
        focusEditor();
    });
  
    btnTxtUnderline.addEventListener('click', function () {
        if(!focusEd) return false;
        document.execCommand('underline');
        focusEditor();
    });
    btnTxtHead.addEventListener('click', function () {
        if(!focusEd) return false;

        removeUlOl();
        formatBlockToggle('h1');
        focusEditor();
    });
    btnTxtTit.addEventListener('click', function () {
        if(!focusEd) return false;

        removeUlOl();
        formatBlockToggle('h2');
        focusEditor();
    });
    btnTxtOrdered.addEventListener('click', function () {
        if(!focusEd) return false;

        removeHeading();
        document.execCommand('insertOrderedList');

        focusEditor();
    });
    btnTxtUnordered.addEventListener('click', function () {
        if(!focusEd) return false;

        removeHeading();
        document.execCommand('insertUnorderedList');

        focusEditor();
    });

    btnColor.addEventListener('click', function () {
        if(!focusEd) return false;
        var btnColorsBox = document.querySelector('.__font_color_wrap');

        if(btnColorsBox.classList.contains('act')){
            btnColorsBox.classList.remove('act');
            btnColorsBox.style.display = 'none';
        }else{
            btnColorsBox.classList.add('act');
            btnColorsBox.style.display   = 'block';
        }
        focusEditor();
    });
    btnTxtColors.forEach(function(el){
        el.addEventListener('click', function () {
            console.log(el.getAttribute('data-color'));
            document.execCommand('styleWithCSS', false, true);
            document.execCommand('foreColor', false,  el.getAttribute('data-color'));
            focusEditor();
        });
    })

    function removeUlOl(){
        if(hasParents('ol')){
            document.execCommand('insertOrderedList');
        }
        if(hasParents('ul')){
            document.execCommand('insertUnorderedList');
        }
    }

    function removeHeading(){
        if(hasParents('h1')){
            document.execCommand('formatBlock', false, 'div');
        }
        if(hasParents('h2')){
            document.execCommand('formatBlock', false, 'div');
        }
    }

    function formatBlockToggle(tag) { 
        var elSele = window.getSelection().focusNode.parentNode;
        var elWrap = elSele.closest("#editorWriter " + tag);
        console.log(elWrap);
        
        if(elWrap){
            document.execCommand('formatBlock', false, 'div');
        }else{
            document.execCommand('formatBlock', false, tag);
        }
    }
    function unwrap(el ){

        var parent = el.parentNode;

        while (el.firstChild) parent.insertBefore(el.firstChild, el);

        parent.removeChild(el);
    }

    function hasParents(tag) { 
        var elSele = window.getSelection().focusNode.parentNode;
        var elWrap = elSele.closest("#editorWriter " + tag);

        if(elWrap){
            return true;
        }else{
            return false;
        }
    }

    function focusEditor() { 
        //editor.focus({preventScroll: true});
    }






</script>