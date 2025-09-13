

$(document).ready(function () {

//get course by course type
    $('#divisional_id').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $(this).val();

        $('#gn_id').empty();
        $.ajax({
            url: "ajax/php/get-gn.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_DISTRICT_BY_GN'
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

                $('#gn_id').empty();
                $('#gn_id').append(html);
            }
        });
    });     
    
    
});

