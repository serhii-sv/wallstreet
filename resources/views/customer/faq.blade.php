@extends('layouts.app')
@section('title', __('FAQ'))
@section('content')
  <div class="main--body">
    <!--========== Preloader ==========-->
  @include('layouts.app-preloader')
  <!--========== Preloader ==========-->
    
    
    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->
    
    
    <!--=======Banner-Section Starts Here=======-->
    <section class="bg_img hero-section-2" data-background="{{ asset('images/about/hero-bg3.jpg') }}">
      <div class="container">
        <div class="hero-content text-white">
          <h1 class="title">faq</h1>
          <ul class="breadcrumb">
            <li>
              <a href="{{ route('customer.main') }}">Home</a>
            </li>
            <li>
              faq
            </li>
          </ul>
        </div>
      </div>
      <div class="hero-shape">
        <img class="wow slideInUp" src="{{ asset('images/about/hero-shape1.png') }}" alt="about" data-wow-duration="1s">
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->
    
    
    <!--=======Feature-Section Starts Here=======-->
    <section class="faq-section padding-top padding-bottom mb-xl-5">
      <div class="ball-group-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('images/balls/ball-group7.png') }}" alt="balls">
      </div>
      <div class="ball-group-2 rtl" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('images/balls/ball-group8.png') }}" alt="balls">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="section-header">
              <span class="cate">You have questions</span>
              <h2 class="title">
                we have answers
              </h2>
              <p class="mw-100">
                Do not hesitate to send us an email if you can't find what you're looking for.
              </p>
            </div>
          </div>
        </div>
        <div class="tab faq-tab">
          <ul class="tab-menu">
            <li>BASIC</li>
            <li class="active">FINANCIAL</li>
            <li>Affiliate</li>
          </ul>
          <div class="tab-area">
            <div class="tab-item">
              <div class="faq-wrapper">
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What is the minimum percentage that an investor can earn on Hyipland?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item active open">
                  <div class="faq-title">
                    <h5 class="title">Can i invest using cryptocurrency?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What are the minimum and maximum deposit amounts?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">How long will the money arrive in my account after the withdrawal process?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What payment system can i use to withdraw?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-item active">
              <div class="faq-wrapper">
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What is the minimum percentage that an investor can earn on Hyipland?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item active open">
                  <div class="faq-title">
                    <h5 class="title">Can i invest using cryptocurrency?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What are the minimum and maximum deposit amounts?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">How long will the money arrive in my account after the withdrawal process?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What payment system can i use to withdraw?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-item">
              <div class="faq-wrapper">
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What is the minimum percentage that an investor can earn on Hyipland?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item active open">
                  <div class="faq-title">
                    <h5 class="title">Can i invest using cryptocurrency?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What are the minimum and maximum deposit amounts?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">How long will the money arrive in my account after the withdrawal process?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
                <div class="faq-item">
                  <div class="faq-title">
                    <h5 class="title">What payment system can i use to withdraw?</h5>
                    <span class="right-icon"></span>
                  </div>
                  <div class="faq-content">
                    <p>
                      Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Feature-Section Ends Here=======-->
    
    <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->
  
  
  </div>

@endsection
