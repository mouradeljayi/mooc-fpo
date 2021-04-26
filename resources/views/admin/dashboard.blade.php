@extends('layouts.app')

@section('content')
<section class="container mx-auto mt-32">
  <div class="text-center tracking-wide">
    <h1 class="text-gray-600 font-bold text-5xl">BIENVENUE DANS L'ESPACE ADMIN</h1>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-20 mb-10">

    <div class="p-4 mb-4 m-4 md:m-0 rounded shadow bg-white text-gray-600 hover:bg-gray-200 hover:shadow-lg hover:transition duration-300 ease-in-out">
      <div class="flex flex-col justify-center items-center">
        <i class="fas fa-user-graduate fa-5x text-green-500"></i>
        <span class="text-3xl mt-4 font-bold">Etudiants</span>
        <span class="text-5xl mt-2 font-bold">{{ $users->count() }}</span>
      </div>
    </div>

    <div class="p-4 mb-4 m-4 md:m-0 rounded shadow bg-white text-gray-600 hover:bg-gray-200 hover:shadow-lg hover:transition duration-300 ease-in-out">
      <div class="flex flex-col justify-center items-center">
        <i class="fas fa-user-tie fa-5x text-green-500"></i>
        <span class="text-3xl mt-4 font-bold">Professeurs</span>
        <span class="text-5xl mt-2 font-bold">{{ $profs->count() }}</span>
      </div>
    </div>

    <div class="p-4 mb-4 m-4 md:m-0 rounded shadow bg-white text-gray-600 hover:bg-gray-200 hover:shadow-lg hover:transition duration-300 ease-in-out">
      <div class="flex flex-col justify-center items-center">
        <i class="fas fa-paperclip fa-5x text-green-500"></i>
        <span class="text-3xl mt-4 font-bold">Filières</span>
        <span class="text-5xl mt-2 font-bold">{{ $filieres->count() }}</span>
      </div>
    </div>

    <div class="p-4 mb-4 m-4 md:m-0 rounded shadow bg-white text-gray-600 hover:bg-gray-200 hover:shadow-lg hover:transition duration-300 ease-in-out">
      <div class="flex flex-col justify-center items-center">
        <i class="fas fa-stream fa-5x text-green-500"></i>
        <span class="text-3xl mt-4 font-bold">Modules</span>
        <span class="text-5xl mt-2 font-bold">{{ $modules->count() }}</span>
      </div>
    </div>

  </div>
</section>


@endsection
