@if(!auth()->check())
<div class="col-lg-3 order-lg-3 col-md-12 order-1 feature-item rounded py-3 px-1">
@else
<div class="col-lg-3 order-lg-3 col-md-12 order-2 feature-item rounded py-3 px-1">
@endif
    <div class="shadow pt-1 pb-4 px-4">
        @if(!$user || !$user->count())
        <div class="text-center">
            <div class="locale-right-sidebar mb-2">@include('layouts.locale')</div>
            <div>{!! trans('right-menu.please_login', [ 'path' => route('login') ]) !!}</div>
        </div>
        @else
            @if(isset($page) && $page === 'main')
                <h6 class="text-center">Your friends</h6>
            @else
                <h6 class="text-center">{!! shortName($user->name) !!}'s friends</h6>
            @endif

            <hr>
        
            @if(!$user->friends()->count())
                <p class="text-center">No friends found</p>
            @else
                <ul class="list-unstyled">
                @foreach($user->friends() as $friend)
                    <li class="user-has-friends-block">
                        <a href="{{ route('get.status', ['id' => Hashids::encode($friend->id), 'slug' => $friend->slug]) }}">
                            <span class="user-friend-thumbnail">
                                @include('layouts.profile-pic', ['user' => $friend])
                            </span>
                            <span class="user-friend-name">{!! shortName($friend->name) !!}</span>
                            @if($friend->isOnline())
                                <span class="badge badge-pill badge-success">&nbsp;&nbsp;</span>
                            @else
                                <span class="badge badge-pill badge-danger">&nbsp;&nbsp;</span>
                            @endif
                        </a>
                    </li>
                    <hr>
                @endforeach
                </ul>
            @endif
        @endif
           
    </div>
</div>
