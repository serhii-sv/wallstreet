$(function () {
    $('.materialize-textarea').each((index, element) => {
        CKEDITOR.replace($(element).attr('id'));
    })
})
