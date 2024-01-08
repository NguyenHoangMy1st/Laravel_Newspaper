var GlobalJs = {
    init : function (){
        this.showSidebarRightToLeftMb()
        this.hideSidebarMb()
    },
    showSidebarRightToLeftMb()
    {
        $(".js-bars").click(function (event){
            event.preventDefault()
            $(".js-sidebar-right-to-left").addClass('active')
            $(".bg-overflow").addClass('in')
        })
    },

    renderLazyload()
    {
        return `<div class="sk-fading-circle js-loading-1">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
`
    },
    hideSidebarMb()
    {
        $(".js-bg-overflow").click(function (event){
            event.preventDefault()
            $(".bg-overflow").removeClass('in')
            $(".js-sidebar-right-to-left").removeClass('active')
        })
    }
}
export default GlobalJs
