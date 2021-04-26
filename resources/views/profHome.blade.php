@extends('layouts.app')

@section('content')
<h1 class="text-center text-3xl mt-28 tracking-wide font-bold"><i class="fas fa-stream"></i> MES MODULES</h1>
<section class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 mt-10 mb-10">

  @foreach($modules as $module)
  <a href="{{ route('modules.show', $module) }}">
    <div class="p-4 mb-4 m-4 md:m-0 rounded shadow bg-white text-gray-600 hover:bg-gray-200 hover:shadow-lg hover:transition duration-300 ease-in-out">
      <h2 class="text-green-500 font-bold text-xl text-center">{{ $module->name }}</h2>
      <div class="flex justify-between mt-4">
        <span class="font-bold">Filière :</span>
        <span class="rounded-full bg-blue-500 text-white font-bold px-2">{{ $module->filiere->name }}</span>
      </div>
      <div class="flex justify-between mt-4">
        <span class="font-bold">Nombre de Chapitres:</span>
        <span class="rounded-full bg-blue-500 text-white font-bold px-2">{{ $module->chapters->count() }}</span>
      </div>
      <div class="flex justify-between mt-4">
        <span class="font-bold">Nombre des TD/TPs :</span>
        <span class="rounded-full bg-blue-500 text-white font-bold px-2">{{ $module->works->count() }}</span>
      </div>
      <div class="flex justify-between mt-4">
        <span class="font-bold">Nombre de Devoirs :</span>
        <span class="rounded-full bg-blue-500 text-white font-bold px-2">{{ $module->exams->count() }}</span>
      </div>
      <div class="flex justify-between mt-4">
        <span class="font-bold">Nombre des Etudiants :</span>
        <span class="rounded-full bg-blue-500 text-white font-bold px-2">{{ $module->filiere->users->count() }}</span>
      </div>
    </div>
  </a>
  @endforeach

</section>



@endsection
