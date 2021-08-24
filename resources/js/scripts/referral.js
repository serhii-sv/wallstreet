$(function () {
    $(".referrals").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        order: [1, 'asc'],
        aoColumns: [
            {
                data: 'empty',
                searchable: false,
                bSortable: false
            },
            {
                data: 'level',
                searchable: true,
                bSortable: true
            },
            {
                data: 'percent',
                searchable: true,
                bSortable: true
            },
            {
                data: 'on_load',
                searchable: true,
                bSortable: true
            },
            {
                data: 'on_profit',
                searchable: true,
                bSortable: true
            },
            {
                data: 'on_task',
                searchable: true,
                bSortable: true
            },
            {
                data: 'actions',
                searchable: false,
                bSortable: false
            },
        ],
        processing: true,
        serverSide: true,
        ajax: {},
        dom: '<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',
        language: {
            processing: "Загрузка",
            paginate: {
                previous: "‹",
                next: "›",
            },
            emptyTable: 'Нет записей'
        }
    });

    $(document).on('click', '.delete', function () {
        swal({
            title: "Вы уверены?",
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
                window.location.replace($(this).attr('href'))
            }
        })
        return false;
    })
})
