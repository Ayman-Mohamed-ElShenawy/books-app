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
        <div class="container text-center mt-4">

            @if (session('register'))
                <div class="alert alert-success ">
                    {{ session('register') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-primary ">{{ session('success') }}</div>
            @endif
            <div class="home-title text-primary mt-4  ">
                <h5>welcome {{ Auth::user()->name }}</h5>
            </div>
        </div>
        @if ($books->count() > 0)
        <div class="container mt-3">
            <div class="row ">
                @foreach ($books as $book)
                    <div class="col-12 col-md-3">
                        <div class='title'>{{ $book->title }}</div>
                        <div class='author'>{{ $book->author }}</div>
                        <a class='download-book d-flex gap-2 align-items-center' href="/storage/"
                            download="{{ $book->upload }}">
                            <div class= "pdf-image">
                                <img src=../gallery/pdf-file-svgrepo-com.png alt=pdf image />
                            </div>

                            download {{ $book->upload }}
                        </a>
                        <div class='mt-2 status d-flex gap-1 fw-bold'>status:
                            <h6 class='text text-primary-emphasis mb-0' style="line-height: 1.4">
                                {{ $book->status }}
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @else
            <div class="container text-center">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h5 class='text-success-emphasis mt-3'>
                            No contributions from other users available
                        </h5>
                    </div>
                </div>
            </div>
        @endif
      
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

            debounceTimeout = setTimeout(async () => {

                $('.searchbar').on('keyup', function() {
                    let query = $(this).val().toLowerCase();
                    // show results container on typing
                    $('.search-results[hidden]').removeAttr('hidden');
                    // close results container if no input
                    if ($(this).val().length == 0) {
                        $('.search-results').attr('hidden', true);
                    }
                    // make ajax search request
                    async function searchRequest() {
                        try {
                            const response = await axios.get(
                                `http://127.0.0.1:8000/api/search/`, {
                                    params: {
                                        query
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content'),
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                    },
                                })
                            if (response && response.data.length > 0) {
                                // add the search results to search results container
                                $('.search-results').empty();
                                $.each(response.data, function(index, book) {

                                    $('.search-results').append(
                                        `<li> 
                                           <a href='searchbooks/${book.id}' class='search-item text text-dark' data-id="${book.id}" >${book.title}</a>
                                           </li>
                                       `
                                    );
                                });
                            }



                        } catch (error) {
                            if (error && error.response) {
                                console.log(error)
                            }
                        }
                    }
                    searchRequest();
                });
            }, 4500);
            $(document).on('click', '.make-search', function(e) {
                e.preventDefault();
                let bookId = $('.search-item').data('id');
                let formAction = `http://127.0.0.1:8000/searchbooks/${bookId}`;
                let searchForm = $('#search-form').attr('action', formAction);
                searchForm.submit();
                if (typeof bookId === 'undefined') {
                    window.location.href = 'http://127.0.0.1:8000/noresults';

                }
            });

            $(document).on('click', '.search-item', function(e) {
                // console.log('clicked');
                e.preventDefault();
                $('.search-results').attr('hidden', true);
                $('.searchbar').val($(this).text());
            });
        });
    </script>
@endsection
