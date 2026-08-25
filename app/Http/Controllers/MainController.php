<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
  public function index()
  {
    //load users  notes
    $id = session('user.id');
    $user = User::find($id)->toArray();
    $notes = User::find($id)->notes()->get()->toArray();

    //show home view
    return view('home', ['notes' => $notes]);
  }

  public function newNote()
  {
    echo "Im inside the new note page";
  }

  public function editNote($id)
  {
    $id = $this->decryptId($id);
  }



  public function deleteNote($id)
  {
    $id = $this->decryptId($id);
  }

  private function decryptId($id)
  {
    try {
      $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
      return redirect()->route('home');
    }
    return $id;
  }
}
