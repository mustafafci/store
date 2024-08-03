<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/images/favicon.svg') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}" />
    @stack('styles')
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->
