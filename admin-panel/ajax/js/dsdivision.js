

$(document).ready(function () {


   
    $('#district').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var disID = $(this).val();

        $('#dsdivision_id').empty();

        $.ajax({
            url: "ajax/php/dsdivision.php",
            type: "POST",
            data: {
                district: disID,
                action: 'GET_DIVISIONAL_BY_DISTRICT'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select your Ds Division - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });

                $('#dsdivision_id').empty();
                $('#dsdivision_id').append(html);
            }
        });
    });





});

