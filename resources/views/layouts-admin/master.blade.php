@include('layouts-admin.header')

<!-- Navigation-->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary" id="mainNav">
    <a class="navbar-brand" href="{{ url('/') }}">Home Page</a>
    <button class="navbar-toggler navbar-toggler-right" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item mt-3 mb-2" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="people" id="collapse-people-li">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePeople"
                    data-parent="#exampleAccordion">
                    <i class="fas fa-fw fa-users"></i>
                    <span class="nav-link-text">People</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsePeople">
                    <li>
                        <a href="{{ route('admin.role.admin') }}">Admins</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.role.user') }}">Users</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Favicon">
                <a class="nav-link" href="{{ route('admin.favicon') }}">
                    <i class="fa fa-fw fa-flag"></i>
                    <span class="nav-link-text">Set Favicon</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Forbidden words">
                <a class="nav-link" href="{{ route('admin.forbidden.words') }}">
                    <i class="fas fa-fw fa-skull-crossbones"></i>
                    <span class="nav-link-text">Forbidden words</span>
                </a>
            </li>

            

        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container-fluid" id="app">
        @yield('content')
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-outline-danger" 
                       href="#" 
                       onclick="event.preventDefault(); 
                       document.getElementById('logout-form').submit();"
                    >
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts-admin.footer')
