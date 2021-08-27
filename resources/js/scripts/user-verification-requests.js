$(function () {
    $(".verification-requests").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        order: [2, 'desc'],
        aoColumns: [
            {
                data: 'empty',
                searchable: false,
                bSortable: false
            },
            {
                data: 'email',
                searchable: false,
                bSortable: false
            },
            {
                data: 'created_at',
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
})
