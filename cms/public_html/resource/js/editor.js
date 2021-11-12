var agent = navigator.userAgent.toLowerCase(); 
if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) { 
	alert('Internet Explorer에서 지원되지 않는 기능이 있습니다.\n엣지브라우져 또는 크롬브라우져를 이용해 주세요.') 
}




var editerAni = {
    init : function(){

        this.editorWriter   = document.querySelector('.editor_writer');
        this.floatingBtns   = document.querySelector('.ew_m_btn_box');
        this.floatingBtns2  = document.querySelector('.ew_f_btn_box');

        this.scrollEvt();
        this.btnText();
    },

    scrollEvt : function(){

        var _editorWriter   = this.editorWriter;
        var _floatingBtns   = this.floatingBtns;
        var _floatingBtns2  = this.floatingBtns2;

        var fixedIs         = false;
        var st              = window.scrollY || window.pageYOffset ;
        var l               = Math.floor(_editorWriter.getBoundingClientRect().left) + 1;
        var fbw             = _floatingBtns.offsetWidth;
        var editorWriterT   = editorWriter.getBoundingClientRect().top + st;


        function fixedScroll(){
            editorWriterT   = editorWriter.getBoundingClientRect().top + st;
            st              = window.scrollY || window.pageYOffset ;
                
            if(st >= editorWriterT){
                _floatingBtns.classList.add('fixed');
                _floatingBtns2.classList.add('fixed');

                _floatingBtns.style.left  = l - fbw  + 'px';
                _floatingBtns2.style.left = l + 'px';
                fixedIs = true;
            }else{
                _floatingBtns.classList.remove('fixed');
                _floatingBtns2.classList.remove('fixed');
                _floatingBtns.style.left  = fbw * -1 + 'px';
                _floatingBtns2.style.left = '0px';
                fixedIs = false;
            }
        }

        window.addEventListener('scroll', fixedScroll);

        var delta = 200; 
        var timer = null;

        function resizeDone( ) { 
            l               = Math.floor(_editorWriter.getBoundingClientRect().left) + 1;
            fbw             = _floatingBtns.offsetWidth;
            st              = window.scrollY || window.pageYOffset ;
            editorWriterT   = editorWriter.getBoundingClientRect().top + st;
            
            fixedScroll();
        }
       
        window.addEventListener( 'resize', function( ) { 
            clearTimeout( timer ); 
            timer = setTimeout( resizeDone, delta ); 
        }, false );
    }, 
    btnText: function(){
        var _floatingBtns2  = this.floatingBtns2;

        var btnMenuText     = document.querySelector('#btnMenuText');
            btnMenuText.addEventListener('click', function(){
                var _el = this;
                if(_el.classList.contains('act')){
                    _el.classList.remove('act');
                    _floatingBtns2.style.display = 'none';
                }else{
                    _el.classList.add('act');
                    _floatingBtns2.style.top       = '0px';
                    _floatingBtns2.style.transform = 'translate(0%)';
                    _floatingBtns2.style.display   = 'block';
                }
            });
    }
}


$(function(){
	 
	 var btnAreafocus = 0; 

	 /*
	 $('#editorWriter, .btnAreaEditor').bind('focus', function(event){ 
		if($('.btm_fix_box').is(':visible')){
			$('.btnAreaEditor').css({'width':$('#editorWrap').width()},{'bottom':$('.btm_fix_box').height()+'px'});
		}else{
			$('.btnAreaEditor').css({'width':$('#editorWrap').width()},{'bottom':'0px'});
		}
		$('.btnAreaEditor').show();
	 });

	 $('#editorWriter').bind('blur', function(event){ 
		if(btnAreafocus < 1) $('.btnAreaEditor').hide();
	 });
	 */

	 $('.btnAreaEditor').on('mouseover', function(){ 
		btnAreafocus = 1;
	 });
	  $('.btnAreaEditor').on('mouseleave', function(){ 
		btnAreafocus = 0;
	 });

	 $('div[contenteditable]').keydown(function(e) {
		
		if (e.keyCode === 13) {        
		   //e.preventDefault();
		   //document.execCommand('insertHTML', false, '<br>');
           //return false;
		}
	});


	
	var ele = document.querySelector('#editorWriter');
	if(eval(ele)){
		ele.addEventListener('paste', function(event) {
			event.preventDefault();
			var pastedData = event.clipboardData ||  window.clipboardData;
			var textData = pastedData.getData('Text');
			textData = strip_tags(textData);
			textData = textData.replace(/\r\n/gi, '<br>'); 
			window.document.execCommand('insertHTML', false,  textData);
		});
	}

	$('.__font_color').on('click', function(){
		var color = $(this).data('color');
		if(color != ''){
			formatDoc('foreColor', color);
			$(this).parent().hide();
		}
	});
	
	//upload form appent
	var uploadFromHtml = '<form name="frmUpload" id="frmUpload" method="POST" enctype="multipart/form-data" style="display:none">';
	uploadFromHtml += 	'<input type="file" name="upfile" id="upfile" accept=".gif, .png, .jpg, .jepg">';
	uploadFromHtml +=   '</form>';
	$('body').append(uploadFromHtml);
});


function changeFont(size) {
    document.execCommand("fontSize", false, 3);
    var fontElements = window.getSelection().anchorNode.parentNode
    fontElements.removeAttribute("size");	
	fontElements.style.fontSize = size + "px";
}

var defaultFontSize = 3;

// 에디터 스타일
function formatDoc(sCmd, opt){	

	//$('#editorWriter').focus();
	var obj = $('#'+sCmd);

	if(sCmd == 'backColor'){
		sValue = opt;
	}else if(sCmd == 'foreColor'){
		sValue = opt;	
	}else if(sCmd == 'blockquote'){
		var data = { "content" : "내용" };
		setEditorHtml('blockquote', JSON.stringify(data));
	}else if(sCmd == 'formatblock'){		
		sValue = opt;
	}else if(sCmd == 'hr'){		
		document.execCommand('insertHTML', false, '<hr>');
		return;
	
	}else if(sCmd == 'createLink'){		

		var url = prompt('URL을 입력해 주세요', 'http://');
		var selection = document.getSelection();

		if (selection.rangeCount < 1) return false;
		var range = selection.getRangeAt(0);
		if (range.collapsed) return false;

		//console.log(selection);
		if(url !== null){
			document.execCommand('createLink', true, url);
			selection.anchorNode.parentElement.target = '_blank';	
		}
		return;
	
	}else{
		var sValue =  false;
	}

	document.execCommand(sCmd, false, sValue);
	
	getContetHtml();

	//console.log(sCmd);
		
}

function setEditorHtml(obj, html){

	data = JSON.parse(html);
	$('#editorWriter').focus();

	if(obj == "link"){
		var selection = document.getSelection();
		if (selection.rangeCount < 1) return false;
		var range = selection.getRangeAt(0);
		if (range.collapsed) return false;
		document.execCommand('createLink', true, data.link);
		if(data.target == "_blank"){
			selection.anchorNode.parentElement.target = '_blank';	
		}
		act_popup_close();
	}else if(obj == "blockquote"){
		var str = '<div class="editor_blockquote"><p>'+nl2br(strip_tags(data.content))+'</p></div><br>';
		//document.execCommand('insertHTML', false, str);
		pasteHtmlAtCaret(str);
		act_popup_close();
	}else if(obj == "youtube"){
		var str = "[유튜브:" + data.id + '/설명:' + removeBr(strip_tags(data.title)) + ']<br>';		
		//document.execCommand('insertHTML', false, str);
		pasteHtmlAtCaret(str);
		act_popup_close();
	}else if(obj == "box"){
		var str = '<div class="editor_box"><h3>'+nl2br(strip_tags(data.title))+'</h3><p>'+nl2br(strip_tags(data.content))+'</p></div><br>';
		//document.execCommand('insertHTML', false, str);
		pasteHtmlAtCaret(str);
	 	act_popup_close();
	}else if(obj == "question"){
		var str = '<div class="editor_q"><p>'+nl2br(strip_tags(data.content))+'</p></div><br>';
		//document.execCommand('insertHTML', false, str);
		pasteHtmlAtCaret(str);
	 	act_popup_close();
     }else if(obj == "answer"){
		var str = '<div class="editor_a"><p>'+nl2br(strip_tags(data.content))+'</p></div><br>';
		//document.execCommand('insertHTML', false, str);
		pasteHtmlAtCaret(str);
		act_popup_close();
	 }else if(obj == "embed"){
		var str = '<div>'+data.content+'</div><br><br>';
		//document.execCommand('insertHTML', false, str);		
		pasteHtmlAtCaret(str);
		act_popup_close();
	 }else if(obj == "photo"){
		//[사진:P00001599999/설명:포토뉴스 테스터]
		var str = '<div>[사진:'+data.code;
		if(data.title != '') str = str + '/설명:'+data.title;
		if(data.author != '') str = str + '/저작권:'+data.author;
		str = str + ']';
		//document.execCommand('insertHTML', false, str);		
		pasteHtmlAtCaret(str);
		act_popup_close();
	 }

	//getContetHtml();
	$('#editorWriter').click();
	return;

}

function nl2br(str){
	return str.replace(/\n/gi, '<br>');  // '/\r\n/gi' 아님 주의!
}
function removeBr(str){
	str = str.replace(/\n/gi, '');  // '/\r\n/gi' 아님 주의!	
	str = str.replace(/<br>/gi, '');
	return str
}

function getContetHtml(){
	var html = $('#editorWriter').html().trim();
	$('#contents').html(html);
}

function showHtmlSource(){
	var html = $('#editorWriter').html().trim().replace(/<br>/gi, '\n');
	$('#source').html(html);
	$('#tabBox').show();
}
function setHtmlSource(){	
	var html = $('#source').val().trim().replace(/\n/gi, '<br>');  // '/\r\n/gi' 아님 주의!
	$('#editorWriter').html(html);
	$('#source').html('');
	$('#tabBox').hide();	
}

$(document).ready(function() {	
	//if($('#editorWriter').html() == "") $('#editorWriter').html('<br>'); //글이 없는 경우 focus시 커서를 나타내기 위해


});

function pasteHtmlAtCaret(html) {
    var sel, range;
	var selectPastedContent = true;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            var firstNode = frag.firstChild;
            range.insertNode(frag);
            
            // Preserve the selection
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                range.collapse(true);
                sel.removeAllRanges();
                sel.addRange(range);	
            }
        }
    } else if (document.selection && document.selection.type != "Control") {
        // IE < 9
        document.selection.createRange().pasteHTML(html);
    }
}

function getSelectionHtml() {
    var html = "";
    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }

	//console.log(sel);

	
	/*
	range = sel.getRangeAt(0);
    range.deleteContents();
	var el = document.createElement("h1");
    el.innerHTML = html;
	sel.createRange().pasteHTML(html);
	*/
	//console.log(html);
    return html;
}

//선택영역 HTML 제거
function removeSectionHtml(){
	var html = "";
    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();		
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }

			//console.log(range.commonAncestorContainer());

			html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }

	if(html != ''){
		range = sel.getRangeAt(0);
		var container = sel.anchorNode; 
		//var tag = container.parentElement;
		console.log('tagname:'+ container.parentNode.tagName);

		if(container.parentNode.tagName == 'A' || container.parentNode.tagName == 'H1' || container.parentNode.tagName == 'H2'){
			container.parentNode.remove();
		}else if(container.parentNode.tagName == 'P' || container.parentNode.tagName == 'LI'){
			container.parentNode.parentNode.remove();
		}
		//range.deleteContents();
		document.execCommand("insertHTML", false, strip_tags(html));
	}
}


 //허용태그 : allowed , '<i><b>'
function strip_tags(input, allowed) { 
	allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); 
	var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi ,
		commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
	return input.replace(commentsAndPhpTags, '')
				.replace(tags, function ($0, $1) {return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';});
}

function editorCommand(cmd){
	//event.preventEvent();
	//$('#editorWriter').focus();
	var obj = $('#'+cmd);
	if(cmd == 'fontsize'){
		if(obj.attr('class').match('on')==null) var sValue = '20px';
		else var sValue =  '14px';
		return false;
	}else{
		var sValue =  false;
	}
	//obj.toggleClass('on');	
} 

var execFontSize = function (size, unit) {
    var spanString = $('<span/>', {
        'text': document.getSelection()
    }).css('font-size', size + unit).prop('outerHTML');

    document.execCommand('insertHTML', false, spanString);
};


function js_get_editor_html(obj){	
	var brText = $('#editorWriter').html().replace(/\n/gi, '<br>');  // '/\r\n/gi' 아님 주의!
	//var brText = $('#editorWriter').html();
	//console.log(brText);
	$('#'+obj).html(brText);
}

function js_open_photo_list(){
	var url = '/photo/pop';
	$('#popup_iframe').attr('src',url);
	$('#popup_iframe').stop().fadeIn().css('visibility','visible');
	$('body,html').css('overflow','hidden');
}