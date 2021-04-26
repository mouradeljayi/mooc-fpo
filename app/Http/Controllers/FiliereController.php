<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;

class FiliereController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }


    public function store(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:filieres',
        ]);

        Filiere::create([
        'name' => $request->name,
        ]);

        return back()->with('success', 'une nouvelle filière a été crée avec succés');
    }


    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));
    }


    public function update(Request $request, Filiere $filiere)
    {
      $validated = $request->validate([
        'name' => 'required|unique:filieres,name,' . $filiere->id,
      ]);

      $filiere->update([
        'name' => $request->name
      ]);

      return redirect()->route('admin.filieres') ->with('success', 'La filiere a été bien modifiée');
    }


    public function destroy(Filiere $filiere)
    {
        foreach($filiere->users as $user)
        {
          if($user->avatar !== "default.jpg")
          {
            unlink(public_path('files/avatars/' . $user->avatar));
          }
          $user->delete();
        }


        foreach($filiere->modules as $module)
        {
          if($module->professor->avatar !== "default.jpg")
          {
            unlink(public_path('files/avatars/' . $module->professor->avatar));
          }
          $module->professor->delete();
          $module->delete();
        }

        $filiere->delete();

        return back()->with('success', 'La filière a été bien supprimée');
    }
}
