<link rel="stylesheet" href="./styles/_header.css">
<header class="feed_search">
    <div class="header_title">
        <button class="btn_navigation btn_title" id="btn_navigation"></button>
        <h1 class="header_h1">PHProgramando</h1>
    </div>
    <div class="header_inputs">
        <button class="btn_navigation btn_nav" id="btn_navigation"></button>
        <input class="filter" id="search" type="search" placeholder="Encuentra a tu autor favorito">
    </div>
    <div class="header_buttons">
        <a href="profile/create" id="btnMenuReco" class="create_button">Create<img src="./assets/plus.png" alt="Create Recomendation"></a>
        <select id="sentido" class="filter">
            <option value="asc">ASC</option>
            <option value="desc" selected>DESC</option>
        </select>
    </div>
</header>