<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filiere;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->only(['notifications', 'profile', 'updateProfile']);
      $this->middleware('auth:admin')->only(['create', 'edit', 'update', 'destroy']);
    }

    public function create(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|unique:users',
        'filiere_id' => 'required',
        'password' => 'required|confirmed',
        ]);

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'filiere_id' => $request->filiere_id,
        'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'un nouveau etudiant a été crée avec succés');
    }

    public function edit(User $user)
    {
      $filieres = Filiere::all();
      return view('users.edit', compact('user'))->with(['filieres' => $filieres]);
    }

    public function update(Request $request, User $user)
    {
      $validated = $request->validate([
        'name' => 'required|unique:users,name,' . $user->id,
        'email' => 'required|unique:users,email,' . $user->id,
        'filiere_id' => 'required'
      ]);

      if($request->password)
      {
        if($request->password === $request->password_confirmation)
        {
          $user->password = Hash::make($request->password);
        }
        else
        {
          return back()->withErrors([
            'password' => 'La confirmation du mot de passe ne correspond pas'
          ]);
        }
      }

      $user->name = $request->name;
      $user->email = $request->email;
      $user->filiere_id = $request->filiere_id;
      $user->save();

      return redirect()->route('admin.users')
                       ->with('success', 'Le profil de ' . $user->name . ' a été bien modifié');
    }

    public function destroy(User $user)
    {
      if($user->avatar !== "default.jpg")
      {
        unlink(public_path('files/avatars/' . $user->avatar));
      }
      foreach ($user->discussions as $discussion) {
        $discussion->delete();
      }
      foreach ($user->reponses as $reponse) {
        $reponse->delete();
      }
      $user->delete();

      return back()->with('success', 'Le profil de ' . $user->name . ' a été bien supprimé');
    }

    public function notifications()
    {
      auth()->user()->unreadNotifications->markAsRead();
      return view('users.notifications',
      ['notifications' => auth()->user()->notifications()->paginate(10)
      ]);
    }

    public function profile()
    {
      return view('users.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
      $user = User::find(Auth::id());

      $validated = $request->validate([
        'name' => 'required|unique:users,name,' . $user->id,
        'email' => 'required|unique:users,email,' . $user->id
      ]);

      if($request->old_pass)
      {
        if(Hash::check($request->old_pass, $user->password))
        {
          $user->password = Hash::make($request->new_pass);
        }
        else
        {
          return back()->withErrors([
              'old_pass' => 'Ancien mot de passe incorrect !',
          ]);
        }
      }

      if($request->avatar)
      {
        if($request->avatar->extension() === "jpg" || $request->avatar->extension() === "png")
        {
          if($user->avatar !== "default.jpg")
          {
            unlink(public_path('files/avatars/' . $user->avatar));
          }
          $file = $request->avatar;
          $fileName = $file->getClientOriginalName();
          $file->move(public_path('files/avatars'), $fileName);
          $user->avatar = $fileName;
        }
        else
        {
          return back()->with('error', 'vous ne pouvez pas utiliser ce type de fichiers');
        }

      }

      $user->name = $request->name;
      $user->email = $request->email;

      $user->save();

      return back()->with('success', 'Profile modifié avec succés.');
    }
}
