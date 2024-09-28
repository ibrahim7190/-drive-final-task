@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">


                        @auth
                            <h4>You are logged in!</h4><br />
                        @endauth

                        @guest
                            <h4>Please login to view your profile</h4>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
