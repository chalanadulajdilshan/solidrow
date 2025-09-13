

$(document).ready(function () {

//get course by course type
    $('#province_id').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $(this).val();

        $('#district_id').empty();
        $.ajax({
            url: "ajax/php/get-district.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_DISTRICT_BY_PROVINCE'
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

                $('#district_id').empty();
                $('#district_id').append(html);
            }
        });
    });     
    
    
});

