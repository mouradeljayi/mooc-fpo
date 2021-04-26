@extends('layouts.app')

@section('content')

<div class="p-8 mb-4 rounded shadow bg-white text-gray-600 flex flex-col md:flex-row justify-center">
  @if($reponses->count() > 0)
  <table class="table-auto">
    <thead>
      <tr>
        <th class="px-4 py-2 text-gray-600">Nom d'Etudiant</th>
        <th class="px-4 py-2 text-gray-600">Fichier de reponse</th>
        <th class="px-4 py-2 text-gray-600">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($reponses as $reponse)
      <tr>
        <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> {{ $reponse->user->name }} </td>
        <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"><a href="{{ asset('files/reponses/' . $reponse->file) }}" target="_blank" class="hover:text-red-600"><i class="fas fa-file-pdf text-red-600"></i></a></td>
        <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
          <div class="flex justify-center">
            <div x-data="{ open: false }">
              <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
              <!-- Dialog (full screen) -->
              <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                <!-- A basic modal dialog with title, body and one button to close -->
                <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-2xl font-medium text-gray-900">
                      Supprission d'une reponse
                    </h3>

                    <div class="mt-2">
                      <p class="text-gray-800">
                        Etes-vous sûr de vouloir supprimer cette reponse ?
                      </p>
                  </div>
                </div>

                  <!-- One big close button.  --->
                  <div class="mt-5 sm:mt-6">
                    <span class="flex justify-start">
                      <form action="{{ route('exams.destroy', $exam) }}" method="POST">
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
  @else
  <div class="w-full h-auto mt-4 md:mt-0 md:h-14 md:w-1/2 ml-0 md:ml-2 text-center bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 relative mb-3 text-center" role="alert">
    Aucun Devoir n'a encore été ajouté
  </div>
  @endif
</div>

@endsection
