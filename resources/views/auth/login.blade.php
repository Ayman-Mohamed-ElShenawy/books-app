@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                
                <form action="{{ route('login.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class='mb-2'>email</label>
                        <input type="email" class="mb-2 form-control" placeholder="email" value='{{ old('email') }}'
                            name="email">
                        @error('email')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class='mb-2'>password</label>
                        <input type="password" class="mb-2 form-control" placeholder="password" name="password">
                        @error('password')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="submit" class='btn btn-primary btn-md' value='Login'>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
