<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg fixed-top navbar-dark default-color">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('espaceEmployer.index')}}">Accueil
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-433" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Conget
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-433">
                        <a class="dropdown-item" href="{{route('conget.create')}}">Demandé un conget</a>
                        <a class="dropdown-item" href="{{route('conget.index')}}">Conget accepter</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        @if(session()->has('name'))
                        {{session()->get('name')}}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Entreprise</a>
                        <a class="dropdown-item" href="#">Demande</a>
                        <a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <i class="fas fa-sign-out-alt ml-2 text-info"></i>
                        </a>
                        <form id="logout-form" action="{{ route('espaceemployer.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--/.Navbar -->
