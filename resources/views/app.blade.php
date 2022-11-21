<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @routes

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @inertiaHead

<body>
    @inertia
</body>

</html>
