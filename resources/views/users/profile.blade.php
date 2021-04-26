@extends('layouts.app')

@section('content')

<section class="container mx-auto mt-28 px-8 mb-10">
  <h1 class="text-3xl font-semibold text-green-500"><i class="fas fa-user"></i> MON PROFILE</h1>
  <div class="grid md:grid-cols-2 gap-4">
    <div class="flex flex-col md:flex-row items-center bg-white rounded shadow p-8 mt-4">
      <img src="{{ asset('/files/avatars/' . $user->avatar) }}" alt="photo de profile" class="rounded-full w-60 h-60">
      <div class="border-l-4 border-gray-800 ml-6 pl-4 mt-4">
        <h4 class="text-gray-700 uppercase font-bold text-2xl">{{ $user->name }}</h1>
        <h5 class="text-gray-700 uppercase font-bold">Filière : {{ $user->filiere->name }}</h5>
        <h5 class="text-gray-700 uppercase font-bold">Modules : {{ $user->filiere->modules->count() }}</h5>
        <h5 class="text-gray-700 uppercase font-bold">Discussions : {{ $user->discussions->count() }}</h5>
        <h5 class="text-gray-700 uppercase font-bold">Réponses aux examens : {{ $user->reponses->count() }}</h5>
      </div>
    </div>
    <div class="flex items-center flex-col md:flex-row bg-white rounded shadow p-8 mt-4">
      <form class="w-full max-w-lg" action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
              Nom et prenom
            </label>
            <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" value="{{ $user->name }}">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
              Adresse E-mail
            </label>
            <input name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" value="{{ $user->email }}">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
              Ancien Mot de passe
            </label>
            <input name="old_pass" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('old_pass') border-2 border-red-500 @enderror" type="password" placeholder="Entrez le mot de passe actuel">
            @error('old_pass')
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              Nouveau mot de passe
            </label>
            <input name="new_pass" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" placeholder="Entrez le nouveau mot de passe">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Photo de profile
            </label>
            <label class="w-full flex flex-row justify-center items-center bg-gray-700 py-2 px-2 shadow text-black tracking-wide uppercase cursor-pointer mt-4 hover:shadow-lg hover:bg-gray-800">
                <i class="fas fa-cloud-upload-alt fa-lg text-white mr-2"></i>
                <span class="text-base text-white">Importer une photo </span>
                <input type="file" name="avatar" class="hidden actual-btn" />
            </label>

            @if(Session::has('error'))
            <p class="text-red-500">{{ session('error') }}</p>
            @endif

            <span class="file-chosen"></span>
          </div>
        </div>
        <button type="submit" class="p-2 uppercase px-2 text-white bg-blue-500 hover:bg-blue-800 rounded font-medium focus:outline-none" name="button">Changer mes infos</button>
      </form>
    </div>
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
