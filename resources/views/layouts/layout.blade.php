<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="shortcut icon" href="{{ asset('gallery/book-2-svgrepo-com.png') }}" type="image/x-icon">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
     @vite(['resources/css/app.css'])
     <title>@yield('title','pagetitle')</title>
    </head>
    <body>
        <header>
            <x-navbar></x-navbar>
        </header>
        <main>
            @yield('content')
        </main>
        
        <footer></footer>
       
    @vite(['resources/js/app.js'])
</body>
</html>