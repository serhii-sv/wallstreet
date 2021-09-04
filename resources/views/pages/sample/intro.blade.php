<!-- Intro -->
<div id="intro">
  <div class="row">
    <div class="col s12">

      <div id="img-modal" class="modal white" style="height: 480px">
        <div class="modal-content">
          <div class="bg-img-div"></div>
          <p class="modal-header right modal-close">
            Закрыть <span class="right"><i class="material-icons right-align">clear</i></span>
          </p>
          <div class="carousel carousel-slider center intro-carousel">
            <div class="carousel-fixed-item center middle-indicator">
              <div class="left">
                <button
                  class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                  <i class="material-icons">navigate_before</i> <span class="hide-on-small-only">Prev</span>
                </button>
              </div>

              <div class="right">
                <button
                  class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                  <span class="hide-on-small-only">Next</span> <i class="material-icons">navigate_next</i>
                </button>
              </div>
            </div>
            <div class="carousel-item slide-1">
              <img src="{{asset('images/gallery/intro-app.png')}}" alt=""
                class="responsive-img animated fadeInUp slide-1-img">
              <h5 class="intro-step-title mt-7 center animated fadeInUp">Приветствуем вас!</h5>
              <p class="intro-step-text mt-5 animated fadeInUp">Добро пожаловать в {{ config('app.name') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Intro -->
