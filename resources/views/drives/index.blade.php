@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center text-info">Your Files</h1>

        @if (Session::has('done'))
            <div class="alert alert-success mx-auto text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th colspan="3">Action</th>
                    </tr>
                    @forelse ($drives as $item)
                        <tr>
                            <th>{{ $item->id }}</th>
                            <th>{{ $item->title }}</th>
                            <th><a href="{{ route('drive.change', $item->id) }}">{{ $item->status }}</a></th>
                            <th>
                                <a href="{{ route('drive.show', $item->id) }}"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('drive.edit', $item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('drive.destroy', $item->id) }}"><i class="fa-solid fa-trash-can"></i></a>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="4"> No drives available.</th>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
