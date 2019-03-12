@if(!auth()->check())
<div class="col-lg-3 col-md-12 order-2 feature-item rounded py-3 px-1 app-left-sidebar">
@else
<div class="col-lg-3 col-md-12 order-1 feature-item rounded py-3 px-1 app-left-sidebar">
@endif
    <div class="shadow p-2">
        <ul class="list-group list-group-flush app-left-sidebar-ul">
            <li class="list-group-item">
                <a href="{{ route('findFriends') }}">
                    <i class="fas fa-fw fa-user-friends mr-2"></i>@lang('left-menu.find_friends')
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('statuses') }}">
                    <i class="fas fa-fw fa-stream mr-2"></i>@lang('left-menu.statuses')
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('friends') }}">
                    <i class="fas fa-fw fa-users mr-2"></i>@lang('left-menu.friends')
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('requests') }}">
                    <i class="fas fa-fw fa-exchange-alt mr-2"></i>@lang('left-menu.requests')
                </a>
                @if(auth()->user() && auth()->user()->hasfriendRequest())
                    <span class="mt-1 badge badge-pill badge-warning float-right">&nbsp;&nbsp;</span>
                @endif
            </li>
        </ul>
    </div>
</div>
