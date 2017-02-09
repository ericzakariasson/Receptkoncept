        <section id="main"></section>
        <section id="recipe">
            <section id="recipeHeader"></section>
            <section id="recipeIngredients">
                <section class="ingredientsNeededContainer">
                    <section class="ingredientsNeeded">
                        <h3>Ingredienser</h3>
                        <ul id="recipeIngredientsList"></ul>
                    </section>
                </section>        
            </section>
            <section id="recipeSteps"></section>
        </section>
    </main>
    <template id="searchRecipeTemplate">
        <section data-id="{{id}}" class="searchRecipe">
            <img class="searchRecipeImg" src="{{imgUrl}}">
            <h4>{{name}}</h4>
            <h5>{{time}} min</h5>
            <p>{{description}}</p>
            <div class="fadeOut"></div>
            <button class="readMore">Läs mer</button>
        </section>
    </template>
    <template id="recipeHeaderTemplate">
        <div class="nameContainer">
            <svg id="hide-icon" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
            <h2 class="hc">{{name}}</h2>
        </div>
        <div class="recipeImg" style="background: url('{{imgUrl}}')">
            <h4 id="recipeImgTime">{{time}} minuter</h4>
        </div>
        <section id="recipeInfo">
            <section id="recipeDesc">
                <p>{{description}}</p>
            </section>
            <section id="recipeAmountTime">
                <p class="amount-time">Tid: <span class="bold">{{time}} minuter</span></p>
                <p class="amount-time">Portioner: <span class="bold" id="recipePortions"></span></p>
            </section>
        </section>
    </template>
    <template id="recipeIngredientsTemplate">
        <li class="recipeIngredient"><span class="amount"><span data-required="{{amount_required}}" class="required">{{amount_required}}</span> {{ingredient_unit}}</span> {{ingredient_name}}</li>
    </template>
    <template id="recipeStepsTemplate">
        <section class="recipeStep">
            <h4>{{step_number}}.</h4>
            <p>{{instructions}}</p>
        </section>
    </template>
    <div class="overlay"></div>
</body>
</html>
