<?php
namespace App\Models;

class Tool
{
    private $table = 'tool';

    public function getAllTools(){
        return \DB::table($this->table)
            ->paginate(6);
    }

    public function getAll(){
        return \DB::table($this->table)
            ->get();
    }

    public function getOneTool($id){
        return \DB::table($this->table)
            ->where('toolID', $id)
            ->first();
    }

    public function getToolBySearch($value){

        return \DB::table($this->table)
            ->join('category_tool', 'tool.toolID','=', 'category_tool.toolID')
            ->join('category','category_tool.categoryID', '=','category.categoryID')
            ->select('tool.*')
            ->distinct()
            ->where('tool.name', 'like', "%" . $value . "%")
            ->orWhere('tool.description','like', "%" . $value . "%")

            ->get();
    }

    public function toolsFilter($value, $categoryID){

        $query = \DB::table($this->table);


        if($value){
            $query = $query->where('tool.name', 'like', "%" . $value . "%")
                ->orWhere('tool.description','like', "%" . $value . "%")
                ->distinct();


        }
      /*  $query = $query ->join('category_tool', 'tool.toolID','=', 'category_tool.toolID')*/
            /*->join('category','category_tool.categoryID', '=','category.categoryID')*/
        if($categoryID){
            $query = $query->join('category_tool', 'tool.toolID','=', 'category_tool.toolID')
                ->join('category','category_tool.categoryID', '=','category.categoryID')
                ->where('tool.toolID', $categoryID)
                ->select("*","tool.name as tool");

        }
        $query = $query->paginate(6);
        return $query;
    }

    public function getOneToolWithCategory($toolID){
        return \DB::table($this->table)
            ->join('category_tool', 'tool.toolID','=', 'category_tool.toolID')
            ->join('category','category_tool.categoryID', '=','category.categoryID')
            ->where('tool.toolID', $toolID)
            ->select("*","tool.name as tool")
            ->get()->first();
    }

    public function getNumberOFTools(){
        return \DB::table($this->table)
            ->count();
    }

    public function addTool($name, $description, $price, $sitePrice, $input){
        return \DB::table($this->table)
            ->insert(['name' => $name,
                'description' => $description,
                'price' => $price,
                'sitePrice' => $sitePrice,
                'imgSrc' => $input,
                ]);
    }

    public function insert($tool){
        $toolId = \DB::table($this->table)->max("toolID");

        $tool["toolID"] = $toolId + 1;

        return \DB::table($this->table)->insertGetId($tool);
    }
    public function  insertCatTool($catID, $toolID){
        return \DB::table("category_tool")
            ->insert([
                'categoryID' => $catID,
                'toolID' => $toolID
            ]);

    }
    public function deleteTool($toolID) {
        return \DB::table($this->table)
            ->where('toolID', $toolID)
            ->delete();

    }
    public function deleteCatTool($toolID) {
        return \DB::table($this->table)
            ->where('toolID', $toolID)
            ->delete();

    }

    public function updateTool($toolID, $name, $description, $price, $sitePrice, $imgSrc ){
        return \DB::table($this->table)
            ->where('toolID', $toolID)
            ->update([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'sitePrice' => $sitePrice,
                'imgSrc' => $imgSrc,

            ]);
    }
    public function updateToolWithoutImage($toolID, $name, $description, $price, $sitePrice ){
        return \DB::table($this->table)
            ->where('toolID', $toolID)
            ->update([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'sitePrice' => $sitePrice,
            ]);
    }


    public function getImage($toolID){
        return \DB::table($this->table)
            ->where('toolID', $toolID)
            ->select("tool.imgSrc")
            ->get()->first();

    }

    public function updateCatTool($toolID,$categoryID){
        return \DB::table("category_tool")
            ->where('toolID', $toolID)
            ->update([
                'categoryID' => $categoryID


            ]);

    }
}
