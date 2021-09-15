@extends('layouts.app')

@section('content')


<div class="container-lg">
    <div class="table-wrapper">
        @includeWhen(Auth::user()->is_manager, 'components.addEmployee')
        @includeWhen(!Auth::user()->is_manager, 'components.addRecord')
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Records Title</th>
                <th>Authors Name</th>
                <th>Image</th>
                <th style="width: auto">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td><a href="{{route('records.show', $record->id)}}">{{ $record->title }}</a></td>

                        <td>{{ $record->user->name }}</td>
                        <td style="text-align: center;"><img src="{{url('images/' . $record->image->url)}}" width="100" height="60"></td>
                        <td style="width: auto">
                            <div class="row ml-3">
                            @can('update', $record)
                            <a href="{{ route('records.edit', $record->id) }}"> <button class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></button></a>
                            @endcan
                            <form method="POST" action="{{route('records.destroy', $record->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="delete" type="submit" title="Delete" data-toggle="tooltip" ><i class="material-icons">&#xE872;</i></button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $records->links() }}
</div>
</div>
@endsection
