<div class="card mb-3">
    <div class="card-header find-friends-card-header">
        <h5 class="d-inline-block">
            <a href="{{ route('getWithSlug', ['id' => Hashids::encode($friend->id), 'slug' => $friend->slug]) }}">
                {!! shortName($friend->name) !!}
            </a>
        </h5>
        @include('layouts.friend-status', ['user' => $friend, 'delete' => $delete])
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
