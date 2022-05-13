<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function insertContact(Request $request){

        if($request->has('contactBtn')) {
            $contactModel = new Contact();

            $fullName = $request->input('fullName');
            $email = $request->input('email');
            $content = $request->input('content');

            $data = [
                'name' => $fullName,
                'mail' => $email,
                'text' => $content
            ];
            $rules = [
                'fullName' => 'required|min:3|max:20|regex:/^[A-Z][a-z]{2,15}\s[A-Z][a-z]{2,15}$/',
                'email' => 'required|email',
                'content' => 'required'
            ];

            $validator = \Validator::make($request->all(), $rules);
            $validator->validate();

            try {

                Mail::to('test.zatestiranje@gmail')->send(new ContactMail($data));
                $contactModel->AddContact($fullName,$email,$content);
                Log::insertLog("Poruka je poslata");
                return response(['success' => 'Uspešno ste nas kontaktirali!'], 201);
            } catch (\PDOException $e){
                Log::insertLog("Greška: {$e->getMessage()}");
                return response(['error' => $e->getMessage()], 500);
            }


        }

    }


}
