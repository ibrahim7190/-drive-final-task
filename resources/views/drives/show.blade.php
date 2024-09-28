@extends('layouts.app')

@section('content')
    <div class="container col-3">
        <h1 class="text-center text-info">Show File</h1>

        @if (Session::has('done'))
            <div class="alert alert-success mx-auto text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <img src="{{ asset('img/2.jpg') }}" class="img-fluid img-top">
            <div class="card-body">
                <h6>Title : {{ $drive->title }}</h6>
                <hr>
                <h6>Description : {{ $drive->description }}</h6>
                <hr>
                <a href="{{ route('drive.download', $drive->id) }}" class="btn btn-success"> <i
                        class="fa-solid fa-download"></i> Download </a>
            </div>
        </div>
    </div>
@endsection
