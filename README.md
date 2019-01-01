# **DOC API**
API base URL : http://localhost/recipe-project/public/api.php  
To use the API you need to send data into the body of the http request in JSON format  
Exemple for insert request at the end of the doc.
### INSERT RECIPE

##### Url

    > /recipe

#### Method

    > POST

##### Params
    >  recipe name  : string 'name'
    >  recipe time  : string 'time' (mysql format ex 00:00:00)
    >  ingredients  : array 'ingredient' :
         > 	ingredient name : string 'ingredient_name'


### UPDATE RECIPE

##### Url

    > /recipe/{id}

#### Method

    > PUT

##### Params
    >  recipe id    : int    'id'
    >  recipe name  : string 'name'
    >  recipe time  : string 'time' (mysql format ex 00:00:00)
    >  ingredients  : array  'ingredient' :
		 > 	ingredient id   : int    'id'
         > 	ingredient name : string 'ingredient_name'
         
### DELETE RECIPE

##### Url

    > /recipe/{id}

#### Method

    > DELETE

### GET ALL RECIPES

##### Url

    > /recipe

#### Method

    > GET

### GET RECIPE

##### Url

    > /recipe/{id}

#### Method

    > GET

### GET RECIPE BY VAL

##### Url

    > /recipe/{val}

#### Method

    > GET




## Example

### INSERT REQUEST

 - **Url           :** http://localhost/recipe-project/public/api.php/recipe
 - **Method :** POST
 - **Params :**

			{
			  "recipe":
			  {
			    "name": "Pizza",
			    "time": "00:30:00",
			    "ingredient":
			    {
			      "0":
			      {
			        "ingredient_name": "Tomatoes"
			      },
			      "1":
			      {
			        "ingredient_name": "Butter"
			      }
			    }
			  }
			}
