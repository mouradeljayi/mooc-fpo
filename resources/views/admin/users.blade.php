@extends('layouts.app')

@section('content')

<section class="container mx-auto mt-28 px-4 mb-10">
  <div class="flex flex-col md:flex-row justify-between">
    <a href="{{ route('admin.users') }}"><h1 class="text-3xl font-semibold text-green-500"><i class="fas fa-user-graduate"></i> LES ETUDIANTS</h1></a>
    <form class="w-full max-w-md" action="{{ route('users.search') }}" method="GET">
      @csrf
      <div class="flex items-center mt-4 md:mt-0">
        <input name="search" class="rounded bg-white w-full border text-gray-700 mr-3 py-2 px-2 focus:border-gray-500 focus:outline-none" type="text" placeholder="Tapez le nom ou le prénom">
        <button type="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 uppercase hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
          <i class="fas fa-search"></i> Rechercher Etudiant
        </button>
      </div>
    </form>
  </div>
  <div class="grid md:grid-cols-2 mt-10 gap-4">

    <div>
      <table class="table-auto">
        <thead>
          <tr >
            <th class="px-4 py-2 text-gray-600">Photo</th>
            <th class="px-4 py-2 text-gray-600">Nom et Prénom</th>
            <th class="px-4 py-2 text-gray-600">Adresse E-mail</th>
            <th class="px-4 py-2 text-gray-600">Filiere</th>
            <th class="px-4 py-2 text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> <img src="{{ asset('files/avatars/' . $user->avatar) }}" alt="photo de profile" class="rounded w-12 h-12"> </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $user->name }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $user->email }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $user->filiere->name }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
              <div class="flex justify-center">
                <div>
                  <a href="{{ route('users.edit', $user) }}" class="hover:text-yellow-600"> <i class="fas fa-edit fa-lg mr-2"></i> </a>
                </div>
                <div x-data="{ open: false }">
                  <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
                  <!-- Dialog (full screen) -->
                  <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                    <!-- A basic modal dialog with title, body and one button to close -->
                    <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-2xl font-medium text-gray-900">
                          Supprission d'un étudiant
                        </h3>

                        <div class="mt-2">
                          <p class="text-gray-800">
                            Etes-vous sûr de vouloir supprimer cet étudiant ?
                          </p>
                      </div>
                    </div>

                      <!-- One big close button.  --->
                      <div class="mt-5 sm:mt-6">
                        <span class="flex justify-start">
                          <form action="{{ route('users.destroy', $user) }}" method="post">
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
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-5">
        {{ $users->links() }}
      </div>

    </div>

    <div class="mt-6 md:mt-0">
      <h1 class="uppercase text-blue-700 font-bold">Ajouter un nouveau etudiant</h1>
      <div class="flex items-center flex-col md:flex-row bg-white rounded shadow p-8 mt-4">
        <form class="w-full max-w-lg" action="{{ route('users.create') }}" method="POST">
          @csrf
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                Nom et prenom
              </label>
              <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') border-2 border-red-500 @enderror" type="text" placeholder="Tapez le nom et le prénom">
              @error('name')
              <p class="text-red-500 text-xs">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                Adresse E-mail
              </label>
              <input name="email" class="appearance-none block w-full bg-gray-200 mb-2 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('email') border-2 border-red-500 @enderror" type="text" placeholder="Tapez l'adresse e-mail">
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
                <option value="{{ $filiere->id }}">{{ $filiere->name }}</option>
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
                Mot de passe
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

          <button type="submit" class="p-2 uppercase px-2 text-white bg-blue-500 hover:bg-blue-800 rounded font-medium focus:outline-none" name="button">Ajouter Etudiant</button>
        </form>
      </div>
    </div>
  </div>
</section>

@if(Session::has('success'))
  <div x-data="{ open: true }">
    <div x-show="open" class="w-3/4 md:w-1/4 flex justify-center items-center fixed bottom-5 right-5 h-16 z-20 rounded p-8 shadow-lg bg-green-500 text-white">
      {{ session('success') }}
      <span @click="open = false" class="fas fa-times absolute top-0 right-0 mr-1 mt-1 cursor-pointer"></span>
    </div>
  </div>
@endif



@endsection
