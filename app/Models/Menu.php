<?php
namespace App\Models;



class Menu
{

    private $table = "menu";

    public function getAllMenu(){

        return \DB::table($this->table)
            ->get();
    }



}
