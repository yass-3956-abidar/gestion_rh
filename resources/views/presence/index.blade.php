@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none">
    <div class="row">
        <div class="col-md-6">
            <div class="card-header mt-1 border-secondary text-white" style="background-color: #9e9e9e ">
                Présence des employes le {{date('yy-m-d')}}
            </div>
        </div>
        <div class="col-md-6">
            <button id="pointer_employer_selectioner" data-toggle="modal" data-target="#addALL" class="btn btn-primary float-right">Pointer les employer selectionee</button>
        </div>
    </div>
    <div class="row">
        <div class="card-body" style="background-color: white">
            @if(count($employers)==0)
            <div class="alert alert-warning" role="alert">
                Aucun Employer Trouver
            </div>
            @else
            <!-- Table  -->
            <table class="table table-bordered">
                <!-- Table head -->
                <thead>
                    <tr>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1">
                                <label class="custom-control-label" for="tableDefaultCheck1">Selectione tout</label>
                            </div>
                        </th>
                        <th class="th-sm">Nom Employer
                        </th>
                        <th class="th-sm">Pointage
                        </th>
                        <th class="th-sm text-center">Action
                        </th>
                    </tr>
                </thead>
                <!-- Table head -->

                <!-- Table body -->
                <tbody>
                    <div class="row">
                        <input type="hidden" id="nbr_employer" value="{{count($employers)}}">
                        @foreach($employers as $employer)
                        <tr>
                            <th scope="row">
                                <!-- Default unchecked -->
                                <div id="check_div" class="custom-control custom-checkbox col-md-3">
                                    <input type="checkbox" class="custom-control-input " id="chek{{$employer->id}}">
                                    <label class="custom-control-label " for="chek{{$employer->id}}"></label>
                                </div>
                            </th>
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
                <!-- Table body -->
            </table>
        </div>
    </div>
</div>
<!-- Table  -->
@endif
@include('util.presence.modelAdd')
@include('util.presence.modelEdit')
@include('util.presence.modelAddAll')
@endsection
@section('script')
<!-- <script src="{{asset('App/public/js/presence/index.js')}}"></script> -->
<script>
    $(document).ready(function() {

        let item1 = '<li class="breadcrumb-item active">Presence</li>';
        let item2 = '<li class="breadcrumb-item active">Pointage</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);


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
        $(document).on('click', '#tableDefaultCheck1', function() {
            if ($("#tableDefaultCheck1").is(':checked')) {
                console.log('selection tous');
                for (let i = 1; i <= $("#nbr_employer").val(); i++) {
                    $("#chek" + i).prop('checked', true)
                }
            } else {
                console.log('deselectionne tous');
                for (let i = 1; i <= $("#nbr_employer").val(); i++) {
                    $("#chek" + i).prop('checked', false)
                }
            }

        });
        $('#addALL').on('show.bs.modal', function(event) {
            var employer_selectionne = [];
            for (let i = 1; i <= $("#nbr_employer").val(); i++) {
                if ($("#chek" + i).is(':checked')) {
                    let option = '<option selected>' + i + '</option>';
                    employer_selectionne.push(i);
                    $("#select_empl").append(option);
                    // console.log('l\'un des employer sel ' + i);
                }
            }
        });
        // select_empl
        $(document).on('submit', '#formForAddAll', function(e) {
            $.ajax({
                url: "{{route('presence.saveAll')}}",
                type: "GET",
                contentType: 'application/json',
                data: $('#formForAddAll').serialize(),
                success: function(data) {
                    console.log(data);
                },
                error: function(one, two, tre) {
                    console.log(one);
                    console.log(two);
                    console.log(tre);
                }

            })
        });
    });
</script>
@endsection
