<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $data;
    private $model;
    public function __construct()
    {
        $this->model = new Category();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['category'] = $this->model->getAllCategories();
        return view("admin.pages.category", $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('categoryBtn')) {
            $categoryName = $request->input('categoryName');
            try {

                $this->model->addCategory($categoryName);
                Log::insertLog("Dodata je nova kategorija  {$categoryName}");
                return response(['success' => 'Uspesno!'], 201);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->has('btn')) {
            $categoryID = $request->input('categoryID');
            try {

                $data = $this->model->getOneCategory($categoryID);
                return \Response::json($data);
            } catch (\PDOException $e){
                return response(['error' => $e->getMessage()], 500);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('updateCategory')) {
            $categoryID = $request->input('categoryID');
            $name = $request->input('name');

            try {

                $data = $this->model->updateCategory($name, $categoryID);
                Log::insertLog("Kategorija {$name} je izmenjena");
                return response(['success' => 'Uspesno!'], 204);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->has('deleteCategory')) {
            $categoryID = $request->input('categoryID');
            try {

                $this->model->deleteCategory($categoryID);
                Log::insertLog("Obrisana je kategorija ");
                return response(['success' => 'Uspesno!'], 204);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }

        }
    }

    public function showAjax(){
        try {
            $data = $this->model->getAllCategories();


            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }

    }
}
