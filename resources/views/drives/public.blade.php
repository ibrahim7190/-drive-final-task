@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center text-info"> Public Drive Files</h1>

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
                            <th>{{ $item->status }}</th>
                            <th>
                                <a href="{{ route('drive.showpublic', $item->id) }}"><i class="fa-solid fa-eye"></i></a>
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
