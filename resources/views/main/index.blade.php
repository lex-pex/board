@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row text-center">
            @if(!count($ads)) <p class="text-info m-auto display-4">There are no ads</p> @endif
            @foreach($ads as $ad)
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">{{ $ad->title }}</div>
                    <div class="card-body">
                        <div class="position-absolute text-muted font-weight-bold">

                            <p class="text-muted">Price:</p>
                            <p class="text-light bg-danger">{{ $ad->price }}</p>
                        </div>
                        <img src="{{ $ad->image ? $ad->image : '/up/ads/empty.jpg' }}" width="50%"/>
                        <p>{{ substr($ad->text, 0, 130) }} <a href="{{ route('adShow', $ad->id) }}"> &raquo; Read more...</a></p>
                    </div>
                    <div class="card-footer text-right">
                        Rating:
                        @for($i = 0; $i < 5; $i ++)
                            <i class="fa {{ $ad->rate > $i ? 'fa-star green' : 'fa-star-o' }}" aria-hidden="true"></i>
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row justify-content-center">
                <div class="col-md-3 ml-auto">
                    {{ $ads->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
