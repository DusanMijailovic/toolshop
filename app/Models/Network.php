<?php
namespace App\Models;



class Network
{
    public function getAllNetworks(){
        return \DB::table('socialnetwork')
            ->get();
    }



}
