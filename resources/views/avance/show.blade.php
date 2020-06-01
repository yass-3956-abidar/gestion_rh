@extends('admin.include.default')
@section('content')
<div id="accordion">
    @foreach($employers as $employer)
    <div class="card" style="box-shadow: none">
        <div class="card-header bg-info" id="headingOne" style="opacity: 0.6">
            <a id="emp" class=" text-white mt-1" data-toggle="collapse" data-target="#{{$employer->cin}}" aria-expanded="true" aria-controls="{{$employer->cin}}">{{$employer->nom_employer." ".$employer->prenom}}
                <i id="iconDown" class="fas fa-chevron-down float-right"></i>
            </a>
        </div>
        <div id="{{$employer->cin}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><strong>Date Creation</strong> </th>
                            <th scope="col"><strong>Montant</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employer->avance as $avance)
                        <tr>

                            <td>{{$avance->date_affectation}}</td>
                            <td>{{$avance->montant." ".$devise}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <button type="button" class="btn btn-outline-primary float-right">
                    Total {{$employer->total}}
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('script')
<script>
</script>
@endsection
