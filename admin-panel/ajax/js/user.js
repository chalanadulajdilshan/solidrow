function loadUsersByType(typeId) {
    if (!typeId) {
        $('#fullname').html('<option value="">-- Select User type first --</option>');
        return;
    }
    
    $.ajax({
        url: 'ajax/php/user.php',
        type: 'POST',
        data: {
            action: 'get_users_by_type',
            type_id: typeId
        },
        dataType: 'json',
        success: function(response) {
            var options = '<option value="">-- Select User --</option>';
            if (response.status === 'success' && response.users.length > 0) {
                $.each(response.users, function(key, user) {
                    options += '<option value="' + user.id + '">' + user.name + '</option>';
                });
            } else {
                options = '<option value="">No users found for this type</option>';
            }
            $('#fullname').html(options);
        },
        error: function() {
            $('#fullname').html('<option value="">Error loading users</option>');
        }
    });
}

$("document").ready(function () {
    $("#create").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#name").val() || $("#name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter name.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#username").val() || $("#username").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Username..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#type").val() || $("#type").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Select User Type..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#password").val() || $("#password").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Password..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else {
            //start preloarder
            $(".someBlock").preloader();
            //grab all form data

            var formData = new FormData($("#form-data")[0]); //grab all form data


            $.ajax({
                url: "ajax/php/user.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    //remove preloarder

                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            swal({
                                title: "success!",
                                text: "Your data saved successfully !",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 4000);
                        } else if (result.status === "error") {
                            swal({
                                title: "Error!",
                                text: "Something went wrong",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
            });
        }
        return false;
    });
    //---------- End Create Data ---------
    //------------------------------------
    //---------- Start Edit Data ---------
    $("#update").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#name").val() || $("#name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter name.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#username").val() || $("#username").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Username..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#type").val() || $("#type").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter type..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else {
            //start preloarder
            $(".someBlock").preloader();
            //grab all form data
            var formData = new FormData($("#form-data")[0]);
            $.ajax({
                url: "ajax/php/user.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    //remove preloarder
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            swal({
                                title: "success!",
                                text: "Your data updated successfully !",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.href = "create-users.php";
                            }, 4000);
                        } else if (result.status === "error") {
                            swal({
                                title: "Error!",
                                text: "Something went wrong",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
            });
        }
        return false;
    });

    //////////////update password /////

    $("#change_password").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter new password.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });


        } else {

            //start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]); //grab all form data  
           

            $.ajax({
                url: "ajax/php/user.php",
                type: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $(".someBlock").preloader("remove");

                    if (result.status == "success") {
                        swal({
                            title: "Success!",
                            text: "Your data saved successfully !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (result.status == "error") {
                        swal({
                            title: "Error!",
                            text: "Some Error!...",
                            type: "error",
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        }
        return false;
    });

});
