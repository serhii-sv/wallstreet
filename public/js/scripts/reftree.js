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
                if (response.success) {
                    setTimeout(() => {
                        location.reload()
                    }, 200)
                }
            }
        });
        return false;
    })
})
