@extends('admin.include.default')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('employer.store')}}" method="POST">
            <h2 style="font-family: italic;color:gray">Information De L'Employer</h2>

            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Nom" name="nom_employer" class="form-control @error('nom_employer') is-invalid @enderror" value="{{old('nom_employer')}}">
                        @error('nom_employer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Prenom" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{old('prenom')}}">
                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Group of default radios - option 1 -->
                    <div class="custom-control custom-radio custom-control-inline mb-4 mt-1">
                        <input type="radio" class="custom-control-input" id="sexeh" name="sexe" checked>
                        <label class="custom-control-label" for="sexeh">Homme</label>
                    </div>

                    <!-- Group of default radios - option 2 -->
                    <div class="custom-control custom-radio custom-control-inline mb-4 mt-1">
                        <input type="radio" class="custom-control-input" id="sexef" name="sexe">
                        <label class="custom-control-label" for="sexef">Femme</label>
                    </div>
                    <div class="form-group mt-1">
                        <input type="text" placeholder="Cin/Matricul" name="cin" class="form-control @error('cin') is-invalid @enderror" value="{{old('cin')}}">
                        @error('cin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Date Naissance" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{old('date_naissance')}}">
                        @error('date_naissance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                        <input placeholder="Select date" type="text" id="example" class="form-control">
                        <label for="example">Try me...</label>
                        <i class="fas fa-calendar input-prefix"></i>
                    </div> -->
                    <div class="form-group">
                        <select name="situationFami" id="situationFami" class="form-control" value="{{old('situationFami')}}">
                            <option value="célibataire">célibataire</option>
                            <option value="marié">marié</option>
                            <option value="pacsé">pacsé</option>
                            <option value="divorcé">divorcé</option>
                            <option value="séparé">séparé</option>
                            <option value="veuf">veuf</option>
                        </select>
                        @error('situationFami')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Numero CNSS" name="Num_cnss" class="form-control @error('Num_cnss') is-invalid @enderror" value="{{old('Num_cnss')}}">
                        @error('Num_cnss')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Numero ICMR" name="Num_Icmr" class="form-control @error('Num_Icmr') is-invalid @enderror" value="{{old('Num_Icmr')}}">
                        @error('Num_Icmr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Salaire" name="salaire" class="form-control @error('salaire') is-invalid @enderror" value="{{old('salaire')}}">
                        @error('salaire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" placeholder="Choisir Image" name="image" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="nbrEnfant" placeholder="Nombre Enfant" name="nbr_enfant" class="form-control @error('nbr_enfant') is-invalid @enderror" value="{{old('nbr_enfant')}}" required>
                        @error('nbr_enfant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <h2 style="font-family: italic;color:gray">Poste</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="fonction" placeholder="fonction" class="form-control @error('fonction') is-invalid @enderror" value="{{old('fonction')}}">
                        @error('fonction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="date" name="date_debut" placeholder="Date Debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{old('date_debut')}}">
                        @error('date_debut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="nom_dep" placeholder="Departement" class="form-control @error('nom_dep') is-invalid @enderror" value="{{old('nom_dep')}}">
                        @error('nom_dep')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="date" name="date_fin" placeholder="Date Fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{old('date_fin')}}">
                        @error('date_fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="salaire_base" placeholder="Salaire De Base" class="form-control @error('salaire_base') is-invalid @enderror" value="{{old('salaire_base')}}">
                        @error('salaire_base')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <h2 style="font-family: italic;color:gray">Contrat</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}">
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                            <option value="CTT">CTT</option>
                            <option value="CUI">CUI</option>
                            <option value="CAE">CAE</option>
                            <option value="CIE">CIE</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="date" name="date_embauche" placeholder="Date Embauche" class="form-control  @error('date_embauche') is-invalid @enderror" value="{{ old('date_embauche') }}">
                        @error('date_embauche')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <h2 style="font-family: italic;color:gray">Banque</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="nom_banque" placeholder="Nom De La Banque " class="form-control @error('nom_banque') is-invalid @enderror" value="{{ old('nom_banque') }}">
                        @error('nom_banque')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="rib" placeholder="Rib" class="form-control @error('rib') is-invalid @enderror" value="{{old('rib')}}">
                        @error('rib')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="adresse" placeholder=" Adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{old('adresse')}}">
                        @error('adresse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="tele" placeholder="Telephone" class="form-control @error('tele') is-invalid @enderror" value="{{old('tele')}}">
                        @error('tele')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="enregistre" type="submit" class="btn btn-primary">Enregistrer
                    <span id="spinerEnregister" style="display:none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
