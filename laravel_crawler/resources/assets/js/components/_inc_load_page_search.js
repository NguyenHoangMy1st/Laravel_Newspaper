import Toastr from "toastr";

var PageSearch =
{
    init : function ()
    {
        this.clickLoadPage()
    },

    clickLoadPage()
    {
        $("body").on("click",".js-bar-menu", function (event){
            event.preventDefault()
            let $this = $(this)
            let URL = $this.attr('href')
            $.ajax({
                url: URL,
                beforeSend: function() {
                    // _this.click = true
                },
                success: function(results) {
                    $(".load-page-content").html(results)
                    history.pushState({},"Tìm kiếm",'/tim-kiem');
                    document.title = "Tìm kiếm";
                },
                error: function(xhr) {
                    console.log(xhr)
                },
            });
        })
    }
}

export default PageSearch
