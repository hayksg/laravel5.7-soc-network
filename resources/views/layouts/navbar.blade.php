<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
    <div class="container">
        <h1 class="app-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <form class="top-search-form mr-auto">
                <input class="form-control top-search-input"
                       type="search"
                       placeholder="Type and press enter to search"
                       name="search"
                       aria-label="Search"
                       autocomplete="off">
            </form>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-fw fa-sign-in-alt mr-1"></i>{{ __('Login') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-fw fa-user-plus mr-1 app-user-plus-icon"></i>{{ __('Register') }}
                            </a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link app-thubnail-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="app-thubnail-wrapper">
                                @include('layouts.profile-pic')
                            </span>&nbsp;<span>{{ onlyName(false) }}</span> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('getWithSlug', [Auth::user()->slug]) }}">
                                <i class="fas fa-fw fa-user"></i> {{ __('Profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}">
                                <i class="fas fa-fw fa-user-edit"></i> {{ __('Edit Profile') }}
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="fas fa-fw fa-user-friends"></i> {{ __('Find Friends') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('admin') }}">
                                <i class="fas fa-fw fa-user-cog"></i> {{ __('Admin') }}</a>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>