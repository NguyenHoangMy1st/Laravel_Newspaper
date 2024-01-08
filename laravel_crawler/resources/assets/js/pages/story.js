import GlobalJs from "../components/_inc_global";
var Story = {
    init : function (){
        this.nextPrevChapter()
        this.showLoadMoreContent()
        this.showNavMenuMb()
        this.scrollTabContentStory()
        this.addProductRecently()
        this.loadChapter()
    },
    showLoadMoreContent()
    {
        $('.js-show-content-load').click(function (event){
            event.preventDefault()
            $(".js-content").addClass('active')
            $(this).remove()
        })
    },

    scrollTabContentStory()
    {
        $(".js-scroll-tab").click( function (event){
            event.preventDefault()
            let $this = $(this)
            let $idBox = $this.attr('data-id')
            $('html, body').animate({
                scrollTop: $($idBox).offset().top  - 100
            }, 500);
        })
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

    addProductRecently()
    {
        if(typeof StoryID === "undefined"){
            return false
        }
        let id = StoryID;

        let products = localStorage.getItem('products');

        if (products == null)
        {
            let arrayProduct = new Array();
            arrayProduct.push(id)
            localStorage.setItem('products',JSON.stringify(arrayProduct))

        }else
        {
            // chuyển về mảng
            products = $.parseJSON(products)
            if ( products.indexOf(id) === -1)
            {
                products.push(id);
                localStorage.setItem('products',JSON.stringify(products))
            }
        }
    },

    nextPrevChapter()
    {
        $("body").keydown(function(e) {
            if(e.keyCode === 37) { // left
                let $elementPrev = $(".js-prev-chapter")
                if($elementPrev.length)
                {
                    window.location.href = $elementPrev.attr('href')
                }
            }
            if(e.keyCode === 39) { // right
                let $elementNext = $(".js-next-chapter")
                if($elementNext.length)
                {
                    window.location.href = $elementNext.attr('href')
                }
            }
        });
    },

    loadChapter()
    {
        let _this = this
        let checkRenderProduct = false;
        $(document).on( 'scroll', function() {
            if ($(window).scrollTop() > 150 && checkRenderProduct === false) {
                checkRenderProduct = true;
                if(typeof URL_LOAD_CHAPTER !== "undefined")
                {
                    $.ajax({
                        url : URL_LOAD_CHAPTER,
                        beforeSend : function (){
                            $("#tab-chapter").html(GlobalJs.renderLazyload())
                        },
                        success : function(results)
                        {
                            $("#tab-chapter").html(results.html)
                            let link = _this.renderLinkRead(results.readFirst)
                            $("#js-info-text").html(link)
                        }
                    });
                }
            }
        })
    },

    renderLinkRead(link)
    {
        return `<a href="${link}" class="flex align-center text-primary text-bold">Đọc truyện <i class="la la-angle-double-right"></i></a`
    }

}

$(function (){
    GlobalJs.init()
    Story.init()
})
