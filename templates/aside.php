<main>  
    <aside>
        <section id="your-ingredients" class="sidepanel">
            <h3>Dina Ingredienser</h3>
            <section class="sidepanelContainer">
                <ul id="ingredients"></ul>
                <template id="ingredientsTemplate">
                    <li data-id="{{id}}" class="ingredient">{{name}}</li>
                </template>
                <input id="searchIngredient" class="hc" placeholder="Sök efter ingredienser!">
                <ul id="searchIngredientResult" class="hc"></ul>
                <template id="searchIngredientTemplate">
                    <li data-id="{{id}}" class="searchIngredientItem">{{name}}</li>
                </template>
            </section>
        </section>
        <section id="filters" class="sidepanel">
            <h3>Filter</h3>
            <section class="sidepanelContainer">
                <section class="filter">
                    <p class="filter-text slider-text">Tid</p>
                    <input id="time" class="slider" type="range" min="5" max="60" step="5" value="15" title="Max antal minuter">
                    <input id="timeBox" class="filterBox" type="number" title="Max antal minuter">
                    <label class="filterBoxLabel" for="timeBox" title="Max antal minuter">Minuter:</label>
                </section>
                <section class="filter">
                    <p class="filter-text slider-text">Portioner</p>
                    <input id="portions" class="slider" type="range" min="1" max="10" step="1" value="4" title="Antal portioner">
                    <input id="portionsBox" class="filterBox" type="number" title="Antal portioner">
                </section>
                <section class="filter">
                    <p class="filter-text">Vegetarisk</p>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="vegetarian">
                        <label class="onoffswitch-label" for="vegetarian" title="Vegetarisk"></label>
                    </div>
                </section>
                <section class="filter">
                    <p class="filter-text">Vegan</p>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="vegan">
                        <label class="onoffswitch-label" for="vegan" title="Vegan"></label>
                    </div>
                </section>
                <section class="filter">
                    <p class="filter-text">Laktosfri</p>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="lactosefree">
                        <label class="onoffswitch-label" for="lactosefree" title="Laktosfri"></label>
                    </div>
                </section>
                <section class="filter">
                    <p class="filter-text">Glutenfri</p>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="glutenfree">
                        <label class="onoffswitch-label" for="glutenfree" title="Glutenfri"></label>
                    </div>
                </section>
            </section>
        </section>
        <button id="searchCustomRecipe" class="hc">Sök recept</button>
        <!--<p data-garv="https://www.youtube.com/watch?v=rOEvqZx_XLo" id="copyright">&copy; Eric Zakariasson</p>-->
    </aside>
    
</section>
