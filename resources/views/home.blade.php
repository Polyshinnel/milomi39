<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Milomi') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-page-background font-sans text-text antialiased">
    <header class="h-[92px] border-b border-primary px-[65px]">
        <div class="flex h-full items-center justify-between">
            <a href="/" aria-label="Главная страница" class="shrink-0">
                <img src="{{ asset('img/logo.svg') }}" alt="Milomi" class="h-[48px] w-auto">
            </a>

            <nav aria-label="Основная навигация">
                <ul class="flex items-center gap-8 text-[18px] text-primary">
                    <li><a href="#about" class="header__nav-link">О НАС</a></li>
                    <li><a href="#services" class="header__nav-link">УСЛУГИ</a></li>
                    <li><a href="#special-offers" class="header__nav-link">СПЕЦ.ПРЕДЛОЖЕНИЯ</a></li>
                    <li><a href="#reviews" class="header__nav-link">ОТЗЫВЫ</a></li>
                    <li><a href="#contacts" class="header__nav-link">КОНТАКТЫ</a></li>
                </ul>
            </nav>

            <div class="flex items-center gap-[11px]">
                <a href="#" aria-label="Telegram" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/telegram.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
                <a href="#" aria-label="WhatsApp" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/whatsapp.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
                <a href="#" aria-label="MAX" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/max.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero__content">
                <h1 id="hero-title" class="hero__title">Пространство заботы о себе — Мило Ми</h1>

                <p class="hero__description">
                    Milo Mi в переводе означает приятно. В этом названии — философия нашего пространства.
                    Мы верим, что истинная забота проявляется в деталях: в тёплой атмосфере, искреннем
                    внимании и ощущении комфорта, которое сопровождает вас с первых минут.
                </p>

                <p class="hero__quote">— Мария, основательница пространства.</p>

                <a href="#booking" class="hero__button">
                    <span>Запись онлайн</span>
                    <img src="{{ asset('img/heart.svg') }}" alt="" aria-hidden="true">
                </a>
            </div>

            <div class="hero__image-wrap">
                <img src="{{ asset('img/top-banner.webp') }}" alt="Интерьер пространства Мило Ми" class="hero__image">
            </div>

            <img src="{{ asset('img/top-photo.webp') }}" alt="Основательница пространства Мило Ми" class="hero__photo">
        </section>

        <section class="marquee" aria-label="SPA, массаж, косметология, лазерная эпиляция">
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

        <section class="mission" aria-labelledby="mission-title">
            <img src="{{ asset('img/heart-title.webp') }}" alt="" aria-hidden="true" class="mission__background">
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

                <ul class="details__list">
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Атмосфера спокойствия</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Профессиональные мастера</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Напитки, угощения</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Премиальная косметика</li>
                    <li><img src="{{ asset('img/heart-dark.svg') }}" alt="" aria-hidden="true">Эстетика в каждой детали</li>
                </ul>
            </div>
        </section>
    </main>
</body>
</html>
