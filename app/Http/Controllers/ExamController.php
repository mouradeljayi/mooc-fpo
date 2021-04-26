<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Reponse;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Notifications\ExamAdded;
use Illuminate\Support\Facades\Notification;

class ExamController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:professor');
    }


    public function store(Request $request, Module $module)
    {
      $validated = $request->validate([
      'title' => 'required',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf|unique:exams',
      'delivery_date' => 'required'
      ]);

      if($request->hasFile('file'))
      {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/exams'), $fileName);

        $exam = new Exam();
        $exam->title = $request->title;
        $exam->module_id = $request->module_id;
        $exam->file = $fileName;
        $exam->delivery_date = $request->delivery_date;
        $exam->save();
      }
      $moduleFiliere_id = Module::pluck('filiere_id');

      $users = User::where('filiere_id', $moduleFiliere_id)->get();

      Notification::send($users, new ExamAdded($exam->module));

      return back()->with('success', 'Un devoir a été ajouté avec succés !');
    }


    public function show(Exam $exam)
    {
      $reponses = $exam->reponses;
      return view('exams.show', [
        'reponses' => $reponses,
        'exam' => $exam
      ]);
    }

    
    public function edit(Exam $exam)
    {
        return view('exams.edit', ['exam' => $exam]);
    }


    public function update(Request $request, Exam $exam)
    {
      $validated = $request->validate([
      'title' => 'required',
      'module_id' => 'required',
      'file' => 'file|mimes:pdf',
      'delivery_date' => 'required'
      ]);

      if($request->hasFile('file'))
      {
        unlink(public_path('files/exams/' . $exam->file));
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/exams'), $fileName);
        $exam->file = $fileName;

      }
      $exam->update([
        'title' => $request->title,
        'module_id' => $request->module_id,
        'file' => $exam->file,
        'delivery_date' => $request->delivery_date
      ]);
      $module = Module::where('id', $request->module_id)->first();
      return redirect('/modules/' . $module->slug)->with('success', 'Un devoir a été modifié avec succés !');
    }


    public function destroy(Exam $exam)
    {
      foreach($exam->reponses as $reponse)
      {
        unlink(public_path('files/reponses/' . $reponse->file));
      }
      unlink(public_path('files/exams/' . $exam->file));
      $exam->reponses()->delete();
      $exam->delete();
      return back()->with('success', 'Un devoir a été supprimé avec succés !');
    }
}
