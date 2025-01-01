@extends('layouts.layout')
@section('title','Books Search')
@section('content')
<div class="container">
    @if ($book->count()==0)
        <div class="mt-3 text-danger-emphasis">No books found</div>
    @else
    <div class="row">
      
        <div class="mt-3 col-12 col-md-3">
            <div class='title'>{{ $book->title }}</div>
            <div class='author'>{{ $book->author }}</div>
            <a class='download-book' href="/storage/" download="{{ $book->upload }}">
               download {{ $book->upload }}
            </a>
            <div class='mt-2 status d-flex gap-1 fw-bold'>status:
                <h6 class='text text-primary-emphasis mb-0' style="line-height: 1.4">
                 {{ $book->status }}
                </h6>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection