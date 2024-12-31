@extends('layouts.layout')

@section('title','Register')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
         

             <form action="{{ route('register.store') }}" method="post" autocomplete="off">
                @csrf
                @if ($errors->any())
             
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                             <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label class='mb-2'>name</label>
                    <input type="text" class="form-control" placeholder="name" name="name">
                </div>
                <div class="mb-3">
                    <label class='mb-2'>email</label>
                    <input type="email" class="form-control" placeholder="email" name="email">
                </div>
                <div class="mb-3">
                    <label class='mb-2'>password</label>
                    <input type="password" class="form-control" placeholder="password" name="password">
                </div>
                <div class="mb-3">
                    <label class='mb-2'>confirm password</label>
                    <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation">
                </div>
                <div class="mb-3">
                    <input type="submit" class='btn btn-primary btn-md' value='Register'>
                </div>
             </form>
        </div>
    </div>
</div>

@endsection