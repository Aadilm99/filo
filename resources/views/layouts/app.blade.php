<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <title>{{config('app.name', 'FiLo')}}</title>
</head>
    <body>
        <div id="app">
         @include('inc.navbar')
            <div class="container p-5">
                <div>
                    @include('inc.messages')
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
        <!-- Scripts -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</html>
