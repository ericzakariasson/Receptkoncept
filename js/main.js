$(document).ready(function() {

    var $login = $('#btn-login');
    var $register = $('#btn-register');

    $login.click(function() {
        $('.overlay').fadeIn(200);
        $('.user-popup').hide(  );
        $('#main-login').fadeIn(200);
    });

    $register.click(function() {
        $('.overlay').fadeIn(200);
        $('.user-popup').hide();
        $('#main-register').fadeIn(200); 
    });

    $('.overlay').click(function() {
        $(this).fadeOut(200);
        $('.user-popup').fadeOut(200); 
    });

    $('h3').click(function() {
        $(this).siblings('.sidepanelContainer').slideToggle(250);
    });
    
    var recipeTemplate = $('#recipeTemplate').html();
    var $recipe = $('#recipe');
    var $main = $('#main');
    var ingredientsTemplate = $('#ingredientsTemplate').html();
    var $ingredients = $('#ingredients');
    var searchIngredientTemplate = $('#searchIngredientTemplate').html();
    var $searchIngredientResult = $('#searchIngredientResult');
    var $searchIngredient = $('#searchIngredient');
    var searchRecipeTemplate = $('#searchRecipeTemplate').html();
    var $searchRecipe = $('#searchRecipe');
    var recipeIngredientsTemplate = $('#recipeIngredientsTemplate').html();
    var $recipeIngredientsList = $('#recipeIngredientsList');
    var recipeHeaderTemplate = $('#recipeHeaderTemplate').html();
    var $recipeHeader = $('#recipeHeader');
    var $recipeIngredients = $('#recipeIngredients');
    var recipeStepsTemplate = $('#recipeStepsTemplate').html();
    var $recipeSteps = $('#recipeSteps');
    
    var amountFilter = $('#portions');
    var amountBoxFilter = $('#portionsBox');
    amountBoxFilter.val(4);

    var currentSlider = amountBoxFilter.val();

    if ($main.empty()) {
        $main.html('<h2 class="emptyMain">Sök efter recept!</h2>');
    }

    function addIngredient(ingredient) {
        $ingredients.append(Mustache.render(ingredientsTemplate, ingredient));
    }

    function searchIngredient(ingredient) {
        if ($ingredients.children('li').data('id') == ingredient.id) {
            return false
        } else {
            $searchIngredientResult.append(Mustache.render(searchIngredientTemplate, ingredient));
        }
    }

    function searchRecipe(recipe) {
        $main.append(Mustache.render(searchRecipeTemplate, recipe));
    }

    function recipeHeader(recipe) {
        $recipeHeader.empty();
        $recipeIngredientsList.empty();
        $recipeSteps.empty();
        $recipe.fadeIn(150);
        $recipeHeader.append(Mustache.render(recipeHeaderTemplate, recipe));
        $('#recipePortions').text(amountBoxFilter.val());
    }

    function recipeIngredients(ingredient) {
        if(ingredient.amount_required) {
            var amount = ((ingredient.amount_required)*amountBoxFilter.val()).toFixed(2);
            if (amount > parseInt(amount, 10)) {

            } else {
                    amount = parseInt(amount, 10)
            }
            var ingredientData = {
                amount_required: amount,
                ingredient_unit: ingredient.ingredient_unit,
                ingredient_name: ingredient.ingredient_name,
            }
        } else {
            var ingredientData = {
                amount_required: '',
                ingredient_unit: ingredient.ingredient_unit,
                ingredient_name: ingredient.ingredient_name,
            }
        }
        $recipeIngredientsList.append(Mustache.render(recipeIngredientsTemplate, ingredientData));
    }

    function recipeSteps(step) {
        $recipeSteps.append(Mustache.render(recipeStepsTemplate, step));
    }

    /* logga in */
    $('#loginForm').submit(function() {
        event.preventDefault();
      
        var username = $('#usernameL').val();
        var password = $('#passwordL').val();
        var loginData = {
            username: username,
            password: password
        }

        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: loginData,
            success: function(response) {
                if (response == "success") {
                    location.reload();
                } else if (response == "error") {
                    if (!$('.user-error').length) {
                        $('<p class="user-error">Användarnnamnet eller lösenordet felaktigt</p>').insertBefore('#loginButton');  
                    }
                }
            },
            error: function() {
                alert('Fel vid inloggning. Försök igen senare.'); 
            }
        })
    });
    /* */

    /* registrera */
    $('#registerForm').submit(function() {
        event.preventDefault();
      
        var username = $('#usernameR').val();
        var email = $('#emailR').val();
        var password = $('#passwordR').val();
        var password2 = $('#password2R').val();

        if (password == password2) {
            var registerData = {
                username: username,
                email: email,
                password: password,
                password2: password2
            }
            $.ajax({
                type: 'POST',
                url: 'php/register.php',
                data: registerData,
                success: function(response) {
                    if (response == "success") {
                        location.reload();
                    } else if (response == 'error') {
                        alert('Fel vid registrering. Försök igen senare.');
                    }
                },
                error: function() {
                    alert('Fel vid registrering. Försök igen senare.'); 
                }
            })
        } else {
            $('.passwordR').css('background-color', '#FFBABA');
        }
    });
    /* */

    /* större recept */
    $('#main').on('click', '.readMore, .searchRecipeImg', function() {
        var id = $(this).parent('section').data('id');
        $.ajax({
            type: 'POST',
            url: 'php/get_recipe.php',
            data: {recipeId: id},
            dataType: 'JSON',
        })
        .done(function(response) {
            if(response == 'error') {
                alert('Ett fel uppstod. Försök senare igen.');
            } else {
                $main.html($recipe);
                recipeHeader(response[0].info);
                for (var i = 0; response[1].length - 1 >= i; i++) {
                    recipeIngredients(response[1][i].ingredient);
                }
                for (var i = 0; response[2].length - 1 >= i; i++) {
                    recipeSteps(response[2][i].step);
                }

                /* justera mängden ingredienser */
                currentSlider = amountBoxFilter.val();
            }
        })
        .fail(function(response) {
            alert("Ett fel uppstod, försök gärna senare.");
        })
    })
    /*  */

    /* trycker ner stort recept */
    $('#recipe').delegate('#hide-icon', 'click', function() {
        $recipe.fadeOut(250);
    });

    $('#hide-icon').click(function() {
        $recipe.fadeOut(250);
    });
    /*  */

    /* recept baserat på användarinput */
    var timeFilter = $('#time');
    var timeBoxFilter =  $('#timeBox');

    timeBoxFilter.val(15);

    timeFilter.mousemove(function() {
        timeBoxFilter.val(timeFilter.val());
    });

    timeBoxFilter.on('input', function() {
        timeFilter.val(timeBoxFilter.val());
    });

    amountFilter.on('change mousemove', function() {
        amountBoxFilter.val(amountFilter.val());
    });

    amountBoxFilter.on('change input', function() {
        amountFilter.val(amountBoxFilter.val());
    });



    $('#portions, #portionsBox').on('change input mousemove', function() {
        $('#recipePortions').text(amountBoxFilter.val());
        $('.required').each(function() {
            var currentAmount = $(this).data('required');
            if(currentAmount == '') {
                $(this).text();
            } else {
                var singleAmount = currentAmount/currentSlider;
                var newValue = (singleAmount*amountBoxFilter.val()).toFixed(2);
                if (newValue > parseInt(newValue, 10)) {

                } else {
                    newValue = parseInt(newValue, 10)
                }
                $(this).text(newValue);  
            }
        });        
    })


    $('#searchCustomRecipe').click(function() {
        var recipeTime = $('#timeBox').val();
        var recipeAmount = $('#portionsBox').val();
        var vegetarian = 0
        if ($('#vegetarian').is(':checked')) {
            vegetarian = 1
        }

        var vegan = 0
        if ($('#vegan').is(':checked')) {
            vegan = 1
        }

        var lactosefree = 0
        if ($('#lactosefree').is(':checked')) {
            lactosefree = 1
        }

        var glutenfree = 0
        if ($('#glutenfree').is(':checked')) {
            glutenfree = 1
        }

        var filterData = {
            time: recipeTime,
            vegetarian: vegetarian,
            vegan: vegan,
            lactosefree: lactosefree,
            glutenfree: glutenfree
        }

        $.ajax({
            type: 'POST',
            url: 'php/filter.php',
            data: filterData,
            dataType: 'JSON'
        })
        .done(function(response) {
            $main.empty();
            searchRecipe(response);
        })
        .fail(function(response) {
            $main.html('<h2 class="emptyMain">Inga recept hittades. Prova att söka igen!</h2>');
        })
    });

    /* */


    /* hämta ingredienser*/
    $.ajax({
        type: 'GET',
        url: 'php/get_ingredients.php',
        dataType: 'JSON',
    })
    .done(function(ingredients) {
        if(ingredients == 'error') {
            alert('Ett fel uppstod. Försök senare igen.');
        }
        $.each(ingredients, function(i, ingredient) {
            addIngredient(ingredient);
        });
    })
    /* */

    /* sök ingredienser*/
    $searchIngredient.on('input', function() {
        var key = $(this).val();
        if(key == '') {
          $searchIngredientResult.fadeOut(150);
        } else {
            $searchIngredientResult.fadeIn(150)
            $.ajax({
                type: 'POST',
                url: 'php/search_ingredient.php',
                data: {key: key},
                dataType: 'JSON'
            })
            .done(function(responses) {
                if(responses == 'error') {
                    alert('Ett fel uppstod. Försök senare igen.');
                }
                $searchIngredientResult.empty();
                $.each(responses, function(i, response) {
                    searchIngredient(response);
                });
            })
        }
    });
    /* */

    /* dölj ingrediensmeny */
    $('#ingredients, #main').click(function() {
        $searchIngredientResult.fadeOut(200);
    });
    /*  */

    /* spara ingrediens */
    $searchIngredientResult.delegate('.searchIngredientItem', 'click', function() {
        $searchIngredient.focus().select();
        var ingredientId = $(this).data('id');
        var ingredientName = $(this).text();
        var exist = 0

        $ingredients.children('li').each(function() {
            if($(this).data('id') == ingredientId) {
                exist = 1
            }
        });

        if(exist == 0) {

            var newIngredient = {
                id: ingredientId,
                name: ingredientName
            }

            $.ajax({
                type: 'POST',
                url: 'php/add_ingredient.php',
                data: newIngredient
            })
            .done(function(response) {
                if(response == 'error') {
                    alert('Ett fel uppstod. Försök senare igen.');
                }
                if(response == 'error') {
                    alert('Ett fel uppstod. Försök senare igen.');
                }
                addIngredient(newIngredient);
            })
            .fail(function() {
                alert("Kunde inte lägga till ingrediens");
            })
        }
    });
    /* */

    /* ta bort ingrediens */
    $ingredients.delegate('.ingredient', 'click', function() {
      
        var ingredientId = $(this).data('id');
        var clicked = $(this);

        $.ajax({
            type: 'POST',
            url: 'php/delete_ingredient.php',
            data: {id: ingredientId}
        })
        .done(function(response) {
            if(response == 'error') {
                alert('Ett fel uppstod. Försök senare igen.');
            }
            clicked.fadeOut(150, function() {
                this.remove();
            });
        })
        .fail(function() {
            alert("Kunde inte ta bort ingrediens");
        })
    });
    /* */

    /* sök recept */
    $searchRecipe.on('input', function() {
        var key = $(this).val();
        if(key == '') {
          $main.html('<h2 class="emptyMain">Sök efter recept!</h2>');
        } else {
            $.ajax({
                type: 'POST',
                url: 'php/search_recipe.php',
                data: {key: key},
                dataType: 'JSON'
            })
            .done(function(results) {
                if(results == 'error') {
                    alert('Ett fel uppstod. Försök senare igen.');
                }   
                $main.empty();
                $.each(results, function(i, result) {
                    searchRecipe(result);
                });
            })
        }
    });
    /* */

    /* hämta e-post */
    $.ajax({
        type: 'GET',
        url: 'php/get_email.php',
    })
    .done(function(response) {
        if(response == 'error') {
            alert('Ett fel uppstod. Försök senare igen.');
        }
        $('#currentEmail').text(response);
    })
    .fail(function() {
        alert("Kunde inte hämta e-post");
    })
      
    /* */

    /* uppdatera e-post */
    $('#emailForm').submit(function() {
        event.preventDefault();
      
        var newEmail = $('#newEmail').val();

        $.ajax({
            type: 'POST',
            url: 'php/update_email.php',
            data: {email: newEmail},
            success: function(response) {
                if(response == 'error') {
                    alert('Ett fel uppstod. Försök senare igen.');
                }
                $('#currentEmail').text(newEmail)
                $('#currentEmail').css({
                    background: '#099A4D',
                    color: '#FFF'
                });
                $('#newEmail').val('');
                $('.user-popup, .overlay').delay(1000).fadeOut(200);
            },
            error: function() {
                alert('Fel vid uppdatering. Försök igen senare.'); 
            }
        })
    });
    /* */

    /* uppdatera lösenord */
    $('#passwordForm').submit(function() {
        event.preventDefault();
      
        var newPassword = $('#newPassword').val();
        var currentPassword = $('#currentPassword').val();

        var passwordData = {
            updatedPassword: newPassword,
            confirmPassword: currentPassword
        }

        $.ajax({
            type: 'POST',
            url: 'php/update_password.php',
            data: passwordData,
            success: function(response) {
                if (response == 'error') {
                    if (!$('.user-error').length) {
                        $('<p class="user-error">Felaktigt lösenord</p>').insertBefore('#passwordButton');
                    }
                } else {
                    $('.user-error').fadeOut(250);
                    $('#newPassword').css({
                        border: '3px solid #099A4D',
                        color: '#099A4D',
                        'font-size': '2em',
                        padding: '0 10px'
                    });
                    $('.user-popup, .overlay').delay(1000).fadeOut(200);
                }
            },
            error: function() {
                alert('Fel vid uppdatering. Försök igen senare.'); 
            }
        })
    });

    /* */

    /* inställningar för inloggad användare */
    $('#user-menu').click(function() {
        $('#menu').slideToggle(250);
        $('.username-settings').toggleClass('menu-active');
    });

    $('#change-email').click(function() {
        $('.overlay').fadeIn(200);
        $('.user-popup').hide(200);
        $('#main-email').fadeIn(200);
    });

    $('#change-password').click(function() {
        $('.overlay').fadeIn(200);
        $('.user-popup').hide(200);
        $('#main-password').fadeIn(200);
    });
    /*  */
});
