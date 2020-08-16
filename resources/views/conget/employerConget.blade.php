@extends('admin.include.default')
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header text-white bg-primary">
            Les Employers en conget
        </div>
        <div class="card-body">
            @if(count($employerEnConget)==0)
            <div class="alert alert-warning" role="alert">
                Aucun Conget Trouver
            </div>
            @else
            <table id="tableEmployer" class="table text-center table-hover" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Matricule
                            <i class="fas fa-sort inline"></i>

                        </th>
                        <th class="th-sm">Nom Employer
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm">Prenom
                            <i class="fas fa-sort ml-0.5"></i>
                        </th>
                        <th class="th-sm">Type de conget
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm bg-default text-white">date debut
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm text-white bg-danger">date Fin
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm text-center">Durre
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm text-center">Status
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employerEnConget as $employerEnCon)
                    <tr>

                        <td>{{$employerEnCon[1]->cin}}</td>
                        <td>{{$employerEnCon[1]->nom_employer}}</td>
                        <td>{{$employerEnCon[1]->prenom}}</td>
                        <td>{{$employerEnCon[2]->type}}</td>
                        <td class="bg-default text-white">{{$employerEnCon[0]->date_debut}}</td>
                        <td class="bg-danger text-white">{{date('Y-m-d', strtotime($employerEnCon[0]->date_debut.'+'.($employerEnCon[0]->durre).'days'))}}</td>
                        <td>{{$employerEnCon[0]->durre}}</td>
                        <td>{{$employerEnCon[0]->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection
