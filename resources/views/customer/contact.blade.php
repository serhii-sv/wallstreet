@extends('layouts.app')
@section('title', __('Contacts'))
@section('content')
  <div class="main--body section-bg">
    <!--========== Preloader ==========-->
  @include('layouts.app-preloader')
  <!--========== Preloader ==========-->
    
    
    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->
    
    
    <!--=======Banner-Section Starts Here=======-->
    <section class="bg_img hero-section-2 left-bottom-lg-max" data-background="{{ asset('images/about/hero-bg5.png') }}">
      <div class="container">
        <div class="hero-content text-white">
          <h1 class="title">Contact</h1>
          <ul class="breadcrumb">
            <li>
              <a href="{{ route('customer.main') }}">Home</a>
            </li>
            <li>
              Contact
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->
    
    
    <!--=======Contact-Section Starts Here=======-->
    <section class="contact-section padding-bottom padding-top">
      <div class="container">
        <div class="contact-wrapper padding-top">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-xl-4 offset-xl-1">
              <div class="contact-header">
                <h2 class="title">Get in touch</h2>
                <p>Ready to make life easier?</p>
              </div>
              <div class="contact-content">
                <h3 class="title">Have questions?</h3>
                <p>
                  Have questions about payments or price plans? We have answers!
                </p>
                <a href="{{ route('customer.faq') }}">Read F.A.Q <i class="flaticon-right-arrow"></i></a>
              </div>
            </div>
            <div class="col-lg-5 offset-xl-1">
              <form class="contact-form" id="contact_form_submit">
                <div class="form-group">
                  <label for="name">First name</label>
                  <input type="text" id="name" placeholder="name" name="name">
                </div>
                <div class="form-group">
                  <label for="surename">Last name</label>
                  <input type="text" id="surename" placeholder="surename" name="name">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="text" id="email" placeholder="Enter your email" name="email">
                </div>
                <div class="form-group">
                  <label for="message">How can we help</label>
                  <textarea name="message" id="message" placeholder="Enter Message"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Send Message">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Contact-Section Ends Here=======-->
    
    
    <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->
  
  
  </div>
@endsection
