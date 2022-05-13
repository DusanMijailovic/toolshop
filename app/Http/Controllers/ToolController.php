<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tool;
use Psy\Util\Json;

class ToolController extends Controller
{


    public function show(Request $request){
            $value = $request->value;

                $toolModel = new Tool();

        return $toolModel->getToolBySearch($value);

    }

}
