// Mobile
if(isMobile && !isIe){
    function vhMax (){
        var vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', vh + 'px');
    }
    vhMax();
}


var headerH = 0, footerT = 0, windowH = 0,
    lastScrollTop = 0,
    line, line1, line2, amb, ambYoutubeBtn;

var scroll = {
    disable : function(){
        $('body').css('overflow', 'hidden');
    },
    enable : function(){
        $('body').css('overflow', 'visible');
    },
    parentEnable : function(){
        $('body', parent.document).css('overflow', 'visible');
    },
}
var layout = {
    init : function (){
        windowH        = window.innerHeight;
        headerH        = $(".header").height();
        footerT        = document.querySelector('.footer').offsetTop;

        if(!isMobile){

            floatingBox               = $('.floating_box')[0];
            floatingBox.style.opacity = 1;

        }else{

            $('.floating_box').remove();

        }

        //animaition
        /* line           = gsap.to(".header_button_menu svg", 0.3,{scale:0.8, reversed: true}).pause();
        line1          = gsap.to(".header_button_menu .line_1", 0.3,{rotation: 45,   scaleX:1.4, transformOrigin: "50% 50%", x:1, y:-12,reversed: true}).pause().delay(0.3);
        line2          = gsap.to(".header_button_menu .line_2", 0.3,{rotation: -45,  scaleX:1.4, transformOrigin: "50% 50%", x:0, y:1,  reversed: true}).pause().delay(0.3);
        line3          = gsap.to(".header_button_menu .line_3", 0.3,{rotation: -45,  scaleX:0, opacity:0, transformOrigin: "0% 50%", reversed: true}).pause(); */

        amb            = gsap.timeline({reversed: true, onComplete: layout.ambComplete, onReverseComplete: layout.ambReverseComplete})
                             .to(".amb_wrap", {display:'block'})
                             .to(".amb_box", 0.3,{x:'0'}).pause();

        ambYoutubeBtn  = gsap.timeline({reversed: true})
                              .from(".amb_youtube ul", 0.1,{visibility:'hidden'})
                              .from(".amb_youtube ul", 0.1,{zIndex:-1, opacity:0}).pause();

        //event
        $(document).on('click', '.header_button_menu',  layout.evtAllmenu);
        $(document).on('click', '.amb_close_buttton',   layout.evtAllmenuClose);
        $(document).on('click', '.amb_youtube_btn',     layout.evtAmbYoutube);
        $(document).on('click', '.header_button_search',layout.evtSearch);
        $(document).on('click', '.header_search_close', layout.evtSearchClose);

        $(document).on('click', function (event) {
            var $li = $('.amb_box');
            if (!$li.is(event.target) && $li.has(event.target).length === 0) {
                layout.evtAllmenuClose();
            }
        });

        layout.scroll();
        layout.resize();
    },
    ambComplete : function(){
        $('.header'  ).addClass('_openAllmenu');
        $('.amb_wrap').addClass('on');
        $('.header_all_menu').addClass('act');
    },
    ambReverseComplete : function(){
        scroll.enable();

        $('.header'  ).removeClass('_openAllmenu');
        $('.amb_wrap').removeClass('on');
        $('.header_all_menu').removeClass('act');

        if(!ambYoutubeBtn.isActive()) {
            if(!ambYoutubeBtn.reversed()){
                ambYoutubeBtn.reverse();
            }
        }
    },
    resize : function(){

        var timer,
        resizeDone = function(){
            var currentPos  = document.documentElement.scrollTop;

            headerH   = $(".header").height();
            footerT   = document.querySelector('.footer').offsetTop;
            windowH   = window.innerHeight;

            //pc Only
            if(!isMobile){
                layout.scrollFloatingBox(currentPos);
            }
        };

        //event
        window.addEventListener("resize", function(){

            clearTimeout( timer );
            timer     = setTimeout( resizeDone, 150 );
        });
    },
    scroll : function(){
        window.addEventListener("scroll", function() {

            var currentPos  = document.documentElement.scrollTop;

            //header
            if(currentPos > headerH) {

                $(".header:not(._fixed)").addClass('_fixed');

            }else{

                $(".header._fixed").removeClass('_fixed');

            }

            //pc Only
            if(!isMobile){
                layout.scrollFloatingBox(currentPos);
            }


            lastScrollTop = currentPos;
        });
    },
    scrollFloatingBox : function(currentPos){

        var currentPos = currentPos + windowH * 1;
            /* footerT    = $(".footer").offset().top; */
            footerT    = document.querySelector('.footer').offsetTop;

        if(currentPos > footerT) {
            floatingBox.style.transform = 'translateY(' +  Math.floor(currentPos - footerT) * -1 + 'px)';
        }else{
            floatingBox.style.transform = 'none';
        }

    },

    evtAllmenu : function(e){
        e.preventDefault();

        /* if(!line3.isActive()) {
            line3.reversed() ? line3.play() : line3.reverse();
        }
        if(!line2.isActive()) {
            line2.reversed() ? line2.play() : line2.reverse();
        }
        if(!line1.isActive()) {
            line1.reversed() ? line1.play() : line1.reverse();
        }
        if(!line.isActive()) {
            line.reversed() ? line.play() : line.reverse();
        } */
        if(!amb.isActive()) {
            if(amb.reversed()){
                scroll.disable();
                $('.amb_mask').fadeIn(150);
                amb.play();
            }
        }
    },
    evtAllmenuClose:function(){
        if(!amb.isActive()) {
            if(!amb.reversed()){
                amb.reverse();
                $('.amb_mask').fadeOut(300);
            }
        }
    },
    evtAmbYoutube : function(e){
        e.preventDefault();

        if(!ambYoutubeBtn.isActive()) {
            if(ambYoutubeBtn.reversed()){
                ambYoutubeBtn.play()
            }else{
                ambYoutubeBtn.reverse();
            }
        }
    },
    evtSearch : function(e){
        if( $('.header' ).hasClass('_openAllmenu')){
            $('.header_search_wrap').stop().slideUp(300, function(){
                $('.header' ).removeClass('_openAllmenu');
            });
        }else{
            $('.header' ).toggleClass('_openAllmenu');
            $('.header_search_wrap').stop().slideDown(300);
        }
    
    },

    evtSearchClose : function(e){
        $('.header_search_wrap').stop().slideUp(300, function(){
            $('.header' ).removeClass('_openAllmenu');
        });
    }

}

$(function(){
    layout.init();
});
