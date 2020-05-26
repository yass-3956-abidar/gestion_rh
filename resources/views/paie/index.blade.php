@extends('admin.include.default')
@section('content')
<div class="col-md-12">
    <router-link to="/paie"><a id="idBtn" class="btn btn-outline-primary"> Les Fiches de paie</a></router-link>
    <router-link to="/addPaie"><button id="idBtn" class="btn btn-outline-success"> Cree Une Fiche de paie</button></router-link>
    <router-view></router-view>
</div>
@endsection
@section('script')
<script src="{{asset('js/app.js')}}">
</script>
<script>
    $("#idBtn").click(function() {

    });
</script>
@endsection
