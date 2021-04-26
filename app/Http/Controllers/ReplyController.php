<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
      $this->middleware('CanAccess');
    }


    public function store(Request $request, Discussion $discussion)
    {
      $validated = $request->validate([
        'content' => 'required',
      ]);

      $reply = new Reply();
      $reply->discussion_id = $discussion->id;
      $reply->content = $request->content;

      if(Auth::guard('professor')->check())
      {
        $reply->professor_id = Auth::guard('professor')->id();
      }
      else
      {
        $reply->user_id = Auth::id();
      }

      $reply->save();

      return back()->with('success', 'Votre réponse a été ajoutée avec succés');
    }


    public function edit(Reply $reply)
    {

    }

    public function update(Request $request, Reply $reply)
    {
        //
    }

    public function destroy(Reply $reply)
    {
        //
    }
}
