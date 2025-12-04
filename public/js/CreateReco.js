const btnMenuRecoOpen = document.getElementById("btnMenuRecoOpen");
const btnMenuRecoClose = document.getElementById("btnMenuRecoClose");
const formMenuReco = document.getElementById("formMenuReco");

btnMenuRecoOpen.addEventListener("click", () => {
    formMenuReco.classList.add("show");
    document.body.classList.add("no-scroll");
});

btnMenuRecoClose.addEventListener("click", () => {
    formMenuReco.classList.remove("show");
    document.body.classList.remove("no-scroll");
});