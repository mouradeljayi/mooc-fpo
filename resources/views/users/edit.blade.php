@extends('layouts.app')


@section('content')

<section class="container mx-auto mt-28 px-4 mb-10">
  <h1 class="uppercase text-blue-700 font-bold">Modifier les informations de l'étudiant : {{ $user->name }}</h1>
  <div class="flex items-center justify-center flex-col md:flex-row bg-white rounded shadow p-8 mt-4">
    <form class="w-full max-w-lg" action="{{ route('users.update', $user) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
            Nom et prenom
          </label>
          <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') border-2 border-red-500 @enderror" type="text" value="{{ $user->name }}">
          @error('name')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
            Adresse E-mail
          </label>
          <input name="email" class="appearance-none block w-full bg-gray-200 mb-2 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('email') border-2 border-red-500 @enderror" type="text" value="{{ $user->email }}">
          @error('email')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 relative">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Filiere
          </label>
          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="filiere_id">
            @foreach($filieres as $filiere)
            <option value="{{ $filiere->id }}" @if($filiere->id === $user->filiere_id) selected @endif>{{ $filiere->name }}</option>
            @endforeach
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-4 top-5 flex items-center px-2 text-gray-700">
            <i class="fas fa-chevron-down"></i>
          </div>
          @error('filiere_id')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
            Nouveau Mot de passe
          </label>
          <input name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('password') border-2 border-red-500 @enderror" type="password" placeholder="Entrez un mot de passe">
          @error('password')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Confirmer le mot de passe
          </label>
          <input name="password_confirmation" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('password_confirmation') border-2 border-red-500 @enderror" type="password" placeholder="Confirmer le mot de passe">
          @error('password_confirmation')
          <p class="text-red-500 text-xs">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <button type="submit" class="p-2 uppercase px-2 text-white bg-blue-500 hover:bg-blue-800 rounded font-medium focus:outline-none" name="button">Modifier Etudiant</button>
    </form>
  </div>

</section>

@endsection
