<html>

    <?php include "./../layouts/head.html" ?>

    <body>
    <header class="navbar nav-color-bg">
        <section class="navbar-section nav-width">
            <b><a href="#" class="btn btn-link nav-color-text nav-title">Recipe project</a></b>
            <a href="#recipeList" class="btn btn-link nav-color-text">All recipes</a>
            <a id="addButton" class="btn btn-link nav-color-text">Add recipe</a>
            <a id="searchButton" class="btn btn-link nav-color-text">Search recipe</a>
        </section>
        <section class="navbar-section nav-search">
            <div class="input-group input-inline" id="searchBar">
                <input class="form-input" type="text" placeholder="SEARCH RECIPE">
                <button class="btn btn-primary input-group-btn btn-color"><span><img src="./../assets/img/search.png"></span></button>
            </div>
        </section>
    </header>

    <div class="container-box">
        <article class="column col-12 recipeBox">
            <div class="headArticle">
                <h3>Add recipe</h3>
                <span id="logoRecipe"><img src="./../assets/img/cooker.png"</span>
            </div>

            <div class="bodyArticle">

                <div class="form-group">
                    <label class="form-label" for="nameRecipe">Recipe name</label>
                    <div class="d-inline-flex max-width">
                        <input class="form-input" type="text" id="nameRecipe" placeholder="recipe name">
                        <button class="btn btn-primary input-group-btn btn-color-white"><span><img src="./../assets/img/recipe.png"></span></button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="timeRecipe">Preparation time</label>
                    <input class="form-input" type="time" id="timeRecipe" placeholder="recipe name">
                </div>

                <div id="ingredientArea" class="form-group scrollBox">
                    <label class="form-label" for="ingredients">Ingredients</label>
                    <div class="d-inline-flex max-width">
                        <input id="ingredients" type="text" class="form-input ingredient" placeholder="tomatoes, sugar, salad...">
                        <button id="addIngredient" class="btn btn-primary input-group-btn btn-color-white"><span><img src="./../assets/img/add.png"></span></button>
                    </div>
                </div>

                <div class="input-group">
                    <input id="submitRecipe" type="submit" class="form-input" value="Add recipe">
                </div>
            </div>

        </article>

        <article class="column col-10 recipeBox">
            <div class="headArticle">
                <h3>Search recipe</h3>
                <span id="logoRecipe"><img src="./../assets/img/loupe.png"</span>
            </div>

            <div class="bodyArticle">

                <div class="form-group">
                    <label class="form-label" for="nameRecipe">Search</label>
                    <div class="d-inline-flex max-width">
                        <input class="form-input" type="text" id="searchRecipe" placeholder="hamburger, pizza...">
                    </div>
                </div>

            </div>

        </article>
    </div>

    <div class="clearbox"></div>

    <div id="recipeList" class="container">
        <article class="column col-10 recipeBox" id="listRecipe">
            <div class="headArticle">
                <h3>Recipe list</h3>
                <span id="logoRecipe"><img src="./../assets/img/recipes-cooking-book.png"</span>
            </div>

            <div class="bodyArticle">

                <div class="form-group">
                    <label class="form-label" for="nameRecipe">Search</label>
                    <div class="d-inline-flex max-width">
                        <input class="form-input" type="text" id="nameRecipe" placeholder="hamburger, pizza...">
                    </div>
                </div>

            </div>

        </article>
    </div>

    <?php include "./../layouts/footer.html" ?>
    </body>

</html>