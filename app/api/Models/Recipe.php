<?php
/**
 * Created by PhpStorm.
 * User: Floran
 * Date: 27/12/2018
 * Time: 09:01
 */

namespace App\api\Models;
use PDO;
use Exception;


class Recipe
{
    protected $db;

    protected $id;
    protected $recipeName;
    protected $recipeTime;

    /**
     * Recipe constructor.
     * @throws Exception if the database connexion failed
     * @param int id the id of the recipe
     * @param string name of the recipe
     * @param string time to do the recipe
     */
    public function __construct($id = null, $recipeName = null, $recipeTime = null)
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=recipe-project;charset=utf8','root','');
        }
        catch (Exception $e)
        {
            throw new Exception("Error while contaction the server : ".$e->getMessage());
        }
        $this->setDb($db);

        if($id != null)
        {
            $this->setId($id);
        }

        if($recipeName != null)
        {
            $this->setRecipeName($recipeName);
        }

        if($recipeTime != null)
        {
            $this->setRecipeTime($recipeTime);
        }
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRecipeName()
    {
        return $this->recipeName;
    }

    /**
     * @param mixed $recipeName
     */
    public function setRecipeName($recipeName)
    {
        $this->recipeName = $recipeName;
    }

    /**
     * @return mixed
     */
    public function getRecipeTime()
    {
        return $this->recipeTime;
    }

    /**
     * @param mixed $recipeTime
     */
    public function setRecipeTime($recipeTime)
    {
        $this->recipeTime = $recipeTime;
    }

    public function getAllRecipe()
    {
        $query = $this->getDb()->prepare("SELECT * FROM recipe");
        $query->execute();

        $fetch = $query->fetchall(PDO::FETCH_ASSOC);

        $response = array();
        if($query->rowCount() > 0)
        {
            $response['status'] = 'success';
            $response['code'] = '200';
            $response['data'] = $fetch;

            return $response;
        }
        $response['status'] = 'failed';
        $response['code'] = '';
        return $response;
    }

    public function getRecipeById($id)
    {
        $query = $this->getDb()->prepare("SELECT * FROM recipe WHERE id = :id");
        $query->execute(array("id" => $id));

        $fetch = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount() > 0)
        {
            return $response = array("status" => "success","code" => 200, "data" => $fetch);
        }
        return $response = array("status" => "success", "code" => 204, "msg" => "Pas de recette pour l'id : ".$id);
    }

    public function updateRecipe($id)
    {
        $query = $this->getDb()->prepare("UPDATE recipe SET recipe_name = :recipeName, recipe_time = :recipeTime WHERE id = :id");
        $query->execute(array(
            "recipeName" => $this->getRecipeName(),
            "recipeTime" => $this->getRecipeTime(),
            "id" => $id,
        ));

        if($query->rowCount() > 0)
        {
            return $result = array("status" => "success", "code" => 200);
        }
        return $result = array("status" => "failed", "code" => 500);
    }

    public function deleteRecipe($id)
    {
        $query = $this->getDb()->prepare("DELETE FROM RECIPE WHERE id = :id");
        $query->execute(array('id' => $id));

        if($query->rowCount() > 0)
        {
            return $result = array("status" => "success", "code" => 200);
        }

        return $result = array("status" => "success", "code" => 204, "msg" => "L'id ".$id." est inexistant");
    }

    public function insertRecipe()
    {
        $query = $this->getDb()->prepare("INSERT INTO recipe(`recipe_name`,`recipe_time`) VALUES(:recipeName, :recipeTime)");
        $query->execute(array(
            "recipeName" => $this->getRecipeName(),
            "recipeTime" => $this->getRecipeTime(),
            ));

        if($query->rowCount() > 0)
        {
            $id = $this->getDb()->lastInsertId();
            return $response = array("status" => "success", "code" => 201, "data" => array("id" => $id));
        }
        return $response = array("status" => "failed", "code" => 500, "msg" => "Erreur lors de l'insertion de la recette");
    }

    public function getRecipeByVal($val)
    {
        $query = $this->getDb()->prepare("SELECT * FROM recipe WHERE recipe_name LIKE :val");
        $query->execute(array("val" => $val.'%'));

        if($query->rowCount() > 0)
        {
            $fetch = $query->fetchall(PDO::FETCH_ASSOC);
            return $response = array("status" => "success", "code" => 200, "data" => $fetch);
        }
        return $response = array("status" => "success", "code" => 204, "msg" => "No results found");
    }

}