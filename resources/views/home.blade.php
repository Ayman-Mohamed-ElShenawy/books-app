@extends('layouts.layout')


@section('title', 'HomePage')

@section('content')
    @guest
        <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-warning text-center">{{ session('success') }}</div>
            @endif
            <div class="container text-center">
                <div class="home-title text-warning-emphasis mt-4">
                    <h4>welcome to online books library, please register or login to continue</h4>
                </div>
            </div>
        </div>
    @endguest
    @auth
        <div class="container mt-4">

            @if ( session('register') )
            <div class="alert alert-success text-center">
                {{ session('register') }}
            </div>
            @endif

            @if (session('success'))
                <div class="alert alert-primary text-center">{{ session('success') }}</div>
            @endif
            <div class="home-title text-primary mt-4 container text-center">
                <h5>welcome {{ Auth::user()->name }}</h5>
            </div>
        </div>
    @endauth
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                if ($('.alert-primary').length) {
                    $('.alert-primary').css({
                        'transition': 'all .4s ease-in-out'
                    });
                    $('.alert-primary').hide();
                }
                if ($('.alert-warning').length) {
                    $('.alert-warning').css({
                        'transition': 'all .4s ease-in-out'
                    });
                    $('.alert-warning').hide();
                }
                if ($('.alert-success').length) {
                $('.alert-success').css({
                    'transition': 'all .4s ease-in-out'
                });
                $('.alert-success').hide();
            }
            }, 5000);
        });
    </script>
@endsection
