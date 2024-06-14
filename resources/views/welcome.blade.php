<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <title>Золотые руки</title>
        @vite(['resources/js/app.js'])
    </head>

    <body>
        <div id="app"></div>
    </body>
</html>
