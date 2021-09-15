@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.nav')
        <h3>Record # {{ $record->id }}</h3>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Records Title</th>
                <th>Category</th>
                @if(auth()->user()->is_manager)
                    <th>Authors Name</th>
                @endif
                <th>Image</th>
                <th style="width: auto">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $record->title }}</td>
                    <td><a href="{{route('category.records', $record->category->id)}}"> {{$record->category->title}}</a></td>
                    @if(auth()->user()->is_manager)
                        <td><a href="{{route('user.records', $record->user->id)}}">{{ $record->user->name }}</a></td>
                    @endif
                    <td style="text-align: center;"><img src="{{url('images/' . $record->image->url)}}" width="100" height="60"></td>
                    <td style="width: auto">
                        <div class="row ml-3">
                            @can('update', $record) <a href="{{ route('records.edit', $record->id) }}"> <button class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></button></a>@endcan
                            <form method="POST" action="{{route('records.destroy', $record->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="delete" type="submit" title="Delete" data-toggle="tooltip" ><i class="material-icons">&#xE872;</i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection
