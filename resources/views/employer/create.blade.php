@extends('admin.include.default')
@section('content')
<div class="card border-primary">
    <div class="card-body">
        <form action="{{route('employer.store')}}" method="POST">
            <h2>Information De L'Employer</h2>
            <hr class="bg-primary">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Nom" name="nom_employer" class="form-control @error('nom_employer') is-invalid @enderror">
                        @error('nom_employer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Prenom" name="prenom" class="form-control @error('prenom') is-invalid @enderror">
                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Group of default radios - option 1 -->
                    <div class="custom-control custom-radio custom-control-inline mb-1">
                        <input type="radio" class="custom-control-input" id="sexeh" name="sexe" checked>
                        <label class="custom-control-label" for="sexeh">Homme</label>
                    </div>

                    <!-- Group of default radios - option 2 -->
                    <div class="custom-control custom-radio custom-control-inline mb-1">
                        <input type="radio" class="custom-control-input" id="sexef" name="sexe">
                        <label class="custom-control-label" for="sexef">Femme</label>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Cin/Matricul" name="cin" class="form-control @error('cin') is-invalid @enderror">
                        @error('cin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Date Naissance" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror">
                        @error('date_naissance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="situationFami" id="situationFami" class="form-control">
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
                    <div class="form-group">
                        <input style="display: none" type="text" id="nbrEnfant" placeholder="Nombre Enfant" name="nbr_enfant" class="form-control @error('nbr_enfant') is-invalid @enderror">
                        @error('nbr_enfant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Numero CNSS" name="Num_cnss" class="form-control @error('Num_cnss') is-invalid @enderror">
                        @error('Num_cnss')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Numero ICMR" name="Num_Icmr" class="form-control @error('Num_Icmr') is-invalid @enderror">
                        @error('Num_Icmr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Salaire" name="salaire" class="form-control @error('salaire') is-invalid @enderror">
                        @error('salaire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" placeholder="Choisir Image" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <h2>Poste</h2>
            <hr class="bg-warning">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="fonction" placeholder="fonction" class="form-control @error('fonction') is-invalid @enderror">
                        @error('fonction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="date" name="date_debut" placeholder="Date Debut" class="form-control @error('date_debut') is-invalid @enderror">
                        @error('date_debut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="nom_dep" placeholder="Departement" class="form-control @error('nom_dep') is-invalid @enderror">
                        @error('nom_dep')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="date" name="date_fin" placeholder="Date Fin" class="form-control @error('date_fin') is-invalid @enderror">
                        @error('date_fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="salaire_base" placeholder="Salaire De Base" class="form-control @error('salaire_base') is-invalid @enderror">
                        @error('salaire_base')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <h2>Banque</h2>
            <hr class="bg-info">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="nom_banque" placeholder="Nom De La Banque " class="form-control @error('nom_banque') is-invalid @enderror">
                        @error('nom_banque')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="rib" placeholder="Rib" class="form-control @error('rib') is-invalid @enderror">
                        @error('rib')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="adresse" placeholder=" Adresse" class="form-control @error('adresse') is-invalid @enderror">
                        @error('adresse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="tele" placeholder="Telephone" class="form-control @error('tele') is-invalid @enderror">
                        @error('tele')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection
