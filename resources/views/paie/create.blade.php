@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none;">
    <div class="card-header bg-success text-white">
        Cree Une fiche de paie de {{date('yy-m')}}
    </div>
    <div class="card-body">
        <form id="fromSimul" method="get">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- les employers -->
                    <!-- la date du paie -->
                    <!-- date embauche  -->
                    <!-- salaire de base -->
                    <div class="form-group row">
                        <label for="employer_id" name="employer_id" class="col-md-4 col-form-label text-md-right">{{ __('Employer') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <select id="employer_id" name="employer_id" class="form-control col-md-6 @error('employer_id') is-invalid @enderror">
                            <option value="0">---select---</option>
                            @foreach($employers as $employer)
                            <option value="{{$employer->id}}">{{$employer->nom_employer}}</option>
                            @endforeach
                        </select>
                        @error('employer_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="date_belletin_debut" class="col-md-4 col-form-label text-md-right">{{ __('Du') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="date_belletin_debut" type="date" name="date_belletin_debut" class=" col-md-6 form-control @error('date_belletin_debut') @enderror" value="{{old('date_belletin_debut')}}">
                        @error('date_belletin_debut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="date_belletin_fin" class="col-md-4 col-form-label text-md-right">{{ __('Au') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="date_belletin_fin" type="date" name="date_belletin_fin" class=" col-md-6 form-control @error('date_belletin_fin') @enderror" value="{{old('date_belletin_fin')}}">
                        @error('date_belletin_fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="date_embauche" class="col-md-4 col-form-label text-md-right">{{ __('Date D\'embauche') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="date_embauche" type="date" name="date_embauche" class="col-md-6 form-control @error('date_embauche') @enderror" value="{{old('date_embauche')}}">
                        @error('date_embauche')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="salaire_base" class="col-md-4 col-form-label text-md-right">{{ __('Salaire de base') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="salaire_base" type="text" name="salaire_base" class=" col-md-6 form-control @error('salaire_base') @enderror" value="{{old('salaire_base')}}">
                        @error('salaire_base')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="situationFami" class="col-md-4 col-form-label text-md-right">{{ __('Situation Familaile') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="situationFami" type="text" name="situationFami" class=" col-md-6 form-control @error('situationFami') @enderror" value="{{old('situationFami')}}">
                        @error('situationFami')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="nbr_enfant" class="col-md-4 col-form-label text-md-right">{{ __('Nombre d\'enfant') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="nbr_enfant" type="number" min="0" name="nbr_enfant" class=" col-md-6 form-control @error('nbr_enfant') @enderror" value="{{old('nbr_enfant')}}">
                        @error('nbr_enfant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('sexe') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="sexe" type="text" name="sexe" class=" col-md-6 form-control @error('sexe') @enderror">
                        @error('sexe')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="avance" class="col-md-4 col-form-label text-md-right">{{ __('Avance') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="avance" type="number" min="0" value="0" name="avance" class=" col-md-6 form-control @error('avance') @enderror">
                        @error('avance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="cout_heurSup" class="col-md-4 col-form-label text-md-right">{{ __('Cout Par Heur') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="cout_heurSup" type="number" min="1" value="0" name="cout_heurSup" class=" col-md-6 form-control @error('cout_heurSup') @enderror">
                        @error('cout_heurSup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">Jour Ferier</p>
                </div>
                <div class="col-md-6">
                    <p class="lead">Jour Ouvrable</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" name="nbr_heur_ferie" id="nbr_heur_ferie" class="form-control" placeholder="Heur Supplementaire">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select type="text" name="interval_Ferier" id="interval_Ferier" class="form-control" placeholder="Interval">
                            <option>---</option>
                            <option value="6-21">Entre 6h--21h</option>
                            <option value="21-6">Entre 21h--6h</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" name="nbr_heur_ouvrable" id="nbr_heur_ouvrable" class="form-control" placeholder="Heur Supplementaire">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select type="text" name="interval_ouvrable" id="interval_ouvrable" class="form-control" placeholder="Interval">
                            <option>---</option>
                            <option value="6-12">Entre 6h--21h</option>
                            <option value="21-6">Entre 21h--6h</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead"> Les Primes et indemnités Imposable</p>
                    <hr>
                </div>
                <div class="col-md-6">
                    <p class="lead"> Les Primes et indemnités Non Imposable</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <input id="nbr_prime_impo" type="hidden" name="nbr_prime_impo">
                <input id="nbr_prime_Non_impo" type="hidden" name="nbr_prime_Non_impo">
                <div class="col-md-3">
                    Designation
                    <div id="forDesignImposa">

                    </div>

                </div>
                <div class="col-md-3">
                    Montant
                    <div id="forMontantImposa">

                    </div>
                </div>
                <div class="col-md-3">
                    Designation
                    <div id="forDesignNonImposa">

                    </div>
                </div>
                <div class="col-md-3">
                    Montant
                    <div id="forMontantNonImposa">

                    </div>
                </div>
            </div>
            <div class="row">
                <div id="addDeleteImpo" class="col-md-6">
                    <a id="btnImosable" class=" btn btn-outline-info">Ajouter une prime imposable</a>
                    <a style="display: none;" id="iconImp" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </div>
                <div id="AddDeleteNImp" class="col-md-6">
                    <a id="btnNonImposable" class=" btn btn-outline-info">Ajouter une prime non imposable</a>
                    <a style="display: none;" id="iconNonImpo" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Simuler</button>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        let i = 1;
        let j = 1;
        // $("#iconImp").hide();
        // $("#iconNonImpo").hide();
        $(document).on('change', '#employer_id', function(e) {
            e.preventDefault()
            var id = $("#employer_id").val();
            if (id > 0) {
                $.ajax({
                    url: "{{route('paie.show')}}",
                    type: "GET",
                    contentType: 'application/json',
                    data: {
                        id
                    },
                    success: function(data) {
                        console.log(data.employer.id);
                        $("#nbr_enfant").val(data.employer.nbr_enfant);
                        $("#situationFami").val(data.employer.situationFami);
                        $("#sexe").val(data.employer.sexe);
                        $("#date_embauche").val(data.contrat.date_embauche);
                        $("#salaire_base").val(data.post.salaire_base);

                    },
                })
            } else {
                $("#nbr_enfant").val("");
                $("#situationFami").val("");
                $("#sexe").val("");
                $("#date_embauche").val("");
                $("#salaire_base").val("");
            }
        });

        $(document).on('submit', '#fromSimul', function(e) {
            e.preventDefault()
            if ($("#employer_id").val() == 0) {
                Swal.queue([{
                    title: 'Employer non trouver',
                    text: 'Choisit un employer',
                    showLoaderOnConfirm: true,
                }]);
            }

            $.ajax({
                url: "{{route('paie.salNet')}}",
                type: "get",
                contentType: 'application/json',
                data: $('#fromSimul').serialize(),
                success: function(data) {
                    console.log(data);
                },
                error: function(one, two, three) {
                    console.log(one);
                    console.log(two);
                    console.log(three);
                }
            });
        });
        $(document).on('click', '#btnImosable', function(e) {
            e.preventDefault();

            $("#iconImp").show();
            var e1 = $("<input id='i' class='form-control mt-1' placeholder='Designation' type='text'>");
            $("#forDesignImposa").append(e1);
            e1.attr('id', 'designImpo' + j);
            e1.attr('name', 'designImpo' + j);

            var e2 = $("<input id='i' class='form-control mt-1' placeholder='Montant'  type='number'>");
            $("#forMontantImposa").append(e2);
            e2.attr('id', 'MontantImpo' + j);
            e2.attr('name', 'MontantImpo' + j);
            $("#nbr_prime_impo").val(j);
            j++;



        });
        $(document).on('click', '#btnNonImposable', function(e) {
            e.preventDefault();
            $("#iconNonImpo").show();
            var e3 = $("<input id='i' class='form-control mt-1' placeholder='Designation'  type='text'>");
            $("#forDesignNonImposa").append(e3);
            e3.attr('id', 'designNonImpo' + i);
            e3.attr('name', 'designNonImpo' + i);


            var e4 = $("<input id='i' class='form-control mt-1' placeholder='Montant' type='number'>");
            $("#forMontantNonImposa").append(e4);
            e4.attr('id', 'MontantNonImpo' + i);
            e4.attr('name', 'MontantNonImpo' + i);
            $("#nbr_prime_Non_impo").val(i);
            i++;
        });
        $(document).on('click', '#iconImp', function() {
            let index = j - 1;
            $("#designImpo" + index).remove();
            $("#MontantImpo" + index).remove();
            $("#nbr_prime_impo").val(j - 2);
            j = j - 1;
            if (j == 1) {
                $("#iconImp").hide();
            }


        });
        $(document).on('click', '#iconNonImpo', function() {
            let index = i - 1;
            $("#designNonImpo" + index).remove();
            $("#MontantNonImpo" + index).remove();
            $("#nbr_prime_Non_impo").val(i - 2);
            i = i - 1;
            if (i == 1) {
                $("#iconNonImpo").hide();
            }
        });


    });
</script>
@endsection
