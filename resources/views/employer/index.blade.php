@extends('admin.include.default')
@section('content')
<div class="espace"></div>
<div class="espace"></div>
<div class="col-md-12 mt-4">
    <div class="card border-primary">
        <div class="card-header">Les Employer</div>
        <div class="card-body">
            @forelse ($employers as $employer)
            <li>{{ $employer->nom_employer }}</li>
            @empty
            <div class="alert alert-warning" role="alert">
                Aucun Employer Trouver
            </div>
            @endforelse
            <center>
                <a href="{{route('employer.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus fa-1x mr-1"></i>Ajouter Un Employer
                </a>
            </center>
        </div>
    </div>
</div>
@endsection


<!-- information post -->
<!--
