@extends('layouts.app')

@section('content')

<section class="container mx-auto p-8 mt-28 bg-white rounded shadow flex justify-center">
  <div class="w-auto md:w-3/5">
    <div class="bg-green-500 text-white rounded-t px-4 py-2">
       <i class="fas fa-bell"></i> Notifications
    </div>
    <div class="border border-t-0 border-green-400 rounded-b  px-4 py-3 text-red-700 ">
      @forelse($notifications as $notification)
      <div class="mb-2 px-3 py-2 bg-blue-100 border rounded border-blue-500 text-blue-700 hover:bg-blue-500 hover:text-white hover:shadow flex justify-between">
        <a href="{{ route('modules.show', $notification->data['module']['slug']) }}">Un nouveau devoir à été ajouté au module : <strong>{{ $notification->data['module']['name'] }}</strong> </a>
        <span class="border-l border-blue-500 pl-2">{{ $notification->created_at->diffForHumans() }}</span>
      </div>
      @empty
      <div class="mb-2 px-3 py-2 bg-blue-100 border rounded border-blue-500 text-blue-700">
        Vous n'avez aucune Notification pour le moment
      </div>
      @endforelse
    </div>
  </div>
</section>


@endsection
