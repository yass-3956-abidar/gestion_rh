$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
    $("#dropdownMenu1").click(function() {
        $("#util").toggle();
    });
    $("#situationFami").change(function() {
        if ($("#situationFami").val() == 'marié') {
            $("#nbrEnfant").css("display", "inline");
        } else {
            $("#nbrEnfant").css("display", "none");
        }
    });


});