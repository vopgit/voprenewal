// Mobile 
if(isMobile && !isIe){
    function vhMax (){
        var vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', vh + 'px');
    }
    vhMax();
}


var wDelta, ms2Pos, ms2Val = 0, maxLen = 0,
    scroller, bodyScrollBar, damping = 0.25;


var line, line1, line2;

$(function(){
    layout.init();
    layout.scroll();
    layout.haader();


    $("html, body").on('mousewheel wheel DOMMouseScroll', function(e) {
        if (e.originalEvent.deltaY > 0) {
            wDelta = 'down'
        }else{
            wDelta = 'up'
        };
    });

    
});
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
        ms2Pos = $('.visual');
        maxLen = $('.visual .visual_slide').length -1;
        scroller = document.querySelector('.container');

        line  = gsap.to(".allmenu svg", 0.3,{scale:0.8, reversed: true});
        line1 = gsap.to(".allmenu .line_1", 0.3,{rotation: 45, scaleX:1.4, transformOrigin: "center center", y:4, reversed: true});
        line2 = gsap.to(".allmenu .line_2", 0.3,{rotation: -45,  scaleX:1.4, transformOrigin: "center center", y:-10, reversed: true});

        var gnbMo= $('.gnb_wrap').clone().addClass('gnb_wrap_mo').removeClass('gnb_wrap');
        gnbMo.append('<button type="button" class="gnb_mo_close"><i class="iconFt_close"></i></button>');
        $('.container').after(gnbMo);
        $('.gnb_wrap_mo .gnb').removeClass('gnb');



        $(document).on('click', '.allmenu',       layout.event_allmenu);
        $(document).on('click', '.gnb_mo_close',  layout.event_allmenu_close);

        $(document).on('click', '.gnb_wrap_mo .gnb_drop',  layout.event_gnb_mo_drop);
        $(document).on('mouseenter', '.gnb > li > a',      layout.event_gnb_pc_down);
        $(document).on('mouseleave', '.gnb',               layout.event_gnb_pc_up);

        var resizeTimer;
        $(window).bind('resize', function( ) {
            window.clearTimeout( resizeTimer );
            resizeTimer = window.setTimeout( resizeFunction, 300 );
        });
        function resizeFunction(){
            if(isMobile){
                //mo menu open scroll control
                if (matchMedia("screen and (min-width: 1023px)").matches) {
                    scroll.enable();
                }else{
                    if($('.gnb_wrap_mo').hasClass('on')){
                        scroll.disable();
                    }
                }
            }
        }
    },
    scroll : function(){

        damping = (isIe) ? 0.7 : 0.25;
        
        gsap.registerPlugin(ScrollTrigger);

        if(!isMobile){
            bodyScrollBar = Scrollbar.init(scroller, {damping: damping, delegateTo: document, alwaysShowTracks: false});
            bodyScrollBar.setPosition(0, 0);

            $(bodyScrollBar.track.xAxis.element).remove();

            ScrollTrigger.defaults({ scroller: '.container' })

            ScrollTrigger.scrollerProxy(scroller, {
                scrollTop: function(value) {
                    if (arguments.length) {
                    bodyScrollBar.scrollTop = value;
                    }
                    return bodyScrollBar.scrollTop;
                }
            });
            bodyScrollBar.addListener(ScrollTrigger.update);
        }else{
            $('html, body').css('overflow', 'visible');
            $('.container').css('height', 'auto');    
        }
    },
    haader : function(){
        var stOp = {
            start: 'top -70',
            trigger: '.__header_trigger',
            end: 99999,
            invalidateOnRefresh: true,
            toggleClass: {className: '__fixed', targets: '.header'}
        }
        if(!isMobile){
            bodyScrollBar.addListener(function(status){
                $('.header')[0].style.transform = 'translateY(' + status.offset.y + 'px)';
            });
            stOp.pinType = 'transform';
        }else{
            $('.header').css('position', 'fixed');
        }
        $('.header').after('<div class="__header_trigger" style=" position: absolute; top: 10px; display: block; height: 10px; width: 10px; "></div>');

        ScrollTrigger.create(stOp); 
    },
    event_allmenu : function(e){
            e.preventDefault();

            /* if(!line2.isActive()) {
                line2.reversed() ? line2.play() : line2.reverse();
            }
            if(!line1.isActive()) {
                line1.reversed() ? line1.play() : line1.reverse();
            } 
            if(!line.isActive()) {
            line.reversed() ? line.play() : line.reverse();
            }

        
            if($(this).hasClass('act')){
                $('.gnb_wrap_mo').removeClass('on');
                $(this).removeClass('act');
                
            }else{
                $('.gnb_wrap_mo').addClass('on');
                $(this).addClass('act');
                
            } */
            scroll.disable();
            $('.gnb_wrap_mo').addClass('on');
            $(this).addClass('act');
    },
    event_allmenu_close: function(e){
        $('.gnb_wrap_mo').removeClass('on');
        $('.allmenu').removeClass('act');
        scroll.enable();
    },
    event_gnb_mo_drop: function(e){
        e.preventDefault();
        $(this).next('ul').stop().slideToggle(200);
    },
    event_gnb_pc_down: function(e){
        $('.gnb li.on').removeClass('on').find('ul').stop().slideUp(200);
        $(this).parent('li').addClass('on');
        $(this).next('ul').stop().slideDown(200);
    },
    event_gnb_pc_up: function(e){
        $('.gnb li.on').removeClass('on').find('ul').stop().slideUp(200);
    },
}