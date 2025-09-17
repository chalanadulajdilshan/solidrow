// Contact Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Form validation and submission
    const contactForm = document.getElementById('contactForm');
    const submitBtn = contactForm ? contactForm.querySelector('button[type="submit"]') : null;
    const btnText = submitBtn ? submitBtn.innerHTML : '';
    const btnLoader = submitBtn ? submitBtn.querySelector('.btn-loader') : null;
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    // Form submission handler
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();

            // Hide previous messages
            hideMessages();

            if (contactForm.checkValidity()) {
                submitForm();
            } else {
                // Show validation errors
                contactForm.classList.add('was-validated');
                
                // Focus on first invalid field
                const firstInvalidField = contactForm.querySelector('.form-control:invalid, .form-select:invalid');
                if (firstInvalidField) {
                    firstInvalidField.focus();
                    
                    // Smooth scroll to invalid field
                    const fieldRect = firstInvalidField.getBoundingClientRect();
                    const scrollTop = window.pageYOffset + fieldRect.top - 100;
                    
                    window.scrollTo({
                        top: scrollTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    }

    // Submit form function
    function submitForm() {
        // Show loading state
        setLoadingState(true);

        // Collect form data
        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData);

        // Simulate API call (replace with actual endpoint)
        setTimeout(() => {
            // For demo purposes, we'll simulate success
            // In production, replace this with actual form submission
            simulateFormSubmission(data)
                .then(response => {
                    if (response.success) {
                        showSuccessMessage();
                        contactForm.reset();
                        contactForm.classList.remove('was-validated');
                    } else {
                        showErrorMessage();
                    }
                })
                .catch(error => {
                    console.error('Form submission error:', error);
                    showErrorMessage();
                })
                .finally(() => {
                    setLoadingState(false);
                });
        }, 1500);
    }

    // Simulate form submission (replace with actual API call)
    function simulateFormSubmission(data) {
        return new Promise((resolve, reject) => {
            // Log form data for development
            console.log('Form Data Submitted:', data);
            
            // Simulate success (90% success rate for demo)
            const success = Math.random() > 0.1;
            
            if (success) {
                resolve({ success: true, message: 'Form submitted successfully' });
            } else {
                reject(new Error('Submission failed'));
            }
        });
    }

    // Set loading state
    function setLoadingState(loading) {
        if (!submitBtn) return;
        
        if (loading) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = btnText;
        }
    }

    // Show success message
    function showSuccessMessage() {
        if (!successMessage) return;
        
        successMessage.classList.remove('d-none');
        successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Hide message after 5 seconds
        setTimeout(() => {
            successMessage.classList.add('d-none');
        }, 5000);
    }

    // Show error message
    function showErrorMessage() {
        if (!errorMessage) return;
        
        errorMessage.classList.remove('d-none');
        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Hide message after 5 seconds
        setTimeout(() => {
            errorMessage.classList.add('d-none');
        }, 5000);
    }

    // Hide all messages
    function hideMessages() {
        if (successMessage) successMessage.classList.add('d-none');
        if (errorMessage) errorMessage.classList.add('d-none');
    }

    // Add input event listeners for real-time validation
    const formInputs = contactForm ? contactForm.querySelectorAll('.form-control, .form-select') : [];
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    });

    // Initialize AOS animation
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
});
