<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CategoryController extends Controller
{

    public function categoryTool(Request $request){
        $id = $request->id;

        $categoryModel = new Category();

        return $categoryModel->getCategoriesAndTools($id);
    }
}
