<?php


namespace App\Models;

class Contact {

    private $table = 'contact';


    public function getContact(){
        return \DB::table($this->table)
            ->get();

    }

    public function AddContact($fullName, $email, $content){

        return \DB::table($this->table)
            ->insert(['fullName' => $fullName,
                        'email' => $email,
                        'content' =>  $content
                ]);

    }


    public function deleteContact($contactID) {
        return \DB::table($this->table)
            ->where('contactID', $contactID)
            ->delete();

    }

}
