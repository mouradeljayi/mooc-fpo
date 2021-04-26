<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function studentLogin(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'student_name' => 'required',
        'student_password' => 'required'
      ]);
      if($validator->fails())
      {
        return back()->withErrors($validator)->withInput();
      }
      if(Auth::attempt([
        'name' => $request->student_name,
        'password' => $request->student_password
      ]))
      {
        return redirect()->route('studentHome');
      }
      else
      {
        return back()->withErrors([
          'student_name' => "Nom d'utilisateur ou Mot de passe Incorrect !",
        ]);
      }
    }

    public function studentLogout(Request $request)
    {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/');
    }

    public function profLogin(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'prof_name' => 'required',
        'prof_password' => 'required'
      ]);
      if($validator->fails())
      {
        return back()->withErrors($validator)->withInput();
      }
      if(Auth::guard('professor')->attempt([
        'name' => $request->prof_name,
        'password' => $request->prof_password
      ]))
      {
        return redirect()->intended('profHome');
      }
      else
      {
        return back()->withErrors([
          'prof_name' => "Nom d'utilisateur ou Mot de passe Incorrect !",
        ]);
      }
    }

    public function profLogout(Request $request)
    {
      Auth::guard('professor')->logout();
      return redirect('/');
    }
}
