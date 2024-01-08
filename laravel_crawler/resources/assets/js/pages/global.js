import Http from "../helpers/http";

var Global = {
    init : function (){
        this.loadDashboardCrawler()
    },
    loadDashboardCrawler()
    {
        let _this = this;
        if(typeof LOADING_DASHBOARD !== 'undefined')
        {
            var result = Http.get({
                'url': LOADING_DASHBOARD,
                'dataType': 'html',
            });
            result.done(function (response) {
                _this.renderHtmlDashboard(response);
            });
        }
    },

    renderHtmlDashboard(response)
    {
        console.log(response)
        let domData = $.parseJSON(response)
        $("#domain").html(domData.domain)
        $("#category").html(domData.category)
        $("#totalCategory").html(domData.totalCategory)
    },

}

$(function (){
    Global.init()
})
