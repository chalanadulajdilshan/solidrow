

$(document).ready(function () {

//get course by course type
    $('#district_id').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $(this).val();

        $('#divisional_id').empty();
        $.ajax({
            url: "ajax/php/get-ds.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_DISTRICT_BY_DISTRICT'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select your district - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id   + '">';
                    html += data.name;
                    html += '</option>';
                });

                $('#divisional_id').empty();
                $('#divisional_id').append(html);
            }
        });
    });     
    
    
});

