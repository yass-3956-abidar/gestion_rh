@extends('admin.include.default')
@section('style')
<style>
</style>
@endsection
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="annee_paie">Choisit L'annee</label>
                    <select name="annee_paie" id="annee_paie" class="form-control mdb-select md-form">
                        <option value="0">---</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="moi_paie">Choisit le mois</label>
                    <select name="moi_paie" id="moi_paie" class="form-control mdb-select md-form">
                        <option value="0">---</option>
                    </select>
                </div>
            </div>
            <div id="paie_alert" style="display: none;" class="alert alert-warning mt-2" role="alert"></div>
            <table style="display: none;" id="table_paie" class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Nom employer</th>
                        <th>Prenom</th>
                        <th>Fiche de paie Du</th>
                        <th>Fiche de paie Au</th>
                        <th>Salire Brut global</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body_table_paie">

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Paie</li>';
        let item2 = '<li class="breadcrumb-item active">Index</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);
        let d = new Date();
        let yearNow = d.getFullYear();
        for (let i = 2015; i <= yearNow; i++) {
            let option = `<option> ${i}</option>`
            $("#annee_paie").append(option);
        }
        for (let j = 1; j <= 12; j++) {
            let optionn = '<option>' + j + '</option>'
            $("#moi_paie").append(optionn);
        }
        $(document).on('change', '#annee_paie', function(e) {
            $("#moi_paie").trigger('change');
        });
        $(document).on('change', '#moi_paie', function(e) {
            e.preventDefault();
            let month = $("#moi_paie").val();
            let year = $("#annee_paie").val();
            $.ajax({
                url: "{{route('paie.cherche')}}",
                type: "GET",
                contentType: 'application/json',
                data: {
                    'month': month,
                    'year': year,
                },
                success: function(data) {
                    console.log(data)
                    if (data.status) {
                        $("#table_paie").show();
                        $("#paie_alert").hide();
                        $("tbody").html(data.data);
                    } else {
                        $("#table_paie").hide();
                        $("#paie_alert").show();
                        $("#paie_alert").text(data.data);
                    }


                },
                error: function(errr, tow) {
                    console.log(errr);
                    console.log(tow);
                }
            });


        });
    });
</script>
@endsection
