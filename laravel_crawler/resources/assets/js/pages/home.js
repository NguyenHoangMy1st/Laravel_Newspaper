import GlobalJs from "../components/_inc_global";
import 'owl.carousel'
var Home = {
    init : function (){
        this.showNavMenuMb()
        this.loadProductRecently()
        this.tabHome()
        this.bannerSlide()
        this.loadContentTab()
    },

    bannerSlide()
    {
        $('.js-story-banner').owlCarousel({
            // items: 4,
            lazyLoad: true,
            loop: true,
            dots: false,
            nav: true,
            margin: 10,
            responsive: {
                0:{
                    items: 2
                },
                480:{
                    items: 2
                },
                769:{
                    items: 2
                },
                960:{
                    items: 4
                }
            }
        });
    },

    tabHome()
    {
        let $tabContent = $(".js-tab-list")
        $tabContent.click( function (event){
            event.preventDefault()
            $tabContent.removeClass('active')
            let $this = $(this)
            $this.addClass('active')
            $.ajax({
                url : URL_TAB_CONTENT,
                beforeSend : function (){
                    $("#tab-list-content").html(GlobalJs.renderLazyload())
                },
                method : "GET",
                data  : {

                },
                success : function(results)
                {
                    $("#tab-list-content").html(results.html)
                }
            });
        })
    },
    loadContentTab()
    {
        $.ajax({
            url : URL_TAB_CONTENT,
            beforeSend : function (){
                $("#tab-list-content").html(GlobalJs.renderLazyload())
            },
            success : function(results)
            {
                $("#tab-list-content").html(results.html)
            }
        });
    },
    showLoadMoreContent()
    {
        $('.js-show-content-load').click(function (event){
            event.preventDefault()
            $(".js-content").addClass('active')
            $(this).remove()
        })
    },
    loadProductRecently()
    {
        let checkRenderProduct = false;
        $(document).on( 'scroll', function(){
            if ($(window).scrollTop() > 150 && checkRenderProduct === false ) {
                checkRenderProduct = true;
                let products = localStorage.getItem('products');
                products = $.parseJSON(products)
                if (typeof URL_RECENTLY !== "undefined") {
                    if ( products)
                    {
                        $.ajax({
                            url : URL_RECENTLY,
                            method : "GET",
                            data  : { id : products},
                            success : function(results)
                            {
                                $("#recently").html(results.data);
                            }
                        });
                    }else {
                        $("#recently").html('')
                    }
                }
            }
        });
    },
    showNavMenuMb()
    {
        $(".js-sub-menu").click(function (event){
            event.preventDefault()
            let $this = $(this)
            let $navNext  = $this.next()
            if($navNext.hasClass('sub-menu'))
            {
                $navNext.toggleClass('active-mobile')
            }
        })
    },
}

$(function (){
    GlobalJs.init()
    Home.init()
})
