document.addEventListener('DOMContentLoaded', function() {
    // Form Validation
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    // Animation for form elements
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check if input has value on page load
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Password visibility toggle (optional)
    const passwordField = document.getElementById('password');
    const togglePassword = document.createElement('span');
    togglePassword.innerHTML = '👁️';
    togglePassword.style.cursor = 'pointer';
    togglePassword.style.position = 'absolute';
    togglePassword.style.right = '10px';
    togglePassword.style.top = '35px';
    
    if (passwordField) {
        passwordField.parentElement.style.position = 'relative';
        passwordField.parentElement.appendChild(togglePassword);
        
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        });
    }
});