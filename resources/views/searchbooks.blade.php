@extends('layouts.layout')
@section('title', 'Books Search')
@section('content')
    <div class="container">

        <div class="no-results text-danger">

        </div>

        <div class="row">
            <div class="mt-3 col-12 col-md-3">
                <div class='title'>{{ $book->title }}</div>
                <div class='author'>{{ $book->author }}</div>
                @auth
                    <a class='download-book d-flex gap-2 align-items-center' href="/storage/" download="{{ $book->upload }}">
                        <div class= "pdf-image">
                            <img src=../gallery/pdf-file-svgrepo-com.png alt=pdf image />
                        </div>

                        download {{ $book->upload }}
                    </a>
                @endauth
                @guest
                    <span class='text text-danger-emphasis'>please login or register to download book</span>
                @endguest
            </div>
            <div class='mt-2 status d-flex gap-1 fw-bold'>status:
                <h6 class='text text-primary-emphasis mb-0' style="line-height: 1.4">
                    {{ $book->status }}
                </h6>
            </div>
        </div>
    </div>

@endsection
