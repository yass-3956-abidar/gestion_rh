@extends('admin.include.default')
@section('content')
<div class="card" style="box-shadow: none">
    <div class="card-header border-secondary text-white" style="background-color: #9e9e9e ">
        Historique de Presences
    </div>
    <div class="card-body">
        @if(count($employers)==0)
        <div class="alert alert-warning" role="alert">
            Aucun Employer Trouver
        </div>
        @else
        <div class="d-flex justify-content-center">
            <input id="datePresence" name="datePresence" style="width: 30%" type="text" class="form-control mt-2 text-center p-1 pt-1" value="{{ old('datePresence') }}" autocomplete="false">
            <button type="submit" id="btnChercher" class="btn btn-success">Chercher Pointage<i class="fas fa-search  ml-2 fa-1x"></i></button>

        </div>
        <center>
            <table class="table table-striped table-bordered text-center" cellspacing="0" style="width: 70%">
                <thead>
                    <tr>
                        <th class="th-sm">Nom Employer
                        </th>
                        <th class="th-sm">Pointage
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </center>
        <!-- <a href="{{route('presence.pdf')}}" class="btn btn-outline-primary">Apercu</a> -->
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#datePresence").datepicker();

        function getData(query = '') {

        }
        $(document).on('click', '#btnChercher', function() {
            console.log('hi')
            var query = $("#datePresence").val();
            $.ajax({
                url: "{{ route('presence.employer') }}",
                method: 'GET',
                data: {
                    query
                },
                dataType: 'json',
                success: function(data) {
                    $('tbody').html(data);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log(data);
                },
            })
        });
    })
</script>
@endsection
