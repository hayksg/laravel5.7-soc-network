@extends('layouts.app')
@section('title', "| Gallery")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow p-2">
            @if(!$gallery->count())
                <h5>Gallery is empty</h5>
            @else
                @foreach($gallery as $item)
                    
                @endforeach
            @endif
        </div>
    </div>

</div>

@endsection
