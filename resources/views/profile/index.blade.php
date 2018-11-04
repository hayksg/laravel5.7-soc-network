@extends('layouts.app')
@section('title', "| Profile")

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Welcome to your profile</div>
            <div class="card-body">

                <div class="text-success">
                    <vue-message message="{{ session()->get('message') }}"></vue-message>
                </div>

                <div class="row">
                    <div class="col-sm-4">

                        <div class="card text-center app-user-profile">
                            <div class="p-2">
                                @include('layouts.profile-pic')
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p>
                                    @if($profile->city)
                                    <strong class="card-text">{{ $profile->city }}, </strong>
                                    @endif
                                    @if($profile->country)
                                    <strong class="card-text">{{ $profile->country }}</strong>
                                    @endif
                                </p>
                                <hr>
                                <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit profile</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-8">
                        @if($profile->about)
                        <h5 class="text-center">About</h5>
                        <div>{!! nl2br($profile->about) !!}</div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection