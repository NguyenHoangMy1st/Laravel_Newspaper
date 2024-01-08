import Toastr from 'toastr';
import Swal from 'sweetalert2'

var ConfirmDelete =
    {
        init: function () {
            this.clickDelete()
        },
        clickDelete() {
            let _this = this;
            $(".js-delete").click(function (event) {
                event.preventDefault()
                let $this = $(this)
                let URL = $this.attr('href')
                if (URL) {
                    Swal.fire({
                        title: 'Xoá dữ liệu!',
                        text: 'Bạn có chắc chắn xoá dữ liệu không',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showCancelButton: true,
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Huỷ bỏ"
                    }).then((result) => {
                        if (result.value) _this.processDelete(URL, $this)
                    })
                }

            })
        },
        processDelete(URL, $element) {
            $.ajax({
                url: URL,
                beforeSend: function (xhr) {

                }
            })
                .done(function (results) {
                    console.log(results)
                    if (results.status === 200) {
                        Toastr.success(results.message)
                        $element.parents('tr').remove()
                        $element.parents('.tr').remove()
                    } else {
                        Toastr.error(results.message)
                    }

                });
        }
    }

export default ConfirmDelete
