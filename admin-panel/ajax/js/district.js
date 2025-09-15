jQuery(document).ready(function () {

    function loadDistricts() {
        $('.someBlock').preloader();

        $.ajax({
            url: 'ajax/php/district.php',
            type: 'POST',
            data: { display: true },
            dataType: 'JSON',
            success: function (response) {
                $('.someBlock').preloader('remove');

                if (response.status === 'success') {
                    var html = '';
                    response.data.forEach(function (district) {
                        html += '<tr>';
                        html += '<td>' + district.id + '</td>';
                        html += '<td>' + district.province + '</td>';
                        html += '<td>' + district.name + '</td>';
                        html += '<td>' + district.queue + '</td>';
                        html += '</tr>';
                    });
                    $('#districtTable tbody').html(html);
                } else {
                    $('#districtTable tbody').html('<tr><td colspan="4">No districts found.</td></tr>');
                }
            }
        });
    }

    // Load districts on page load
    loadDistricts();

});
