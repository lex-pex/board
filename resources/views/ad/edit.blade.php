@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ad Edit</div>
                <div class="card-body">
                    <div class="text-danger mr-auto"><small>{{ Session::get('status') }}</small></div>
                    <form method="POST" action="{{ route('adUpdate',  $ad) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : $ad->title }}" autocomplete="name" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Text</label>
                            <div class="col-md-6">
                                <textarea id="text" rows="10" type="text" class="form-control @error('text') is-invalid @enderror" name="text" autocomplete="text">{{ old('text') ? old('text') : $ad->text }}</textarea>
                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 offset-md-2">
                                <img src="{{ asset($ad->image ? $ad->image : '/up/ads/empty.jpg') }}" width="100%" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Picture</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="btn btn-primary @error('image') is-invalid @enderror" name="image" autocomplete="current-image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="image_del" id="image_del" {{ old('image_del') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="image_del">Delete Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                            <div class="col-md-4">
                                <button onclick="event.preventDefault(); document.getElementById('delete-ad-form').submit();" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                    <form id="delete-ad-form" action="{{ route('adDelete', $ad) }}" method="post" style="display: none;">
                        <input type="hidden" name="_method" value="delete" />
                        @csrf
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('adShow', $ad->id) }}"> Go on Ads Page  &raquo; </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
