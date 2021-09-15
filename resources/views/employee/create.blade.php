@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.nav')
        <h3>Add new employee</h3>
        <form method="POST" action="{{ route('employees.store') }}" class="form-inline">
            @csrf
            <label class="sr-only" for="inlineFormInputGroupUsername2">Email</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="email" name="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="user@mail.com">
            </div>

            <label class="sr-only" for="inlineFormInputGroupPassword2">Password</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" name="password" class="form-control" id="inlineFormInputGroupPassword2" placeholder="strong password">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Create</button>
        </form>
    </div>
@endsection
