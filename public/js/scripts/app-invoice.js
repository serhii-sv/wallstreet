$(document).ready((function(){if($(".invoice-data-table").length){$(".invoice-data-table").DataTable({keepConditions:{conditions:["page"]},paging:!0,lengthChange:!1,ordering:!0,info:!0,autoWidth:!1,aoColumns:[{data:"empty",searchable:!1,bSortable:!1},{data:"id",searchable:!0,bSortable:!0},{data:"email",searchable:!1,bSortable:!1},{data:"teamlead",searchable:!1,bSortable:!1},{data:"amount",searchable:!1,bSortable:!0},{data:"created_at",searchable:!0,bSortable:!0},{data:"approved",searchable:!1,bSortable:!0},{data:"actions",searchable:!1,bSortable:!1,width:"100%"},{data:"empty3",searchable:!1,bSortable:!1}],processing:!0,serverSide:!0,ajax:{},columnDefs:[{targets:0,className:"control"},{orderable:!0,targets:1,render:function(e,t,a){return"display"===t?'<input type="checkbox" name="list[]" class="select-checkbox dt-checkboxes" value="'+e+'" />':e},checkboxes:{selectRow:!0}},{targets:[0,1],orderable:!1}],order:[6,"desc"],dom:'<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',language:{search:"",searchPlaceholder:"/withdrawals"===window.location.pathname?"Поиск выводов":"Поиск пополнений",processing:"Загрузка",paginate:{previous:"‹",next:"›"}},select:{style:"multi",selector:"td:first-child>",items:"row"},responsive:{details:{type:"column",target:0}}});var e=$(".invoice-filter-action"),t=$(".invoice-create-btn"),a=$(".filter-btn");$(".action-btns").append(e,t),$(".dataTables_filter label").append(a),$(document).on("click",".dt-checkboxes-select-all",(function(){$("tbody .select-checkbox").map(((e,t)=>{$(t).prop("checked",$(this).find('input[type="checkbox"]').prop("checked"))}))})),$(document).on("click",".invoice-action-view:not(:first-child)",(function(){return swal({title:"Вы уверены?",icon:"warning",buttons:{cancel:{text:"Отменить",value:null,visible:!0,className:"",closeModal:!0},confirm:{text:"Подтвердить",value:!0,visible:!0,className:"",closeModal:!0}}}).then((e=>{e&&($("tbody .select-checkbox:checked").length?($('input[name="type"]').val($(this).data("action_type")),$("#transactionsForm").submit()):window.location.replace($(this).attr("href")))})),!1}))}$(".tabs a").click((function(){window.location.replace($(this).attr("href"))})),$(document).on("click","#deleteTransaction button",(function(){return swal({title:"Вы уверены что хотите удалить эти данные?",icon:"warning",buttons:{cancel:{text:"Отменить",value:null,visible:!0,className:"",closeModal:!0},confirm:{text:"Подтвердить",value:!0,visible:!0,className:"",closeModal:!0}}}).then((e=>{e&&$("#deleteTransaction").submit()})),!1})),$("#transactions").length&&$("#transactions").DataTable({keepConditions:{conditions:["page"]},paging:!0,lengthChange:!1,searching:!1,ordering:!1,pageLength:15,info:!0,autoWidth:!1,order:[5,"desc"],aoColumns:[{data:"id",searchable:!1,bSortable:!1},{data:"email",searchable:!0,bSortable:!1},{data:"type_name",searchable:!0,bSortable:!1},{data:"amount",searchable:!0,bSortable:!1,width:"50px"},{data:"paymentSystem_name",searchable:!0,bSortable:!1,width:"100px"},{data:"created_at",searchable:!0,bSortable:!1},{data:"open_operation",searchable:!0,bSortable:!1}],processing:!0,serverSide:!0,ajax:{},dom:'<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',language:{processing:"Загрузка",paginate:{previous:"‹",next:"›"},emptyTable:"Нет записей"}}),$("#deposits").length&&$("#deposits").DataTable({keepConditions:{conditions:["page"]},paging:!0,lengthChange:!1,searching:!1,ordering:!1,pageLength:15,info:!0,autoWidth:!1,order:[5,"desc"],aoColumns:[{data:"id",searchable:!1,bSortable:!1},{data:"email",searchable:!0,bSortable:!1},{data:"invested",searchable:!0,bSortable:!0},{data:"total_assessed",searchable:!0,bSortable:!1},{data:"next_charge",searchable:!0,bSortable:!1},{data:"created_at",searchable:!0,bSortable:!0}],processing:!0,serverSide:!0,ajax:{},dom:'<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',language:{processing:"Загрузка",paginate:{previous:"‹",next:"›"},emptyTable:"Нет записей"}});var n=1;$(".invoice-item-repeater").length&&$(".invoice-item-repeater").repeater({show:function(){$(this).find(".dropdown-button").attr("data-target","dropdown-discount"+n),$(this).find(".dropdown-content").attr("id","dropdown-discount"+n),n++,$(this).slideDown()},hide:function(e){$(this).slideUp(e)}}),$(document).on("click",".invoice-apply-btn",(function(){var e=$(this),t=e.closest(".dropdown-content").find("#discount").val(),a=e.closest(".dropdown-content").find("#Tax1 option:selected").val(),n=e.closest(".dropdown-content").find("#Tax2 option:selected").val();e.parents().eq(4).find(".discount-value").html(t+"%"),e.parents().eq(4).find(".tax1").html(a),e.parents().eq(4).find(".tax2").html(n),$(".dropdown-button").dropdown("close")})),$(document).on("click",".invoice-cancel-btn",(function(){$(".dropdown-button").dropdown("close")})),$(document).on("change",".invoice-item-select",(function(e){switch(this.options[e.target.selectedIndex].text){case"Frest Admin Template":$(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("The most developer friendly & highly customisable HTML5 Admin");break;case"Stack Admin Template":$(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Ultimate Bootstrap 4 Admin Template for Next Generation Applications.");break;case"Robust Admin Template":$(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities");break;case"Apex Admin Template":$(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ");break;case"Modern Admin Template":$(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("The most complete & feature packed bootstrap 4 admin template of 2019!")}})),$(".dropdown-button").dropdown({constrainWidth:!1,closeOnClick:!1}),$(document).on("click",".invoice-repeat-btn",(function(e){$(".dropdown-button").dropdown({constrainWidth:!1,closeOnClick:!1})})),$(".invoice-print").length>0&&$(".invoice-print").on("click",(function(){window.print()}))}));
