$(function() {

    //load all the recipes
    loadRecipe();


    //focus to the add recipe box
    $('#addButton').on('click', function(event) {
        $('#nameRecipe').focus();
    });

    //focus to the search recipe box
    $('#searchButton').on('click', function(event) {
        $('#searchRecipe').focus();
    });

    //add ingredients input
    $('#addIngredient').on('click', function(event) {

        $('#ingredientArea').append('<div class="form-group scrollBox"><input type="text" class="form-input ingredient" placeholder="..."></div>');
    });

    //Submit the recipe
    $('#submitRecipe').on('click', function(event) {
        var recipeName = $('#nameRecipe').val();
        var recipeTime = $('#timeRecipe').val()+':00';
        console.log(recipeTime);
        let ingredients = {};

        $('.ingredient').each(function (i) {
            if($(this).val() != "")
            {
                ingredients[i] = {ingredient_name: $(this).val()};
            }
        });

        if(recipeName !== "" && recipeTime !== "")
        {
            if(ingredients.length !== 0)
            {

                let jsonObject =
                    {
                        recipe:
                        {
                            name: recipeName,
                            time: recipeTime,
                            ingredient: ingredients
                        }
                    };

                var json = JSON.stringify(jsonObject);

                $.ajax({
                    url: 'http://localhost/recipe-project/public/api.php/recipe',
                    contentType: "application/json;charset=utf-8",
                    method : 'POST',
                    data: json,
                    dataType: "json",
                    beforeSend : function ( xhr ) {

                    }
                })
                    .done(function(data, status) {
                        console.log(data);
                    })
                    .fail(function (status, response, error) {

                    })
                    .always(function() {

                    });
            }
            else
            {

            }
        }
        else
        {

        }

    });

    $('#searchRecipe').on('keyup', function (event) {
       var searchRecipe = $('#searchRecipe').val();

       if(searchRecipe.length >= 3)
       {
           $.ajax({
               url: '',
               method: 'POST',
               data:  ''
           })
               .done(function (status, response) {

               })
               .fail(function(status, response, error){

               })
               .always(function () {

               });
       }
    });

});

function loadRecipe()
{
    $.ajax({
        url: 'http://localhost/recipe-project/public/api.php/recipe',
        method: 'GET',
        beforeSend: function(){

        }
    })
        .done(function (data, status) {
            var recipe = JSON.parse(data);
            console.log(recipe.data);

            for(var i in recipe.data)
            {
                $('#recipeTab').append("<div class='recipeRow' id='"+i+"'></div>");
                $('#'+i).append("<div class='accordion'><input type='checkbox' id='accordion-"+i+"' name='accordion-checkbox' hidden></div>");
                $("#"+i+" > .accordion").append("<div class='column col-2 recipeObject recipeName'><img src='../assets/img/recipe.png'>"+recipe.data[i].recipe_name+"</div><div class='column col-9 recipeObject recipeTime'><img src='../assets/img/alarm-clock.png'><b>"+recipe.data[i].recipe_time+"</b></div>");
                $("#"+i+" > .accordion").append("<label class='accordion-header' for='accordion-"+i+"'><span class='openAccordion'><img src='../assets/img/add.png'></span></label>");
                $("#"+i+" > .accordion").append("<div class='accordion-body'></div>");
                for(var x in recipe.data[i].ingredient)
                {
                    $("#"+i+" > .accordion > .accordion-body").append("<span>"+recipe.data[i].ingredient[x]+"</span>");
                }
            }
        })
        .fail(function(data, response, error){

        })
        .always(function() {

        });
}

function formatTime(time)
{

}