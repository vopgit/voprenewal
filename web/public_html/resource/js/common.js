//forEach script
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}

(function (arr) {
arr.forEach(function (item) {
    if (item.hasOwnProperty('after')) {
    return;
    }
    Object.defineProperty(item, 'after', {
    configurable: true,
    enumerable: true,
    writable: true,
    value: function after() {
        var argArr = Array.prototype.slice.call(arguments),
        docFrag = document.createDocumentFragment();

        argArr.forEach(function (argItem) {
        var isNode = argItem instanceof Node;
        docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
        });

        this.parentNode.insertBefore(docFrag, this.nextElementSibling);
    }
    });
});
})([Element.prototype, CharacterData.prototype, DocumentType.prototype]);


var agent = navigator.userAgent.toLowerCase();
var isIe = false;
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

var responsive = {
    'pcOnly'  : window.matchMedia("(min-width: 1025px)").matches,
    'tabOnly' : window.matchMedia("(min-width: 801px) and (max-width: 1024px)").matches,
    'tab'     : window.matchMedia("(max-width: 1280px)").matches,
    'tabS'    : window.matchMedia("(max-width: 1024px)").matches,
    'mob'     : window.matchMedia("(max-width: 800px)").matches
}


if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
    isIe = true;
}

// Mobile
if(isMobile && !isIe){
    function vhMax (){
        var vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', vh + 'px');
    }
    vhMax();
}


function noImage(el) {
    //el.src='/resource/images/common/no_img.svg';
    //el.alt='이미지 없음';
    el.src='/resource/images/no_image.jpg';
    el.alt='이미지 없음';
}


function noDataImage(el) {
    //el.src='/resource/images/common/logo_on.png';
    //el.alt='이미지 없음';
}

function getParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



$(document).ready(function() {
   
	//상단전체검색
	$('.header_search_button').on('click', function(){
		var q = $('#header_search_input').val().trim();
		if(q == ""){
			alert("검색어를 입력해 주세요");
			$('#header_search_input').focus();
			return false;
		} 
		if(q.length < 2){
			alert("검색어를 2자 이상 입력해 주세요");
			$('#header_search_input').focus();
			return false;
		}
		location.href = '/search?search_q='+encodeURIComponent(q);
	});

	$('#header_search_input').keypress(function(e){
		if(e.keyCode == 13){
			$('.header_search_button').click();	
		}
	})
		
});
