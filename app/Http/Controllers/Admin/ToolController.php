<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Models\Category;
use App\Models\Log;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    private $data;
    private $model;
    private  $categoryModel;
    public function __construct()
    {
        $this->model = new Tool();
        $this->categoryModel = new Category();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['tools'] = $this->model->getAll();
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        return view("admin.pages.tool", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertToolRequest $request)
    {


        $image = $request->file('imgSrc');
        $image_name = uniqid() . "_" . time() . "." . $image->extension();
        $image->move(public_path() . "/img/tools", $image_name);
        $input = $request->except(['_token','categoryId']);
        $input["imgSrc"] = $image_name;
        $catId = $request->input('categoryId');


        try {

            $id = $this->model->insert($input);
            $this->model->insertCatTool($catId,$id);
            Log::insertLog("Dodat je novi alat ");

            return redirect()->back();
        } catch (\PDOException $e){

            Log::insertLog("Greška : {$e->getMessage()}");
            /*return response(['error' => $e->getMessage()], 500);*/
            return redirect()->back()->with(['error' => $e->getMessage()]);
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

        $data = $this->model->getOneToolWithCategory($id);
        $this->data['categories'] = $this->categoryModel->getAllCategories();

        if(!$data){
            abort(404);
        }

        $this->data['tool']=$data;
        return view("admin.pages.tool_edit", $this->data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolRequest $request, $id)
    {

            $toolID = $request->input('hdnToolID');
            $name = $request->input('name');
            $description = $request->input('description');
            $price = $request->input('price');
            $priceSite = $request->input('sitePrice');
            $catId = $request->input('categoryId');


        if($request->has('imgSrc')){
            $photoToDelete = $this->model->getImage($toolID);

            \File::delete(\public_path(). "/img/tools/" .$photoToDelete->imgSrc);

            $image = $request->file('imgSrc');
            $image_name = uniqid() . "_" . time() . "." . $image->extension();
            $image->move(public_path() . "/img/tools", $image_name);



            try {

                $this->model->updateTool($toolID,$name,$description,$price,$priceSite,$image_name);

                $this->model->updateCatTool($toolID,$catId);
                Log::insertLog("  Alat je izmenjen");
                return redirect("/admin/tools/")->with('success','Uspesno!');
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return redirect()->back()->with('error','Greška na serveru! Pokušajte kasnije');
            }

        }
        else {
            try {

                $this->model->updateToolWithoutImage($toolID,$name,$description,$price,$priceSite);

                $this->model->updateCatTool($toolID,$catId);
                Log::insertLog("  Alat je izmenjen");
                return redirect("/admin/tools/")->with('success','Uspesno!');
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return redirect()->back()->with('error','Greška na serveru! Pokušajte kasnije');
            }


        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->has('deleteTool')) {
            $toolID = $request->input('toolID');
            try {
                $photoToDelete = $this->model->getImage($toolID);
                \File::delete(\public_path(). "/img/tools/" .$photoToDelete->imgSrc);
                $this->model->deleteCatTool($toolID);
                $this->model->deleteTool($toolID);

                Log::insertLog("Alat je obrisan");
                return response(['success' => 'Uspesno!'], 204);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }

        }
    }

    public function showAjax(){
        try {
            $data = $this->model->getAll();


            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }

    }


}
