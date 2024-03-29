$(window).on('load', function () {
  const d = new Date();
  $('.modal').modal({
    'onOpenEnd': initCarouselModal,
  });
  if (d.getDate() == 1 && localStorage.getItem('closeIntroMonth') != d.getMonth()) {
    localStorage.removeItem('showIntro');
    localStorage.setItem('closeIntroMonth', d.getMonth());
  }
  
  setTimeout(function () {
    if (localStorage.getItem('closeIntroMonth') != d.getMonth() && localStorage.getItem('showIntro') == null) {
      $('.modal').modal('open');
    }
  }, 1800)
  
  
  $('.modal-close').click(function () {
    localStorage.setItem('showIntro', '1');
    localStorage.setItem('closeIntroMonth', d.getMonth());
    return true;
  })
  
  $('.btn-next').on('click', function (e) {
    $('.intro-carousel').carousel('next');
  })
  
  $('.btn-prev').on('click', function (e) {
    $('.intro-carousel').carousel('prev');
  })
  
  // Inti carousel when modal pops up
  
  function initCarouselModal() {
    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true,
      onCycleTo: function () {
        
        // When carousel is at it's first step disable prev button
        
        if ($('.carousel-item.active').index() == 1) {
          $('.btn-prev').addClass('disabled');
          
        }
        
        // When carousel is at 2nd or 3rd step
        
        else if ($('.carousel-item.active').index() > 1) {
          
          // activate button
          
          $('.btn-prev').removeClass('disabled');
          $('.btn-next').removeClass('disabled');
          
          // on 3rd step add and remove elements
          
          if ($('.carousel-item.active').index() == 3) {
            $('.btn-next').addClass('disabled');
          }
        }
      }
    })
  }
  
});
