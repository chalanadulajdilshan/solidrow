jQuery(document).ready(function ($) {
    // Form validation
    function validateForm() {
        const requiredFields = [
            { id: "name", message: "Please enter your name" },
            { id: "mobile", message: "Please enter your mobile number" },
            { id: "address", message: "Please enter your address" },
            { id: "position", message: "Please select a position" },
            { id: "experience", message: "Please enter your experience" },
            { id: "cv", message: "Please upload your CV" }
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                return { valid: false, message: field.message };
            }
        }

        // Validate mobile number format
        const mobile = $("#mobile").val();
        const mobileRegex = /^[0-9+\-\s]{10,15}$/;
        if (!mobileRegex.test(mobile)) {
            return { valid: false, message: "Please enter a valid mobile number" };
        }

        // Validate CV file type
        const cvInput = document.getElementById('cv');
        if (cvInput.files.length > 0) {
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const fileType = cvInput.files[0].type;
            if (!allowedTypes.includes(fileType)) {
                return { valid: false, message: "Only PDF, DOC & DOCX files are allowed" };
            }
        }

        return { valid: true };
    }

    // Form submission
    $(document).on('submit', '#career-form', function (e) {
        e.preventDefault();
        
        const validation = validateForm();
        if (!validation.valid) {
            Swal.fire({
                title: 'Error!',
                text: validation.message,
                icon: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }

        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
        
        const formData = new FormData(this);
        formData.append('create', true);

            $.ajax({
            url: "/solidrow/ajax/php/careers.php",
            type: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                // Reset button state
                submitBtn.prop('disabled', false).html(originalText);
                
                if (response && response.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Application submitted successfully!',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    
                    // Reset form
                    document.getElementById('career-form').reset();
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: (response && response.message) || 'Failed to submit application. Please try again.',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Reset button state
                submitBtn.prop('disabled', false).html(originalText);
                
                console.error('AJAX Error:', status, error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again later.',
                    icon: 'error'
                });
            }
        });
    });
});
