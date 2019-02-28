@extends('layouts.app')
@section('title', "| Gallery")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 feature-item rounded py-3 px-1">
        <div class="shadow p-2">
            <div>
                
                <vue-gallery 
                    url="{{ url('/') }}" 
                    user-id="{{ $user->id }}"
                    user-name="{{ strip_tags(shortName(onlyName($user->name, false))) }}"
                    auth-user-id="{{ auth()->user()->id }}"
                    storage-path="{{ asset('storage/gallery/') }}"
                >
                </vue-gallery>
                
            </div>

            @if($gallery->count())
            <div ref="fromServer" class="user-gallery from-server mt-4">
                @foreach($gallery as $key => $item)
                    <div class="gallery-image-wrap hover-zoomin">
                        <a data-fancybox="gallery" href="{{ asset('storage/gallery/' . $item->image) }}">
                            <img src="{{ asset('storage/gallery/' . $item->image) }}">
                        </a>
                        @if(auth()->user()->id === $user->id)
                            <button class="btn btn-outline-danger delete-from-gallery" data-id="{{ $item->id }}">&times;</button>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

</div>

@endsection
