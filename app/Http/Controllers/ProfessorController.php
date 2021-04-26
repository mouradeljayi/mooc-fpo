<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:professor')->only(['notifications', 'profile', 'updateProfile']);
      $this->middleware('auth:admin')->only(['store', 'edit', 'update', 'destory']);
    }

    public function notifications()
    {
      Auth::guard('professor')->user()->unreadNotifications->markAsRead();
      return view('profs.notifications',
      ['notifications' => Auth::guard('professor')->user()->notifications()->paginate(10)
      ]);
    }

    public function profile()
    {
      return view('profs.profile', [
        'prof' => Auth::guard('professor')->user(),
      ]);
    }

    public function updateProfile(Request $request)
    {
      $prof = Professor::find(Auth::guard('professor')->user()->id);

      $validated = $request->validate([
        'name' => 'required|unique:professors,name,' . $prof->id,
        'email' => 'required|unique:professors,email,' . $prof->id
      ]);

      if($request->old_pass)
      {
        if(Hash::check($request->old_pass, $prof->password))
        {
          $prof->password = Hash::make($request->new_pass);
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
          if($prof->avatar !== "default.jpg")
          {
            unlink(public_path('files/avatars/' . $prof->avatar));
          }
          $file = $request->avatar;
          $fileName = $file->getClientOriginalName();
          $file->move(public_path('files/avatars'), $fileName);
          $prof->avatar = $fileName;
        }
        else
        {
          return back()->with('error', 'vous ne pouvez pas utiliser ce type de fichiers');
        }

      }

      $prof->name = $request->name;
      $prof->email = $request->email;

      $prof->save();

      return back()->with('success', 'Profile modifié avec succés.');
    }



    public function store(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:professors',
        'email' => 'required|unique:professors',
        'password' => 'required|confirmed',
        ]);

        Professor::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'un nouveau professeur a été crée avec succés');
    }


    public function edit(Professor $professor)
    {
        return view('profs.edit', compact('professor'));
    }


    public function update(Request $request, Professor $professor)
    {
      $validated = $request->validate([
        'name' => 'required|unique:professors,name,' . $professor->id,
        'email' => 'required|unique:professors,email,' . $professor->id,
      ]);

      if($request->password)
      {
        if($request->password === $request->password_confirmation)
        {
          $professor->password = Hash::make($request->password);
        }
        else
        {
          return back()->withErrors([
            'password' => 'La confirmation du mot de passe ne correspond pas'
          ]);
        }
      }

      $professor->name = $request->name;
      $professor->email = $request->email;
      $professor->save();

      return redirect()->route('admin.profs')
                       ->with('success', 'Le profil de ' . $professor->name . ' a été bien modifié');
    }


    public function destroy(Professor $professor)
    {
      if($professor->avatar !== "default.jpg")
      {
        unlink(public_path('files/avatars/' . $professor->avatar));
      }
      foreach ($professor->discussions as $discussion) {
        $discussion->delete();
      }
      foreach ($professor->modules as $module) {
        foreach ($module->exams as $exam) {
          unlink(public_path('files/exams/' . $exam->file));
          $exam->delete();
        }
        foreach ($module->chapters as $chapter) {
          unlink(public_path('files/chapters/' . $chapter->file));
          $chapter->delete();
        }
        foreach ($module->works as $work) {
          unlink(public_path('files/works/' . $work->file));
          $work->delete();
        }
        $module->delete();
      }
      $professor->delete();

      return back()->with('success', 'Le profil de ' . $professor->name . ' a été bien supprimé');
    }
}
