
document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const errorMessage = document.getElementById("error-message");
    if (errorMsg) errorMsg.style.display = 'none';
});