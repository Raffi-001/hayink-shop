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

<script src="https://cdn.jsdelivr.net/npm/embla-carousel@8.1.6/embla-carousel.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.embla').forEach((emblaEl) => {
            const api = EmblaCarousel(emblaEl, {
                align: 'start',
                loop: true,
                slidesToScroll: 1,
                containScroll: 'trimSnaps',
            });

            // Arrows
            const root = emblaEl.closest('.relative') || emblaEl.parentElement;
            root.querySelector('.embla__prev')?.addEventListener('click', () => api.scrollPrev());
            root.querySelector('.embla__next')?.addEventListener('click', () => api.scrollNext());

            // Pagination
            const dotsContainer = root.querySelector('.embla__dots');
            if (dotsContainer) {
                const slides = api.slideNodes();
                slides.forEach((_, i) => {
                    const dot = document.createElement('button');
                    dot.className = 'w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400 transition-colors';
                    dot.addEventListener('click', () => api.scrollTo(i));
                    dotsContainer.appendChild(dot);
                });

                const updateDots = () => {
                    const selected = api.selectedScrollSnap();
                    [...dotsContainer.children].forEach((dot, i) => {
                        dot.classList.toggle('bg-gray-800', i === selected);
                        dot.classList.toggle('bg-gray-300', i !== selected);
                    });
                };

                api.on('select', updateDots);
                updateDots();
            }
        });
    });
</script>




</body>

</html>
