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
})
