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
    layoyt.init();
    layoyt.scroll();
    layoyt.haader();


    $("html, body").on('mousewheel wheel DOMMouseScroll', function(e) {
        if (e.originalEvent.deltaY > 0) {
            wDelta = 'down'
        }else{
            wDelta = 'up'
        };
    });

    $(document).on('click', '.gnb a[data-anchor]', layoyt.event_gnb);   
    $(document).on('click', '.allmenu', layoyt.event_allmenu)
});

var layoyt = {
    init : function (){
        ms2Pos = $('.visual');
        maxLen = $('.visual .visual_slide').length -1;
        scroller = document.querySelector('.container');

        line  = gsap.to(".allmenu svg", 0.3,{scale:0.8, reversed: true});
        line1 = gsap.to(".allmenu .line_1", 0.3,{rotation: 45, scaleX:1.4, transformOrigin: "center center", y:4, reversed: true});
        line2 = gsap.to(".allmenu .line_2", 0.3,{rotation: -45,  scaleX:1.4, transformOrigin: "center center", y:-10, reversed: true});
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
        if(!isMobile){
            bodyScrollBar.addListener(function(status){
                $('.header')[0].style.transform = 'translateY(' + status.offset.y + 'px)';
            });
        }
        $('.header').after('<div class="__header_trigger" style=" position: absolute; top: 10px; display: block; height: 10px; width: 10px; "></div>');

        ScrollTrigger.create({
            start: 'top -70',
            trigger: '.__header_trigger',
            end: 99999,
            invalidateOnRefresh: true,
            pinType: 'transform',
            toggleClass: {className: '__fixed', targets: '.header'}
        }); 
    },
    event_allmenu : function(e){
            e.preventDefault();

            if(!line2.isActive()) {
                line2.reversed() ? line2.play() : line2.reverse();
            }
            if(!line1.isActive()) {
                line1.reversed() ? line1.play() : line1.reverse();
            } 
            if(!line.isActive()) {
            line.reversed() ? line.play() : line.reverse();
            }
        
            if($(this).hasClass('act')){
                $('.allmenu_wrap').removeClass('on');
                $(this).removeClass('act');
            }else{
                $('.allmenu_wrap').addClass('on');
                $(this).addClass('act');
            }
    },
    event_gnb : function(e){
        if(!isMobile){
            e.preventDefault();
            var tag         = $(this).attr('href');
            var $body       = $('body');
            var $visualWrap = $('.visual_wrap');


            bodyScrollBar.scrollTo(0,  bodyScrollBar.offset.y + $(tag).offset().top, 500);
            //bodyScrollBar.scrollIntoView(document.querySelector(tag));
            if(tag != '#link1'){
                ms2Val = maxLen + 2;
                $visualWrap.removeClass('on');
                document.querySelector('.header').style.transform = 'translateY(' + bodyScrollBar.offset.y + 'px)';
                if($slider){
                    $slider.slick('slickGoTo', maxLen );
                }
            }else{
                ms2Val = 0;
                $visualWrap.addClass('on');
                document.querySelector('.header').style.transform = 'translateY(0px)';
                if($slider){
                    $slider.slick('slickGoTo', 0 );
                }
            }

            $body.addClass('__scroll');

            setTimeout(function(){
                $body.removeClass('__scroll')
            },600);
        }
    }
}