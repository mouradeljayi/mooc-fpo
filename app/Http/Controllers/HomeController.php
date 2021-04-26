<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\User;
use App\Models\Professor;


class HomeController extends Controller
{
    public function welcome()
    {
      return view('welcome');
    }

    public function authentication()
    {
      return view('authentication');
    }

    public function studentHome()
    {
      $user = Auth::user();
      $user_filiere = $user->filiere_id;
      $modules = Module::where('filiere_id', $user_filiere)->get();

      return view('studentHome', [
        "modules" => $modules,
      ]);
    }

    public function profHome()
    {
      $prof = Auth::guard('professor')->user()->id;
      $modules = Module::where('professor_id', $prof)->get();
      return view('profHome', [
        "modules" => $modules
      ]);
    }
}
