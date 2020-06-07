@extends('admin.include.default')
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="container" id="tabs">
    <ul>
        <li> <a href="#employer"> Employeés</a></li>
        <li> <a href="#pointage">Pointage </a></li>
        <li> <a href="#avance">Avance </a></li>
        <li> <a href="#paie">Paie </a></li>
    </ul>
    <div id="employer">
        <table id="tableEmployer" class="table text-center" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Id Employer
                        <i class="fas fa-sort inline"></i>

                    </th>
                    <th class="th-sm">Matricule
                        <i class="fas fa-sort inline"></i>

                    </th>
                    <th class="th-sm">Nom Employer
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm">Prenom
                        <i class="fas fa-sort ml-0.5"></i>
                    </th>
                    <th class="th-sm">Numero CNSS
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm">Salaire
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm text-center">Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employers as $employer)
                <tr>
                    <td>{{$employer->id}}</td>
                    <td>{{$employer->cin}}</td>
                    <td>{{$employer->nom_employer}}</td>
                    <td>{{$employer->prenom}}</td>
                    <td>{{$employer->Num_cnss}}</td>
                    <td>{{$employer->salaire." ".$devise}}</td>
                    <td class="text-center">
                        <a href="{{route('para.emp.restore',$employer->id)}}" class="btn btn-default btn-sm  mr-1"><i class="far fa-edit mr-2"></i>restore</a>
                        <a id="forceDelete" href="{{route('employer.forceDelete',$employer->id)}}" class="btn btn-danger btn-sm  mr-1 ml-1 delete-confirm"> <i class="fas fa-trash-alt mr-2"></i>Supprimer</a>
                        <!-- Button trigger modal -->
                        <!-- Modal -->

                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="pointage">
        <!-- presence -->
        <table id="tablePointage" class="table text-center" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Matricule
                        <i class="fas fa-sort inline"></i>

                    </th>
                    <th class="th-sm">Id Employer
                        <i class="fas fa-sort inline"></i>

                    </th>
                    <th class="th-sm">Nom Employer
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm">Prenom
                        <i class="fas fa-sort ml-0.5"></i>
                    </th>
                    <th class="th-sm">Numero CNSS
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm">Salaire
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm text-center">Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employers as $employer)
                <tr>

                    <td>{{$employer->cin}}</td>
                    <td>{{$employer->id}}</td>
                    <td>{{$employer->nom_employer}}</td>
                    <td>{{$employer->prenom}}</td>
                    <td>{{$employer->Num_cnss}}</td>
                    <td>{{$employer->salaire." ".$devise}}</td>
                    <td class="text-center">
                        <a href="{{route('para.emp.restore',$employer->id)}}" class="btn btn-default btn-sm  mr-1"><i class="far fa-edit mr-2"></i>restore</a>
                        <a id="forceDelete" href="{{route('employer.forceDelete',$employer->id)}}" class="btn btn-danger btn-sm  mr-1 ml-1 delete-confirm"> <i class="fas fa-trash-alt mr-2"></i>Supprimer</a>
                        <!-- Button trigger modal -->
                        <!-- Modal -->

                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="avance">
        <table id="tableAvance" class="table text-center" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">
                        <span>Id Employer</span>
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm"><span class="test-sm">Date Afectation</span>
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm"><span>Montant</span>
                        <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th class="th-sm text-center"><span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                @if(count($avances)>0)
                <tr>

                    @foreach($avances as $avance)
                    <td>{{$avance->employer_id}}</td>
                    <td>{{$avance->date_affectation}}</td>
                    <td>{{$avance->montant." ".$devise}}</td>
                    <td class="text-center">
                        <a href="{{route('para.avance.restore',$avance->id)}}" class="btn btn-default btn-sm  mr-1"><i class="far fa-edit mr-2"></i>Restore</a>
                        <a href="{{route('para.avance.restore',$avance->id)}}" class="btn btn-danger btn-sm  mr-1 ml-1 delete-confirm"> <i class="fas fa-trash-alt mr-2"></i>Supprimer</a>

                        <!-- Button trigger modal -->
                        <!-- Modal -->
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <div id="paie"> tab 3 content</div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(e) {
        $("#tabs").tabs();
        $('#tablePointage').DataTable({
            "order": [
                [3, "desc"]
            ],
            "paging": true,
            "oLanguage": {
                "sLengthMenu": "Afficher _MENU_",
                "sSearch": "Rechercher",
                "sLenghtMenu": "Afficher _MENU_",
                "sZeroRecords": "Aucun pointage Trouvez!",
                "sInfo": "Afficher _START_ à _END_ de _TOTAL_ pointage",
                "sInfoFiltered": "(filtré à partir de _MAX_ pointage)",
                "oPaginate": {
                    "sPrevious": "Précédent",
                    "sNext": "Suivant"
                }
            }
        });
        $('#forceDelete').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Vous Voulez Vraiment supprimer l\'employer ?',
                text: "La suppression est ireversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'supprimer'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                    Swal.fire(
                        'Suppression!',
                        'L\'employer et supprimer',
                        'success'
                    )
                }
            })
        });
    });
</script>
@endsection
