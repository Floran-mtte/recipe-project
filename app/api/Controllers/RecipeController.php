<?php
/**
 * Created by PhpStorm.
 * User: Floran
 * Date: 27/12/2018
 * Time: 09:01
 */

namespace App\api\Controllers;

use App\api\Interfaces\Irecipe;
use App\api\Models\Recipe;


class RecipeController implements Irecipe
{
    protected $oRecipe;

    public function __construct(Recipe $recipe)
    {
        $this->setORecipe($recipe);
    }

    /**
     * @return mixed
     */
    public function getORecipe()
    {
        return $this->oRecipe;
    }

    /**
     * @param mixed $oRecipe
     */
    public function setORecipe($oRecipe)
    {
        $this->oRecipe = $oRecipe;
    }

    public function get()
    {
        return $this->getORecipe()->getAllRecipe();
    }

    public function getRecipe($id)
    {
        return $this->getORecipe()->getRecipeById($id);
    }

    public function insert()
    {
        return $this->getORecipe()->insertRecipe();
    }

    public function update($id)
    {
        return $this->getORecipe()->updateRecipe($id);
    }

    public function delete($id)
    {
        return $this->getORecipe()->deleteRecipe($id);
    }

    public function autoComplete($val)
    {
        return $this->getORecipe()->getRecipeByVal($val);
    }
}