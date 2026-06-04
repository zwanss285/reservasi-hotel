<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Hero Section */
            .hero-section {
                height: 80vh;
                background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset("images/hero-bg.jpg") }}');
                background-size: cover;
                background-position: center;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                color: white;
            }

            .hero-section h1 {
                font-size: 48px;
                margin-bottom: 20px;
            }

            .btn-book-now {
                display: inline-block;
                background: #ffd700;
                color: #1a1a2e;
                padding: 12px 30px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
                margin-top: 20px;
                transition: 0.3s;
            }

            .btn-book-now:hover {
                background: #ffed4a;
                color: #1a1a2e;
            }

            /* Facilities Section */
            .facilities-section {
                padding: 60px 0;
                background: #f8f9fa;
            }

            .section-title {
                text-align: center;
                font-size: 32px;
                margin-bottom: 40px;
                position: relative;
            }

            .section-title:after {
                content: '';
                display: block;
                width: 80px;
                height: 3px;
                background: #667eea;
                margin: 15px auto 0;
            }

            .facilities-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
            }

            .facility-card {
                text-align: center;
                padding: 30px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                transition: transform 0.3s;
            }

            .facility-card:hover {
                transform: translateY(-5px);
            }

            .facility-card i {
                color: #667eea;
                margin-bottom: 15px;
            }

            .facility-card h3 {
                margin-bottom: 15px;
            }

            /* Rooms Section */
            .rooms-section {
                padding: 60px 0;
            }

            .rooms-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 30px;
            }

            .room-card {
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                transition: transform 0.3s;
            }

            .room-card:hover {
                transform: translateY(-5px);
            }

            .room-image {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 40px;
                text-align: center;
                color: white;
            }

            .room-info {
                padding: 20px;
            }

            .room-price {
                font-size: 24px;
                font-weight: bold;
                color: #667eea;
            }

            .btn-book {
                display: block;
                text-align: center;
                background: #1a1a2e;
                color: white;
                padding: 10px;
                border-radius: 5px;
                text-decoration: none;
                margin-top: 15px;
            }

            .btn-book:hover {
                background: #667eea;
                color: white;
            }

            /* Testimonials Section */
            .testimonials-section {
                padding: 60px 0;
                background: #f8f9fa;
            }

            .testimonials-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
            }

            .testimonial-card {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .testimonial-card .rating {
                color: #ffc107;
                margin-bottom: 10px;
            }

            .testimonial-card .comment {
                font-style: italic;
                margin-bottom: 15px;
            }

            .testimonial-card .author {
                font-weight: bold;
                color: #667eea;
            }

            /* Contact Section */
            .contact-section {
                padding: 60px 0;
                background: #1a1a2e;
                color: white;
            }

            .contact-info {
                display: flex;
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;
            }

            .contact-item {
                text-align: center;
            }

            .contact-item i {
                font-size: 24px;
                margin-bottom: 10px;
                color: #ffd700;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
