import { auth } from "./AuthClient.js";

document.querySelector(".form_create_reco").addEventListener("submit", async (e) => {
    e.preventDefault();

    try {

        const formData = new FormData();
        formData.append("user", document.getElementById("user").value);
        formData.append("image", document.getElementById("inputImage").files[0]);
        formData.append("title", document.getElementById("title").value);
        formData.append("text", document.getElementById("description").value);


        const response = await auth.fetch(document.baseURI + "profile/recomendationdata", {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            document.getElementById("formMenuReco").style.display = "none";
            
            document.getElementById("title").value = "";
            document.getElementById("description").value = "";
            document.getElementById("inputImage").value = "";
            document.getElementById("previewImage").src = "";
            
            window.location.reload();
        } else {
            console.error("Error al crear la recomendación:", response.status);
        }

    }
    catch(error) {
        //falta cambiarlo a json
        console.log(error);
    }
});