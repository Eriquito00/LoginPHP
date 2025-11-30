const sentido = document.getElementById("sentido");
const search = document.getElementById("search");

const filters = Array.from(document.getElementsByClassName("filter"));
let buttons;

sentido.addEventListener("change", async () => createFilteredFeed(1));
search.addEventListener("input", async () => createFilteredFeed(1));

document.addEventListener("DOMContentLoaded", () => {
    createFilteredFeed(1);
});

async function createFilteredFeed(page) {
    const params = new URLSearchParams();

    filters.forEach(e => {
        params.append(e.id, e.value);
    })

    params.append("page", page);

    const newUrl = "?" + params.toString();
    window.history.pushState({}, '', newUrl);

    const response = await fetch("feed?" + params.toString(), {
        method: "GET",
    });

    const html = await response.text();
    document.getElementById("lista_posts").innerHTML = html;
    
    buttons = Array.from(document.querySelectorAll("#page"));
    buttons.forEach((btn) => {
        btn.addEventListener("click", async () => createFilteredFeed(btn.value));
    });
}