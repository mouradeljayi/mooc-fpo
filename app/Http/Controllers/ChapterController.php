<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Module;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:professor');
    }

    public function store(Request $request)
    {
      $validated = $request->validate([
      'title' => 'required|unique:chapters',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf',
      ]);

      if($request->hasFile('file'))
      {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/chapters'), $fileName);
        Chapter::create([
          'title' => $request->title,
          'module_id' => $request->module_id,
          'file' => $fileName
        ]);
      }

      return back()->with('success', 'Un chapitre a été ajouté avec succés !');
    }


    public function edit(Chapter $chapter)
    {
        return view('chapters.edit', ['chapter' => $chapter]);
    }

    public function update(Request $request, Chapter $chapter)
    {
      $validated = $request->validate([
      'title' => 'required',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf',
      ]);

      if($request->hasFile('file'))
      {
        unlink(public_path('files/chapters/' . $chapter->file));
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/chapters'), $fileName);
        $chapter->file = $fileName;

      }
      $chapter->update([
        'title' => $request->title,
        'module_id' => $request->module_id,
        'file' => $chapter->file
      ]);
      $module = Module::where('id', $request->module_id)->first();
      return redirect('/modules/' . $module->slug)->with('success', 'Un chapitre a été modifié avec succés !');
    }


    public function destroy(Chapter $chapter)
    {
        unlink(public_path('files/chapters/' . $chapter->file));
        $chapter->delete();
        return back()->with('success', 'Un chapitre a été supprimé avec succés !');
    }
}
