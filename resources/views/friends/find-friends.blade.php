@extends('layouts.app')
@section('title', "| Find friends")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-3 text-center feature-item rounded py-3 px-1">
        <div class="shadow p-2">
                
            @foreach($allFriends as $friend)

            <div class="card mb-3">
                <div class="card-header find-friends-card-header">
                    <h5 class="d-inline-block">
                        <a href="{{ route('getWithSlug', ['id' => $friend->id, 'slug' => $friend->slug]) }}">{{ $friend->name }}</a>
                    </h5>

                    @if (friendsStatus($friend->id) == 'pending')
                        <div>You sent friend request <span class="text-warning">[pending]</span></div>
                    @elseif (friendsStatus($friend->id) == 'friends')
                        <div class="text-success">You are friends</div>
                    @else
                        <form action="{{ route('friendship.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $friend->id }}">
                            <button type="submit" class="btn btn-primary btn-sm">Add to friend</button>
                        </form>
                    @endif

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 col-sm-3 col-md-2">
                            <div class="find-friends-items">
                                @include('layouts.profile-pic', ['user' => $friend])
                                <div class="mt-2"><strong class="card-text">{!! cityAndCountry($friend->profile->city, $friend->profile->country) !!}</strong></div>
                            </div>
                        </div>
                        <div class="col-9 col-sm-9 col-md-10 text-left pl-4">
                            <h5>About</h5>
                            @if($friend->profile->about)
                            <div class="about-user">{!! nl2br($friend->profile->about) !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
       
    </div>

</div>

@endsection
