<?php
/**
 * Created by PhpStorm.
 * User: Floran
 * Date: 27/12/2018
 * Time: 11:31
 */

namespace App\api\Interfaces;


interface Irecipe
{
    public function get();
    public function getRecipe($id);
    public function insert();
    public function update($id);
    public function delete($id);
    public function autoComplete($val);
}