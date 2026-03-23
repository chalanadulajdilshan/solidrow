$(document).ready(function () {
    // Handle Create Location
    $("#create").click(function (event) {
        event.preventDefault();

        if (!$("#name").val()) {
            swal({
                title: "Error!",
                text: "Please enter location name.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            // Start preloader
            $(".someBlock").preloader();

            // Form data
            var formData = new FormData($("#form-data")[0]);
            formData.append("create", true);

            $.ajax({
                url: "ajax/php/location.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $(".someBlock").preloader("remove");

                    if (result.status === "success") {
                        swal({
                            title: "Success!",
                            text: "Location created successfully!",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        swal({
                            title: "Error!",
                            text: "Something went wrong!",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
    });

    // Handle Update Location
    $("#update").click(function (event) {
        event.preventDefault();

        if (!$("#name").val()) {
            swal({
                title: "Error!",
                text: "Please enter location name.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            // Start preloader
            $(".someBlock").preloader();

            // Form data
            var formData = new FormData($("#form-data")[0]);
            formData.append("update", true);

            $.ajax({
                url: "ajax/php/location.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $(".someBlock").preloader("remove");

                    if (result.status === "success") {
                        swal({
                            title: "Success!",
                            text: "Location updated successfully!",
                            type: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        swal({
                            title: "Error!",
                            text: "Something went wrong!",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
    });
});
