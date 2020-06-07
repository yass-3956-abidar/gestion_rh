@extends('espaceEmployer.include.nosidebar')
@section('style')
<style>
    .espace {
        height: 50px;
    }
</style>
@endsection
@section('content')
<div class="espace"></div>
<div class="espace"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    text
                </div>
                <div class="card-body">
                    tbhjdnmd ds vbsdv dskjbv msdkbvsd
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!--Panel-->
            <div class="card text-center">
                <div class=" card-header default-color white-text">
                    Votre demande est traite {{$time}}
                </div>
                <div class="card-body">
                    <h4 class="card-title">Votre demande</h4>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                 -->
                    <!-- <a class="btn btn-success btn-sm">Go somewhere</a> -->
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">Date dubét</div>
                                <div class="col-md-6">{{$conget->date_debut}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">Durre</div>
                                <div class="col-md-6">{{$conget->durre}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">Reponse</div>
                                <div class="col-md-6">{{$conget->status}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">Raison</div>
                                <div class="col-md-6">
                                    <p class="lead"> {{$conget->raison}}
                                        kbdhvds vdsbvd vbsvmdvb bd bysine yassine abidare yyhelo gahbnbjhd yassine ha abiare anofadrkjnfojdkvbdvyassine abbhjc
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Grid row -->
    </div>
</div>
<div class="espace"></div>
<div class="espace"></div>
@endsection
@section('script')
<script>
    // alert('hi')
</script>

@endsection
