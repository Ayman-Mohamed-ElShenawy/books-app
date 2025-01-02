@extends('layouts.layout')
@section('title','Not Found')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class='text-center  vh-100 d-flex flex-column justify-content-center align-items-center  mt-3'>
                <h1 class='text-danger'>the requested page does not exist</h1>
                <a href="{{url('/')}}" class="mt-2 btn btn-outline-primary">Back to Home</a>
            </div>
        </div>
    </div>
</div>

@endsection