/*
 * Nested - Extra Components
 */

$(function() {

  var updateOutput = function(e) {
    let list = e.length ? e : $(e.target);
      $.ajax({
          url: $('#request_url').val(),
          method: 'post',
          data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              referrals: list.nestable('serialize')
          },
          success: (response) => {
              M.toast({
                  html: response.message,
                  classes: response.success ? 'green' : 'red'
              })
              setTimeout(() => {
                  location.reload()
              }, 200)
          }
      })
  };

  // activate Nestable for list 1
  $('#nestable').nestable({
      group: 1,
      maxDepth: 100000000000000,
      threshold: 100000000000000
    })
    .on('change', updateOutput);

  // activate Nestable for list 2
  $('#nestable2').nestable({
      group: 1
    })
    .on('change', updateOutput);

  // // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));
  // updateOutput($('#nestable2').data('output', $('#nestable2-output')));

  $('#nestable-menu').on('click', function(e) {
    var target = $(e.target),
      action = target.data('action');
    if (action === 'expand-all') {
      $('.dd').nestable('expandAll');
    }
    if (action === 'collapse-all') {
      $('.dd').nestable('collapseAll');
    }
  });

  $('#nestable3').nestable();

});
