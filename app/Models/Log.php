<?php

namespace App\Models;

class Log {



    public static function insertLog($log){

        $date = date("Y-m-d H:i:s");
        return \DB::table('log')
            ->insert([
                'log' => $log,
                'date' => $date
            ]);
    }

    public function getLogs(){
        return \DB::table("log")
            ->orderBy('date', 'desc')
            ->paginate(15);
    }




}
