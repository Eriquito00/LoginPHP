import { auth } from "./AuthClient.js";


document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const errorMsg = document.getElementById('error-message');
    if (errorMsg) errorMsg.style.display = 'none';

    try {
        let recaptchaToken = null;

        if (typeof grecaptcha !== 'undefined') {
            recaptchaToken = grecaptcha.getResponse();

            if (!recaptchaToken || recaptchaToken.length === 0) {
                // Usuario no completó el reCAPTCHA
                if (errorMsg) {
                    errorMsg.textContent = 'Por favor, completa el reCAPTCHA';
                    errorMsg.style.display = 'block';
                } else {
                    alert('Por favor, completa el reCAPTCHA');
                }
                return; // No enviar el formulario
            }
        }

        const data = await auth.login(
            document.getElementById("email").value,
            document.getElementById("password").value,
            document.getElementById("remember").checked,
            recaptchaToken
        );
        window.location.href = document.baseURI;
    }
    catch(error){
        console.error('Error de login:', error);
        
        // Intentar parsear el error si viene como JSON
        let errorData = null;
        try {
            errorData = JSON.parse(error.message);
        } catch {
            // Si no es JSON, usar el mensaje directo
        }
        
        const errorMessage = errorData?.error || error.message;
        const requiresReload = errorData?.requires_reload || false;
        
        if (errorMsg) {
            errorMsg.textContent = errorMessage;
            errorMsg.style.display = 'block';
        } else {
            alert(errorMessage);
        }

        if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
            grecaptcha.reset();
        }
        
        if (requiresReload) {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }

    // FETCHES PARA URL AUTORIZADAS
    /*
    async function loadUserData() {
        const response = await auth.fetch("");
        const data = await response.json();
    }
    */

});