@extends('layouts.app')
@section('title', "| Find friends")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow p-2">


                
            @if (!$requests->count()) 
                <h5>You have no friend requests</h5>
            @else 
                @foreach($requests as $user)
                    <?php var_dump($user); ?>
                @endforeach
            @endif    
            
        </div>
    </div>
</div>

@endsection
