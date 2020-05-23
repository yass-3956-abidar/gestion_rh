@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none">
    <div class="card-header border-secondary text-white" style="background-color: #9e9e9e ">
        Présence des employes
    </div>
    <div class="card-body" style="background-color: white">
        <div class="d-flex justify-content-center">
            <form action="{{route('presence.employer')}}" method="POST" class="form-inline">
                @csrf
                <input id="datePiker" name="datePresence" style="width: 30%" type="text" class="form-control mt-2 text-center p-1 pt-1" value="{{date('m/d/yy')}}">
                <button type="submit" id="btnNext" class="btn btn-success">Chercher Pointage<i class="fas fa-arrow-right ml-2"></i></button>
            </form>
        </div>
        @if(count($employers)==0)
        <div class="alert alert-warning" role="alert">
            Aucun Employer Trouver
        </div>
        @else
        <table id="tablePointage" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Nom Employer
                    </th>
                    <th class="th-sm">Pointage
                    </th>
                    <th class="th-sm text-center">Action

                    </th>
                </tr>
            </thead>
            <tbody>
                <div class="row">
                    @foreach($employers as $employer)
                    <tr>
                        <td>{{$employer->nom_employer." ".$employer->prenom}}</td>
                        <td>
                            <ul class="list-group list-group-horizontal">
                                @foreach($tablePresence[$employer->id] as $presence)
                                <li class="list-group-item active mr-1">
                                    <a> {{$presence->heur_entre." ".$presence->heur_sortit}}</a>
                                    </a>
                                    @endforeach
                            </ul>
                        </td>
                        <td>
                            <center><button class="btn btn-info btn-sm" data-toggle="modal" data-whatever="{{$employer->id}}" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Supprime</button></center>
                        </td>
                    </tr>
                    @endforeach
                </div>
            </tbody>
        </table>
        @endif
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pointage des employer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('presence.store')}}" method="POST">
                            @csrf
                            <input id="id_emp" type="hidden" name="id_emp">
                            <div class="form-group row">
                                <label for="heur_entre" class="col-md-4 col-form-label text-md-right">{{ __('Heure Entree') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input id="heur_entre" type="text" class="form-control @error('heur_entre') is-invalid @enderror" name="heur_entre" value="{{ old('heur_entre') }}" autocomplete="name" autofocus>
                                    @error('heur_entre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="heur_sortit" class="col-md-4 col-form-label text-md-right">{{ __('Heure Sortie') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input id="heur_sortit" type="text" class="form-control @error('heur_sortit') is-invalid @enderror" name="heur_sortit" value="{{ old('heur_sortit') }}" autocomplete="name" autofocus>
                                    @error('heur_sortit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('heur_sortit') }}" autocomplete="name" autofocus>
                                    @error('heur_sortit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- <script src="{{asset('App/public/js/presence/index.js')}}"></script> -->
<script>
    $(document).ready(function() {
        $("#datePiker").datepicker();
        $('#tablePointage').DataTable();
        $('.dataTables_length').addClass('bs-select');
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#id_emp').val(recipient);
        })
    });
</script>
@endsection
