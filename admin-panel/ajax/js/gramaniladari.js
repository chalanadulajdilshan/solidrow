 

$(document).ready(function () {
    $('#dsdivision_id').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var division_id = $(this).val();

        $('#gn_division').empty();
        
        $.ajax({
            url: "ajax/php/gramaniladari.php",
            type: "POST",
            data: {
                division_id: division_id,
                action: 'GET_GRAMANILADARI_BY_DSDIVISION'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > -  Select your Gn Division - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });

                $('#gn_division').empty();
                $('#gn_division').append(html);
            }
        });
    });
});

