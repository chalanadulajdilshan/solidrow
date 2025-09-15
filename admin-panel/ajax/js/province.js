jQuery(document).ready(function () {

    function loadProvinces() {
        $('.someBlock').preloader();

        $.ajax({
            url: 'ajax/php/province.php',
            type: 'POST',
            data: { display: true },
            dataType: 'JSON',
            success: function (response) {
                $('.someBlock').preloader('remove');

                if (response.status === 'success') {
                    var html = '';
                    response.data.forEach(function (province) {
                        html += '<tr>';
                        html += '<td>' + province.id + '</td>';
                        html += '<td>' + province.name + '</td>';
                        html += '<td>' + province.queue + '</td>';
                        html += '</tr>';
                    });
                    $('#provinceTable tbody').html(html);
                } else {
                    $('#provinceTable tbody').html('<tr><td colspan="3">No provinces found.</td></tr>');
                }
            }
        });
    }

    // Load provinces on page load
    loadProvinces();

});
