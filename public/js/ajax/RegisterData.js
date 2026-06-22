document
  .getElementById("registerForm")
  .addEventListener("submit", async (e) => {
    e.preventDefault();

    const errorMsg = document.getElementById("error-message");
    if (errorMsg) errorMsg.style.display = "none";

    try {
      if (typeof grecaptcha !== "undefined") {
        recaptchaToken = grecaptcha.getResponse();

        if (!recaptchaToken || recaptchaToken.length === 0) {
          // Usuario no completó el reCAPTCHA
          if (errorMsg) {
            errorMsg.textContent = "Por favor, completa el reCAPTCHA";
            errorMsg.style.display = "block";
          } else {
            alert("Por favor, completa el reCAPTCHA");
          }
          return; // No enviar el formulario
        }
      }

      const formData = new FormData();
      formData.append("email", document.getElementById("email").value);
      formData.append("password", document.getElementById("password").value);
      formData.append(
        "repeat_password",
        document.getElementById("repeat_password").value
      );

      // Enviar los datos al endpoint de registro
      const response = await fetch(document.baseURI + "register", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(JSON.stringify(errorData));
      }

      // Si el registro fue exitoso, redirigir a profile/setup
      window.location.href = document.baseURI + "profile/setup";
    } catch (error) {
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
        errorMsg.style.display = "block";
      } else {
        alert(errorMessage);
      }

      if (typeof grecaptcha !== "undefined" && grecaptcha.reset) {
        grecaptcha.reset();
      }

      if (requiresReload) {
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      }
    }
  });
