var agent = navigator.userAgent.toLowerCase();
var isIe = false;
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
    isIe = true;
}
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;

        do {
        if (el.matches(s)) return el;
        el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}

$(document).ready(function(){
    act_file.init();
    table.init();
    act_gnb();
    tableHover();
    act_onClass($('.depth_1.on'));
    act_popload('#popup_iframe');

	scrollTable();
	boardChklist();
    $('#popup_iframe').wrap('<div class="ifr_prWrap" > </div>');
   
	$('.ifr_prWrap').hide();
});



window.addEventListener('load', function() {
    var $is_pick = ['.pick_ch','.board_chk'];
    $(document).on('change','.all_ch', function(e) {
        var $all_ch = $(this);
        var $pick_ch, $pick_name;
        var $wrap = $all_ch.closest('table');
        if($wrap.find($is_pick[0]).length > 0) {
            $pick_ch = $wrap.find($is_pick[0]);
            $pick_name = $is_pick[0];
        }else if($wrap.find($is_pick[1]).length > 0) {
            $pick_ch = $wrap.find($is_pick[1]);
            $pick_name = $is_pick[1];
        }
        $(this).is(':checked') ?  $pick_ch.prop('checked',true) :  $pick_ch.prop('checked', false);


    })
    $(document).on('change','.pick_ch, .board_chk',function() {

        var $pick_ch, $pick_name;
        var $wrap = $(this).closest('table');
        var $all_ch = $wrap.find('.all_ch');
        if($wrap.find($is_pick[0]).length > 0) {
            $pick_ch = $wrap.find($is_pick[0]);
            $pick_name = $is_pick[0];
        }else if($wrap.find($is_pick[1]).length > 0) {
            $pick_ch = $wrap.find($is_pick[1]);
            $pick_name = $is_pick[1];
        }
        var chLangth = $pick_ch.length;
        var pickLangth = $($pick_name+':checked').length;
        chLangth == pickLangth  ?  $all_ch.prop('checked',true) :  $all_ch.prop('checked', false);
    })
});
var timer;
var delta = 300;
var act_file = {
    init : function () {
        var $_this = this;
        $fileBox = $('.file_box');
        $fileBox.each(function (num,obj){
            var createBtn = '<div class="create_box ">'
            +'<a  href="javascript:void(0);" class="btn  btn_sm add_btn" onclick="act_file.createVar(this);">추가</a>'
            +'<a  href="javascript:void(0);" class="btn btn_c6 btn_sm remove_btn" onclick="act_file.createVar(this)">삭제</a>'
            +'</div>';
            $_this.act_click(obj);
            if ($(obj).hasClass('create') == true && $(obj).closest('.custom').length < 1) {
                if($(this).closest('.edit').length >= 1) return true;
                if($(this).closest('.file_contents').length < 1) {
                    $(obj).wrapAll('<div class="file_contents"></div>');
                }
                if(!$(obj).next().hasClass('create_box')) {
                    obj.insertAdjacentHTML('beforeend', createBtn);
                }
                // $('.remove_btn').hide();
            }

        })
    },
    act_click : function (obj,click){
        var   $_this = this;
        var   $fileBtn = $(obj).find('.btn.file');
        $fileBtn.off('click').click(function(e){
            var  $fileInput =  $(this).siblings('input[type=file]');
            $_this.act_change($fileInput);
            $fileInput.trigger('click') ;
        });

    },
    act_change : function ($fileInput) {
        $fileInput.off('change').on('change', function (){

			//첨부파일 용량 제한
			if($(this).closest('.poto_con').length >= 1 || $(this).closest('.td_thumb').length >= 1) {
                var maxSize  = 10 * 1024 * 1024;    //10MB
				if($(this)[0].files[0].size > maxSize){
					alert('파일 용량을 10MB이내로 등록하여 주세요');
					return false;
				}
			}else{
				 var maxSize  = 30 * 1024 * 1024;    //30MB
				 if($(this)[0].files[0].size > maxSize){
					alert('파일 용량을 30MB이내로 등록하여 주세요');
					return false;
				}
			}

			var  $fileText =  $(this).siblings('.file_name');
            var  fileVal = $(this).val().toLowerCase();
            var  fext = fileVal.split('\\')[fileVal.split('\\').length - 1].toLowerCase();

			$fileText.text(fext).attr('title',fext);

            if($(this).closest('.poto_con').length >= 1 || $(this).closest('.td_thumb').length >= 1) {
				profileImageChk($fileInput);
            }
        })
    }, createVar : function (btn){
        var obj = $(btn).closest('.file_box');
        var fileContents = $(btn).closest('.file_contents');
        var fileClone =  obj.clone();
        var fileBox = fileContents.find('.file_box');
        var fileLenght = fileBox.length;

      if( $(btn).hasClass('add_btn') == true){

        if (fileLenght > 4 ){
            alert('첨부 파일은 최대 5개 까지 입니다.');
            return false;
        }
        fileLenght= fileLenght + 1;
        $(fileClone).find('input[type=file]').val('');
        $(fileClone).find('.file_name').text('');
        fileContents.append(fileClone);

        this.act_click(fileClone,fileContents);

      }else{
        fileLenght =   fileLenght - 1;
        if(fileLenght < 2){
            $(fileContents).find('.add_btn').show();
            obj.remove();
            return ;
        }
        obj.remove();

      }

      // $(fileContents).find('.remove_btn').show();
      // $(fileContents).find('.remove_btn').eq(0).hide();
    }
}

function act_checkBox(all_ch,name){

}

function profileImageChk(_file) {
    var that = _file[0];
    var fileName;

    var file = _file[0].files;
    fileName = file[0].name;
    var typeChk = /\.(png|jpg|jpeg|bmp|gif)/;
    if (!typeChk.test(fileName)) {
        that.type = 'radio';
        that.type = 'file';
        that.value = '';
        $(that).siblings('.file_name').text('');
        return alert('이미지 파일을 첨부해 주세요.');
    }

    // 파일을 읽기 위한 FileReader 생성
    var reader = new FileReader();
    // 파일을 읽으면 실행
    reader.onload = function (e) {
        // image 객체 생성
        var img;
        if($(that).closest('.td_thumb').length < 1) {
            img = $(that).closest('.poto_con').find('.add_img img');
        }else {
            img = $(that).closest('.td_thumb').find('.thumb img');
        };
        img[0].src = e.target.result;
    }

    reader.readAsDataURL(that.files[0]);
};


function act_gnb(){
    var $depth_1 = $('.depth_1');
    var $onClass_1 = $('.depth_1.on');
    var $onClass_2 = $onClass_1.find('.depth_2 li.on');

        $depth_1.mouseenter(function (){
            $onClass_2.addClass('act_on');
            $onClass_1.removeClass('on act_on');
            $(this).addClass('act_on');
            $('.header').addClass('act_on');


        })
        $depth_1.mouseleave(function (){
            $(this).removeClass('act_on');

            $onClass_1.addClass('on act_on');
            $onClass_2.addClass('on act_on');

            clearTimeout(timer);
            timer = setTimeout(function(){
                act_onClass($(this));
            }, delta);

        });

}

function act_onClass (onClass){
    if($(onClass).hasClass('on')){
         onClass.addClass('act_on on');
        $('.header').addClass('act_on on');
    }else{
        onClass.removeClass('act_on');
        $('.header').removeClass('on');
    }
}


var table = {
    init : function(){
        this.width();
    },
    width:function(el){
        var tables = el || document.querySelectorAll('table');
        tables.forEach(function(table){
            var cols     = table.querySelectorAll('col');
            var tableW = table.offsetWidth;
            cols.forEach(function(col){
                var colW        = col.getAttribute('data-col-width') || 0;
                if(!isNaN(colW) && colW > 0){
                    col.style.width = (colW/tableW * 100) + '%';
                }
            })
        })
    }
}

//내가입력한 사진 event
var photoBox = {
    simpleEvt : function(btn, elName){
        var photoBox = document.querySelector(elName) || document.querySelector('.eadit_photo_box');
        var btns     = btn.parentElement.querySelectorAll('button');

        if(!photoBox.classList.contains('simple')){
            photoBox.classList.add('simple');
            btns.forEach(function(button){
                button.classList.remove('on')
            });
            btn.classList.add('on');
        }
    },
    detailEvt : function(btn, elName){
        var photoBox = document.querySelector(elName) || document.querySelector('.eadit_photo_box');
        var btns     = btn.parentElement.querySelectorAll('button');
        if(photoBox.classList.contains('simple')){
            photoBox.classList.remove('simple')
            btns.forEach(function(button){
                button.classList.remove('on')
            });
            btn.classList.add('on');
        }
    }
}

//시리얼 넘버
function serial_drop(wrp) {
    $(wrp).sortable({
        placeholder: "ui-sortable-placeholder",
    });
    $( ".number_item" ).disableSelection().find('.num_close').click(function (e){
        $(this).closest('li').remove();
		return false;
    })
}


function tableHover(){
    var $table_box = $('.table_box');
    $table_box.find('.act_tc3').mouseenter(function (){
        $(this).addClass('hover');
        $(this).siblings('.act_tc3').addClass('hover');
    }).mouseleave(function (){
        $('.act_tc3').removeClass('hover')

    })

}


// Node 추가
// 추가되는 기준점에 lst_item class 추가해 주세요.
// resetForm 은 input:file제외 초기화 됩니다.
function createNextNode() {
    var t = $(event.target);
    var clone = t.closest('.lst_item').clone()[0];
    var v_form = document.createElement('form');
    v_form.name = 'v_form';
    v_form.appendChild(clone);
    resetForm(v_form);
    t.closest('.lst_item').after(v_form.childNodes[0]);
}
function moveNode(_direct) {
    var direction = _direct;
    var par = $(event.target).closest('.lst_item');
    console.log(par);
    if(_direct == 'up') {
        par.prev().before(par);
    }else {
        par.next().after(par);
    }
}
function resetForm(_frm) {
    var fm = _frm;
    $(fm).find('input').each(function(idx, el) {
        $(this).removeAttr('value','').val('');
    })
    $(fm).find('radio:checked').each(function(idx, el) {
        $(this).prop(':checked',false);
    })
    $(fm).find('checkbox:checked').each(function(idx, el) {
        $(this).prop(':checked',false);
    })
    $(fm).find('.file_name').each(function(idx, el) {
        $(this).text('');
    })
    return fm;
}

// 게시판 리스트 checkbox 선택에 따른 tr 배경색 변경
function boardChklist() {
    if($('.board_chk').length < 1) return;
    $('.board_chk').on('change', function(e) {
        if($(this).is(':checked')) {
            $(this).closest('tr').addClass('__chk');
        }else {
            $(this).closest('tr').removeClass('__chk');
        }
    })
}


//popup

function act_popup(e){

	if($(e).data('url') == "link"){
		var selection = document.getSelection();
		if (selection.rangeCount < 1) {
			alert('영역을 먼저 지정하여 주세요');
			return false;
		}
		var range = selection.getRangeAt(0);
		if (range.collapsed){
			alert('영역을 먼저 지정하여 주세요');
			return false;
		}
	}

    var url = '/include/popup/' + $(e).data('url') + '.php';
    $('#popup_iframe').attr('src',url);
    // $('#popup_iframe').stop().fadeIn().css('visibility','visible');
    $('.ifr_prWrap').fadeIn().css('visibility','visible');
    $('body,html').css('overflow','hidden');
}

function act_popup_close(){
    $('#popup_iframe').hide();
    $('body,html').css('overflow','');
}

function act_popload(iframe) {
    $(iframe).on('load',function(){

        $(iframe).contents().find('.pop_close,.popbg').click(function() {
            $(iframe).closest('.ifr_prWrap').stop().fadeOut(300, function() {
                $(iframe).closest('.ifr_prWrap').css('visibility','hidden');
                $(iframe).attr('src','');
                $('body,html').removeAttr( 'style' );
            });
        });
    });
}



//scroll talbe

function scrollTable(){
    if($('.table_box').hasClass('scroll') ){
        var tableWidth = $('.table_box').data('scroll-width');
        $('.table_box').find('table').css('width',tableWidth+'px');
    }
}


function ranking(){
    var newPop = window.open("/resource/images/ranking.jpg");
    newPop.document.body.style.textAlign = 'center';
}



// 메인섹션관리 박스 순서 변경

// 박스 이동
function moveSectionBoxs() {
    var tg = $(event.target);
    var direct = tg.attr('class').indexOf('up') != -1 ? 'up' : 'down';
    var tbl = tg.closest('.table_box');
    var sibAry = tbl.parent().find('.table_box:not(".fix")');
    var idx;
    // area_con_box 가 없으면 return;
    if($('.table_box').closest('.area_con_box').length < 1) return;
    idx = sibAry.index(tbl);

    if(idx == 0 && direct == 'up') {
        return alert('최상위 입니다.');
    }else if(idx + 1 == sibAry.length  && direct == 'down') {
        return alert('최하위 입니다.');
    }
    if(direct == 'up') {
        tbl.prev().before(tbl);
    }else {
        tbl.next().after(tbl);
    }
    initNumbering(tbl);
}


// 번호 재할당
function initNumbering(tbl) {
    var par = tbl.closest('.area_con_box');
    var befAry = par.find('.in_multy_radio input[type=radio]:checked');

    //var names = substr(0,$(befAry[0]).attr('name').indexOf('['));
    //console.log(names);
    var idxUp = false;
    if(par.find('.table_box.fix').length >= 1) {
        idxUp = true;
    }
    par.find('.table_box:not(.fix)').each(function(idx, el) {
        if(idxUp) {
            $(this).find('.num_count').text(idx + 2);
        }else {
            $(this).find('.num_count').text(idx + 1);
        }
        var defName = 'fm_rd';
        var getName = $(this).find('.in_multy_radio input[type=radio]').attr('name');
        if(typeof getName != 'undefined') {
            defName = getName.substr(0, getName.indexOf('[') -1)
        }
        $(this).find('.in_multy_radio input[type=radio]').attr('name',defName+''+(idx)+'[]');
    })
    for(var i = 0; i< befAry.length; i++) {
        $(befAry[i]).prop('checked',true);
    }
}




function act_readOnly(){
    $('input[type=radio]').change(function (){
        var actread =  $(this).closest('.poto_box').find('.act_read');
        if($(this).is(':checked') && $(this).hasClass('readChange')) {
            actread.removeClass('read_only').attr('readonly',false);
        }else{
            actread.addClass('read_only').attr('readonly',true).val('');
        }
    })
}

function openPop(name, url){
  window.open(url, name, 'menubar=no, status=no, toolbar=no');
}

function isEmpty(value){
	if( value == "" || value == null || value == undefined || ( value != null && typeof value == "object" && !Object.keys(value).length ) ){
		return true;
	}else{
		return false;
	}
}

//이메일 유효성 체크시 @ 여러개일때도 통과되는 오류발생 (2021.2.16)
function CheckEmail(str){
	if ((str.match(/@/g)).length > 1){
		return false;
	}else{
		var regex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		if((str != '') && (str != 'undefined')){
			return regex.test(str);
		}else{
			return false;
		}
	}
}
