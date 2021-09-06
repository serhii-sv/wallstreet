$(document).ready(function () {
    $(".currency-rates").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: false,
        info: true,
        autoWidth: false,
        aoColumns: [
            {
                data: 'empty',
                searchable: false,
                bSortable: false
            },
            {
                data: 'currency_rate',
                searchable: false,
                bSortable: false
            },
            {
                data: 'rate',
                searchable: false,
                bSortable: false
            },
            {
                data: 'autoupdate',
                searchable: false,
                bSortable: false
            },
            {
                data: 'actions',
                searchable: false,
                bSortable: false,
            },
            {
                data: 'empty',
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
            }
        },
        responsive: {
            details: {
                type: "column",
                target: 0
            }
        }
    });
})
