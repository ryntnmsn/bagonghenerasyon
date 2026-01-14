<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="Lead the fight against sickness, ignorance, poverty, and indifference by
empowering individuals with knowledge and skills. Achieve a healthy, educated, prosperous and empowered citizenry and out goals is to comprehensively implement continuous and sustainable programs through its H.E.L.P.S. advocacies.">
    <meta name="keywords" content="Poverty, Empowering Individuals, Healthy, Educated, Empowered Citizenry, Sustainable Programs, Advocacies, Sickness">
    <meta name="author" content="Bagong Henerasyon Partylist">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Bagong Henerasyon Partylist">
    <meta property="og:description" content="Lead the fight against sickness, ignorance, poverty, and indifference by
empowering individuals with knowledge and skills.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('storage/images/og-image.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bagong Henerasyon Partylist">
    <meta name="twitter:description" content="Lead the fight against sickness, ignorance, poverty, and indifference by
empowering individuals with knowledge and skills.">
    <meta name="twitter:image" content="{{ asset('storage/images/og-image.jpg') }}">


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @inertiaHead
    @routes
</head>
<body>
    @inertia
</body>
</html>