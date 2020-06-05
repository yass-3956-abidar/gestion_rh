@extends('admin.include.default')
@section('content')
<div class="col-md-12">
    <div class="row justify-content-center">
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i class="fas fa-5x fa-users text-warning"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">{{$nombre_employer}} employers dans votre entreprise</h4>
                    <!-- Text -->
                    <a href="{{route('employer.index')}}" class="btn btn-outline-warning float-right">Detail</a>
                </div>
            </div>
        </div>
        <!-- Card -->
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i class="fas fa-5x fa-users text-info"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">{{$employer_preson}} Present le {{date('d/m/yy')}}</h4>
                    <!-- Text -->
                    <a href="{{route('presenceEmp.index')}}" class="btn btn-outline-info float-right">Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i class="fas fa-building fa-5x mt-1 text-secondary"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">Le Nombre de departement est {{$nbrdep}}</h4>
                    <!-- Text -->
                    <a href="#" class="btn btn-outline-secondary float-right">Detail</a>
                </div>
            </div>
        </div>
        <!-- Card -->
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i class="fas  fa-5x fa-briefcase text-default"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">Les post Ocuper sont {{$nbremploi}}</h4>
                    <!-- Text -->
                    <a href="#" class="btn btn-outline-default float-right">Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i style="color: #ff4444;" class="fas mt-1 fa-5x fa-file-alt"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">{{$nbrFichePaie}} fiche cree le {{date('m/yy')}}</h4>
                    <!-- Text -->
                    <a href="{{route('paie.index')}}" class="btn btn-outline-danger float-right">Detail</a>
                </div>
            </div>
        </div>
        <!-- Card -->
        <!-- Card -->
        <div class="col-md-5">
            <div class="card">
                <!-- Card image -->
                <center><i style="color: #ff4444;" class="fas mt-1 fa-5x fa-file-alt"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title" style="font-style: italic;">{{$nbrFichePaie}} fiche cree le {{date('m/yy')}}</h4>
                    <!-- Text -->
                    <a href="#" class="btn btn-outline-danger float-right">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
