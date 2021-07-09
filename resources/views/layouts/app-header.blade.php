<header class="header-section">
  <div class="header-top">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6">
          <ul class="support-area">
            <li>
              <a href="#0"><i class="flaticon-support"></i>Support</a>
            </li>
            <li>
              <a href="Mailto:info@hyipland.com"><i class="flaticon-email"></i>info@hyipland.com</a>
            </li>
          </ul>
        </div>
        <div class="col-6">
          <ul class="cart-area">
            <li>
              <i class="flaticon-globe"></i>
              <div class="select-area">
                <select class="select-bar">
                  <option value="en">English</option>
                  <option value="bn">Bangla</option>
                  <option value="sp">Spanish</option>
                </select>
              </div>
            </li>
            <li>
              <a href="{{ route('login') }}">Sign In</a>
            </li>
            <li>
              <a href="{{ route('register') }}">Sign Up</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom">
    <div class="container">
      <div class="header-area">
        <div class="logo">
          <a href="{{ route('customer.main') }}">
            <img src="{{ asset('images/logo/logo.png') }}" alt="logo">
          </a>
        </div>
        <ul class="menu">
          <li>
            <a href="{{ route('customer.main') }}">Home</a>
          </li>
          <li>
            <a href="{{ route('profile.profile') }}">Dashboard</a>
          </li>
          <li>
            <a href="{{ route('customer.aboutus') }}">About</a>
          </li>
          <li>
            <a href="{{ route('customer.partners') }}">Affiliate</a>
          </li>
          <li>
            <a href="">Plan</a>
          </li>
          <li>
            <a href="{{ route('customer.faq') }}">Faqs</a>
          </li>
          <li>
            <a href="{{ route('customer.contact') }}">Contact</a>
          </li>
          <li class="pr-0">
            <a href="{{ route('login') }}" class="custom-button">Join Us</a>
          </li>
        </ul>
        <div class="header-bar d-lg-none">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </div>
</header>