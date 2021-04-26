<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function __construct()
    {
      $this->middleware(['CanAccess']);
    }

    public function index()
    {
        $discussions = Discussion::latest()->simplePaginate(10);
        return view('forum.discussions', ['discussions' => $discussions]);
    }

    
    public function create()
    {
        return view('forum.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
          'title' => 'required|unique:discussions',
          'content' => 'required'
        ]);

        $discussion = new Discussion();
        $discussion->title = $request->title;
        $discussion->slug = Str::slug($discussion->title);
        $discussion->content = $request->content;

        if(Auth::guard('professor')->check())
        {
          $discussion->professor_id = Auth::guard('professor')->id();
        }
        else
        {
          $discussion->user_id = Auth::id();
        }

        $discussion->save();

        return redirect()->route('discussions.index')->with('success', 'Votre discussion a été ajoutée avec succés');
    }


    public function show(Discussion $discussion)
    {
        return view('forum.show', [
          'discussion' => $discussion
        ]);
    }


    public function edit(Discussion $discussion)
    {
        return view('forum.edit', ['discussion' => $discussion]);
    }


    public function update(Request $request, Discussion $discussion)
    {
      $validated = $request->validate([
        'title' => 'required|unique:discussions',
        'content' => 'required'
      ]);

      $discussion->title = $request->title;
      $discussion->slug = Str::slug($discussion->title);
      $discussion->content = $request->content;

      if(Auth::guard('professor')->check())
      {
        $discussion->professor_id = Auth::guard('professor')->id();
      }
      else
      {
        $discussion->user_id = Auth::id();
      }

      $discussion->save();

      return redirect()->route('discussions.show', $discussion->slug)->with('success', 'Votre discussion a été modifiée avec succés');
    }


    public function destroy(Discussion $discussion)
    {
        $discussion->replies()->delete();
        $discussion->delete();
        return redirect()->route('discussions.index')->with('success', 'Votre discussion a été supprimée avec succés');
    }
}
