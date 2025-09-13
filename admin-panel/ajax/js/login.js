jQuery(document).ready(function () {


    //---------- Start Create Data ---------
    $("#create").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#user_name').val() || $('#user_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the user name.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the password.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else {

            //start preloarder
            //$('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]); //grab all form data  
            formData.append("create", "TRUE");

            $.ajax({
                url: "ajax/php/login.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    //remove preloarder
                    // $('.someBlock').preloader('remove');

                    if (result.status === 'success') {
                        swal({
                            title: "success!",
                            text: "You have successfully login the system !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.setTimeout(function () {
                             window.location = 'index.php?message=5';
                        }, 2000);
                    } else if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Your Email address or password wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
        return false;
    }); 
});

 