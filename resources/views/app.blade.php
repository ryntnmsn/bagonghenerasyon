<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="{{ $meta['description'] ?? '' }}" />
    <meta name="keywords" content="Poverty, Empowering Individuals, Healthy, Educated, Empowered Citizenry, Sustainable Programs, Advocacies, Sickness" />
    <meta name="author" content="Bagong Henerasyon Partylist" />
    <meta name="robots" content="index, follow" />

    <meta property="og:title" content="{{ $meta['title'] ?? '' }}" />
    <meta property="og:description" content="{{ $meta['description'] ?? '' }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $meta['image'] ?? '' }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $meta['title'] ?? '' }}" />
    <meta name="twitter:description" content="{{ $meta['description'] ?? '' }}" />
    <meta name="twitter:image" content="{{ $meta['image'] ?? '' }}" />

    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon.png') }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @inertiaHead
    @routes
</head>
<body>
    @inertia
</body>
</html>