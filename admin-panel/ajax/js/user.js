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
        } else if (!$("#email").val() || $("#email").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Email..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#phone").val() || $("#phone").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Phone Number..!",
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

        } else if (!$("#email").val() || $("#email").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter email..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#phone").val() || $("#phone").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Phone..!",
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

    $("#type").change(function () {
        var type = $(this).val();
 

        if (type == "3") {
            $("#center_name_section").removeClass("hidden");
        } else {
            $("#center_name_section").addClass("hidden");
        }
        
           if (type == "8") {
            $("#province_section").removeClass("hidden");
        } else {
            $("#province_section").addClass("hidden");
        }
        
        
        if (type == 11) {
            $("#course_name_section").removeClass("hidden");
        } else {
            $("#course_name_section").addClass("hidden");
        }
        
        
        if (type == "5") {
            $("#division_name_section").removeClass("hidden");
            $("#position_name_section").removeClass("hidden");
        } else {
            $("#division_name_section").addClass("hidden");
            $("#position_name_section").addClass("hidden");
        }
        
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
