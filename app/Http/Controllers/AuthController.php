<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'text_username' => 'required | email | ',
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
        
        echo "Ok";
    }

    public function logout(){
        echo "Logout";
    }
}
