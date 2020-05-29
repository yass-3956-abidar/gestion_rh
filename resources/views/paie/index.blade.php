@extends('admin.include.default')
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('paie.create')}}" class="btn btn-outline-primary">
                <i class="fas fa-plus fa-1x mr-1"></i>Ajouter Une Fice de Paie
            </a>
        </div>
    </div>
    <div class="card border-primary">
        <div class="card-header">
            Les fiches de paie
        </div>
        @if(isset($paie))<center>
            <div class="alert alert-warning mt-2" style="width: 50%;">
                Aucun fiche de paie Trouver
            </div>
        </center>
        @else
        <div class="card-body">
            body
            {{$paie}}
        </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection
