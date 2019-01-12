<div class="col-lg-3 col-md-12 order-1 feature-item rounded py-3 px-1">
    <div class="shadow">
        <div class="p-2">
            <ul class="list-group list-group-flush app-left-sidebar-ul">
                <li class="list-group-item">
                    <a href="{{ route('findFriends') }}">
                        <i class="fas fa-fw fa-user-friends mr-2"></i>{{ __('Find Friends') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-fw fa-envelope-open mr-2"></i>{{ __('Messages') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('friends') }}">
                        <i class="fas fa-fw fa-users mr-2"></i>{{ __('Friends') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('requests') }}">
                        <i class="fas fa-fw fa-exchange-alt mr-2"></i>{{ __('Requests') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
