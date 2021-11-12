var $slider;

$(function(){
    main.slide();
    main.scroll();
    main.ani();
    main.map();
    main.link();

    $(document).on('click', 'a[data-anchor]',  main.event_gnb);   
    $(document).on('click', '.business_item',  main.event_business);
});


var main = {
    anchorMove : function(tag){
        bodyScrollBar.scrollTo(0,  bodyScrollBar.offset.y + $(tag).offset().top, 500);

        var $body       = $('body');
        var $visualWrap = $('.visual_wrap');

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
        $('.gnb_wrap_mo').removeClass('on');
        $('.allmenu').removeClass('act');

        setTimeout(function(){
            $body.removeClass('__scroll');
        },600);

    },
    anchorMoveMo : function(tag){

        var top = $(tag).offset().top;

        $(window).scrollTop(top);

        $('.gnb_wrap_mo').removeClass('on');
        $('.allmenu').removeClass('act');

        scroll.enable();
    },
    event_gnb : function(e){
        e.preventDefault();
        var tag         = $(this).attr('data-anchor');
        setTimeout(function(){
            if(tag != null && tag != ''){
                if(!isMobile){
                    //pc
                    main.anchorMove(tag);
                }else{
                    //mo
                    main.anchorMoveMo(tag);
                }
            }
        },200);
    },
    link  : function(){
        var tag = window.location.href.split('#')[1];

        setTimeout(function(){
            if(tag != null && tag != ''){
                if(!isMobile){ 
                    //pc
                    main.anchorMove('#'+tag);
                }else{
                    //mo
                    main.anchorMoveMo('#'+tag);
                }
            }
        },200);

    },
    scroll : function(){
        if(!isMobile){
            bodyScrollBar.addListener(function(status){
                
                if(!$('body').hasClass('__scroll') && matchMedia("screen and (min-width: 1023px)").matches){
                    
                    if(wDelta == 'down'){
                        
                        if(status.offset.y < (ms2Pos.height() *0.9 ) && ms2Pos.offset().top < 20){
                            if(ms2Val == maxLen + 1){
                                ms2Val = maxLen + 2;
                            }
                            if(ms2Val == maxLen || ms2Val == maxLen + 2){
                                $('.visual_wrap').removeClass('on');
                            }else{
                                bodyScrollBar.setPosition(0, status.offset.y + ms2Pos.offset().top);
                                setTimeout(function(){
                                    $('.visual_wrap').addClass('on');
                                },50);
                            }
                        }
                        
                    }else{
                        if(status.offset.y <=  120){
                            //console.log(status.offset.y)
    
                            bodyScrollBar.setPosition(0, status.offset.y + 0);
                            ms2Val = maxLen + 1;
    
                            $('.visual_wrap:not(.on)').addClass('on');
                        }
                        if(ms2Pos.offset().top > -20){
                            bodyScrollBar.setPosition(0, status.offset.y + ms2Pos.offset().top);
                            setTimeout(function(){
                                $('.visual_wrap').addClass('on');
                            },50);
                        }
                    }
                }
            });
            $(document).on('mousewheel wheel DOMMouseScroll', '.visual', function(e) {
                if (matchMedia("screen and (min-width: 1023px)").matches) {
                    //console.log(ms2Val)
                    //console.log(maxLen)
                    if (e.originalEvent.deltaY >= 0) {//내릴때
                            $slider.slick('next');
                    } else if((e.originalEvent.deltaY < 0)){ //올릴때
                        if(ms2Val == maxLen){
                            $('.visual_wrap').removeClass('on')
                        }else{
                            $slider.slick('slickPrev');
                        }
                    }
                }
            });
        }else{
            $('.visual_wrap').addClass('mobile');
        }
    },
    slide : function(){
        $('.visual').on('init', function(){
            $('.visual_wrap').addClass('on step1');
        });
        
        $slider = $('.visual').slick({
            dots: true,
            infinite: false,
            speed: 500,
            arrows:false,
            fade: true,
        });
       
        $slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
            ms2Val = currentSlide;
            //console.log(ms2Val);
        });
    
        $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
            $('.visual_wrap').removeClass('step1 step2 step3 step4 step5');
            $('.visual_wrap').addClass('step'+(nextSlide + 1)+'');
            console.log('step')
        });
    },
    ani : function(){
    
        gsap.utils.toArray('.main .ani_box').forEach(function(box){
            var elems = box.querySelectorAll('.sc_ani');
            var elems_line = box.querySelectorAll('.sc_ani_line');
    
            gsap.set(elems, { y: 50, opacity: 0 });
            gsap.set(elems_line, { scaleX: 0, opacity: 0 });
            console.log(elems);
            ScrollTrigger.create({
                trigger: box,
                start: 'top 60%',
                invalidateOnRefresh: true,
                onEnter: function(){
                    gsap.to(elems, {
                        y: 0,
                        opacity: 1,
                        duration: 1,
                        stagger: 0.2,
                        delay: 0.3,
                        ease: 'power3.out',
                        overwrite: 'auto'
                    });
                    gsap.to(elems_line, {
                        scaleX: 1,
                        opacity: 1,
                        duration: 1,
                        stagger: 0.2,
                        delay: 0.4,
                        ease: 'power3.out',
                        overwrite: 'auto',
                        transformOrigin:'center left'
                    });
                },
                onLeaveBack: function(){ 
                    /* gsap.to(elems, {
                        y: 50,
                        opacity: 0,
                        duration: 1,
                        stagger: 0.2,
                        delay: 0.3,
                        ease: 'power3.out',
                        overwrite: 'auto'
                    }); */
                }
            });
        });
    },
    event_business : function(e){
        if (matchMedia("screen and (max-width: 600px)").matches) {
            $('.business_item').removeClass('on');
            $(this).addClass('on');
        }
    },
    map : function(){
        if(isMobile){
            $('#map').addClass('disabled')
        }
        var map = new daum.roughmap.Lander({
            "timestamp" : "1628737422996",
            "key" : "26xyd",
            "mapWidth" : "1980",
            "mapHeight" : "575",
            "level": "3"
        }).render();
    }
}   