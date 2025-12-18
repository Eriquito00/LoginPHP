document.getElementById("btnSubmitReco").addEventListener("submit", async (e) => {
    e.preventDefault();

    try {

        const formData = new formData();
        formData.append("image", document.getElementById("inputImage"));
        formData.append("title", document.getElementById("title"));
        formData.append("text", document.getElementById("description"));

        console.log("llega")

        const response = await fetch(document.baseURI + "profile/recomendationdata", {
            method: 'POST',
            body: formData
        });

        console.log("enviado");
    }
    catch(error) {
        console.log(error);
    }
});