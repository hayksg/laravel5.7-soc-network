<div class="col-lg-3 order-lg-3 col-md-12 order-2 feature-item rounded py-3 px-1">
    <div class="shadow p-4">
        @if(!$user || !$user->count())
        <h6 class="text-center">
            Please <a href="{{ route('login') }}">login</a> to see your friends
        </h6>
        @else
            @if(isset($page) && $page === 'main')
                <h6 class="text-center">Your friends</h6>
            @else
                <h6 class="text-center">{!! shortName($user->name) !!}'s friends</h6>
            @endif

            <hr>
        
            @if(!$user->friends()->count())
                <p>Has no friends</p>
            @else
                <ul class="list-unstyled">
                @foreach($user->friends() as $friend)
                    <li class="user-has-friends-block">
                        <a href="{{ route('getWithSlug', ['id' => Hashids::encode($friend->id), 'slug' => $friend->slug]) }}">
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
