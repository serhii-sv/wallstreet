/*
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

function nrOfDecimals(number, fixed) {
    var match = (''+number).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    if (!match) { return 0; }

    var decimals =  Math.max(0,
        (match[1] ? match[1].length : 0)
        // Correct the notation.
        - (match[2] ? +match[2] : 0));

    if(decimals > 8){
        //if decimal are more then 8
        number = parseFloat(number).toFixed(fixed);
    }
    //else no adjustment is needed
    return number;
}

function calculateDeposit()
{
    $(document).ready(function(){
        var amount = $('#calculatorAmount').val();
        var duration = $('.calculatorDuration').val();
        var percent = 1.5;
        var highPercent = 1.7;
        var currency = $('#calculatorCurrency').val();

        if (amount > 50000) {
            return false;
        }

        if (currency == 'BTC' && amount >= 0.16) {
            percent = highPercent;
        } else if (currency == 'ETH' && amount >= 4.99) {
            percent = highPercent;
        } else if (currency == 'BCH' && amount >= 2.28) {
            percent = highPercent;
        } else if (currency == 'USD' && amount >= 1000) {
            percent = highPercent;
        }

        var perDay = amount/100*percent;
        var perPeriod = perDay*duration;

        var htmlDay = 0;
        var htmlAlltime = 0;

        if (currency == 'USD') {
            htmlDay = nrOfDecimals(perDay, 2);
            htmlAlltime = nrOfDecimals(parseFloat(perPeriod), 2);
        } else {
            htmlDay = nrOfDecimals(perDay, 8);
            htmlAlltime = nrOfDecimals(parseFloat(perPeriod), 8);
        }

        $('.calc-results__count.day').html(htmlDay);
        $('.calc-results__count.alltime').html(htmlAlltime);
    });
}

calculateDeposit();

$(document).ready(function(){
    $('#calculatorAmount').keyup(function(){
        calculateDeposit();
    });

    $('.calculatorDuration').change(function(){
        calculateDeposit();
    });

    $('#calculatorCurrency').change(function(){
        var val = $(this).val();

        $('.calculatorBonusCurrency').html(val);
        $('.calc-results__currency').html(val);
    });

  // loader
  $(".loader").fadeOut("slow");

  // tilt
  const tilt = $('.js-tilt').tilt({
    perspective: 100
  });
  $('.js-tilt-small').tilt({
    perspective: 500
  });
  // sorting test inverse
  $(".sorting").click(function(){
    $(this).toggleClass("inverse");
  })
  // navigation lk sticky
    $('.js-fixed').theiaStickySidebar({
      minWidth:768
    });

    $(window).resize(function(){
      if ($(window).width() < 751){
        $('.js-fixed').theiaStickySidebar({
          defaultPosition: "fixed"
        });
      }else{
        $('.js-fixed').theiaStickySidebar({
          defaultPosition: "relative"
        });
      }
    })


  //accordion
  $(".accordion").accordion();

  // fancy close
  $('.modal-window__close').click(function(){
    $.fancybox.close();
  });

  // animations
  $('section, .mosaic__row, .plan-item').viewportChecker({
      classToAdd: 'active',
      repeat: true,
      offset: 250
  });

  // select
  $( ".select" ).selectmenu();


  // calculate slider
  $('.js-slider').slider(
    {
      range: "min",
      min:30,
      max:180,
      step:30,
      animate:true,
      value:90,
        change:function(event, ui){
          $('.calculatorDuration').val(ui.value).change();
        },
    })
    .slider('pips', {
      rest:'label',
      step:2.5
    })
    .slider('float');


  // mobile menu
  // $('.nav-icon-wrap').click(function(){
  //   $(this).toggleClass('open');
  //   $(this).children('#nav-icon').toggleClass('open');
  //   $('body').toggleClass('overflow');
  //   $('.navigation, .navigation-lk-mobile, .navigation-icons').toggleClass('open');
  // });
  $(document).mouseup(function (e){
    var div = $(".nav-icon-wrap, .navigation-icons");
    if (!div.is(e.target)
      && div.has(e.target).length === 0) {
        $('#nav-icon, .nav-icon-wrap, .navigation-icons,.navigation').removeClass('open');

        $('body').removeClass('overflow');
    }
  });

  // podmenu
  $('.navigation li.podmenu').click(function(){
    if($(this).hasClass('open')){
      $(this).removeClass('open');
      $('body').removeClass('overflow');
    }else{
      $('.podmenu').removeClass('open');
      $(this).addClass('open');
      $('body').addClass('overflow');
    }
  });
	$(document).on('click', function (e) {
		var div = $(".navigation li.podmenu, .podmenu-block");
		if (!div.is(e.target)
			&& div.has(e.target).length === 0) {
        $('.podmenu').removeClass('open');
        $('body').removeClass('overflow');
        $('.navigation li.podmenu').removeClass('open');
		}
  });
})

