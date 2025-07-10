/**
 * Custom validation and notification functions for the application
 */

// Input validation functions
const CentreClasValidation = {
    /**
     * Initialize all validation functions on document load
     */
    init: function() {
        this.setupNumericOnlyFields();
        this.setupFormValidations();
        this.setupDeleteConfirmations();
    },

    /**
     * Setup numeric-only inputs (CIN, telephone)
     */
    setupNumericOnlyFields: function() {
        const numericFields = document.querySelectorAll('input[data-numeric-only="true"]');

        numericFields.forEach(field => {
            field.addEventListener('input', function() {
                // Replace any non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Check for maxlength attribute and enforce it
                if (this.hasAttribute('maxlength')) {
                    const maxLength = parseInt(this.getAttribute('maxlength'));
                    if (this.value.length > maxLength) {
                        this.value = this.value.slice(0, maxLength);
                    }
                }
            });

            // Also validate on blur for better user experience
            field.addEventListener('blur', function() {
                if (this.hasAttribute('minlength')) {
                    const minLength = parseInt(this.getAttribute('minlength'));
                    if (this.value.length < minLength && this.value.length > 0) {
                        // Show validation message
                        this.classList.add('is-invalid');

                        // Find or create feedback element
                        let feedback = this.nextElementSibling;
                        if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                            feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            this.parentNode.insertBefore(feedback, this.nextSibling);
                        }
                        feedback.textContent = `Ce champ doit contenir au moins ${minLength} chiffres.`;
                    } else {
                        this.classList.remove('is-invalid');
                    }
                }
            });
        });
    },

    /**
     * Setup form validation hooks
     */
    setupFormValidations: function() {
        const forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Password confirmation validation
        const passwordFields = document.querySelectorAll('input[type="password"][data-match]');
        passwordFields.forEach(field => {
            field.addEventListener('input', function() {
                const targetId = this.getAttribute('data-match');
                const targetField = document.getElementById(targetId);

                if (targetField && this.value !== targetField.value) {
                    this.setCustomValidity('Les mots de passe ne correspondent pas.');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    },

    /**
     * Setup enhanced delete confirmations
     */
    setupDeleteConfirmations: function() {
        const deleteForms = document.querySelectorAll('form[data-confirm="true"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                const message = this.getAttribute('data-confirm-message') || 'Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.';

                if (!confirm(message)) {
                    event.preventDefault();
                }
            });
        });
    }
};

// Notification system
const CentreClasNotification = {
    /**
     * Show notification toast
     *
     * @param {string} message - Notification message
     * @param {string} type - Type of notification (success, error, warning, info)
     * @param {number} duration - Duration in milliseconds
     */
    show: function(message, type = 'success', duration = 5000) {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            // Position toasts in the top-right corner with some padding
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }

        // Create toast
        const toastId = 'toast-' + new Date().getTime();
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.id = toastId;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        // Make toast larger by adding custom styling
        toast.style.minWidth = '300px';
        toast.style.fontSize = '1.1rem';

        // Add some margin between toasts
        toast.style.marginBottom = '10px';

        // Add shadow for better visibility
        toast.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';

        // Create toast content
        const toastContent = `
            <div class="d-flex">
                <div class="toast-body py-3">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        toast.innerHTML = toastContent;
        toastContainer.appendChild(toast);

        // Initialize and show toast
        const bsToast = new bootstrap.Toast(toast, { autohide: true, delay: duration });
        bsToast.show();

        // Remove toast after it's hidden
        toast.addEventListener('hidden.bs.toast', function() {
            toast.remove();
        });
    },

    /**
     * Check for flash messages on page load and display them
     */
    initFlashMessages: function() {
        // Get flash message from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status')) {
            const status = urlParams.get('status');
            const message = urlParams.get('message') || 'Opération réussie!';
            this.show(message, status === 'error' ? 'danger' : status);

            // Clean URL without refreshing the page
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        // Display Laravel flash messages
        const flashSuccessEl = document.getElementById('flash-success-message');
        if (flashSuccessEl) {
            this.show(flashSuccessEl.textContent, 'success');
            flashSuccessEl.remove();
        }

        const flashErrorEl = document.getElementById('flash-error-message');
        if (flashErrorEl) {
            this.show(flashErrorEl.textContent, 'danger');
            flashErrorEl.remove();
        }
    }
};

// Initialize on document load
document.addEventListener('DOMContentLoaded', function() {
    CentreClasValidation.init();
    CentreClasNotification.initFlashMessages();
});
