@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center text-info">Upload File</h1>
        {{-- alert in top page to show filed label input --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
    @endforeach

    </ul>
</div>
@endif --}}

        @if (Session::has('done'))
            <div class="alert alert-success mx-auto text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">

                <form action="{{ route('drive.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>File Title</label>
                        <input type="text" name="title" class="form-control">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File Description</label>
                        <input type="text" name="description" class="form-control">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File Status</label>
                        <select name="status" class="form-control">
                            <option value="public">Public File</option>
                            <option value="Private">Private File</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File Upload</label>
                        <input type="file" name="inputFile" class="form-control">
                        @error('inputFile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="mt-2 btn btn-info">Send Data</button>
                </form>

            </div>
        </div>
    </div>
@endsection
