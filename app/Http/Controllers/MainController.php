<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index(){
    //load users  notes

    //show home view
    return view('home');
  }

  public function newNote(){
    echo "Im inside the new note page";
  }
}
