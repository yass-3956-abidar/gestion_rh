@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none">
    <div class="card-header border-secondary text-white" style="background-color: #9e9e9e ">
        Présence des employes
    </div>
    <div class="card-body" style="background-color: white">
        <div class="d-flex justify-content-center">
            <input id="DateVal" style="width: 30%" type="text" class="form-control mt-2 text-center" value="{{date('Y-m-d')}}">
            <button id="btnNext" class="btn btn-success  ">Chercher Pointage<i class="fas fa-arrow-right ml-2"></i></button>
        </div>
        @if(count($employers)==0)
        <div class="alert alert-warning" role="alert">
            Aucun Employer Trouver
        </div>
        @else
        <ul class="list-group">
            @foreach($employers as $employer)
            <li class="list-group-item">
                <div class="flex-fill">{{$employer->nom_employer." ".$employer->prenom}}</div>
                <div class="flex-fill">Flex item</div>
                <a class="btn btn-info flex-fill" href="#" data-toggle="modal" data-target="#exampleModal">
                    <i class="far fa-plus-square fa-2x">
                </a></i></td>
            </li>
            @endforeach
        </ul>

        @endif
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pointe La presence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            @csrf
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
                                    <textarea id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('heur_sortit') }}" autocomplete="name" autofocus>
                                                    @error('heur_sortit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                              </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>
@endsection
@section('script')
<!-- <script src="{{asset('App/public/js/presence/index.js')}}"></script> -->
<script>
    $(document).ready(function() {
        $("#btnPrev").on('click', function(event) {
            event.preventDefault();


        });
        $("#btnNext").on('click', function(event) {
            event.preventDefault();

        });
    });
</script>
@endsection
