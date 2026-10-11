<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Trend wear</title>
    <!-- Trend Wear Favicon -->
<link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo-img/logo1.jpg') }}">
    <meta name="description" content="Urban Bites - We do not just cook, we create your emotions! Experience artisan culinary delights, fresh ingredients, and fast delivery.">

    <!-- Google Fonts: Rubik & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/page-css/header.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/page-css/Home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page-css/footer.css') }}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    @include('frontend.layouts.partials.header')

    @yield('content')

    @include('frontend.layouts.partials.footer')

    <!-- Scroll To Top Button with Circular Progress Indicator -->
    <button type="button" id="backToTop" class="back-to-top" aria-label="Scroll to top" title="Scroll to top">
        <svg class="progress-circle" viewBox="-1 -1 102 102">
            <path class="progress-bg" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            <path class="progress-ring" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        <i class="bi bi-arrow-up scroll-arrow"></i>
    </button>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Scroll To Top & Circular Progress Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const backToTopBtn = document.getElementById('backToTop');
            if (!backToTopBtn) return;

            const progressRing = backToTopBtn.querySelector('.progress-ring');
            if (!progressRing) return;

            const pathLength = progressRing.getTotalLength();

            progressRing.style.strokeDasharray = `${pathLength} ${pathLength}`;
            progressRing.style.strokeDashoffset = `${pathLength}`;

            const updateScrollProgress = () => {
                const scrollTop = window.scrollY || document.documentElement.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;

                if (scrollHeight > 0) {
                    const scrollFraction = Math.min(Math.max(scrollTop / scrollHeight, 0), 1);
                    const offset = pathLength - (scrollFraction * pathLength);
                    progressRing.style.strokeDashoffset = `${offset}`;
                }

                if (scrollTop > 120) {
                    backToTopBtn.classList.add('show-btn');
                } else {
                    backToTopBtn.classList.remove('show-btn');
                }
            };

            window.addEventListener('scroll', updateScrollProgress, { passive: true });
            window.addEventListener('resize', updateScrollProgress, { passive: true });

            updateScrollProgress();

            backToTopBtn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>

</html>