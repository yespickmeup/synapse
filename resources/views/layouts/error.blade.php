<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>  

    {{-- <link href="/css/errors.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/errors.css') }}" rel="stylesheet">
    <!-- Heads -->
    @yield('heads', '')
</head>
<body> 
    <div id="page">
        <div id="content">
            @yield('content') 
            <div>
                
            </div>
        </div> 
    </div>

    @yield('scripts', '')
</body>
</html>
