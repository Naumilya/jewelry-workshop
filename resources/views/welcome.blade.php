<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Золотые руки</title>
        @vite(['resources/js/app.js'])
    </head>

    <body>
        <div id="app"></div>
    </body>
</html>
