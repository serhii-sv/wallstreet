$(document).ready(function () {
  
  /* select 2 intialization */
  /*-----------------------*/
  
  /* Basic Select2 select */
  var select_template = $(".select2").select2();
  
  select_template.select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: 'Шаблон письма',
  });
  
  /* Select With Icon */
  $(".select2-icons").select2({
    dropdownAutoWidth: true,
    width: '100%',
    minimumResultsForSearch: Infinity,
    templateResult: iconFormat,
    templateSelection: iconFormat,
    escapeMarkup: function (es) {
      return es;
    }
  });
  
  /* Format icon */
  function iconFormat(icon) {
    var originalOption = icon.element;
    if (!icon.id) {
      return icon.text;
    }
    var $icon = "<i class='material-icons'>" + $(icon.element).data('icon') + "</i>" + icon.text;
    
    return $icon;
  }
  
  
  /* Limiting the number of selections */
  $(".max-length").select2({
    dropdownAutoWidth: true,
    width: '100%',
    maximumSelectionLength: 2,
    placeholder: "Select maximum 2 items"
  });
  
  
  /* Programmatic access */
  var $select = $(".js-example-programmatic").select2({
    dropdownAutoWidth: true,
    width: '100%'
  });
  
  var $selectMulti = $(".js-example-programmatic-multi").select2();
  $selectMulti.select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: "Programmatic Events"
  });
  $(".js-programmatic-set-val").on("click", function () {
    $select.val("CA").trigger("change");
  });
  
  $(".js-programmatic-open").on("click", function () {
    $select.select2("open");
  });
  $(".js-programmatic-close").on("click", function () {
    $select.select2("close");
  });
  
  $(".js-programmatic-init").on("click", function () {
    $select.select2();
  });
  $(".js-programmatic-destroy").on("click", function () {
    $select.select2("destroy");
  });
  
  $(".js-programmatic-multi-set-val").on("click", function () {
    $selectMulti.val(["CA", "AL"]).trigger("change");
  });
  $(".js-programmatic-multi-clear").on("click", function () {
    $selectMulti.val(null).trigger("change");
  });
  
  /* Loading array data */
  var data = [
    {id: 0, text: 'enhancement'},
    {id: 1, text: 'bug'},
    {id: 2, text: 'duplicate'},
    {id: 3, text: 'invalid'},
    {id: 4, text: 'wontfix'}
  ];
  
  $(".select2-data-array").select2({
    dropdownAutoWidth: true,
    width: '100%',
    data: data
  });
  
  /* Loading remote data */
  $(".select2-get-user-ajax").select2({
    dropdownAutoWidth: true,
    width: '100%',
    ajax: {
      url: "/ajax/get-user-email",
      dataType: 'json',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      delay: 250,
      method: 'post',
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        return {
          results: data.users,
        };
      },
      cache: true
    },
    placeholder: 'Кому отправить',
    escapeMarkup: function (markup) {
      return markup;
    }, /* let our custom formatter work */
    minimumInputLength: 2,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });
  
  function formatRepo(repo) {
    if (repo.loading) return repo.text = "Поиск";
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.email + "</div>" +
        "</div>" +
        "</div>";
    return markup;
  }
  
  function formatRepoSelection(repo) {
    return repo.email || repo.login;
  }
  
  
  /* Customizing how results are matched */
  function matchStart(term, text) {
    if (text.toUpperCase().indexOf(term.toUpperCase()) === 0) {
      return true;
    }
    
    return false;
  }
  
  $.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
    $(".select2-customize-result").select2({
      dropdownAutoWidth: true,
      width: '100%',
      placeholder: "Search by 'r'",
      matcher: oldMatcher(matchStart)
    });
  });
  
  /* Theme support */
  $(".select2-theme").select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: "Classic Theme",
    theme: "classic"
  });
  
  /* Sizing options */
  /*----------------*/
  
  /* Large */
  $('.select2-size-lg').select2({
    dropdownAutoWidth: true,
    width: '100%',
    containerCssClass: 'select-lg'
  });
  
  /* Small */
  $('.select2-size-sm').select2({
    dropdownAutoWidth: true,
    width: '100%',
    containerCssClass: 'select-sm'
  });
  
  $('.select2').find('.select2-selection').one('focus', select2Focus).on('blur', function () {
    $(this).one('focus', select2Focus)
  })
  
  function select2Focus() {
    $(this).closest('.select2').prev('select').select2('open');
  }
});
