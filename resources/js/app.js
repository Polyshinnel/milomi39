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
                slidesPerView: 1,
                spaceBetween: 16,
            },
            768: {
                slidesPerView: 2,
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

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initGalleryCarousel();
        initReviewsCarousel();
    }, { once: true });
} else {
    initGalleryCarousel();
    initReviewsCarousel();
}

export { Swiper };
