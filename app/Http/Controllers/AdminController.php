<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Module;
use App\Models\Filiere;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin')->except(['loginForm', 'login']);
    }

    public function dashboard()
    {
        $modules = Module::all();
        $filieres = Filiere::all();
        $users = User::all();
        $profs = Professor::all();

        return view('admin.dashboard', [
          "modules" => $modules,
          "filieres" => $filieres,
          "users" => $users,
          "profs" => $profs
        ]);
    }

    public function users()
    {
      $users = User::paginate(10);

      if(request()->input('search'))
      {
        $users = User::where('name', 'like', '%' . request()->input('search') . '%')->paginate(10);
      }

      $filieres = Filiere::all();
      return view('admin.users', ['users' => $users, 'filieres' => $filieres]);
    }

    public function profs()
    {
      $profs = Professor::paginate(10);

      if(request()->input('search'))
      {
        $profs = Professor::where('name', 'like', '%' . request()->input('search') . '%')->paginate(10);
      }

      return view('admin.profs', ['profs' => $profs]);
    }

    public function filieres()
    {
      $filieres = Filiere::paginate(10);

      if(request()->input('search'))
      {
        $filieres = Filiere::where('name', 'like', '%' . request()->input('search') . '%')->paginate(10);
      }

      return view('admin.filieres', ['filieres' => $filieres]);
    }

    public function modules()
    {
      $modules = Module::paginate(10);
      $professors = Professor::all();
      $filieres = Filiere::all();

      if(request()->input('search'))
      {
        $modules = Module::where('name', 'like', '%' . request()->input('search') . '%')->paginate(10);
      }
      return view('admin.modules', [
        'modules' => $modules,
        'professors' => $professors,
        'filieres' => $filieres
      ]);
    }

    public function loginForm()
    {
      return view('admin.login');
    }

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'admin_email' => 'required',
        'admin_password' => 'required'
      ]);

      if($validator->fails())
      {
        return back()->withErrors($validator)->withInput();
      }
      if(Auth::guard('admin')->attempt([
        'email' => $request->admin_email,
        'password' => $request->admin_password
      ]))
      {
        return redirect()->route('admin.dashboard');
      }
      else
      {
        return back()->withErrors([
          'admin_email' => "Adresse E-mail ou Mot de passe Incorrect !",
        ]);
      }
    }

    public function logout()
    {
      Auth::guard('admin')->logout();
      return redirect()->route('admin.loginForm');
    }
}
