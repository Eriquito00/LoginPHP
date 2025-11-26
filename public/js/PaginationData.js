const sentido = document.getElementById("sentido");
const search = document.getElementById("search");

const filters = document.getElementsByClassName("filter");
let buttons;

sentido.addEventListener("change", async () => createFilteredFeed(1));
search.addEventListener("input", async () => createFilteredFeed(1));

document.addEventListener("DOMContentLoaded", () => {
    createFilteredFeed(1);
});

async function createFilteredFeed(page) {
    const elements = [...filters];

    const formData = new FormData();

    for (const element of elements){
        formData.append(element.id, element.value);
    }

    formData.append("page", page);
    
    const response = await fetch(document.baseURI + "feed", {
        method: "POST",
        body: formData
    });

    const html = await response.text();
    document.getElementById("lista-posts").innerHTML = html;
    
    buttons = Array.from(document.querySelectorAll("#page"));
    buttons.forEach((btn) => {
        btn.addEventListener("click", async () => createFilteredFeed(btn.value));
        console.log(btn.value)
    });

    console.log(buttons);
}