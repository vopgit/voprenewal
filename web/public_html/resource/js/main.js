$(function(){
    main.init();
});



var main = {
    news5 : function(){
        setTimeout(function(){
            var msnry = new Masonry( '.news5 .news_area', {
                itemSelector: '.news5_item',
                gutter: '.news5_item_gutter_size',
                columnWidth: '.news5_item_size',
                percentPosition: true,
                transitionDuration: 0
            });
        }, 300);
    },
    academySlider : function(){
        var $ac = $('.academy').clone();
        $('.academy').addClass('pc').after($ac.addClass('mo'));

        //pc
        var swiper = new Swiper('.academy.pc .academy_slider ', {
            spaceBetween: 40 ,
            slidesPerGroup : 2,
            slidesPerView: 2,
            pagination: {
                el: '.academy.pc .swiper-pagination',
                clickable: true,
            },
        });

        //mo
        var swiper_m = new Swiper('.academy.mo .academy_slider ', {
            spaceBetween: 20 ,
            slidesPerColumn:2,
            slidesPerView: 1,
            pagination: {
                el: '.academy.mo .swiper-pagination',
                clickable: true,
            },
            
        });  
    },
    youtubeSlider : function (){
        var swiper2 = new Swiper('.youtube_slider', {
            slidesPerView: 5,
            slidesPerGroup : 5,
            spaceBetween: 0,
            navigation : { // 네비게이션 설정
                nextEl : '.swiper-button-next', // 다음 버튼 클래스명
                prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
            },
            breakpoints: {
                375: {
                    slidesPerView: 2,
                },
                900: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 4,
                }
            }
        });
    },
    init : function(){
        this.news5();
        this.academySlider();
        this.youtubeSlider();
    }
}