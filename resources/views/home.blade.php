<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Мило Ми — пространство заботы о себе</title>
    <meta name="description" content="Мило Ми — пространство заботы о себе: SPA-программы, массаж, косметология и лазерная эпиляция в атмосфере спокойствия и комфорта.">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#F5EEE8">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="Мило Ми">
    <meta property="og:title" content="Мило Ми — пространство заботы о себе">
    <meta property="og:description" content="SPA-программы, массаж, косметология и лазерная эпиляция в атмосфере спокойствия и комфорта.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/og-image.jpg') }}">
    <meta property="og:image:secure_url" content="{{ asset('img/og-image.jpg') }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Мило Ми — пространство заботы о себе">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Мило Ми — пространство заботы о себе">
    <meta name="twitter:description" content="SPA-программы, массаж, косметология и лазерная эпиляция в атмосфере спокойствия и комфорта.">
    <meta name="twitter:image" content="{{ asset('img/og-image.jpg') }}">
    <meta name="twitter:image:alt" content="Мило Ми — пространство заботы о себе">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.30.0/mapbox-gl.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.30.0/mapbox-gl.js"></script>
</head>
<body class="min-h-screen bg-page-background font-sans text-text antialiased">
    <header class="site-header h-[92px] border-b border-primary px-[65px] max-md:h-auto max-md:border-b-0 max-md:p-5">
        <div class="flex h-full items-center justify-between">
            <a href="/" aria-label="Главная страница" class="header__logo shrink-0">
                <img src="{{ asset('img/logo.svg') }}" alt="Milomi" class="h-[48px] w-auto">
            </a>

            <nav aria-label="Основная навигация" class="header__nav max-md:hidden">
                <ul class="flex items-center gap-8 text-[18px] text-primary">
                    <li><a href="#mission" class="header__nav-link">О НАС</a></li>
                    <li><a href="#services" class="header__nav-link">УСЛУГИ</a></li>
                    <li><a href="{{ route('price-list') }}" class="header__nav-link">ПРАЙС ЛИСТ</a></li>
                    <li><a href="#special-offers" class="header__nav-link">СПЕЦ.ПРЕДЛОЖЕНИЯ</a></li>
                    <li><a href="#reviews" class="header__nav-link">ОТЗЫВЫ</a></li>
                    <li><a href="#contacts" class="header__nav-link">КОНТАКТЫ</a></li>
                </ul>
            </nav>

            <div class="header__socials flex items-center gap-[11px] max-md:hidden">
                <a href="{{ $contact->telegram_url }}" aria-label="Telegram" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/telegram.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
                <a href="{{ $contact->whatsapp_url }}" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/whatsapp.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
                <a href="{{ $contact->max_url }}" aria-label="MAX" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/max.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
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
        <button type="button" class="mobile-menu__close" aria-label="Закрыть меню">
            <img src="{{ asset('img/cross.svg') }}" alt="" aria-hidden="true">
        </button>

        <nav class="mobile-menu__nav" aria-label="Мобильная навигация">
            <ul class="mobile-menu__list">
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#mission">О нас</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#services">Услуги</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="{{ route('price-list') }}">Прайс лист</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#special-offers">Спецпредложения</a></li>
                <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true"><a href="#reviews">Отзывы</a></li>
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
        <section class="mobile-hero" aria-labelledby="mobile-hero-title">
            <div class="mobile-hero__banner">
                <img src="{{ asset('img/top-banner-mob.webp') }}" alt="Интерьер пространства Мило Ми" class="mobile-hero__image">
                <div class="mobile-hero__banner-content">
                    <h1 id="mobile-hero-title" class="mobile-hero__title">Пространство заботы о себе — Мило Ми</h1>
                    <a href="{{ $contact->online_booking_url }}" target="_blank" rel="noopener noreferrer" class="hero__button mobile-hero__button">
                        <span>Запись онлайн</span>
                        <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
                    </a>
                </div>
            </div>

            <div class="marquee mobile-hero__marquee" aria-label="SPA, массаж, косметология, лазерная эпиляция">
                <div class="marquee__track" aria-hidden="true">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="marquee__set">
                        <span>SPA</span><span class="marquee__separator">•</span>
                        <span>МАССАЖ</span><span class="marquee__separator">•</span>
                        <span>КОСМЕТОЛОГИЯ</span><span class="marquee__separator">•</span>
                        <span>ЛАЗЕРНАЯ ЭПИЛЯЦИЯ</span><span class="marquee__separator">•</span>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="mobile-hero__intro">
                <p class="mobile-hero__description">
                    «Milo Mi в переводе означает приятно. В этом названии — философия нашего пространства.
                    Мы верим, что истинная забота проявляется в деталях: в тёплой атмосфере, искреннем
                    внимании и ощущении комфорта, которое сопровождает вас с первых минут.»
                </p>
                <p class="mobile-hero__quote">— Мария, основательница пространства</p>
            </div>

            <img src="{{ asset('img/top-photo.webp') }}" alt="Основательница пространства Мило Ми" class="mobile-hero__photo">
        </section>

        <section class="hero desktop-hero" aria-labelledby="hero-title">
            <div class="hero__content">
                <h1 id="hero-title" class="hero__title">Пространство заботы о себе — Мило Ми</h1>

                <p class="hero__description">
                    Milo Mi в переводе означает приятно. В этом названии — философия нашего пространства.
                    Мы верим, что истинная забота проявляется в деталях: в тёплой атмосфере, искреннем
                    внимании и ощущении комфорта, которое сопровождает вас с первых минут.
                </p>

                <p class="hero__quote">— Мария, основательница пространства.</p>

                <a href="{{ $contact->online_booking_url }}" target="_blank" rel="noopener noreferrer" class="hero__button">
                    <span>Запись онлайн</span>
                    <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
                </a>
            </div>

            <div class="hero__image-wrap">
                <img src="{{ asset('img/top-banner.webp') }}" alt="Интерьер пространства Мило Ми" class="hero__image">
            </div>

            <img src="{{ asset('img/top-photo.webp') }}" alt="Основательница пространства Мило Ми" class="hero__photo">
        </section>

        <section class="marquee desktop-hero-marquee" aria-label="SPA, массаж, косметология, лазерная эпиляция">
            <div class="marquee__track" aria-hidden="true">
                @for ($i = 0; $i < 4; $i++)
                <div class="marquee__set">
                    <span>SPA</span><span class="marquee__separator">•</span>
                    <span>МАССАЖ</span><span class="marquee__separator">•</span>
                    <span>КОСМЕТОЛОГИЯ</span><span class="marquee__separator">•</span>
                    <span>ЛАЗЕРНАЯ ЭПИЛЯЦИЯ</span><span class="marquee__separator">•</span>
                </div>
                @endfor
            </div>
        </section>

        <section id="mission" class="mission" aria-labelledby="mission-title">
            <img src="{{ asset('img/heart-title.webp') }}" alt="" aria-hidden="true" class="mission__background mission__background--desktop">
            <img src="{{ asset('img/top-heart-mob.webp') }}" alt="" aria-hidden="true" class="mission__background mission__background--mobile">
            <div class="mission__content">
                <h2 id="mission-title" class="mission__title">НАША МИССИЯ</h2>
                <p class="mission__description">
                    Наша миссия — создавать пространство уюта, заботы и внутренней гармонии, где каждая
                    гостья чувствует себя особенной. Здесь о вас думают заранее. Мы создаём атмосферу
                    спокойствия, безопасности и маленьких радостей, которые делают каждый визит
                    по-настоящему приятным.
                </p>
            </div>
        </section>

        <section class="gallery-carousel" aria-label="Атмосфера пространства Мило Ми">
            <div class="swiper gallery-carousel__swiper">
                <div class="swiper-wrapper">
                    @foreach ([1, 2] as $set)
                        @foreach ([1, 2, 3] as $image)
                    <div class="swiper-slide gallery-carousel__slide" @if ($set === 2) aria-hidden="true" @endif>
                        <img
                            src="{{ asset("img/carusel-img/{$image}.webp") }}"
                            alt="{{ $set === 1 ? 'Атмосфера пространства Мило Ми' : '' }}"
                            class="gallery-carousel__image"
                        >
                    </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>

        <section class="details" aria-labelledby="details-title">
            <div class="details__content">
                <img src="{{ asset('img/bow.svg') }}" alt="" aria-hidden="true" class="details__bow">

                <div class="details__text">
                    <h2 id="details-title" class="details__title">Мы заботимся о деталях</h2>
                    <p class="details__description">
                        Каждая деталь нашего пространства продумана с любовью — чтобы вы могли расслабиться,
                        восстановить силы и насладиться временем, посвящённым себе.
                    </p>
                </div>

                <img src="{{ asset('img/photo-2.webp') }}" alt="Гостья пространства Мило Ми" class="details__photo">

                <div class="details__media-mobile">
                    <img src="{{ asset('img/bow.svg') }}" alt="" aria-hidden="true" class="details__media-bow">
                    <img src="{{ asset('img/photo-2.webp') }}" alt="Гостья пространства Мило Ми" class="details__media-photo">
                    <img src="{{ asset('img/bow.svg') }}" alt="" aria-hidden="true" class="details__media-bow">
                </div>

                <ul class="details__list">
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Атмосфера спокойствия</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Профессиональные мастера</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Напитки, угощения</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Премиальная косметика</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Эстетика в каждой детали</li>
                </ul>
            </div>
        </section>

        <section id="services" class="services" aria-labelledby="services-title">
            <h2 id="services-title" class="services__title">В НАШЕМ ПРОСТРАНСТВЕ ВАС ЖДУТ:</h2>

            <div class="services__grid services__swiper services__desktop swiper">
                <div class="swiper-wrapper">
                @foreach ($homeServices as $service)
                    <article class="service-card swiper-slide">
                        <img src="{{ $service['image_url'] }}" alt="{{ $service['title'] }}" class="service-card__image">
                        <div class="service-card__content">
                            <div class="service-card__text">
                                <h3 class="service-card__title">{{ $service['title'] }}</h3>
                                <p class="service-card__description">{{ $service['description'] }}</p>
                            </div>
                            <a href="{{ route('price-list') . '#' . $service['id'] }}" class="service-card__link">
                                <span>ПОДРОБНЕЕ</span>
                                <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                            </a>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>

            <div class="services__mobile-list" aria-label="Услуги">
                @foreach ($homeServices as $service)
                    <article class="service-card">
                        <img src="{{ $service['image_url'] }}" alt="{{ $service['title'] }}" class="service-card__image">
                        <div class="service-card__content">
                            <div class="service-card__text">
                                <h3 class="service-card__title">{{ $service['title'] }}</h3>
                                <p class="service-card__description">{{ $service['description'] }}</p>
                            </div>
                            <a href="{{ route('price-list') . '#' . $service['id'] }}" class="service-card__link">
                                <span>ПОДРОБНЕЕ</span>
                                <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="services__navigation reviews__navigation" aria-label="Навигация по услугам">
                <button type="button" class="reviews__button reviews__button--previous services__button--previous" aria-label="Предыдущая услуга">
                    <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                </button>
                <button type="button" class="reviews__button services__button--next" aria-label="Следующая услуга">
                    <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                </button>
            </div>
        </section>

        <section class="marquee marquee--special" aria-label="Special for you">
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

        <section id="special-offers" class="special-offers" aria-labelledby="special-offers-title">
            <h2 id="special-offers-title" class="special-offers__title">Специальные предложения</h2>

            <div class="special-offers__grid">
                @foreach ($specialOffers as $offer)
                    <article class="special-offer">
                        <img src="{{ $offer['image_url'] }}" alt="" aria-hidden="true" class="special-offer__image">
                        <div class="special-offer__content">
                            <div>
                                <h3 class="special-offer__title">{{ $offer['title'] }}</h3>
                                <p class="special-offer__description">{{ $offer['description'] }}</p>
                            </div>
                            <a href="{{ route('special-offers.show', $offer['slug']) }}" class="special-offer__link">
                                <span>ПОДРОБНЕЕ</span>
                                <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <a href="{{ $contact->online_booking_url }}" target="_blank" rel="noopener noreferrer" class="hero__button special-offers__booking">
                <span>Запись онлайн</span>
                <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
            </a>
        </section>

        <section id="reviews" class="reviews" aria-labelledby="reviews-title">
            <h2 id="reviews-title" class="reviews__title">Отзывы наших гостей</h2>

            <div class="swiper reviews__swiper">
                <div class="swiper-wrapper">
                    @foreach ($reviews as $review)
                        <div class="swiper-slide reviews__slide">
                            <article class="review-card">
                                <img
                                    src="{{ $review['image_url'] }}"
                                    alt="Отзыв гостя Мило Ми"
                                    class="review-card__image"
                                >
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="reviews__navigation" aria-label="Навигация по отзывам">
                <button type="button" class="reviews__button reviews__button--previous" aria-label="Предыдущий отзыв">
                    <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                </button>
                <button type="button" class="reviews__button reviews__button--next" aria-label="Следующий отзыв">
                    <img src="{{ asset('img/arrow.svg') }}" alt="" aria-hidden="true">
                </button>
            </div>
        </section>

        <section class="invitation-envelope" aria-label="Приглашение в пространство Мило Ми">
            <img
                src="{{ asset('img/evenlope-background.webp') }}"
                alt=""
                aria-hidden="true"
                class="invitation-envelope__background"
            >
            <img
                src="{{ asset('img/sertificate-milo.webp') }}"
                alt="Подарочный сертификат Мило Ми"
                class="invitation-envelope__image"
            >
        </section>

        <section class="gift-certificate" aria-labelledby="gift-certificate-title">
            <div class="gift-certificate__content">
                <h2 class="gift-certificate__eyebrow">Подарочный сертификат</h2>
                <h2 id="gift-certificate-title" class="gift-certificate__title">Подарите приятные эмоции</h2>
                <p class="gift-certificate__description">
                    Сертификат можно оформить на любую услугу или определённую сумму, оставив выбор получателю.
                    Можем подготовить в электронном или бумажном виде.
                </p>
                <a href="{{ $contact->max_url }}" target="_blank" rel="noopener noreferrer" class="hero__button gift-certificate__button">
                    <span>Приобрести сертификат</span>
                    <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
                </a>
            </div>
        </section>

        <section class="marquee marquee--after-envelope" aria-label="SPA, массаж, косметология, лазерная эпиляция">
            <div class="marquee__track" aria-hidden="true">
                @for ($i = 0; $i < 4; $i++)
                <div class="marquee__set">
                    <span>SPA</span><span class="marquee__separator">•</span>
                    <span>МАССАЖ</span><span class="marquee__separator">•</span>
                    <span>КОСМЕТОЛОГИЯ</span><span class="marquee__separator">•</span>
                    <span>ЛАЗЕРНАЯ ЭПИЛЯЦИЯ</span><span class="marquee__separator">•</span>
                </div>
                @endfor
            </div>
        </section>

        <div id="map" class="contacts-map" role="application" aria-label="Карта расположения пространства Мило Ми"
             data-mapbox-token="{{ config('services.mapbox.public_token') }}"
             data-latitude="{{ $contact->latitude }}" data-longitude="{{ $contact->longitude }}" data-address="{{ $contact->address }}"></div>

        <section id="contacts" class="contacts" aria-labelledby="contacts-title">
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

    <script>
        if (window.matchMedia('(max-width: 1023px)').matches) {
            document.querySelectorAll('.desktop-hero, .desktop-hero-marquee').forEach((element) => element.remove());
        }
    </script>
</body>
</html>
