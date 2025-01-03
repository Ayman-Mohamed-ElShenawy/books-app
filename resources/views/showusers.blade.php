@extends('layouts.layout')

@section('tile', 'Show Users')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="title">
                        <h5>Show all Users
                            <a class='btn btn-outline-primary float-end' href="{{ url('/') }}">back</a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div>
</div>
 

@endsection
