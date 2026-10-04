<div class="contacts__content">
    <img src="{{ asset('img/contact-photo-new.webp') }}" alt="Гостья пространства Мило Ми" class="contacts__photo">

    <div class="contacts__details">
        <div>
            <h3 class="contacts__subtitle">Ждем вас по адресу</h3>
            <p class="contacts__text">{{ $contact->address }}</p>
        </div>

        <div class="contacts__item">
            <h3 class="contacts__subtitle">Телефон</h3>
            <p class="contacts__text"><a href="tel:{{ $contact->phoneLink() }}">{{ $contact->phone }}</a></p>
        </div>

        <div class="contacts__item">
            <h3 class="contacts__subtitle">График работы</h3>
            <p class="contacts__text">{{ $contact->working_hours }}</p>
        </div>

        <div class="contacts__socials">
            @if ($contact->telegram_url)
                <a href="{{ $contact->telegram_url }}" aria-label="Telegram" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/telegram.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
            @endif
            @if ($contact->whatsapp_url)
                <a href="{{ $contact->whatsapp_url }}" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/whatsapp.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
            @endif
            @if ($contact->max_url)
                <a href="{{ $contact->max_url }}" aria-label="MAX" target="_blank" rel="noopener noreferrer" class="header__social-link flex h-[65px] w-[65px] items-center justify-center rounded-full">
                    <img src="{{ asset('img/max.svg') }}" alt="" class="max-h-[29px] max-w-[29px]">
                </a>
            @endif
        </div>

        <img src="{{ asset('img/logo.svg') }}" alt="Milomi" class="contacts__logo">
    </div>
</div>
