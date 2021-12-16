$(document).ready(function () {
    /********Invoice List ********/
    /* --------------------------- */

    /* init data table */
    if ($(".invoice-data-table").length) {
        var dataListView = $(".invoice-data-table").DataTable({
            keepConditions: {
                conditions: ['page'],
            },
            paging: true,
            lengthChange: false,
            // "searching": false,
            ordering: true,
            info: true,
            autoWidth: false,
            aoColumns: [
                {
                    data: 'empty',
                    searchable: false,
                    bSortable: false
                },
                {
                    data: 'id',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'email',
                    searchable: false,
                    bSortable: false
                },
                // {
                //     data: 'login',
                //     searchable: false,
                //     bSortable: false
                // },
                {
                    data: 'teamlead',
                    searchable: false,
                    bSortable: false
                },
                // {
                //     data: 'partner',
                //     searchable: false,
                //     bSortable: false
                // },
                {
                    data: 'amount',
                    searchable: false,
                    bSortable: true
                },
                {
                    data: 'created_at',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'repl_type',
                    searchable: false,
                    bSortable: true
                },
                {
                    data: 'replenished',
                    searchable: false,
                    bSortable: true
                },
                {
                    data: 'actions',
                    searchable: false,
                    bSortable: false,
                    width: '100%'
                },
                {
                    data: 'empty3',
                    searchable: false,
                    bSortable: false
                },
            ],
            processing: true,
            serverSide: true,
            ajax: {},
            columnDefs: [
                {
                    targets: 0,
                    className: "control"
                },
                {
                    orderable: true,
                    targets: 1,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return '<input type="checkbox" name="list[]" class="select-checkbox dt-checkboxes" value="' + data + '" />';
                        }
                        return data;
                    },
                    checkboxes: {selectRow: true}
                },
                {
                    targets: [0, 1],
                    orderable: false
                }
            ],
            order: [6, 'desc'],
            dom: '<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',
            language: {
                search: "",
                searchPlaceholder: window.location.pathname === '/withdrawals' ? "Поиск выводов" : 'Поиск пополнений',
                processing: "Загрузка",
                paginate: {
                    previous: "‹",
                    next: "›",
                }
            },
            select: {
                style: "multi",
                selector: "td:first-child>",
                items: "row"
            },
            responsive: {
                details: {
                    type: "column",
                    target: 0
                }
            }
        });

        // To append actions dropdown inside action-btn div
        var invoiceFilterAction = $(".invoice-filter-action");
        var invoiceCreateBtn = $(".invoice-create-btn");
        var filterButton = $(".filter-btn");
        $(".action-btns").append(invoiceFilterAction, invoiceCreateBtn);
        $(".dataTables_filter label").append(filterButton);

        // $('.search').click(() => {
        //     let query = $('.invoice-list-wrapper input[type="search"]').val();
        //     if (query.length > 2) {
        //         location.href = '/withdrawals?email=' + query
        //     }
        // })

        $(document).on('click', '.dt-checkboxes-select-all', function () {
            $('tbody .select-checkbox').map((index, checkbox) => {
                $(checkbox).prop('checked', $(this).find('input[type="checkbox"]').prop('checked'))
            })
        })

        $(document).on('click', '.invoice-action-view:not(:first-child)', function () {
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
                    if ($('tbody .select-checkbox:checked').length) {
                        $('input[name="type"]').val($(this).data('action_type'))
                        $('#transactionsForm').submit();
                    } else {
                        window.location.replace($(this).attr('href'))
                    }
                }
            })
            return false;
        })
    }

    $('.tabs a').click(function () {
        window.location.replace($(this).attr('href'))
    })

    $(document).on('click', '#deleteTransaction button', function () {
        swal({
            title: "Вы уверены что хотите удалить эти данные?",
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
                $('#deleteTransaction').submit();
            }
        })
        return false;
    })

    if ($('#transactions').length) {
        $("#transactions").DataTable({
            keepConditions: {
                conditions: ['page'],
            },
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: false,
            pageLength: 15,
            info: true,
            autoWidth: false,
            order: [5, 'desc'],
            aoColumns: [
                {
                    data: 'id',
                    searchable: false,
                    bSortable: false
                },
                {
                    data: 'email',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'type_name',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'amount',
                    searchable: true,
                    bSortable: false,
                    width: '50px'
                },
                {
                    data: 'paymentSystem_name',
                    searchable: true,
                    bSortable: false,
                    width: '100px'
                },
                {
                    data: 'created_at',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'open_operation',
                    searchable: true,
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

    }

    if ($('#deposits').length) {
        $("#deposits").DataTable({
            keepConditions: {
                conditions: ['page'],
            },
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: false,
            pageLength: 15,
            info: true,
            autoWidth: false,
            order: [5, 'desc'],
            aoColumns: [
                {
                    data: 'id',
                    searchable: false,
                    bSortable: false
                },
                {
                    data: 'email',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'invested',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'total_assessed',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'next_charge',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    bSortable: true
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

    }

    /* Invoice edit */
    /* ------------*/

    /* form repeater jquery */
    var uniqueId = 1;
    if ($(".invoice-item-repeater").length) {
        $(".invoice-item-repeater").repeater({
            show: function () {
                /* Assign unique id to new dropdown */
                $(this).find(".dropdown-button").attr("data-target", "dropdown-discount" + uniqueId + "");
                $(this).find(".dropdown-content").attr("id", "dropdown-discount" + uniqueId + "");
                uniqueId++;
                /* showing the new repeater */
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    /* Onclick of Invoice Apply button Discount value change */
    $(document).on("click", ".invoice-apply-btn", function () {
        var $this = $(this);
        var discount = $this.closest(".dropdown-content").find("#discount").val();
        var tax1 = $this.closest(".dropdown-content").find("#Tax1 option:selected").val();
        var tax2 = $this.closest(".dropdown-content").find("#Tax2 option:selected").val();
        $this.parents().eq(4).find(".discount-value").html(discount + "%");
        $this.parents().eq(4).find(".tax1").html(tax1);
        $this.parents().eq(4).find(".tax2").html(tax2);
        $('.dropdown-button').dropdown("close"); /*dropdown close */
    });
    /* Dropdown close onclick of cancel btn*/
    $(document).on("click", ".invoice-cancel-btn", function () {
        $('.dropdown-button').dropdown("close");
    });
    /* on product change also change product description */
    $(document).on("change", ".invoice-item-select", function (e) {
        var selectOption = this.options[e.target.selectedIndex].text;
        /*switch case for product select change also change product description */
        switch (selectOption) {
            case "Frest Admin Template":
                $(e.target)
                    .closest(".invoice-item-filed")
                    .find(".invoice-item-desc")
                    .val("The most developer friendly & highly customisable HTML5 Admin");
                break;
            case "Stack Admin Template":
                $(e.target)
                    .closest(".invoice-item-filed")
                    .find(".invoice-item-desc")
                    .val("Ultimate Bootstrap 4 Admin Template for Next Generation Applications.");
                break;
            case "Robust Admin Template":
                $(e.target)
                    .closest(".invoice-item-filed")
                    .find(".invoice-item-desc")
                    .val(
                        "Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities"
                    );
                break;
            case "Apex Admin Template":
                $(e.target)
                    .closest(".invoice-item-filed")
                    .find(".invoice-item-desc")
                    .val("Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ");
                break;
            case "Modern Admin Template":
                $(e.target)
                    .closest(".invoice-item-filed")
                    .find(".invoice-item-desc")
                    .val("The most complete & feature packed bootstrap 4 admin template of 2019!");
                break;
        }
    });
    /* Initialize Dropdown */
    $('.dropdown-button').dropdown({
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        closeOnClick: false
    });
    $(document).on("click", ".invoice-repeat-btn", function (e) {
        /* Dynamically added dropdown initialization */
        $('.dropdown-button').dropdown({
            constrainWidth: false, // Does not change width of dropdown to that of the activator
            closeOnClick: false
        });
    })

    if ($(".invoice-print").length > 0) {
        $(".invoice-print").on("click", function () {
            window.print();
        })
    }
})
