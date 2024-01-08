import typeahead from "typeahead.js";
import Bloodhound from "bloodhound-js";

var SearchKeyword = {
    init : function ()
    {
        this.searchKeyword()
        this.appendResult()
    },

    searchKeyword()
    {
        let $element = $(".js-search-keyword")
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/ajax/search-keyword?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });

        $element.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'keyword',
            source: bloodhound,
            display: function(data) {
                return data.name  //Input value to be set when you select a suggestion.
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown">' +
                    '<div class="list-group-item">Không tồn tại dữ liệu.</div>' +
                    '</div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                    return '<div class="item">\n' +
                        '        <div class="item_info">\n' +
                        '            <a href="" class="js-item-result-search" data-code="'+data.id+'" data-name="'+data.k_name+'">'+data.k_name+'</a>\n' +
                        '        </div>\n' +
                        '    </div>';
                }
            }
        });
    },

    appendResult()
    {
        $("body").on("click",".js-item-result-search", function (event){
            event.preventDefault()
            let $this = $(this)
            let valueSearch = $this.attr('data-name')
            let $elementSearchKeyword = $(".js-search-keyword")
            $elementSearchKeyword.val(valueSearch)
            $elementSearchKeyword.typeahead('val', '')
            $elementSearchKeyword.focus().typeahead('val',valueSearch).focus();
        })
    }
}

export default SearchKeyword
