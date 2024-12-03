<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link href="navidad/bootstrap5.min.css" rel="stylesheet">
        <link href="navidad/css/style.css" rel="stylesheet">
        <script src="navidad/js/script.js"></script>
    </head>
    <body>
        <section class="principal"> {{ $slot }} </section>
    </body>
    
</html>
