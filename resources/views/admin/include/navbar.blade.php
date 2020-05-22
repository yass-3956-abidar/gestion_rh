<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn btn-sm">
        <i class="fas fa-bars "></i>
        <!-- <span>Toggle Sidebar</span> -->
    </button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon bg-info"></span> -->
        <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse float-right justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
             <i style="color: red" class="fas fa-comment  fa-2x mr-2"></i>
            </li>
            <li class="nav-item dropdown">
                <i style="color: red" class="fas fa-bell  fa-2x"></i>
            </li>


        </ul>
        <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="test" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img style="width: 35px;height: 35px" src="{{asset('storage/man.png')}}">
                    <span>{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu " aria-labelledby="test">
                    <a class="dropdown-item " href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider "></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-1"></i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav float-right">
            <!-- <li class="nav-item">

              </li> -->
        </ul>
    </div>
</nav>
