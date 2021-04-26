<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReponseAdded;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->only('show');
      $this->middleware('auth:professor')->only('destroy');
    }

    public function store(Request $request)
    {
      $validated = $request->validate([
        'file' => 'required|file|mimes:pdf',
      ]);

      if($request->hasFile('file'))
      {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('files/reponses'), $fileName);

        $reponse = new Reponse();
        $reponse->user_id = Auth::id();
        $reponse->module_id = $request->module_id;
        $reponse->exam_id = $request->exam_id;
        $reponse->file = $fileName;
        $reponse->save();
      }

      $module = Module::where('id', $request->module_id)->first();
      $prof = $module->professor;

      Notification::send($prof, new ReponseAdded($reponse->exam));

      return back()->with('success', 'Votre reponse a été enregistré avec succés !');
    }


    public function destroy(Reponse $reponse)
    {
      unlink(public_path('files/reponses/' . $reponse->file));
      $reponse->delete();
      return back()->with('success', 'Une Réponse a été supprimée avec succés !');
    }
}
