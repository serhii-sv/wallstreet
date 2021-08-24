$(function () {
    $('.materialize-textarea').each((index, element) => {
        CKEDITOR.replace($(element).attr('id'));
    })

    $(document).on('click', '.delete', function () {
        swal({
            title: "Вы уверены что хотите удалить этот продукт?",
            // text: "You will not be able to recover this imaginary file!",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "Отменить",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Подтвердить",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }
        }).then((result) => {
            if (result) {
                window.location.href = $(this).attr('href')
            }
        })
        return false;
    })
})
