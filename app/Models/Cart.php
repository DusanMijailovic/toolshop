<?php
namespace App\Models;


class Cart
{

    private $table = "cart";


    public function insertToCart($amount, $userID, $ctID)
    {
        return \DB::table($this->table)
            ->insert([
                "amount" => $amount,
                "userID" => $userID,
                "ctID" => $ctID
            ]);


    }

    public function getCart($userID){
        return \DB::table($this->table)
            ->join('category_tool', 'cart.ctID', "=", 'category_tool.ctID')
            ->join('tool','category_tool.toolID', '=', 'tool.toolID')
            ->where('userID', $userID)
            ->get();
    }

    public function sumPrice($userID){
        return \DB::table($this->table)
            ->where('userID', $userID)
            ->sum('amount');

    }

    public function deleteCartData($cartID){
        return \DB::table($this->table)
            ->where('cartID', $cartID)
            ->delete();
    }

    public function getNumberOfTools($userID){
        return \DB::table($this->table)
            ->where('userID', $userID)
            ->count('cartID');
    }

    public function buyTools($userID){
        return \DB::table($this->table)
            ->where('userID', $userID)
            ->delete();
    }


}
