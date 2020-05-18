<nav class="navbar navbar-default">
    <div class="d-flex bd-highlight flo">
        <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn btn-sm">
                <i class="fas fa-bars "></i>
                <!-- <span>Toggle Sidebar</span> -->
            </button>
        </div>
        <form action="{{ route('logout') }}" method="POST">
        <div class=" d-flex justify-content-end ">
            <button  type="submit" class="btn btn-primary  btn-sm">Deconnecter</button>
        </div>
        </form>
    </div>
</nav>
