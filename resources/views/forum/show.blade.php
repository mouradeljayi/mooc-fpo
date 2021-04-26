@extends('layouts.app')

@section('content')

<div  x-data="{ open: false }" class="mt-28 mr-5 md:mr-4">
  <div class="flex justify-end ">
    <button @click="open = true" class="flex justify-end focus:outline-none text-white bg-blue-500 text-lg p-2  hover:bg-blue-700">Répondre à la discussion</button>
  </div>
  <form x-show="open" @click.away="open = false" class="container mx-auto px-2 ml-4 md:px-0 mt-2" action="{{ route('replies.store', $discussion) }}" method="POST">
    @csrf
    <textarea type="text" name="content" rows="8" value="{{ old('content') }}" class="rounded text-lg shadow border border-gray-400 w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 @error('content') border-2 border-red-500 @enderror" placeholder="Ecrivez le contenu de votre réponse"></textarea>
    <button type="submit" class="text-sm focus:outline-none text-white bg-green-500 p-2 hover:bg-green-700">Répondre</button>
  </form>
</div>

<div class="container mx-auto px-5 md:px-0">
  <div class="mt-3 mb-8 bg-white border-t-8 border-green-500 rounded-b text-gray-900 px-4 py-3 shadow-md">
  <div class="flex flex-col md:flex-row items-center">
    @if($discussion->professor_id)
    <div class="py-1 flex items-center w-full md:w-1/5">
      <img src="{{ asset('/files/avatars/' . $discussion->professor->avatar) }}" class="rounded-full w-10 h-10">
      <div class="ml-2">
        <span>{{ $discussion->professor->name }} <span class="rounded-full bg-blue-600 px-1 text-white text-sm">P</span> </span>
        <br>
        <span class="text-sm">{{ $discussion->created_at->diffForHumans() }}</span>
      </div>
    </div>
    @else
    <div class="py-1 flex items-center w-full md:w-1/5">
      <img src="{{ asset('/files/avatars/' . $discussion->user->avatar) }}" class="rounded-full w-10 h-10">
      <div class="ml-2">
        <span>{{ $discussion->user->name }}</span>
        <br>
        <span class="text-sm">{{ $discussion->created_at->diffForHumans() }}</span>
      </div>
    </div>
    @endif
    <div class="border-l border-gray-500 pl-4 mt-4 md:mt-0 ml-4 w-auto md:w-full">
      <div class="mb-4 flex flex-col md:flex-row">
        <div>
          <p class="font-bold text-2xl">{{ $discussion->title }}</p>
        </div>
        @if($discussion->user_id === Auth::id())
        <div class="flex items-center ml-0 mt-4 md:ml-5 md:mt-0">
          <a href="{{ route('discussions.edit', $discussion) }}" class="text-sm rounded bg-yellow-500 text-white p-1">Modifier</a>
          <div x-data="{ open: false }"class="ml-2">
            <button class="text-sm rounded bg-red-500 text-white p-1 focus:outline-none" @click="open = true">Supprimer</button>
            <!-- Dialog (full screen) -->
            <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
              <!-- A basic modal dialog with title, body and one button to close -->
              <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-2xl font-medium text-gray-900">
                    Supprission d'une discussion
                  </h3>

                  <div class="mt-2">
                    <p class="text-gray-800">
                      Etes-vous sûr de vouloir supprimer définitivement cette discussion ?
                    </p>
                </div>
              </div>

                <!-- One big close button.  --->
                <div class="mt-5 sm:mt-6">
                  <span class="flex justify-start">
                    <form action="{{ route('discussions.destroy', $discussion) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" name="button" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-red-600 border border-red-600 hover:bg-white hover:text-red-600">Supprimer</button>
                    </form>
                    <button @click="open = false" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-green-600 border border-green-600 hover:bg-white hover:text-green-600">
                      Fermer
                    </button>
                  </span>
                </div>

              </div>
            </div>
            <!--end modal-->
          </div>
        </div>
        @endif

      </div>
      <p class="text-xl tracking-wide	">{{ $discussion->content }}</p>
    </div>
  </div>
  </div>
</div>

<div class="container mx-auto px-5 mb-10">
  @foreach($discussion->replies as $reply)
  <div class="mt-3 mb-8 bg-white border-t-4 border-blue-500 rounded-b text-gray-900 px-4 py-3 shadow-md">
  <div class="flex flex-col md:flex-row items-center">
    @if($reply->professor_id)
    <div class="py-1 flex items-center w-full md:w-1/5">
      <img src="{{ asset('/files/avatars/' . $reply->professor->avatar) }}" class="rounded-full w-10 h-10">
      <div class="ml-2">
        <span>{{ $reply->professor->name }} <span class="rounded-full bg-blue-600 px-1 text-white text-sm">P</span> </span>
        <br>
        <span class="text-sm">{{ $reply->created_at->diffForHumans() }}</span>
      </div>
    </div>
    @else
    <div class="py-1 flex items-center w-full md:w-1/5">
      <img src="{{ asset('/files/avatars/' . $reply->user->avatar) }}" class="rounded-full w-10 h-10">
      <div class="ml-2">
        <span>{{ $reply->user->name }}</span>
        <br>
        <span class="text-sm">{{ $reply->created_at->diffForHumans() }}</span>
      </div>
    </div>
    @endif
    <div class="border-l border-gray-500 pl-4 mt-4 md:mt-0 ml-4 w-auto md:w-full">
      <p class="text-xl tracking-wide	">{{ $reply->content }}</p>
    </div>
  </div>
  </div>
  @endforeach
</div>

@if(Session::has('success'))
  <div x-data="{ open: true }">
    <div x-show="open" class="w-3/4 md:w-1/4 flex justify-center items-center fixed bottom-5 right-5 h-16 z-20 rounded py-8 shadow-lg bg-green-500 text-white">
      {{ session('success') }}
      <span @click="open = false" class="fas fa-times absolute top-0 right-0 mr-1 mt-1 cursor-pointer"></span>
    </div>
  </div>
@endif

@endsection
