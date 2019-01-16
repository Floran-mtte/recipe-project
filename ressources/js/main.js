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
                        $('#nameRecipe').val('');
                        $('#timeRecipe').val('');
                        $('.ingredient').each(function(index) {
                            $(this).val('');
                        });

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

        if (searchRecipe.length < 3)
        {
            $('#resultSearch').html('');
            $('#resultSearch').removeClass('find');
        }

       if(searchRecipe.length >= 3)
       {
           $.ajax({
               url: 'http://localhost/recipe-project/public/api.php/recipe/'+searchRecipe,
               method: 'GET',
           })
               .done(function (data, status) {
                   var recipe = JSON.parse(data);
                   console.log(recipe.data.length);
                   if(recipe.data != null)
                   {
                       for(var i in recipe.data)
                       {
                           console.log(recipe.data);
                           $('#resultSearch').append("<div class='recipeResult recipeName' data-id='"+i+"'><img src='../assets/img/recipe.png'><span class='itemResult'>"+recipe.data[i].recipe_name+"</span></div>" +
                               "<br />");
                       }
                   }
                   else
                   {

                   }

               })
               .fail(function(status, response, error){

               })
               .always(function () {

               });
       }

    });

    $("#resultSearch").on('click','.recipeResult', function(event){
        let id = $(this).data('id');

        if(id != null)
        {
            $('#resultSearch').html('');

            $.ajax({
                url:'http://localhost/recipe-project/public/api.php/recipe/'+id,
                method: 'GET',
                dataType: 'json'
            })
            .done(function(data, status)
            {
                let result = JSON.parse(JSON.stringify(data));
                console.log(result);

                for(var i in result.data)
                {
                    $('#recipeSearch').append("<div id='general'></div>");
                    $('#general').append("<div>"+result.data[i].recipe_name+"</div>");
                    $('#general').append("<div>"+result.data[i].recipe_time+"</div>");
                    $('#recipeSearch').append("<div id='ingredientList'></div>");
                    for(var x in result.data[i].ingredient)
                    {
                        $('#ingredientList').append("<div>"+result.data[i].ingredient[x]+"</div>");
                    }
                }
            })
            .fail(function(data, status, error)
            {

            });
        }
    });

    $('#recipeTab').on('click', '.editLine', function(e) {
        let id = $(this).attr('id');
        $('#name_'+id).show();
        $("#"+id+" > .accordion > .recipeName").hide();
        $('#time_'+id).show();
        $("#"+id+" > .accordion > .recipeTime").hide();

        $('#ingredient_'+id+' > .ingredient_list').each(function(i)
        {
            $(this).hide();
        });

        $('#ingredient_'+id+' > .ingredient_input > input').each(function(i)
        {
            $(this).show();
        });

        $('#commandLine_'+id).show();

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

            for(var i in recipe.data)
            {
                $('#recipeTab').append("<div class='recipeRow' id='"+i+"'></div>");
                console.log($('#'+i));
                $('#'+i).append("<div class='accordion'><input type='checkbox' id='accordion-"+i+"' name='accordion-checkbox' hidden></div>");
                $("#"+i+" > .accordion").append("<div class='column col-2 recipeObject recipeName'><img src='../assets/img/recipe.png'>"+recipe.data[i].recipe_name+"</div><input id='name_"+i+"' type='text' value='"+recipe.data[i].recipe_name+"' hidden><div class='column col-9 recipeObject recipeTime'><img src='../assets/img/alarm-clock.png'><b>"+recipe.data[i].recipe_time+"</b></div><input id='time_"+i+"' type='text' value='"+recipe.data[i].recipe_time+"' hidden>");
                $("#"+i+" > .accordion").append("<label class='accordion-header' for='accordion-"+i+"'><span class='openAccordion'><img src='../assets/img/add.png'></span><span id='"+i+"'class='editLine'><img src='../assets/img/edit.png'></span></label>");
                $("#"+i+" > .accordion").append("<div class='accordion-body'></div>");
                $("#"+i+" > .accordion > .accordion-body").append("<div id='ingredient_"+i+"'></div>");
                for(var x in recipe.data[i].ingredient)
                {
                    $("#ingredient_"+i).append("<span class='ingredient_list'>"+recipe.data[i].ingredient[x]+"</span><span class='ingredient_input'><input type='text' data-id='"+x+"' value='"+recipe.data[i].ingredient[x]+"' hidden></span>");
                }
                $("#"+i+" > .accordion > .accordion-body").append("<div hidden id='commandLine_"+i+"'><span><a class='updateLine' data-id='"+i+"' onclick='updateRecipe($(this).data(\"id\"))'>Modifier</a></span> | <span><a class='backLine'>Annuler</a></span></div>");
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

function updateRecipe(id)
{
    let name = $('#name_'+id).val();
    let time = $('#time_'+id).val();

    let ingredients = {};

    $('#ingredient_'+id+' > .ingredient_input > input').each(function (i) {
        let id_ingredient = $(this).data('id');
        console.log(id_ingredient);
        if($(this).val() != "")
        {
            ingredients[id_ingredient] = {ingredient_name: $(this).val()};
        }
    });

    if(name !== "" && time !== "") {
        if (ingredients.length !== 0) {

            let jsonObject =
                {
                    recipe:
                        {
                            name: name,
                            time: time,
                            ingredient: ingredients
                        }
                };

            let json = JSON.stringify(jsonObject);

            $.ajax({
                url: 'http://localhost/recipe-project/public/api.php/recipe/'+id,
                contentType: "application/json;charset=utf-8",
                method: 'PUT',
                data: json,
                dataType: "json",
                beforeSend: function (xhr) {

                }
            })
                .done(function (data, status) {
                })
                .fail(function (status, response, error) {

                })
                .always(function () {

                });
        }
    }
}