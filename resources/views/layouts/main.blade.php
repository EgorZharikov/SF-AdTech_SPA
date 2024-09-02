<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>SF-AdTech</title>
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
</body>
<noscript>
    <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center" style="height:100vh;">
            <div class="col col-4 offset-md-4 m-3 border border-danger">
                <h1 class="text-danger">JavaScript required</h1>
                <hr>
                <h4>We're sorry, but SF-AdTech doesn't work properly without JavaScript! </h4>
            </div>
        </div>
    </div>

</noscript>

</html>