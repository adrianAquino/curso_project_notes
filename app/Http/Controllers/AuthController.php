<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginSubmit(Request  $request){
        //Form validation 
        $request->validate(
            //rules    
        [
            'text_username' => 'required | email',
            'text_password' => 'required | min:6 | max:16'
        ],
            //custom messages
        [
            'text_username.required' => 'O campo e-mail é obrigatório',
            'text_username.email' => 'O campo e-mail deve ser um endereço de e-mail válido',
            'text_password.required' => 'O campo senha é obrigatório',
            'text_password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
            'text_password.max' => 'O campo senha deve ter no máximo 16 caracteres'
        ]
        ); 
    
        //get user input

        $username = $request->input('text_username');
        $password = $request->input('text_password');
        
        //check if user exists in the database
        $user = User::where('username', $username)->where('deleted_at', null)->first();

        

        if (!$user) {
            return redirect()->back()
                    ->withInput()
                    ->with('loginError', 'Usuário ou senha não encontrados');
        }

        //check if password is correct
        if(!password_verify($password, $user->password)){
            return redirect()->back()
                    ->withInput()
                    ->with('loginError', 'Usuário ou senha não encontrados');
        }

        //update last login date
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login user
        session([
            'user' =>[
                'id' => $user->id,
                 'username' => $user->username
            ]
        ]);


        return redirect()->to('/');

        //print_r($user);
        //test databe connection
        /*try {
            DB::connection()->getPdo();
            echo "Connected successfully to the database.";
        } catch (\Exception $e) {
            echo "Failed to connect to the database: " . $e->getMessage();
        }*/

        //get all users from the database
        //$users = User::all()->toArray();

    }

    public function logout(){
        //logout user
        session()->forget('user');
        return redirect()->to('/login');
    }
}
