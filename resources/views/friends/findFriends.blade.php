@extends('layouts.app')
@section('title', "| Find friends")

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-10">

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
                    <div class="col-sm-2">
                        <div class="text-center find-friends-items">
                            @include('layouts.profile-pic', ['user' => $friend])
                            <div class="mt-2"><strong class="card-text">{!! cityAndCountry($friend->profile->city, $friend->profile->country) !!}</strong></div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div>{{ $friend->profile->about }}</div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection
