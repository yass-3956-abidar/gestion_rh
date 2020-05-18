$(document).ready(function() {
    nbrEnfant();
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
    $("#dropdownMenu1").click(function() {
        $("#util").toggle();
    });
    $("#situationFami").change(function() {
        nbrEnfant();
    });
    $('.datepicker').datepicker({
        inline: true
    });
    $("#enregistre").click(function() {
        $("#enregistre").text('Enregistration ...');
        $("#spinerEnregister").css('display', 'inline');

    })


});

function nbrEnfant() {

    if ($("#situationFami").val() == 'célibataire') {
        $("#nbrEnfant").val(0);
        $("#nbrEnfant").prop("disabled", true);
    } else {
        $("#nbrEnfant").prop("disabled", false);
    }
}