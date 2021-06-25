@extends('profile.layouts.customer')
@section('title', __('Promo'))
@section('content')
<section class="lk-section">
    <div class="referral-link">
        <div class="referral-link__col">
            <h3 class="title">{{ __('Your referral link') }}
            </h3>
            <div class="input-row"><input class="input-row__input input input--accent2" value="{{ getUserReferralLink() }}" type="text"/>
            </div>
        </div>
    </div>
    <div class="referral-banners">
        <div class="referral-banners__row">
            <div class="referral-banners__info">
                <p class="referral-banners__name">{{ __('Banner') }}
                </p>
                <p class="referral-banners__size">768x90
                </p><a class="referral-banners__link" href="/img/banners/banner768.gif">{{ __('Download') }}</a>
            </div>
            <div class="referral-banners__content"><img src="/img/banners/banner768.gif" alt="">
            </div>
        </div>
        <div class="referral-banners__row">
            <code class="referral-banners__code">&lt;a href="{{ getUserReferralLink() }}"&gt;&lt;img src="https://luminex.biz/img/banners/banner768.gif" alt="Luminex"&gt;&lt;/a&gt;</code>
        </div>
        <div class="referral-banners__row">
            <div class="referral-banners__info">
                <p class="referral-banners__name">{{ __('Banner') }}
                </p>
                <p class="referral-banners__size">468x60
                </p><a class="referral-banners__link" href="/img/banners/banner468.gif">{{ __('Download') }}</a>
            </div>
            <div class="referral-banners__content"><img src="/img/banners/banner468.gif" alt="">
            </div>
        </div>
        <div class="referral-banners__row">
            <code class="referral-banners__code">&lt;a href="{{ getUserReferralLink() }}"&gt;&lt;img src="https://luminex.biz/img/banners/banner468.gif" alt="Luminex"&gt;&lt;/a&gt;</code>
        </div>
        <div class="referral-banners__row">
            <div class="referral-banners__info">
                <p class="referral-banners__name">{{ __('Banner') }}
                </p>
                <p class="referral-banners__size">125x125
                </p><a class="referral-banners__link" href="/img/banners/banner125.gif">{{ __('Download') }}</a>
            </div>
            <div class="referral-banners__content"><img src="/img/banners/banner125.gif" alt="">
            </div>
        </div>
        <div class="referral-banners__row">
            <code class="referral-banners__code">&lt;a href="{{ getUserReferralLink() }}"&gt;&lt;img src="https://luminex.biz/img/banners/banner125.gif" alt="Luminex"&gt;&lt;/a&gt;</code>
        </div>
    </div>
</section>

<script>document.getElementById("promoProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection
