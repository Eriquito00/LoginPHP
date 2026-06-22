const previewImage = document.getElementById("previewImage");
const inputImage = document.getElementById("inputImage");

const defaultImage = "./assets/moai.jpg";
//Esto permite imagenes png, jpeg, jpg y webp
const filesAllowed = ["image/png", "image/jpeg", "image/webp"];

previewImage.src = defaultImage;

inputImage.addEventListener("change", () => {
    const img = inputImage.files[0];

    if (!img) return previewImage.src = defaultImage;

    if (!filesAllowed.includes(img.type)){
        alert("Formato de imagen no permitido.");
        inputImage.value = "";
        previewImage.src = defaultImage;
        return;
    }

    const url = URL.createObjectURL(img);
    previewImage.src = url;
});