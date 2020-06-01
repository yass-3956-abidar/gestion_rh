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
                        <label for="employer_id" name="employer_id" class="col-md-5 col-form-label text-md-right">{{ __('Employer') }}
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
                        <label for="date_belletin_debut" class="col-md-5 col-form-label text-md-right">{{ __('Du') }}
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
                        <label for="date_belletin_fin" class="col-md-5 col-form-label text-md-right">{{ __('Au') }}
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
                        <label for="date_embauche" class="col-md-5 col-form-label text-md-right">{{ __('Date D\'embauche') }}
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
                        <label for="salaire_base" class="col-md-5 col-form-label text-md-right">{{ __('Salaire de base') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="salaire_base" type="text" name="salaire_base" class=" col-md-6 form-control @error('salaire_base') @enderror" value="{{old('salaire_base')}}">
                        @error('salaire_base')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="taux_Icmr" class="col-md-5 col-form-label text-md-right">{{ __('Taux ICMR') }}
                            <span class="text-danger ml-1">*</span>
                        </label>
                        <input id="taux_Icmr" type="text" placeholder="entre 3 et 6 %" name="taux_Icmr" class=" col-md-6 form-control @error('taux_Icmr') @enderror" value="{{old('taux_Icmr')}}" required>
                        @error('taux_Icmr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="avantage" class="col-md-5 col-form-label text-md-right">{{ __('Avantage En nature') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="avantage" type="number" min="0" value="0" name="avantage" class=" col-md-6 form-control @error('avantage') @enderror">
                        @error('avantage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="situationFami" class="col-md-5 col-form-label text-md-right">{{ __('Situation Familaile') }}
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
                        <label for="nbr_enfant" class="col-md-5 col-form-label text-md-right">{{ __('Nombre d\'enfant') }}
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
                        <label for="sexe" class="col-md-5 col-form-label text-md-right">{{ __('sexe') }}
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
                        <label for="avance" class="col-md-5 col-form-label text-md-right">{{ __('Avance') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="avance" type="number" min="1" name="avance" class=" col-md-6 form-control @error('avance') @enderror">
                        @error('avance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="cout_heurSup" class="col-md-5 col-form-label text-md-right">{{ __('Cout Par Heur') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="cout_heurSup" type="number" min="1" value="0" name="cout_heurSup" class=" col-md-6 form-control @error('cout_heurSup') @enderror">
                        @error('cout_heurSup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="interit" class="col-md-5 col-form-label text-md-right">{{ __('Interet credit logement') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="interit" type="number" min="1" value="0" name="interit" class=" col-md-6 form-control @error('interit') @enderror">
                        @error('interit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="exoneretion" class="col-md-5 col-form-label text-md-right">{{ __('EXONERATIONS') }}
                            <span class="text-danger ml-1"></span>
                        </label>
                        <input id="exoneretion" type="number" min="0" value="0" name="exoneretion" class=" col-md-6 form-control @error('exoneretion') @enderror">
                        @error('exoneretion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <p class="mt-2">Heur Supplementaire</p>
            <hr style="width: 15%;">
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
                            <option value="6-21">Entre 6h--21h</option>
                            <option value="21-6">Entre 21h--6h</option>
                        </select>
                    </div>
                </div>
            </div>
            <p class="lead mt-2"> Les Primes</p>
            <hr style="width: 9%;">
            <div class="row">
                <input id="nbr_prime_impo" type="hidden" name="nbr_prime_impo">
                <div class="col-md-6">
                    Designation
                    <div id="forDesignImposa">

                    </div>

                </div>
                <div class="col-md-6">
                    Montant
                    <div id="forMontantImposa">

                    </div>
                </div>
            </div>
            <div class="row">
                <div id="addDeleteImpo" class="col-md-6">
                    <a id="btnImosable" class=" btn btn-outline-info">Ajouter une prime</a>
                    <a style="display: none;" id="iconImp" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Simuler</button>
        </form>
        @include('util.avance.paie.fichePaie')
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/paie/paie.js')}}">
</script>
@endsection
