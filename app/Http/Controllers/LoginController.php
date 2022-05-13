<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\Log;
use App\Models\Register;
use App\Models\User;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(Request $request){


        if($request->has('loginBtn')) {
            $email = $request->input('email');
            $password = $request->input('password');
            $secret = md5($password);

            try{
                $userModel = new User();
                $user = $userModel->findByEmailAndPassword($email,$secret);
                if ($user){
                   // \Log::alert($user->fullName);
                     $request->session()->put('user', $user);
                     Log::insertLog("Korisnik {$request->session()->get('user')->fullName  } se ulogovao");
                   return $user->role == "Administrator" ? redirect(route('admin.index')) : redirect(route('home'));
                } else {

                    return redirect()->back()->with('error', 'Pogrešan email ili lozinka. Pokušajte ponovo!');
            }
            } catch (PDOException $e){
                Log::insertLog("Greška : {$e->getMessage()}");
            return response(['error' => $e->getMessage()], 500);
        }

       }


}

public function register(UserRequest $request){
    if($request->has('registerBtn')) {
        $registerModel = new Register();
        $fullName = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirmPass = $request->input('confirmPass');


        try {
            $token = Str::random(60);
            $secret = md5($password);
            $registerModel->addUser($fullName, $email, $secret, $token);
            Log::insertLog("{$fullName} je novi korisnik!");
                return response(['success' => 'Uspešno ste se registrovali!'], 201);
            } catch (PDOException $e) {
                Log::insertLog("Greška: {$e->getMessage() }");
                return response(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function logout(Request $request){
        Log::insertLog("Korisnik {$request->session()->get('user')->fullName} se izlogovao");
        session()->forget('user');
        return redirect(route('login'));

    }

}
