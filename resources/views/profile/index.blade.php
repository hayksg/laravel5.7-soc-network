@extends('layouts.app')
@section('title', "| Profile")

@section('content')


<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-9 order-lg-2 col-md-12 order-2 feature-item rounded py-3 px-1">
        <div class="shadow p-2">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header find-friends-card-header">
                            <h5 class="d-inline-block">{{ $user->name }}</h5>
                        </div>
                        <div class="card-body">

                            <div class="text-success">
                                <vue-message message="{{ session()->get('message') }}"></vue-message>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">

                                    <div class="card text-center app-user-profile">
                                        <div class="p-2">
                                            @include('layouts.profile-pic', ['user' => $user])
                                        </div>
                                        <div class="card-body">
                                            <strong class="card-text">
                                                {!! cityAndCountry($profile->city, $profile->country) !!}
                                            </strong>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-md-9 text-left">
                                    <h5>About</h5>
                                    @if($profile->about)
                                    <div>{!! nl2br($profile->about) !!}</div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
