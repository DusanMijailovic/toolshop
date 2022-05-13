<?php
namespace App\Models;

class Category
{
    private $table = 'category';

    public function  getAllCategories(){
        return \DB::table($this->table)
            ->get();
    }

     public function getCategoriesAndTools($categoryID){
    return \DB::table($this->table)
    ->join('category_tool', 'category.categoryID','=', 'category_tool.categoryID')
    ->join('tool','category_tool.toolID', '=','tool.toolID')
        ->select('tool.*')
    ->where('category.categoryID', $categoryID)
    ->paginate(6);/*select('tool.*')
    ->get();*/
    }

    public function addCategory($name){
    return \DB::table($this->table)
    ->insert(['name' => $name]);
    }

    public function deleteCategory($categoryID){
    return \DB::table($this->table)
        ->where("categoryID", $categoryID)
    ->delete();

    }

    public function updateCategory($name, $categoryID){
    return \DB::table($this->table)
    ->where('categoryID', $categoryID)
    ->update(['name' => $name]);
    }

    public function getOneCategory($categoryID){
    return \DB::table($this->table)
    ->where('categoryID', $categoryID)->first();
    }


}
