<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Professor;
use App\Models\Filiere;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function __construct()
    {
      $this->middleware(['CanAccess'])->only('show');
      $this->middleware(['CanAccess'])->except('show');
      $this->middleware(['auth:admin'])->only(['store', 'edit', 'update', 'destroy']);
    }


    public function store(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:modules',
        'professor_id' => 'required',
        'filiere_id' => 'required',
        ]);

        Module::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'professor_id' => $request->professor_id,
        'filiere_id' => $request->filiere_id,
        ]);

        return back()->with('success', 'un nouveau module a été crée avec succés');
    }


    public function show(Module $module)
    {
        return view('modules.show', [
          'module' => $module,
        ]);
    }


    public function edit(Module $module)
    {
        $filieres = Filiere::all();
        $professors = Professor::all();
        return view('modules.edit', [
          'module' => $module,
          'professors' => $professors,
          'filieres' => $filieres
        ]);
    }


    public function update(Request $request, Module $module)
    {
      $validated = $request->validate([
        'name' => 'required|unique:modules,name,' . $module->id,
        'professor_id' => 'required',
        'filiere_id' => 'required',
        ]);

        $module->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'professor_id' => $request->professor_id,
        'filiere_id' => $request->filiere_id,
        ]);

        return redirect()->route('admin.modules')
                         ->with('success', 'Le module ' . $module->name . ' a été bien modifié');
    }


    public function destroy(Module $module)
    {
        // delete module chapters
        foreach ($module->chapters as $chapter) {
          unlink(public_path('files/chapters/' . $chapter->file));
          $chapter->delete();
        }
        // delete module works
        foreach ($module->works as $work) {
          unlink(public_path('files/works/' . $work->file));
          $work->delete();
        }
        // delete module exams
        foreach ($module->exams as $exam) {
          unlink(public_path('files/exams/' . $exam->file));
          // delete module exams reponses
          foreach ($exam->reponses as $reponse) {
            unlink(public_path('files/reponses/' . $reponse->file));
            $reponse->delete();
          }
          $exam->delete();
        }

        $module->delete();

        return back()->with('success', 'le module a été bien supprimé');
    }
}
