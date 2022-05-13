<?php

namespace App\Models;

class User {

   private $table = 'user';



    public function getAll() {
        return \DB::table($this->table)
            ->get();
    }



    public function findByEmailAndPassword($email, $password){

    return \DB::table($this->table)
        ->join("role","user.roleID","=","role.roleID")
        ->where([
            ["email", "=", $email],
            ['password',"=", $password],
            ["active", "=","1"]
        ])
        ->get()->first();
    }



    public function deleteUser($userID){

        return \DB::table($this->table)
            ->where('userID', $userID)
            ->delete();
    }



}
