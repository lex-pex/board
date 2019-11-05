@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="text-danger m-auto">{{ Session::get('status') }}</div>
            <div class="card mt-3">
                <div class="card-header">
                    {{ $ad->title }}
                    <div class="position-absolute text-muted font-weight-bold">
                        <img class="rounded-circle img-thumbnail shadow" src="{{ $author->image }}" width="55px"/>
                        {{ $author->name }}
                        <p class="text-muted">Price:</p>
                        <p class="text-light bg-danger">{{ $ad->price }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{ $ad->image ? $ad->image : '/up/ads/empty.jpg' }}" width="50%"/>
                    <p>{{ $ad->text }}</p>
                </div>
                <div class="card-footer text-right rating-block" data-rating-id="{{ $ad->id }}">
                    Rating:
                    <span id="stars">
                        <i id="rating_1" class="rating fa fa-star-o" aria-hidden="true"></i>
                        <i id="rating_2" class="rating fa fa-star-o" aria-hidden="true"></i>
                        <i id="rating_3" class="rating fa fa-star-o" aria-hidden="true"></i>
                        <i id="rating_4" class="rating fa fa-star-o" aria-hidden="true"></i>
                        <i id="rating_5" class="rating fa fa-star-o" aria-hidden="true"></i>
                    </span>
                    <span style="display:{{ (Auth::check()) ? ((Auth::user()->role == 'admin' || Auth::user()->id == $ad->user_id) ? '' : 'none') : 'none' }}">
                        | <a href="{{ route('adEdit', $ad) }}">Edit</a>
                    </span>
                </div>
            </div>
            <div id="comments-app" class="comments form-group">
                <label for="cmt">Comments</label>
                <textarea id="cmt" class="form-control" data-id="{{ $ad->id }}" data-user="{{ Auth::user() ? Auth::user()->id : 0 }}"></textarea>
                <small id="cancel-edit" onclick="cancelEdit()" class="text-danger" style="display:none;cursor: pointer;">Cancel Edit | x |</small>
                <div id="showCmt"></div>
            </div>
        </div>
    </div>
</div>
@endsection
