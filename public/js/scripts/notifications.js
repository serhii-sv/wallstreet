$((function(){$("#notifications").DataTable({paging:!0,lengthChange:!1,searching:!1,ordering:!0,info:!0,autoWidth:!1,aoColumns:[{data:"name",searchable:!0,bSortable:!0},{data:"created_at",searchable:!0,bSortable:!1}],processing:!0,serverSide:!0,ajax:{},dom:'<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',language:{processing:"Загрузка",paginate:{previous:"‹",next:"›"},emptyTable:"Нет записей"}})}));
