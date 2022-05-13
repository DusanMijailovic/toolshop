<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    private $data;

    public function index(){
        $logModel = new Log();
        $this->data['logs'] = $logModel->getLogs();
        return view("admin.pages.log", $this->data);
    }
}
