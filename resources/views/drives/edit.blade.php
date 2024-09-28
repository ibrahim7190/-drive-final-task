@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center text-info">Edit File</h1>

        @if (Session::has('done'))
            <div class="alert alert-success mx-auto text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('drive.update', $drive->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>File Title</label>
                        <input type="text" name="title" value="{{ $drive->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>File Description</label>
                        <input type="text" name="description" value="{{ $drive->description }}"class="form-control">
                    </div>
                    <div class="form-group">
                        <label>File Status</label>
                        <select name="status" class="form-control">
                            <option value="{{ $drive->status }}" selected>{{ $drive->status }}</option>
                            <option value="public">Public File</option>
                            <option value="Private">Private File</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>File Upload : {{ $drive->file }}</label>
                            <input type="file" name="inputFile" class="form-control">
                        </div>
                        <button class="mt-2 btn btn-warning">Upadate Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
