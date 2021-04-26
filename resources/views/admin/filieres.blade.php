@extends('layouts.app')

@section('content')

<section class="container mx-auto mt-28 px-4 mb-10">
  <div class="flex flex-col md:flex-row justify-between">
    <a href="{{ route('admin.filieres') }}"><h1 class="text-3xl font-semibold text-green-500"><i class="fas fa-paperclip"></i> LES FILIERES</h1></a>
    <form class="w-full max-w-md" action="{{ route('filieres.search') }}" method="GET">
      @csrf
      <div class="flex items-center mt-4 md:mt-0">
        <input name="search" class="rounded bg-white w-full border text-gray-700 mr-3 py-2 px-2 focus:border-gray-500 focus:outline-none" type="text" placeholder="Tapez le nom du filiere">
        <button type="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 uppercase hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
          <i class="fas fa-search"></i> Rechercher Filière
        </button>
      </div>
    </form>
  </div>
  <div class="grid md:grid-cols-2 mt-10 gap-4">

    <div>
      <table class="table-auto">
        <thead>
          <tr >
            <th class="px-4 py-2 text-gray-600">Nom</th>
            <th class="px-4 py-2 text-gray-600">Etudiants</th>
            <th class="px-4 py-2 text-gray-600">Modules</th>
            <th class="px-4 py-2 text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($filieres as $filiere)
          <tr>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $filiere->name }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $filiere->users->count() }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $filiere->modules->count() }} </td>
            <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
              <div class="flex justify-center">
                <div>
                  <a href="{{ route('filieres.edit', $filiere) }}" class="hover:text-yellow-600"> <i class="fas fa-edit fa-lg mr-2"></i> </a>
                </div>
                <div x-data="{ open: false }">
                  <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
                  <!-- Dialog (full screen) -->
                  <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                    <!-- A basic modal dialog with title, body and one button to close -->
                    <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-2xl font-medium text-gray-900">
                          Supprission d'une filière
                        </h3>

                        <div class="mt-2">
                          <p class="text-gray-800">
                            Attention ! Si vous supprimez cette filière,
                            tous les utilisateurs, les professeurs et les modules qui y sont liées seront supprimés.
                          </p>
                      </div>
                    </div>

                      <!-- One big close button.  --->
                      <div class="mt-5 sm:mt-6">
                        <span class="flex justify-start">
                          <form action="{{ route('filieres.destroy', $filiere) }}" method="post">
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
        {{ $filieres->links() }}
      </div>

    </div>

    <div class="mt-6 md:mt-0">
      <h1 class="uppercase text-blue-700 font-bold">Ajouter une nouvelle filière</h1>
      <div class="flex items-center flex-col md:flex-row bg-white rounded shadow p-8 mt-4">
        <form class="w-full max-w-lg" action="{{ route('filieres.store') }}" method="POST">
          @csrf


          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 relative">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Nom de la Filière
              </label>
              <input name="name" class="appearance-none block w-full bg-gray-200 mb-2 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') border-2 border-red-500 @enderror" type="text" placeholder="Tapez le nom de la filière">
              @error('name')
              <p class="text-red-500 text-xs">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <button type="submit" class="p-2 uppercase px-2 text-white bg-blue-500 hover:bg-blue-800 rounded font-medium focus:outline-none" name="button">Ajouter Filière</button>
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
