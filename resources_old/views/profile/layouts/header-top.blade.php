<div class="header-top">
  <div class="container">
    <div class="mobile-header d-flex justify-content-between d-lg-none align-items-center">
      <div class="author">
        <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
      </div>
      <div class="cross-header-bar">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="mobile-header-content d-lg-flex flex-wrap justify-content-lg-between align-items-center">
      <ul class="support-area">
        <li>
          <a href=""><i class="flaticon-support"></i>Support</a>
        </li>
        <li>
          <a href=""><i class="flaticon-email"></i>info@hyipland.com </a>
        </li>
        <li>
          <i class="flaticon-globe"></i>
          <div class="select-area">
            <select class="select-bar" style="display: none;">
              <option value="en">English</option>
              <option value="bn">Bangla</option>
              <option value="sp">Spanish</option>
            </select>
          </div>
        </li>
      </ul>
      <div class="dashboard-header-right d-flex flex-wrap justify-content-center justify-content-sm-between justify-content-lg-end align-items-center">
        <form class="dashboard-header-search mr-sm-4">
          <label for="search"><i class="flaticon-magnifying-glass"></i></label>
          <input type="text" placeholder="Search...">
        </form>
        <ul class="dashboard-right-menus">
          <li>
            <a href="">
              <i class="flaticon-email-1"></i>
              <span class="number bg-theme-2">4</span>
            </a>
            <div class="notification-area">
              <div class="notifacation-header d-flex flex-wrap justify-content-between">
                <span>4 New Notifications</span>
                <a href="">Clear</a>
              </div>
              <ul class="notification-body">
                <li>
                  <a href="">
                    <div class="icon">
                      <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
                    </div>
                    <div class="cont">
                      <span class="title">Robinhood Pandey</span>
                      <div class="message">Electus rem placeat perspiciatis saepe</div>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <div class="icon">
                      <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
                    </div>
                    <div class="cont">
                      <span class="title">Robinhood Pandey</span>
                      <div class="message">Electus rem placeat perspiciatis saepe</div>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <div class="icon">
                      <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
                    </div>
                    <div class="cont">
                      <span class="title">Robinhood Pandey</span>
                      <div class="message">Electus rem placeat perspiciatis saepe</div>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
              </ul>
              <div class="notifacation-footer text-center">
                <a href="" class="view-all">View All</a>
              </div>
            </div>
          </li>
          <li>
            <a href="">
              <i class="flaticon-notification"></i>
              <span class="number bg-theme">4</span>
            </a>
            <div class="notification-area">
              <div class="notifacation-header d-flex flex-wrap justify-content-between">
                <span>4 New Notifications</span>
                <a href="">Clear</a>
              </div>
              <ul class="notification-body">
                <li>
                  <a href="">
                    <div class="icon">
                      <i class="flaticon-man"></i>
                    </div>
                    <div class="cont">
                      <span class="subtitle">New Affiliate Registered</span>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <div class="icon">
                      <i class="flaticon-atm"></i>
                    </div>
                    <div class="cont">
                      <span class="subtitle">New deposit completed</span>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <div class="icon">
                      <i class="flaticon-wallet"></i>
                    </div>
                    <div class="cont">
                      <span class="subtitle">New Withdraw completed</span>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <div class="icon">
                      <i class="flaticon-exchange"></i>
                    </div>
                    <div class="cont">
                      <span class="subtitle">Fund Transfer Completed</span>
                      <span class="info">2 Sec ago</span>
                    </div>
                  </a>
                </li>
              </ul>
              <div class="notifacation-footer text-center">
                <a href="" class="view-all">View All</a>
              </div>
            </div>
          </li>
          <li>
            <a href="#0" class="author">
              <div class="thumb">
                <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
                <span class="checked">
                    <i class="flaticon-checked"></i>
                </span>
              </div>
              <div class="content">
                <h6 class="title">John Doe</h6>
                <span class="country">Indonesia</span>
              </div>
            </a>
            <div class="notification-area">
              <div class="author-header">
                <div class="thumb">
                  <img src="{{ asset('images/dashboard/author.png') }}" alt="dashboard">
                </div>
                <h6 class="title">John Doe</h6>
                <a href="">Johndoe@gmail.com</a>
              </div>
              <div class="author-body">
                <ul>
                  <li>
                    <a href=""><i class="far fa-user"></i>Profile</a>
                  </li>
                  <li>
                    <a href=""><i class="fas fa-user-edit"></i>Edit Profile</a>
                  </li>
                  <li>
                    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>