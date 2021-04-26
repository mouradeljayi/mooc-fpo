@extends('layouts.app')


@section('content')

<section class="container mx-auto mt-28 px-4 mb-10">
  <h1 class="uppercase text-blue-700 font-bold">Modifier les informations de la filière : {{ $filiere->name }}</h1>
  <div class="flex items-center justify-center flex-col md:flex-row bg-white rounded shadow p-8 mt-4">
    <form class="w-full max-w-lg" action="{{ route('filieres.update', $filiere) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 relative">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Nom de la filière
          </label>
          <input name="name" class="appearance-none block w-full bg-gray-200 mb-2 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') border-2 border-red-500 @enderror" type="text" value="{{ $filiere->name }}">
          @error('name')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <button type="submit" class="p-2 uppercase px-2 text-white bg-blue-500 hover:bg-blue-800 rounded font-medium focus:outline-none" name="button">Modifier Filière</button>
    </form>
  </div>

</section>

@endsection
