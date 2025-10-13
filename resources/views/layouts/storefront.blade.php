<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W5CH4FVV');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>HayInk</title>
    <meta
        name="description"
        content="Example of an ecommerce storefront built with Lunar."
    >
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >

    <link
        rel="icon"
        href="{{ asset('favicon.png') }}"
    >
    @livewireStyles
    @filamentStyles
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body class="antialiased text-gray-900 font-primary">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W5CH4FVV"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @livewire('components.navigation')

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
    @filamentScripts

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    (function () {
        function initSwipers() {
            document.querySelectorAll('.mySwiper').forEach((el) => {
                if (el.swiper) return; // prevent double init
                new Swiper(el, {
                    slidesPerView: 1.3,
                    spaceBetween: 0,
                    loop: true,
                    breakpoints: {
                        640: { slidesPerView: 2.3 },
                        768: { slidesPerView: 3.3 },
                        1024: { slidesPerView: 4.3 },
                    },
                    pagination: {
                        el: el.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: el.querySelector('.swiper-button-next'),
                        prevEl: el.querySelector('.swiper-button-prev'),
                    },
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    on: {
                        touchStart(swiper, e) {
                            swiper.allowClick = true
                        },
                        touchMove(swiper, e) {
                            swiper.allowClick = false
                        },
                        touchEnd(swiper, e) {
                            if (swiper.allowClick) {
                                const link = e.target.closest('a')
                                if (link) link.click()
                            }
                        },
                    },

                    // noSwiping: true,
                    // noSwipingClass: 'swiper-no-swiping',
                    // grabCursor: true,

                    // ✅ Fix link click issue
                    // allowTouchMove: true,
                    // preventClicks: false,
                    // preventClicksPropagation: false,
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initSwipers);
        document.addEventListener('livewire:load', initSwipers);
        document.addEventListener('livewire:navigated', initSwipers);
        document.addEventListener('filament:page-loaded', initSwipers);
    })();
</script>









</body>

</html>
