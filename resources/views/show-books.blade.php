 @extends('layouts.layout')

 @section('title', 'Show Books')

 @section('content')

<div class="container show-books-container ">
    <div ><h4 hidden  class='text-center mt-3 found text-danger-emphasis'>available books</h4></div>
    <div class="row show-books">
        
    </div>
    <div ><h4 hidden class='text-center mt-3 not-found text-danger-emphasis'>no books available</h4></div>
</div>

<div class='mt-3 d-flex justify-content-center align-items-center pagination-buttons gap-3'></div>
 @endsection




</div>