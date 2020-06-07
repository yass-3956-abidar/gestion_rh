@extends('admin.include.default')
@section('content')
<div class="col-md-12">
    <div class="card border-primary">
        <div class="card-body">
            @if(count($demande_congets)==0)
            <div class="alert alert-warning" role="alert">
                Aucun Element Trouver
            </div>
            @else
            <table id="tableEmployer" class="table text-center" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Nom employer

                        </th>
                        <th class="th-sm">Prenom

                        </th>
                        <th class="th-sm">Matricule

                        </th>
                        <th class="th-sm">Date debut

                        </th>
                        <th class="th-sm">Dureé

                        </th>
                        <th class="th-sm">Type de conget

                        </th>
                        <th class="th-sm">Status

                        </th>
                        <th class="th-sm text-center">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demande_congets as $demande_conget)
                    <tr>
                        <td>{{$demande_conget[1]->nom_employer}}</td>
                        <td>{{$demande_conget[1]->prenom}}</td>
                        <td>{{$demande_conget[1]->cin}}</td>
                        <td>{{$demande_conget[0]->date_debut}}</td>
                        <td>{{$demande_conget[0]->durre}}</td>
                        <td>{{$demande_conget[2]->type}}</td>
                        <td id="td_status" style="height: 10px;">{{$demande_conget[0]->status}}</td>
                        <td class="text-center">
                            <a id="accept_btn" href="{{route('conget.updateStatus',$demande_conget[0]->id)}}" class="btn btn-info btn-sm  mr-1"><i class="far fa-edit mr-2"></i>Accepter</a>
                            <a data-toggle="modal" data-target="#modalUpdateConget" data-date_debut="{{$demande_conget[0]->date_debut}}" data-durre="{{$demande_conget[0]->durre}}" data-id_conget="{{$demande_conget[0]->id}}" id="accept_btn" href="{{route('conget.updateStatus',$demande_conget[0]->id)}}" class="btn btn-default btn-sm  mr-1"><i class="far fa-edit mr-2"></i>Modifier</a>
                            <a href="{{route('conget.destroyStatus',$demande_conget[0]->id)}}" class="btn btn-danger btn-sm  mr-1 ml-1 "> <i class="fas fa-trash-alt mr-2"></i>Refuser</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <div class="modal fade" id="modalUpdateConget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="form_update_conget" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier le conget</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="display:none" id="alertMessage" class="alert" role="alert">
                        </div>
                        <input type="hidden" name="id_conget" id="id_conget">
                        <div class="form-group">
                            <label for="durre" class="col-form-label">Dureé</label>
                            <input type="number" min="1" name="durre" id="durre" class="form-control @error('durre') is-invalid @enderror">
                            @error('durre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_debut" class="col-form-label">Date debut:</label>
                            <input name="date_debut" type="date" name="durre" id="date_debut" class="form-control @error('durre') is-invalid @enderror" required>
                            @error('durre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="raison" class="col-form-label">Raison:</label>
                            <textarea rows="8" cols="5" name="raison" type="text" id="raison" class="form-control @error('durre') is-invalid @enderror" required>
                            </textarea>
                            @error('raison')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnupdateConget" type="submit" class="btn btn-primary">Enregistre</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @endsection
    @section('script')
    <script>
        $(document).ready(function() {
            if ($("#td_status").val() == 'Accepter') {
                $("#td_status").addClass('bg-info');
            } else if ($("#td_status").val() == 'en attend') {
                $("#td_status").addClass('bg-warning');
            } else if ($("#td_status").val() == 'refuser') {
                $("#td_status").addClass('bg-danget');
            }
            let item = '<li class="breadcrumb-item active">Conget</li>';
            $("#list_breadcrumb").append(item);
            $("#accept_btn").click(function() {
                $("#td_status").addClass('bg-default');
            })
            $('#modalUpdateConget').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $("#modalUpdateConget");
                modal.find('#durre').val(button.data('durre'));
                modal.find('#date_debut').val(button.data('date_debut'));
                modal.find('#id_conget').val(button.data('id_conget'));
            })
            $(document).on('submit', '#form_update_conget', function(e) {
                e.preventDefault();
                let id_conget = $("#id_conget").val();
                let date_debut = $("#date_debut").val();
                let raison=$("#raison").val();
                console.log(date_debut);
                let durre = $("#durre").val();
                $.ajax({
                    url: "/employer/conget/" + id_conget,
                    method: "PUT",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'date_debut': date_debut,
                        'durre': durre,
                        'raison':raison,
                        'id_conget': id_conget,
                    },
                    success: function(data) {
                        console.log(data);
                        $("#alertMessage").show();
                        $("#alertMessage").addClass('alert-success');
                        $("#alertMessage").text(data.message);
                        setInterval(() => {
                            location.reload(true);
                        }, 3000);

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
    @endsection

    <!-- information post -->
    <!--
