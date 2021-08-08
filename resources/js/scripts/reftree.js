$(function () {
    $('#addNewReferral').submit(function () {
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data:  $(this).serialize(),
            success: (response) => {
                M.toast({
                    html: response.message,
                    classes: response.success ? 'green' : 'red'
                })
            }
        });
        return false;
    })
})
