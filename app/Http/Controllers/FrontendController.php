<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Network;




class FrontendController extends Controller
{
    private $data;

    public function __construct()
    {
        $menuModel = new Menu();
        $this->data['menu'] = $menuModel->getAllMenu();
        $networkModel = new Network();
        $this->data['network'] = $networkModel->getAllNetworks();

    }


    public  function  index(){


        $categoryModel = new Category();
        $toolModel = new Tool();
        $this->data['tools'] = $toolModel->getAllTools();
        $this->data['categories'] = $categoryModel->getAllCategories();
        $cartModel = new Cart();
        if(\Session::has('user')){
            $userID = \Session::get('user')->userID;
            $this->data['cartNumber'] = $cartModel->getNumberOfTools($userID);
        }

        return view("front.pages.index", $this->data);
    }

    public function fetchTools(){

            $toolModel = new Tool();
            return $toolModel->getAllTools();

    }
    public  function  about(){
        $cartModel = new Cart();

        if(\Session::has('user')){
            $userID = \Session::get('user')->userID;
            $this->data['cartNumber'] = $cartModel->getNumberOfTools($userID);
        }
        return view("front.pages.about",$this->data);
    }
    public  function  contact(){
        $cartModel = new Cart();
        if(\Session::has('user')){
            $userID = \Session::get('user')->userID;
            $this->data['cartNumber'] = $cartModel->getNumberOfTools($userID);
        }
        return view("front.pages.contact",$this->data);
    }
    public  function  login(){
        return view("front.pages.login",$this->data);
    }
    public  function  register()
    {
        return view("front.pages.register",$this->data);
    }

    public  function  cart(Request $request)
    {
        $userID = $request->session()->get('user')->userID;
        $cartModel = new Cart();
        $cart = $cartModel->getCart($userID);
        $this->data['cart'] = $cart;
        $sum  = $cartModel->sumPrice($userID);
        $this->data['sum'] = $sum;
        $cartModel = new Cart();
        if(\Session::has('user')){
            $userID = \Session::get('user')->userID;
            $this->data['cartNumber'] = $cartModel->getNumberOfTools($userID);
        }
        return view("front.pages.cart",$this->data);
    }

    public function product(Request $request, $id){

        $toolModel = new Tool();
        $tool = $toolModel->getOneToolWithCategory($id);
        $this->data['tool'] = $tool;
        $cartModel = new Cart();
        if(\Session::has('user')){
            $userID = \Session::get('user')->userID;
            $this->data['cartNumber'] = $cartModel->getNumberOfTools($userID);
        }

        return view("front.pages.product",$this->data);
    }


}
