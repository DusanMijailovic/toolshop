<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Log;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function insertCart(Request $request){

        if($request->has('cartBtn')) {
                $userID = $request->session()->get('user')->userID;
            $priceSite = $request->input("priceSite");
            $categoryID = $request->input("categoryID");

            try {
                $cartModel = new Cart();
                $cartModel->insertToCart($priceSite,$userID,$categoryID);
                Log::insertLog("Korisnik {$request->session()->get('user')->fullName} je dodao proizvod u korpu");
                return response(['success' => 'Vaš proizvod je dodat u korpu!'], 201);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);

            }

        }
    }


    public function deleteCart(Request $request){

        if($request->has('deleteBtn')){
            $cartID = $request->input('cartID');

            try {
                $cartModel = new Cart();
                $cartModel->deleteCartData($cartID);
                Log::insertLog("Korisnik {$request->session()->get('user')->fullName} je uklonio proizvod iz korpe");
                return response(['success' => 'Usesno!'], 204);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function getNewAmount(Request $request){
        try {
            $userID = $request->session()->get('user')->userID;
            $cartModel = new Cart();
            $data = $cartModel->sumPrice($userID);
            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function getAllFromCart(Request $request){
        try {
            $userID = $request->session()->get('user')->userID;
            $cartModel = new Cart();
            $data = $cartModel->getCart($userID);
            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }
    }


    public function numberOfTools(){
        try {
            $userID = \Session::get('user')->userID;
            $cartModel = new Cart();
            $data = $cartModel->getNumberOfTools($userID);
            //\Log::alert($data);
            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function buyTools(Request $request){
        try {
            $userID = \Session::get('user')->userID;
            $cartModel = new Cart();
             $cartModel->buyTools($userID);
            Log::insertLog("Korisnik {$request->session()->get('user')->fullName} je zavrsio kupovinu");
            return response(['success' => 'Uspešno ste izvršili kupovinu!'], 204);
        }catch (\PDOException $e){
            Log::insertLog("Greška : {$e->getMessage()}");
            return response(['error' => $e->getMessage()], 500);
        }
    }


}
