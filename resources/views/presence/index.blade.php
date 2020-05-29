@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none">
    <div class="card-header border-secondary text-white" style="background-color: #9e9e9e ">
        Présence des employes le {{date('yy-m-d')}}
    </div>
    <div class="card-body" style="background-color: white">
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
                                <li id="valPoi" class="list-group-item active mr-1">
                                    <button data-toggle="modal" data-id="{{$presence->id}}" data-note="{{$presence->note}}" data-id-emp="{{$employer->id}}" data-heur-entre="{{$presence->heur_entre}}" data-heur-sortit="{{$presence->heur_sortit}}" data-target="#editModal"> {{$presence->heur_entre." "."=>"." ".$presence->heur_sortit}}</button>
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <center><button class="btn btn-info btn-sm" data-toggle="modal" data-whatever="{{$employer->id}}" data-target="#exampleModal"><i class="fas fa-plus"></i></button>

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
                        <form id="formForAdd" action="{{route('presenceEmp.store')}}" method="POST">
                            @csrf
                            <input id="id_emp" type="hidden" name="id_emp">
                            <input type="hidden" name="date_pointe" class="form-control @error('date_pointe') is-invalid @enderror" value="{{date('yy-m-d')}}">
                            @error('date_pointe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                                <button id="addBtn" type="submit" class="btn btn-primary">Enregistre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pointage</h5>
                        <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('presence.updateP')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input id="id_presence" type="hidden" name="id_presence">
                            <input type="hidden" name="date_pointe" class="form-control @error('date_pointe') is-invalid @enderror" value="{{date('yy-m-d')}}">
                            @error('date_pointe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group row">
                                <label for="heurE" class="col-md-4 col-form-label text-md-right">{{ __('Heure Entree') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input id="heurE" type="text" class="form-control @error('heur_entre') is-invalid @enderror" name="heur_entre" value="{{ old('heur_entre') }}" autocomplete="name" autofocus>
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
                                    <input id="heurS" type="text" class="form-control @error('heur_sortit') is-invalid @enderror" name="heur_sortit" value="{{ old('heur_sortit') }}" autocomplete="name" autofocus>
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
                                    <input id="noteS" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('heur_sortit') }}" autocomplete="name" autofocus>
                                    @error('heur_sortit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a id="deleteBtn" type="submit" class="btn btn-danger">Supprimer</a>
                                <button type="submit" class="btn btn-outline-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endsection
            @section('script')
            <!-- <script src="{{asset('App/public/js/presence/index.js')}}"></script> -->
            <script>
                $(document).ready(function() {
                    $('#tablePointage').DataTable({
                        "paging": true,
                        "oLanguage": {
                            "sLengthMenu": "Afficher _MENU_",
                            "sSearch": "Rechercher",
                            "sLenghtMenu": "Afficher _MENU_",
                            "sZeroRecords": "Aucun employé Trouvez!",
                            "sInfo": "Afficher _START_ à _END_ de _TOTAL_ employés",
                            "sInfoFiltered": "(filtré à partir de _MAX_ employés)",
                            "oPaginate": {
                                "sPrevious": "Précédent",
                                "sNext": "Suivant"
                            }
                        }
                    });
                    $('.dataTables_length').addClass('bs-select');
                    $('#exampleModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('whatever') // Extract info from data-* attributes
                        var modal = $(this)
                        modal.find('#id_emp').val(recipient);
                    });
                    $('#editModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('heur-entre') // Extract info from data-* attributes
                        var modal = $(this);
                        modal.find('#heurE').val(button.data('heur-entre'));
                        modal.find('#heurS').val(button.data('heur-sortit'));
                        modal.find('#noteS').val(button.data('note'));
                        modal.find('#id_presence').val(button.data('id'));
                        modal.find('#deleteBtn').val(button.data('id'));
                        console.log($("#deleteBtn").val());
                    });
                    $(document).on('click', '#deleteBtn', function() {
                        let id = $("#deleteBtn").val();

                        Swal.fire({
                            title: 'Vous Voulez Vraiment l\'apresence ?',
                            text: "La suppression est reversible",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'supprimer'
                        }).then((result) => {
                            if (result.value) {
                                Swal.fire(
                                    'Suppression!',
                                    'La presence est supprimer',
                                    'success'
                                )
                                $("#editModal").modal("hide");
                                $.ajax({
                                    url: "{{route('presence.delete')}}",
                                    method: "get",
                                    data: {
                                        id,
                                        id
                                    },
                                    success: function(data) {
                                        $("#valPoi").remove();
                                    },
                                    error: function(one, two, tre) {
                                        console.log(one);
                                        console.log(two);
                                        console.log(tre);
                                    }

                                })
                            }
                        });
                    });
                    // $(document).on('click', '#addBtn', function(e) {
                    //     e.preventDefault();
                    //     var heur_sortit = $('input[name="heur_sortit"]').val();
                    //     var heur_entre = $('input[name="heur_entre"]');
                    //     var date_pointe = $('input[name="date_pointe"]').val();
                    //     var id_emp = $('input[name="id_emp"]').val()
                    //         $.ajax({
                    //         type: "POST",
                    //             url: "{{route('presenceEmp.store')}}",

                    //             data: {
                    //                 '_token': '{{csrf_token()}}',
                    //                 'heur_sortit': heur_sortit,
                    //                 'heur_entre': heur_entre,
                    //                 'date_pointe': date_pointe,
                    //                 'id_emp': id_emp,
                    //             },
                    //             success: function(data) {
                    //                 console.log(data);
                    //             },
                    //             error: function(request, status, error) {
                    //                 alert(request.responseText);
                    //             }

                    //         })
                    // });



                });
            </script>
            @endsection
