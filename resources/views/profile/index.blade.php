@extends('layouts.app')
@section('title', "| Profile")

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div class="card">
            <div class="card-header">Welcome to your profile</div>
            <div class="card-body">

                <div class="text-success">
                    <vue-message message="{{ session()->get('message') }}"></vue-message>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-4">

                        <div class="card text-center app-user-profile">
                            <div class="p-2">
                                @include('layouts.profile-pic')
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p>
                                    <strong class="card-text">{!! cityAndCountry($profile->city, $profile->country) !!}</strong>
                                </p>
                                <hr>
                                <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit profile</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <h5 class="text-center">About</h5>
                        @if($profile->about)
                        <div>{!! nl2br($profile->about) !!}</div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection


