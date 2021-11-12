var viewScroller;
var viewHeaderH = 0;
var viewLastScrollTop = 0;


$(function(){
    view.init();
});

$(document).ready(function () {
     var clipboard  = new Clipboard('.act_copyLink');
     clipboard.on( 'success', function() {
        alert('주소가 복사되었습니다.');
      })
      .on( 'error', function() {
          alert('주소가 복사가 실패했습니다.');
      });
});

var view = {

    init : function(){
        if($('#container').hasClass('view_container')){
            $('.view_top_share_box > button').on('click', this.shereEvt);
            view.scroll();
            if(!isMobile){
                view.resize();
            }
        }
    },
    scroll : function(){
        viewHeaderH = document.querySelector('.view_top').offsetHeight;
        viewHeaderH2 = document.querySelector('.view_top').clientHeight ;
      
        document.addEventListener("scroll", scrollEvt);
        function scrollEvt() {
                var currentPos = document.documentElement.scrollTop;
                if(currentPos > viewHeaderH ) {
                    document.querySelector('.view_top').style.height = viewHeaderH + 'px';
                    $(".view_top:not(._fixed)").addClass('_fixed');
                    $(".header:not(._fixed)").addClass('_fixed');
                }else{
                    $(".view_top._fixed").removeClass('_fixed').css('height', 'auto');
                    $(".header._fixed").removeClass('_fixed');
                }
                viewLastScrollTop = currentPos;
        }
        scrollEvt();
    },
    resize : function(){
        var timer,
            resizeDone = function(){
                viewHeaderH = $(".view_top").height();
            };
        window.addEventListener("resize", function(){
            clearTimeout( timer );
            timer = setTimeout( resizeDone, 150 );
        });
    },
    shereEvt :function(){
        $(this).next('ul').toggle();
    }
}
