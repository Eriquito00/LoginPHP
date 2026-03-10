const oauth_github = document.getElementById("oauth_github");

oauth_github.addEventListener("click", async () => {
    try {
        const response = await fetch(document.baseURI + "oauth/github/login", {
            method: "POST"
        });
        
        const data = await response.json();
        
        window.location.href = data.url;
    }
    catch (e) {
        console.error(e);
    }
});