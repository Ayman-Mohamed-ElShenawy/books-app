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

            @if (session('register'))
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
                if(typeof bookId==='undefined'){
                    window.location.href='http://127.0.0.1:8000/noresults';
                    
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
