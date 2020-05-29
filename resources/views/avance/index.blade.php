@extends('admin.include.default')
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('avance.create')}}" class="btn btn-outline-success">
                <i class="fas fa-plus fa-1x mr-1"></i>Ajouter Une Avance
            </a>
        </div>
    </div>
    <div class="card border-success">
        <div class="card-header">
            Les avance
        </div>
        @if(count($employers)==0)
        <center>
            <div class="alert alert-warning mt-2" style="width: 50%;">
                Aucun avance Trouver
            </div>
        </center>
        @else
        <div class="card-body">
            <table id="tableAvance" class="table text-center" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Nom Employer
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm">Prenom
                            <i class="fas fa-sort ml-0.5"></i>
                        </th>
                        <th class="th-sm">Matricule
                            <i class="fas fa-sort ml-0.5"></i>
                        </th>
                        <th class="th-sm">Date Afectation
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm">Montant
                            <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="th-sm text-center">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employers as $employer)
                    <tr>
                        <td>{{$employer->nom_employer}}</td>
                        <td>{{$employer->prenom}}</td>
                        <td>{{$employer->cin}}</td>
                        @foreach($avances[0] as $avance)
                        <td>{{$avance->id}}</td>
                        <td>{{$avance->id}}</td>
                        @endforeach
                        <td class="text-center">
                            <a href="{{route('employer.edit',$employer->id)}}" class="btn btn-warning btn-sm  mr-1"><i class="far fa-edit mr-2"></i>Edit</a>

                            <a href="{{route('employer.delete',$employer->id)}}" class="btn btn-danger btn-sm  mr-1 ml-1 delete-confirm"> <i class="fas fa-trash-alt mr-2"></i>Supprimer</a>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <a href="{{route('employer.show',$employer->id)}}" class="btn btn-info btn-sm  mr-1"><i class="fas fa-eye mr-2"></i>Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('body').scrollspy({
            target: '#navbar-example'
        });
        $('#tableAvance').DataTable({
            "order": [
                [3, "desc"]
            ],
            "paging": true,
            "oLanguage": {
                "sLengthMenu": "Afficher _MENU_ employés par page",
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
    });
</script>
@endsection
