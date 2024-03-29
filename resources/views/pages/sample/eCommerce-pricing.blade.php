{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', '')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
  <div class="col s12 m12 l12">
    <div id="basic-tabs" class="card card card-default scrollspy">
      <div class="card-content">
        <h4 class="card-title">Pricing tables style 1</h4>
        <div class="row">
          <div class="col s12">
            <p>When you click on each tab, only the container with the corresponding tab id will become visible.</p>
          </div>
          <div class="col s12">
            <div class="row">
              <div class="col s12">
                <h4 class="header">Pricing tables style 1</h4>
              </div>
              <div class="plans-container">
                <div class="col s12 m6 l4">
                  <div class="card hoverable animate fadeLeft">
                    <div class="card-image gradient-45deg-light-blue-cyan waves-effect">
                      <div class="card-title">BASIC</div>
                      <div class="price">
                        <sup>$</sup>19
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Free 1 month</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">500 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">1 users</li>
                        <li class="collection-item">First 15 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light gradient-45deg-indigo-purple gradient-shadow btn">Select
                        Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card z-depth-1 hoverable animate fadeUp">
                    <div class="card-image gradient-45deg-red-pink waves-effect">
                      <div class="card-title">PROFESSIONAL</div>
                      <div class="price">
                        <sup>$</sup>29
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Most Popular</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">2000 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">10 users</li>
                        <li class="collection-item">First 30 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light gradient-45deg-indigo-purple gradient-shadow btn">Select
                        Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card hoverable animate fadeRight">
                    <div class="card-image gradient-45deg-amber-amber accent-2 waves-effect">
                      <div class="card-title">PREMIUM</div>
                      <div class="price">
                        <sup>$</sup>49
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Get 20% off</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">10,000 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">Unlimited users</li>
                        <li class="collection-item">First 90 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light gradient-45deg-indigo-purple gradient-shadow btn">Select
                        Plan</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col s12">
                <br>
                <br>
                <div class="divider"></div>
                <h4 class="header">Pricing tables style 1</h4>
              </div>
              <div class="plans-container">
                <div class="col s12 m6 l4">
                  <div class="card hoverable animate fadeLeft">
                    <div class="card-image cyan waves-effect">
                      <div class="card-title">BASIC</div>
                      <div class="price">
                        <sup>$</sup>19
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Free 1 month</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">500 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">1 users</li>
                        <li class="collection-item">First 15 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light  btn">Select Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card z-depth-1 hoverable animate fadeUp">
                    <div class="card-image red accent-2 waves-effect">
                      <div class="card-title">PROFESSIONAL</div>
                      <div class="price">
                        <sup>$</sup>29
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Most Popular</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">2000 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">10 users</li>
                        <li class="collection-item">First 30 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light  btn">Select Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card hoverable animate fadeRight">
                    <div class="card-image deep-orange accent-2 waves-effect">
                      <div class="card-title">PREMIUM</div>
                      <div class="price">
                        <sup>$</sup>49
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Get 20% off</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">10,000 emails</li>
                        <li class="collection-item">Unlimited data</li>
                        <li class="collection-item">Unlimited users</li>
                        <li class="collection-item">First 90 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light  btn">Select Plan</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col s12">
                <br>
                <br>
                <div class="divider"></div>
                <h4 class="header">Pricing tables style 3</h4>
              </div>
              <div class="plans-container">
                <div class="col s12 m6 l4">
                  <div class="card z-depth-1 animate fadeLeft">
                    <div class="card-image teal waves-effect">
                      <div class="card-title">BASIC</div>
                      <div class="price">
                        <sup>$</sup>19
                        <sub>/ <span>mo</span></sub>
                      </div>
                      <div class="price-desc">Free 1 month</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">500 emails</li>
                        <li class="collection-item">unlimited data</li>
                        <li class="collection-item">1 users</li>
                        <li class="collection-item">First 15 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light light-blue btn">Select Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card z-depth-2 animate fadeUp">
                    <div class="card-image teal darken-1 waves-effect">
                      <div class="card-title">PROFESSIONAL</div>
                      <div class="price">
                        <sup>$</sup>29
                        <sub>/ <span>mo</span></sub>
                      </div>
                      <div class="price-desc">Most Popular</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">2000 emails</li>
                        <li class="collection-item">unlimited data</li>
                        <li class="collection-item">10 users</li>
                        <li class="collection-item">First 30 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light light-blue btn">Select Plan</button>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l4">
                  <div class="card z-depth-3 animate fadeRight">
                    <div class="card-image teal darken-2 waves-effect">
                      <div class="card-title">PREMIUM</div>
                      <div class="price">
                        <sup>$</sup>49
                        <sub>/<span>mo</span></sub>
                      </div>
                      <div class="price-desc">Get 20% off</div>
                    </div>
                    <div class="card-content">
                      <ul class="collection">
                        <li class="collection-item">10,000 emails</li>
                        <li class="collection-item">unlimited data</li>
                        <li class="collection-item">unlimited users</li>
                        <li class="collection-item">First 90 day free</li>
                      </ul>
                    </div>
                    <div class="card-action center-align">
                      <button class="waves-effect waves-light light-blue btn">Select Plan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
