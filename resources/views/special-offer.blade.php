<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>{{ $offer['title'] }} — Мило Ми</title>
    <meta name="description" content="{{ $offer['description'] }} в пространстве заботы о себе Мило Ми, Калининград.">
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
                    <li><a href="{{ url('/') }}#special-offers" class="header__nav-link">СПЕЦ.ПРЕДЛОЖЕНИЯ</a></li>
                    <li><a href="{{ url('/') }}#reviews" class="header__nav-link">ОТЗЫВЫ</a></li>
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
                <button type="button" class="mobile-header__menu" aria-label="Открыть меню" aria-expanded="false" aria-controls="mobile-menu">
                    <img src="{{ asset('img/burger.svg') }}" alt="" aria-hidden="true">
                </button>
            </div>
        </div>
    </header>

    <aside id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <button type="button" class="mobile-menu__close" aria-label="Закрыть меню"><img src="{{ asset('img/cross.svg') }}" alt="" aria-hidden="true"></button>
        <nav class="mobile-menu__nav" aria-label="Мобильная навигация">
            <ul class="mobile-menu__list">
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#mission">О нас</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#services">Услуги</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#special-offers">Спецпредложения</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ url('/') }}#reviews">Отзывы</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#contacts">Контакты</a></li>
            </ul>
        </nav>
        <div class="mobile-menu__footer">
            <p class="mobile-menu__message">Наполняем любовью к себе и миру</p>
            <div class="mobile-menu__socials">
                <a href="{{ $contact->telegram_url }}" aria-label="Telegram" target="_blank" rel="noopener noreferrer" class="mobile-menu__social-link"><img src="{{ asset('img/telegram.svg') }}" alt=""></a>
                <a href="{{ $contact->whatsapp_url }}" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer" class="mobile-menu__social-link"><img src="{{ asset('img/whatsapp.svg') }}" alt=""></a>
                <a href="{{ $contact->max_url }}" aria-label="MAX" target="_blank" rel="noopener noreferrer" class="mobile-menu__social-link"><img src="{{ asset('img/max.svg') }}" alt=""></a>
            </div>
        </div>
    </aside>

    <main>
        <section class="special-offer-page" aria-labelledby="special-offer-page-title">
            <img src="{{ $offer['image'] }}" alt="" aria-hidden="true" class="special-offer-page__background">
            <div class="special-offer-page__content">
                <h1 id="special-offer-page-title" class="special-offer-page__title">{{ $offer['title'] }}</h1>
                <p class="special-offer-page__description">{{ $offer['description'] }}</p>
                <div class="special-offer-page__actions">
                    <a href="{{ $contact->online_booking_url }}" target="_blank" rel="noopener noreferrer" class="special-offer-page__button special-offer-page__button--online">
                        <span>Запись онлайн</span>
                        <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
                    </a>
                    <a href="tel:{{ $contact->phoneLink() }}" class="special-offer-page__button special-offer-page__button--phone">Позвонить</a>
                </div>
            </div>
        </section>

        <section class="marquee marquee--special special-offer-page__marquee" aria-label="Special for you">
            <div class="marquee__track" aria-hidden="true">
                @for ($i = 0; $i < 4; $i++)
                    <div class="marquee__set">
                        @for ($j = 0; $j < 4; $j++)
                            <span>SPECIAL FOR YOU</span><span class="marquee__separator">•</span>
                        @endfor
                    </div>
                @endfor
            </div>
        </section>

        <section class="special-usage" aria-labelledby="special-usage-title">
            <div class="special-usage__content">
                <h2 id="special-usage-title" class="special-usage__title">Как воспользоваться предложением</h2>
                <ul class="details__list special-usage__list">
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Выберите интересующую вас процедуру</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Запишитесь онлайн или свяжитесь с администратором</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">При записи сообщите, что хотите воспользоваться специальным предложением</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Получите скидку при первом посещении</li>
                </ul>
            </div>
        </section>

        <section class="mission special-attention" aria-labelledby="special-attention-title">
            <img src="{{ asset('img/special-attention.webp') }}" alt="" aria-hidden="true" class="mission__background">
            <div class="mission__content">
                <h2 id="special-attention-title" class="mission__title">Важно</h2>
                <p class="mission__description">Специальные предложения действуют только для<br>новых гостей и применяются при соблюдении<br>условий акции. Скидки не суммируются с другими<br>специальными предложениями.</p>
            </div>
        </section>

        <section id="contacts" class="contacts special-offer-contacts" aria-labelledby="contacts-title">
            <h2 id="contacts-title" class="contacts__title">Контакты</h2>
            @include('partials.contact-details')
        </section>

        <footer class="site-footer">
            <picture>
                <source media="(max-width: 767px)" srcset="{{ asset('img/footer-text-mobile.webp') }}">
                <img src="{{ asset('img/footer-text.webp') }}" alt="Приглашаем вас в пространство Мило Ми, где можно наполниться и восстановиться" class="site-footer__invitation">
            </picture>
        </footer>
    </main>
</body>
</html>
