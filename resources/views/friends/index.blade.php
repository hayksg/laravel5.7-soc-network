@extends('layouts.app')
@section('title', "| Friends")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow p-2">

            @if(!$friends->count())
                <h5>You have no friends!</h5>
            @else   
                @foreach($friends as $friend)

                    @include('layouts.user-profile-small', ['user' => $friend, 'delete' => true])

                @endforeach
            @endif

        </div>
    </div>
</div>

@endsection
