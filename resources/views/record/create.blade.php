@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.nav')
        <h3>Add new record</h3>
        <form method="POST" action="{{ route('records.store') }}" class="form-inline" enctype="multipart/form-data">
            @csrf
            <label class="sr-only" for="inlineFormInputGroupTitle">Title</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" name="title" class="form-control" id="inlineFormInputGroupTitle" placeholder="Title">
            </div>
            <div class="input-group mb-2 mr-sm-2">
            <select class="form-control" name="category_id">
                <option class="custom-select" disabled>Select category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" >{{$category->title}}</option>
                @endforeach
            </select>
            </div>

            <label class="sr-only" for="inlineFormInputGroupPassword2">Image</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="file" name="image" class="form-control-file" id="inlineFormInputGroupImage">
            </div>




            <button type="submit" class="btn btn-primary mb-2">Create</button>
        </form>
    </div>
@endsection
