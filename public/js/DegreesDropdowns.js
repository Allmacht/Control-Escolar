function level1() {
    if ($('#level').val() == "Preparatoria") {
        $('#degree_id').val('');
        $('#office_id').val('');
        $('#degree_id').prop('disabled', true);
        $('#degree_id').prop('required', false);
    }
    else {
        $('#degree_id').prop('disabled', false);
        $('#degree_id').prop('required', true);
    }
}

function dropdowns(){
    $('#office_id').change(function (event) {
        if ($('#level').val() != "Preparatoria") {
            $.get("/getdegrees/" + event.target.value + "", function (response) {
                $('#degree_id').empty();
                for (let i = 0; i < response.length; i++) {
                    $('#degree_id').append("<option value='" + response[i].id + "'>" + response[i].degree_name + "</option>");
                }
            });
        } else {
            $('#degree_id').val('');
        }
    });
}

