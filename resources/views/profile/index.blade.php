@extends('layouts.app')
@section('title', "| Profile")

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div class="card">
            <div class="card-header find-friends-card-header">
                <h5 class="d-inline-block">{{ $user->name }}</h5>
            </div>
            <div class="card-body">

                <div class="text-success">
                    <vue-message message="{{ session()->get('message') }}"></vue-message>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-4">

                        <div class="card text-center app-user-profile">
                            <div class="p-2">
                                @include('layouts.profile-pic', ['user' => $user])
                            </div>
                            <div class="card-body">
                                <p>
                                    <strong class="card-text">{!! cityAndCountry($profile->city, $profile->country) !!}</strong>
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <h5 class="text-left">About</h5>
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


