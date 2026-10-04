import Swiper from 'swiper';
import { Autoplay, Navigation } from 'swiper/modules';
import 'swiper/css';

const initGalleryCarousel = () => {
    const carousel = document.querySelector('.gallery-carousel__swiper');

    if (!carousel || carousel.swiper) {
        return;
    }

    window.galleryCarouselSwiper = new Swiper(carousel, {
        modules: [Autoplay],
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 40,
        loop: true,
        speed: 700,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 3,
                spaceBetween: 8,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1800: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        },
    });
};

const initReviewsCarousel = () => {
    const carousel = document.querySelector('.reviews__swiper');

    if (!carousel || carousel.swiper) {
        return;
    }

    window.reviewsSwiper = new Swiper(carousel, {
        modules: [Autoplay, Navigation],
        slidesPerView: 4,
        slidesPerGroup: 1,
        spaceBetween: 28,
        loop: true,
        speed: 700,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        navigation: {
            prevEl: '.reviews__button--previous',
            nextEl: '.reviews__button--next',
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 28,
            },
        },
    });
};

const initServicesCarousel = () => {
    const carousel = document.querySelector('.services__swiper');

    if (!carousel) {
        return;
    }

    const desktop = window.matchMedia('(min-width: 1024px)');
    const syncCarousel = () => {
        if (desktop.matches && !carousel.swiper) {
            window.servicesSwiper = new Swiper(carousel, {
                modules: [Autoplay, Navigation],
                slidesPerView: 3,
                slidesPerGroup: 1,
                spaceBetween: 28,
                loop: true,
                speed: 700,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                navigation: {
                    prevEl: '.services__button--previous',
                    nextEl: '.services__button--next',
                },
            });
        } else if (!desktop.matches && carousel.swiper) {
            carousel.swiper.destroy(true, true);
        }
    };

    syncCarousel();
    desktop.addEventListener('change', syncCarousel);
};

const initMobileMenu = () => {
    const menu = document.querySelector('.mobile-menu');
    const openButton = document.querySelector('.mobile-header__menu');
    const closeButton = document.querySelector('.mobile-menu__close');

    if (!menu || !openButton || !closeButton) {
        return;
    }

    const closeMenu = () => {
        menu.classList.remove('is-open');
        menu.setAttribute('aria-hidden', 'true');
        openButton.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('mobile-menu-open');
    };

    openButton.addEventListener('click', () => {
        menu.classList.add('is-open');
        menu.setAttribute('aria-hidden', 'false');
        openButton.setAttribute('aria-expanded', 'true');
        document.body.classList.add('mobile-menu-open');
    });

    closeButton.addEventListener('click', closeMenu);
    menu.querySelectorAll('a[href^="#"]').forEach((link) => link.addEventListener('click', closeMenu));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
};

const initPriceAccordion = () => {
    document.querySelectorAll('.price-page__toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const panel = document.getElementById(button.getAttribute('aria-controls'));
            const isExpanded = button.getAttribute('aria-expanded') === 'true';

            button.setAttribute('aria-expanded', String(!isExpanded));
            if (panel) {
                panel.hidden = isExpanded;
            }
        });
    });

    const openLinkedSection = () => {
        const slug = decodeURIComponent(window.location.hash.slice(1));
        const section = slug ? document.getElementById(slug) : null;

        if (!section?.classList.contains('price-page__item')) {
            return;
        }

        const button = section.querySelector('.price-page__toggle');
        const panel = document.getElementById(button?.getAttribute('aria-controls'));

        if (!button || !panel) {
            return;
        }

        button.setAttribute('aria-expanded', 'true');
        panel.hidden = false;
        window.requestAnimationFrame(() => section.scrollIntoView({ behavior: 'smooth', block: 'start' }));
    };

    if (window.location.hash) {
        window.setTimeout(openLinkedSection, 50);
    }
};

const initMapbox = () => {
    const mapContainer = document.querySelector('#map');

    if (!mapContainer || !window.mapboxgl || !mapContainer.dataset.mapboxToken) {
        return;
    }

    window.mapboxgl.accessToken = mapContainer.dataset.mapboxToken;

    const latitude = Number(mapContainer.dataset.latitude);
    const longitude = Number(mapContainer.dataset.longitude);
    const coordinates = [longitude, latitude];

    if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) {
        return;
    }

    const map = new window.mapboxgl.Map({
        container: mapContainer,
        style: 'mapbox://styles/mapbox/streets-v12',
        center: coordinates,
        zoom: 15,
        attributionControl: true,
    });

    map.addControl(new window.mapboxgl.NavigationControl(), 'top-right');

    new window.mapboxgl.Marker({ color: '#8c5d54' })
        .setLngLat(coordinates)
        .setPopup(new window.mapboxgl.Popup({ offset: 25 }).setText(`Мило Ми — ${mapContainer.dataset.address}`))
        .addTo(map);
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initGalleryCarousel();
        initReviewsCarousel();
        initServicesCarousel();
        initMobileMenu();
        initPriceAccordion();
        initMapbox();
    }, { once: true });
} else {
    initGalleryCarousel();
    initReviewsCarousel();
    initServicesCarousel();
    initMobileMenu();
    initPriceAccordion();
    initMapbox();
}

export { Swiper };
