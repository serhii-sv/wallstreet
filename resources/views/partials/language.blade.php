<div class="language">
    <p class="language__name"><span>{{ session('lang') }}</span></p>
    <ul class="language__list">
        <li class="language__item">
            <a href="{{ route('set.lang', ['locale' => 'ru']) }}"><button class="language__button">RU</button></a>
        </li>
        <li class="language__item">
            <a href="{{ route('set.lang', ['locale' => 'en']) }}"><button class="language__button">EN</button></a>
        </li>
    </ul>
</div>