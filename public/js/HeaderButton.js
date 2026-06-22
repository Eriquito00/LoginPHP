const btnMenuRecoOpen = document.getElementById("btnMenuRecoOpen");
const btnMenuRecoClose = document.getElementById("btnMenuRecoClose");
const formMenuReco = document.getElementById("formMenuReco");
const btnMenuLogin = document.getElementById("btnMenuLogin");

btnMenuLogin.addEventListener("click", () => {
    window.location.href = document.baseURI + "/login";
});

//Codigo para abrir y cerrar el menu de creacion de recomendaciones
btnMenuRecoOpen.addEventListener("click", () => {
    formMenuReco.classList.add("show");
    btnMenuLogin.classList.add("show");
    document.body.classList.add("no-scroll");
});

btnMenuRecoClose.addEventListener("click", () => {
    formMenuReco.classList.remove("show");
    btnMenuLogin.classList.remove("show");
    document.body.classList.remove("no-scroll");
});