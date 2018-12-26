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
        var recipeTime = $('#timeRecipe').val();
        var ingredients = [];

        $('.ingredient').each(function (i) {
            ingredients.push($(this).val());
        });

        if(recipeName !== "" && recipeTime !== "")
        {
            if(ingredients.length !== 0)
            {


                $.ajax({
                    url: '',
                    method : 'POST',
                    data: '',
                    beforeSend : function ( xhr ) {

                    }
                })
                    .done(function(status, response) {

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
    /*$.ajax({
        url: '',
        method: 'POST',
        beforeSend: function(){

        }
    })
        .done(function (status, response) {

        })
        .fail(function(status, response, error){

        })
        .always(function() {

        });*/
}