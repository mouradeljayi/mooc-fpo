<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Module;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:professor');
    }


    public function store(Request $request)
    {
      $validated = $request->validate([
      'title' => 'required|unique:works',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf',
      ]);

      if($request->hasFile('file'))
      {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/works'), $fileName);
        Work::create([
          'title' => $request->title,
          'module_id' => $request->module_id,
          'file' => $fileName
        ]);
      }

      return back()->with('success', 'Un TD/TP a été ajouté avec succés !');
    }

    

    public function edit(Work $work)
    {
        return view('works.edit', ['work' => $work]);
    }


    public function update(Request $request, Work $work)
    {
      $validated = $request->validate([
      'title' => 'required',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf',
      ]);

      if($request->hasFile('file'))
      {
        unlink(public_path('files/works/' . $work->file));
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/works'), $fileName);
        $work->file = $fileName;

      }
      $work->update([
        'title' => $request->title,
        'module_id' => $request->module_id,
        'file' => $work->file
      ]);
      $module = Module::where('id', $request->module_id)->first();
      return redirect('/modules/' . $module->slug)->with('success', 'Un TD/TP a été modifié avec succés !');
    }


    public function destroy(Work $work)
    {
      unlink(public_path('files/works/' . $work->file));
      $work->delete();
      return back()->with('success', 'Un TD/TP a été supprimé avec succés !');
    }
}
