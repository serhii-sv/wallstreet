$(function () {
    $('.materialize-textarea').each((index, element) => {
        CKEDITOR.replace($(element).attr('id'));
    })

    var $text = CKEDITOR.instances['editor'].getData();
    $(".notification-preview-input").val($text);
    console.log('aaaaa')

    $("#formValidate").validate({
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            min: {
                required: true,
            },
            max: {
                required: true,
            },
            duration: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Введите название тарифа",
                minlength: "Имя тарифа должно стостоять минимум из 1 символа"
            },
            min: {
                required: "Поле обязательно"
            },
            max: {
                required: "Поле обязательно"
            },
            duration: {
                required: "Поле обязательно"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
})
