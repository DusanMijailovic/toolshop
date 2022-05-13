<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Log;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $data;
    private $model;
    public function __construct()
    {
        $this->model = new Contact();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['contacts'] = $this->model->getContact();
        return view("admin.pages.contact", $this->data);
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
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->has('deleteContact')) {
            $contactID = $request->input('contactID');
            try {

                $this->model->deleteContact($contactID);
                Log::insertLog(" Kontakt je obrisan");
                return response(['success' => 'Uspesno!'], 204);
            } catch (\PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }

        }
    }

    public function showAjax(){
        try {
            $data = $this->model->getContact();


            return \Response::json($data);
        } catch (\PDOException $e){
            return response(['error' => $e->getMessage()], 500);
        }
    }
}
