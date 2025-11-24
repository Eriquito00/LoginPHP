const sentido = document.getElementById("sentido");

sentido.addEventListener("change", async () => {
    const valSentido = sentido.value;

    const formData = new FormData();
    formData.append("sentido", valSentido);
    
    const response = await fetch(document.baseURI + "feed", {
        method: "POST",
        body: formData
    });

    const html = await response.text();
    document.getElementById("lista-posts").innerHTML = html;
});