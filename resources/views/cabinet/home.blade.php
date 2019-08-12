@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ Auth::user()->image ? Auth::user()->image : url('/up/users/avatar.jpg') }}" width="100%" />
                        </div>
                        <div class="col-8">
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('userEdit', Auth::user()->id) }}">Edit</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

























