import { auth } from "./AuthClient.js";


document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    try {
        console.log(document.getElementById("email").value);
        console.log(document.getElementById("password").value);
        console.log(document.getElementById("remember").checked);
        const data = await auth.login(
            document.getElementById("email").value,
            document.getElementById("password").value,
            document.getElementById("remember").checked,
        );
        window.location.href = document.baseURI;
    }
    catch(error){
        alert(error);
    }

    // FETCHES PARA URL AUTORIZADAS
    /*
    async function loadUserData() {
        const response = await auth.fetch("");
        const data = await response.json();
    }
    */

});