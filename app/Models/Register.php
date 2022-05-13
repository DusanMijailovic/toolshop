<?php

namespace App\Models;

class Register {

    private $table = 'user';



    public function addUser($fullName, $email, $password, $token){

        return \DB::table($this->table)
            ->insert([
                'userID' => null,
                'fullName' => $fullName,
                'email' => $email,
                'password' => $password,
                'active' => 1,
                'token' => $token,
                'roleID' => 2
                    ]);


    }

    public function getGender(){

        return $this->conn->executeQuery("SELECT * FROM gender");
    }

}
