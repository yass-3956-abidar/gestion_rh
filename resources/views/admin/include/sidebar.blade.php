<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3 class=" text-white">RHAPP</h3>
        <strong>RH</strong>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a class="text-white" href="#">
                <i class="fas fa-house-user"></i>
                Tableau de bord
            </a>
        </li>
        <li>
            <a class="text-white" href="{{route('employer.index')}}">
                <i class="fas fa-address-card"></i>
                Employeé
            </a>
        </li>
        <li class="active">
            <a href="#presence" class="text-white" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-clipboard"></i>
                présence<i class="fas fa-sort-down float-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="presence">
                <li>
                    <a href="{{route('presenceEmp.index')}}"><span>Pointage </span></a>
                </li>
                <li>
                    <a href="{{route('presence.historique')}}"><span>Historique</span></a>
                </li>

            </ul>
        </li>
        <li>
            <a class="text-white" href="{{route('paie.index')}}">
                <i class="fas fa-paste"></i>
                paie
            </a>


        </li>
        <li>
            <a class="text-white" href="#pageSubmenu">
                <i class="fas fa-briefcase"></i>
                Emploi
            </a>
        </li>
        <li>
            <a class="text-white" href="#">
                <i class="fas fa-house-user"></i>
                Conget
            </a>
        </li>
        <li class="active">
            <a href="#outil" data-toggle="collapse" aria-expanded="false">
                <i id="appIdIcon" class="fas fa-border-none"></i>Outil <i class="fas fa-sort-down float-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="outil">
                <li>
                    <a href="{{route('admin.salire')}}"><span>SBG</span></a>
                </li>
                <li>
                    <a href="{{route('admin.ir')}}"><span>Calcul De IR</span></a>
                </li>
                <li>
                    <a href="#"><span>Salaire Net</span></a>
                </li>
            </ul>
        </li>

    </ul>

</nav>

<!-- Page Content Holder -->
