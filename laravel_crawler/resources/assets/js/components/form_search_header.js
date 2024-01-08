var SearchHeader = {
    init: function () {
        this.toggleSuggest()
        this.appendCategory()
    },
    toggleSuggest() {
        $('.b-cate').on('click', 'input', function (e) {
            e.preventDefault();
            $('.dropdown-cate').toggleClass('hide');
        });
    },

    appendCategory() {
        $("body").on("click", ".js-category-item-search", function (event) {
            event.preventDefault()
            let $this = $(this)
            let nameCategory = $this.attr('data-name');
            let idCategory = $this.attr('data-id');
            $(".js-category-value").val(nameCategory)
            // console.log(nameCategory)
            $('.dropdown-cate').toggleClass('hide');
        })
    }
};

$(function () {
    SearchHeader.init();
});
