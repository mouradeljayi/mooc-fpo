@extends('layouts.app')

@section('content')

<h1 class="text-center text-3xl mt-28 tracking-wide font-bold uppercase"><i class="fas fa-comments"></i> Forum</h1>
<p class="text-center text-lg">Toutes les discussions</p>
<section class="container mx-auto px-6 md:px-12 mt-5 mb-10">
<div class="flex justify-end">
  <a href="{{ route('discussions.create') }}" class="flex justify-end focus:outline-none text-white bg-green-500 text-lg  p-2 hover:bg-green-700">Ajoutez une discussion</a>
</div>
@forelse($discussions as $discussion)
<a href="{{ route('discussions.show', $discussion) }}">
  <div class="mt-5 bg-white border-t-4 border-green-500 rounded-b text-gray-900 px-4 py-3 shadow-md hover:bg-gray-500 hover:text-white">
  <div class="flex flex-col md:flex-row items-start">
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
      <p class="font-bold">{{ $discussion->title }}</p>
      <p class="text-sm md:text-base">{{ $discussion->content }}</p>
    </div>
  </div>
</div>
</a>
@empty
<div class="mt-5 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
  <span class="block sm:inline">Aucune discussion pour le moment.</span>
</div>
@endforelse

<div class="mt-5">
  {{ $discussions->links() }}
</div>
</section>



@if(Session::has('success'))
  <div x-data="{ open: true }">
    <div x-show="open" class="w-3/4 md:w-1/4 flex justify-center items-center fixed bottom-5 right-5 h-16 z-20 rounded py-8 shadow-lg bg-green-500 text-white">
      {{ session('success') }}
      <span @click="open = false" class="fas fa-times absolute top-0 right-0 mr-1 mt-1 cursor-pointer"></span>
    </div>
  </div>
@endif







@endsection
