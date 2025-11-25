const sentido = document.getElementById("sentido");
const search = document.getElementById("search");

const filters = document.getElementsByClassName("filter");

sentido.addEventListener("change", async () => createFilteredFeed());
search.addEventListener("input", async () => createFilteredFeed());

async function createFilteredFeed() {
    const formData = new FormData();

    for (const filter of filters){
        formData.append(filter.id, filter);
    }
    
    const response = await fetch(document.baseURI + "feed", {
        method: "POST",
        body: formData
    });

    const html = await response.text();
    document.getElementById("lista-posts").innerHTML = html;
}