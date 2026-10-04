<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Прайс лист — Мило Ми</title>
    <meta name="description" content="Услуги пространства Мило Ми. Узнайте стоимость массажа, SPA-программ, лазерной эпиляции и косметологии.">
    <meta name="theme-color" content="#F5EEE8">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-page-background font-sans text-text antialiased">
    <header class="site-header h-[92px] border-b border-primary px-[65px] max-md:h-auto max-md:border-b-0 max-md:p-5">
        <div class="flex h-full items-center justify-between">
            <a href="{{ url('/') }}" aria-label="Главная страница" class="header__logo shrink-0">
                <img src="{{ asset('img/logo.svg') }}" alt="Milomi" class="h-[48px] w-auto">
            </a>
            <nav aria-label="Основная навигация" class="header__nav max-md:hidden">
                <ul class="flex items-center gap-8 text-[18px] text-primary">
                    <li><a href="{{ url('/') }}#mission" class="header__nav-link">О НАС</a></li>
                    <li><a href="{{ url('/') }}#services" class="header__nav-link">УСЛУГИ</a></li>
                    <li><a href="{{ route('price-list') }}" class="header__nav-link" aria-current="page">ПРАЙС ЛИСТ</a></li>
                    <li><a href="{{ url('/') }}#special-offers" class="header__nav-link">СПЕЦ.ПРЕДЛОЖЕНИЯ</a></li>
                    <li><a href="#contacts" class="header__nav-link">КОНТАКТЫ</a></li>
                </ul>
            </nav>
            <div class="header__socials flex items-center gap-[11px] max-md:hidden">
                <a href="{{ $contact->telegram_url }}" aria-label="Telegram" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full"><img src="{{ asset('img/telegram.svg') }}" alt="" class="max-h-[29px] max-w-[29px]"></a>
                <a href="{{ $contact->whatsapp_url }}" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full"><img src="{{ asset('img/whatsapp.svg') }}" alt="" class="max-h-[29px] max-w-[29px]"></a>
                <a href="{{ $contact->max_url }}" aria-label="MAX" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full"><img src="{{ asset('img/max.svg') }}" alt="" class="max-h-[29px] max-w-[29px]"></a>
            </div>
            <div class="mobile-header__actions">
                <a href="tel:{{ $contact->phoneLink() }}" class="mobile-header__phone">{{ $contact->phone }}</a>
                <button type="button" class="mobile-header__menu" aria-label="Открыть меню" aria-expanded="false" aria-controls="mobile-menu"><img src="{{ asset('img/burger.svg') }}" alt="" aria-hidden="true"></button>
            </div>
        </div>
    </header>

    <aside id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <button type="button" class="mobile-menu__close" aria-label="Закрыть меню"><img src="{{ asset('img/cross.svg') }}" alt="" aria-hidden="true"></button>
        <nav class="mobile-menu__nav" aria-label="Мобильная навигация">
            <ul class="mobile-menu__list">
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#mission">О нас</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#services">Услуги</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ route('price-list') }}">Прайс лист</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#special-offers">Спецпредложения</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#contacts">Контакты</a></li>
            </ul>
        </nav>
        <div class="mobile-menu__footer"><p class="mobile-menu__message">Наполняем любовью к себе и миру</p></div>
    </aside>

    <main>
        <section class="price-page" aria-labelledby="price-title">
            <h1 id="price-title" class="price-page__title">Прайс лист</h1>

            <div class="price-page__list">
                @foreach ($priceSections as $index => $service)
                    <article id="{{ $service['id'] }}" class="price-page__item">
                        <h2 class="price-page__heading">
                            <button type="button" class="price-page__toggle" aria-expanded="false" aria-controls="price-panel-{{ $index }}">
                                <span>{{ $service['title'] }}</span>
                                <span class="price-page__icon" aria-hidden="true"><span></span><span></span></span>
                            </button>
                        </h2>
                        <div id="price-panel-{{ $index }}" class="price-page__panel" hidden>
                            <div class="price-page__description">{{ $service['description'] }}</div>
                            <div class="price-page__table-wrap">
                                <table @class([
                                    'price-page__table',
                                    'price-page__table--desktop',
                                    'price-page__table--laser' => $service['table_type'] === 'service_price',
                                    'price-page__table--brands' => $service['table_type'] === 'purpose_brand',
                                ])>
                                    <thead>
                                        @if ($service['table_type'] !== 'service_time_price')
                                            @if ($service['table_type'] === 'purpose_brand')
                                                <tr><th scope="col">Назначение</th><th scope="col">Бренд</th></tr>
                                            @else
                                            <tr><th scope="col">Название услуги</th><th scope="col">Стоимость</th></tr>
                                            @endif
                                        @else
                                            <tr><th scope="col">Название услуги</th><th scope="col">Время</th><th scope="col">Стоимость</th></tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                    @if ($service['table_type'] === 'purpose_brand')
                                        @foreach ($service['groups'] as $group)
                                            @foreach ($group['items'] as $brandIndex => $brand)
                                                <tr>
                                                    @if ($brandIndex === 0)
                                                        <td class="price-page__purpose" rowspan="{{ count($group['items']) }}">{{ $group['title'] }}</td>
                                                    @endif
                                                    <td class="price-page__service"><strong>{{ $brand['name'] }}</strong><p>{{ $brand['description'] }}</p></td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @elseif ($service['table_type'] === 'service_price')
                                        @foreach ($service['items'] as $item)
                                            @if (isset($item['category']))
                                                <tr><th class="price-page__category" colspan="2" scope="rowgroup">{{ $item['category'] }}</th></tr>
                                            @endif
                                            <tr><td class="price-page__service">{{ $item['name'] }}</td><td class="price-page__cost">{{ $item['price'] }}</td></tr>
                                        @endforeach
                                    @else
                                        @forelse ($service['items'] as $item)
                                            @if (isset($item['category']))
                                                <tr><th class="price-page__category" colspan="3" scope="rowgroup">{{ $item['category'] }}</th></tr>
                                            @endif
                                            @foreach ($item['variants'] as $variantIndex => $variant)
                                                <tr>
                                                    @if ($variantIndex === 0)
                                                        <td class="price-page__service" rowspan="{{ count($item['variants']) }}">
                                                            @if (!empty($item['description']))
                                                                <strong>{{ $item['name'] }}</strong>
                                                                <p>{{ $item['description'] }}</p>
                                                            @else
                                                                {{ $item['name'] }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                    <td @class(['price-page__time', 'price-page__variant-start' => $variantIndex === 0])>{{ $variant['time'] }}</td>
                                                    <td @class(['price-page__cost', 'price-page__variant-start' => $variantIndex === 0])>{{ $variant['price'] }}</td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr><td class="price-page__service">{{ $service['category'] }}</td><td class="price-page__time">—</td><td class="price-page__cost"><a href="tel:{{ $contact->phoneLink() }}">Уточнить по телефону</a></td></tr>
                                        @endforelse
                                    @endif
                                    </tbody>
                                </table>
                                <div class="price-page__mobile-list">
                                    @if ($service['table_type'] === 'purpose_brand')
                                        @foreach ($service['groups'] as $group)
                                            <section class="price-page__mobile-group">
                                                <h3 class="price-page__category">{{ $group['title'] }}</h3>
                                                @foreach ($group['items'] as $brand)
                                                    <div class="price-page__mobile-entry">
                                                        <strong>{{ $brand['name'] }}</strong>
                                                        <p>{{ $brand['description'] }}</p>
                                                    </div>
                                                @endforeach
                                            </section>
                                        @endforeach
                                    @elseif ($service['table_type'] === 'service_price')
                                        @foreach ($service['items'] as $item)
                                            @if (isset($item['category']))
                                                <h3 class="price-page__category">{{ $item['category'] }}</h3>
                                            @endif
                                            <div class="price-page__mobile-entry price-page__mobile-entry--price">
                                                <span>{{ $item['name'] }}</span><span>{{ $item['price'] }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        @forelse ($service['items'] as $item)
                                            @if (isset($item['category']))
                                                <h3 class="price-page__category">{{ $item['category'] }}</h3>
                                            @endif
                                            <div class="price-page__mobile-entry">
                                                @if (!empty($item['description']))
                                                    <strong>{{ $item['name'] }}</strong>
                                                    <p>{{ $item['description'] }}</p>
                                                @else
                                                    <span>{{ $item['name'] }}</span>
                                                @endif
                                                @foreach ($item['variants'] as $variant)
                                                    <div class="price-page__mobile-variant"><span>{{ $variant['time'] }}</span><span aria-hidden="true">—</span><span>{{ $variant['price'] }}</span></div>
                                                @endforeach
                                            </div>
                                        @empty
                                            <div class="price-page__mobile-entry price-page__mobile-entry--price"><span>{{ $service['category'] }}</span><a href="tel:{{ $contact->phoneLink() }}">Уточнить по телефону</a></div>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="contacts" class="contacts price-page__contacts" aria-labelledby="contacts-title">
            <h2 id="contacts-title" class="contacts__title">Контакты</h2>
            @include('partials.contact-details')
        </section>
        <footer class="site-footer">
            <picture><source media="(max-width: 767px)" srcset="{{ asset('img/footer-text-mobile.webp') }}"><img src="{{ asset('img/footer-text.webp') }}" alt="Приглашаем вас в пространство Мило Ми, где можно наполниться и восстановиться" class="site-footer__invitation"></picture>
        </footer>
    </main>
</body>
</html>
