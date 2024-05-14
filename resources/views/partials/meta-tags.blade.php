<base href="/" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ config('app.name') }} | @yield('meta:title', 'Home')</title>
<meta name="author" content="{{ config('app.name') }}">

<meta name="description" content="@yield('meta:description', 'Laravel - The PHP framework for web artisans.')">
<meta name="keywords" content="@yield('meta:keywords', 'laravel, php, framework, web, artisans, boilerplate')">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="msapplication-navbutton-color" content="#1A1A18">
<meta name="apple-mobile-web-app-status-bar-style" content="#1A1A18">

<meta property="og:type" content="@yield('og:type', url('/') . '/images/MasungiGeoreserve.png')">
<meta property="og:image" content="@yield('og:image', url('/') . '/images/MasungiGeoreserve.png')">
<meta property="og:title" content="@yield('og:title', 'Masungi Georeserve: Award Winning Conservation Project')">
<meta property="og:description" content="@yield('og:description', 'The Masungi Georeserve is a conservation area and a rustic rock garden tucked in the rainforests of Rizal, which serves as the home for more than 400 documented species of flora and fauna. Masungi&rsquo;s name is derived from the word &ldquo;masungki&rdquo; which translates to &ldquo;spiked&rdquo; - an apt description for the sprawling limestone landscape found within.')">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:type" content="website">

<meta name="twitter:image" content="@yield('twitter:image', url('/') . '/images/MasungiGeoreserve.png')">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('twitter:title', 'Masungi Georeserve: Award Winning Conservation Project')">
<meta name="twitter:description" content="@yield('twitter:description', 'The Masungi Georeserve is a conservation area and a rustic rock garden tucked in the rainforests of Rizal, which serves as the home for more than 400 documented species of flora and fauna. Masungi&rsquo;s name is derived from the word &ldquo;masungki&rdquo; which translates to &ldquo;spiked&rdquo; - an apt description for the sprawling limestone landscape found within.')">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">

<!-- Slick -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css" />

<!-- Remodal -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal-default-theme.min.css">
