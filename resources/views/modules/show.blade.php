@extends('layouts.app')

@section('content')

<h1 class="text-center text-3xl mt-28 tracking-wide font-bold">{{ $module->name }}</h1>
<section class="container mx-auto px-6 md:px-12 mt-10 mb-10">
  @if(Auth::guard('professor')->check())
  <div class="flex flex-col md:flex-row justify-between mb-5">
    <div x-data="{ open: false }">
      <button class="focus:outline-none w-full text-lg border-2 border-green-500 p-2 mr-2 font-semibold text-center hover:bg-green-500 hover:text-white" @click="open = true"> <i class="fas fa-plus"></i> Ajouter un chapitre</button>
      <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
        <!-- A basic modal dialog with title, body and one button to close -->
        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">

            <h1 class="font-bold mb-4 uppercase tracking-wider">Ajouter un nouveau chapitre</h1>

          <div class="pb-3">
            <form action="{{ route('chapters.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="text" name="title" class="border border-gray-400 px-2 py-2 focus:outline-none w-full"  placeholder="Tapez le titre du chapitre">
              <input type="hidden" name="module_id" value="{{ $module->id }}">

              <label class="w-full flex flex-row justify-center items-center bg-green-400 py-2 px-2 shadow text-black tracking-wide uppercase cursor-pointer mt-4 hover:shadow-lg hover:bg-green-600">
                  <i class="fas fa-cloud-upload-alt fa-lg text-white mr-2"></i>
                  <span class="text-base text-white leading-normal">Sélectionnez un fichier PDF</span>
                  <input type="file" name="file" class="hidden actual-btn" />
              </label>

              <span class="file-chosen">Aucun fichier choisi</span>

              <div class="flex justify-start pt-8">
                <button type="submit" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-green-600 border border-green-600 hover:bg-white hover:text-green-600">Ajouter</button>
              </form>
                <button @click="open = false" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-yellow-400 border border-yellow-400 hover:bg-white hover:text-yellow-400">Fermer</button>
              </div>
          </div>

        </div>
      </div>
    </div>


    <div x-data="{ open: false }">
      <button class="focus:outline-none w-full text-lg border-2 border-green-500 mt-2 md:mt-0 p-2 mr-2 font-semibold text-center hover:bg-green-500 hover:text-white" @click="open = true"> <i class="fas fa-plus"></i> Ajouter un devoir</button>
      <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
        <!-- A basic modal dialog with title, body and one button to close -->
        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">

            <h1 class="font-bold mb-4 uppercase tracking-wider">Ajouter un nouveau Devoir</h1>

          <div class="pb-3">
            <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="text" name="title" class="border border-gray-400 px-2 py-2 focus:outline-none w-full"  placeholder="Tapez le titre du devoir">
              <div class="flex justify-center items-center">
                <label for="delivery_date">Date de remise</label>
                <input type="date" name="delivery_date" class="mt-2 ml-2 border border-gray-400 px-2 py-2 focus:outline-none">
              </div>
              <input type="hidden" name="module_id" value="{{ $module->id }}">

              <label class="w-full flex flex-row justify-center items-center bg-green-400 py-2 px-2 shadow text-black tracking-wide uppercase cursor-pointer mt-4 hover:shadow-lg hover:bg-green-600">
                  <i class="fas fa-cloud-upload-alt fa-lg text-white mr-2"></i>
                  <span class="text-base text-white leading-normal">Sélectionnez un fichier PDF</span>
                  <input type="file" name="file" class="hidden actual-btn2" />
              </label>

              <span class="file-chosen2">Aucun fichier choisi</span>

              <div class="flex justify-start pt-8">
                <button type="submit" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-green-600 border border-green-600 hover:bg-white hover:text-green-600">Ajouter</button>
              </form>
                <button @click="open = false" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-yellow-400 border border-yellow-400 hover:bg-white hover:text-yellow-400">Fermer</button>
              </div>
          </div>

        </div>
      </div>
    </div>


    <div x-data="{ open: false }">
      <button class="focus:outline-none w-full text-lg border-2 border-green-500 mt-2 md:mt-0 p-2 mr-2 font-semibold text-center hover:bg-green-500 hover:text-white" @click="open = true"> <i class="fas fa-plus"></i> Ajouter un TD/TP</button>
      <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
        <!-- A basic modal dialog with title, body and one button to close -->
        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">

            <h1 class="font-bold mb-4 uppercase tracking-wider">Ajouter un nouveau TD/TP</h1>

          <div class="pb-3">
            <form action="{{ route('works.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="text" name="title" class="border border-gray-400 px-2 py-2 focus:outline-none w-full"  placeholder="Tapez le titre du TD/TP">
              <input type="hidden" name="module_id" value="{{ $module->id }}">

              <label class="w-full flex flex-row justify-center items-center bg-green-400 py-2 px-2 shadow text-black tracking-wide uppercase cursor-pointer mt-4 hover:shadow-lg hover:bg-green-600">
                  <i class="fas fa-cloud-upload-alt fa-lg text-white mr-2"></i>
                  <span class="text-base text-white leading-normal">Sélectionnez un fichier PDF</span>
                  <input type="file" name="file" class="hidden actual-btn2" />
              </label>

              <span class="file-chosen2">Aucun fichier choisi</span>

              <div class="flex justify-start pt-8">
                <button type="submit" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-green-600 border border-green-600 hover:bg-white hover:text-green-600">Ajouter</button>
              </form>
                <button @click="open = false" class="focus:outline-none pt-2 pb-2 pr-4 pl-4 mr-2 text-white bg-yellow-400 border border-yellow-400 hover:bg-white hover:text-yellow-400">Fermer</button>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="p-8 mb-4 rounded shadow bg-white text-gray-600 flex flex-col md:flex-row md:justify-between">
    @if($module->chapters->count() > 0)
    <table class="table-auto">
      <thead>
        <tr>
          <th class="px-4 py-2 text-gray-600">Chapitres</th>
          @if(Auth::guard('professor')->check())
          <th class="px-4 py-2 text-gray-600">Actions</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($module->chapters as $chapter)
        <tr>
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> <a href="{{ asset('files/chapters/' . $chapter->file) }}" target="_blank" class="hover:text-red-600"><i class="fas fa-file-pdf text-red-600"></i> {{ $chapter->title }}</a> </td>
          @if(Auth::guard('professor')->check())
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
            <div class="flex justify-center">
              <div>
                <a href="{{ route('chapters.edit', $chapter) }}" class="hover:text-yellow-600"> <i class="fas fa-edit fa-lg mr-2"></i> </a>
              </div>
              <div x-data="{ open: false }">
                <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
                <!-- Dialog (full screen) -->
                <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                  <!-- A basic modal dialog with title, body and one button to close -->
                  <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-2xl font-medium text-gray-900">
                        Supprission d'un chapitre
                      </h3>

                      <div class="mt-2">
                        <p class="text-gray-800">
                          Etes-vous sûr de vouloir supprimer ce chapitre ?
                        </p>
                    </div>
                  </div>

                    <!-- One big close button.  --->
                    <div class="mt-5 sm:mt-6">
                      <span class="flex justify-start">
                        <form action="{{ route('chapters.destroy', $chapter) }}" method="post">
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
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="w-full h-auto md:h-14 md:w-1/2 text-center bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 relative mb-3" role="alert">
      Aucun chapitre n'a encore été ajouté
    </div>
    @endif
    @if($module->works->count() > 0)
    <table class="table-auto">
      <thead>
        <tr>
          <th class="px-4 py-2 text-gray-600">TD/TP</th>
          @if(Auth::guard('professor')->check())
          <th class="px-4 py-2 text-gray-600">Actions</th>
          @endif
        </tr>
      </thead>
      <tbody>
          @foreach($module->works as $work)
        <tr>
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> <a href="{{ asset('files/works/' . $work->file) }}" target="_blank" class="hover:text-red-600"><i class="fas fa-file-pdf text-red-600"></i> {{ $work->title }}</a> </td>
          @if(Auth::guard('professor')->check())
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
            <div class="flex justify-center">
              <div>
                <a href="{{ route('works.edit', $work) }}" class="hover:text-yellow-600"> <i class="fas fa-edit fa-lg mr-2"></i> </a>
              </div>
              <div x-data="{ open: false }">
                <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
                <!-- Dialog (full screen) -->
                <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                  <!-- A basic modal dialog with title, body and one button to close -->
                  <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-2xl font-medium text-gray-900">
                        Supprission d'un TD/TP
                      </h3>

                      <div class="mt-2">
                        <p class="text-gray-800">
                          Etes-vous sûr de vouloir supprimer ce TD/TP ?
                        </p>
                    </div>
                  </div>

                    <!-- One big close button.  --->
                    <div class="mt-5 sm:mt-6">
                      <span class="flex justify-start">
                        <form action="{{ route('works.destroy', $work) }}" method="POST">
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
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="w-full h-auto mt-4 md:mt-0 md:h-14 md:w-1/2 ml-0 md:ml-2 text-center bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 relative mb-3 text-center" role="alert">
      Aucun TD/TP n'a encore été ajouté
    </div>
    @endif
  </div>
  <div class="p-8 mb-4 rounded shadow bg-white text-gray-600 flex flex-col md:flex-row justify-center">
    @if($module->exams->count() > 0)
    <table class="table-auto">
      <thead>
        <tr>
          <th class="px-4 py-2 text-gray-600">Devoirs</th>
          <th class="px-4 py-2 text-gray-600">Date de remise</th>
          @auth
          <th class="px-4 py-2 text-gray-600">Télécharger votre réponse</th>
          @endauth
          @if(Auth::guard('professor')->check())
          <th class="px-4 py-2 text-gray-600">Reponses</th>
          <th class="px-4 py-2 text-gray-600">Actions</th>
          @endif
        </tr>
      </thead>
      <tbody>
          @foreach($module->exams as $exam)
        <tr>
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold"> <a href="{{ asset('files/exams/' . $exam->file) }}" target="_blank" class="hover:text-red-600"><i class="fas fa-file-pdf text-red-600"></i> {{ $exam->title }}</a> </td>
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-bold">@if($exam->delivery_date < \Carbon\Carbon::now()) <span class="text-red-500">Le devoir est en retard  {{ Carbon\Carbon::parse( $exam->delivery_date )->diffForHumans() }}</span> @else{{ Carbon\Carbon::parse( $exam->delivery_date )->format('m/d/Y')  }} ({{ Carbon\Carbon::parse( $exam->delivery_date )->diffForHumans() }})@endif</td>
          @auth
          <td class="border border-green-500 px-4 py-2 text-gray-600">
            @foreach($exam->reponses as $reponse)
            @if($reponse->user_id === Auth::id())
            <div>
              Deja submmitez votre reponse
            </div>
            @endif
            @endforeach
            <form action="{{ route('reponses.store') }}" method="POST" enctype="multipart/form-data"  class="flex flex-col md:flex-row justify-center items-center">
              @csrf
              <input type="text" name="exam_id" class="hidden" value="{{ $exam->id }}">
              <input type="text" name="module_id" class="hidden" value="{{ $module->id }}">
              <input type="file" name="file" class="@error('file') border border-red-500 @enderror" />
              <button type="submit" class="focus:outline-none border-2 border-green-500 p-1 ml-1 text-center hover:bg-green-500 hover:text-white">Envoyez</button>
            </form>
          </td>
          @endauth
          @if(Auth::guard('professor')->check())
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
            <a href="{{ route('exams.show', $exam) }}" class="font-bold hover:text-green-500">Voir reponses</a>
          </td>
          <td class="border border-green-500 px-4 py-2 text-gray-600 font-medium">
            <div class="flex justify-center">
              <div>
                <a href="{{ route('exams.edit', $exam) }}" class="hover:text-yellow-600"> <i class="fas fa-edit fa-lg mr-2"></i> </a>
              </div>
              <div x-data="{ open: false }">
                <button class="modal-delete focus:outline-none hover:text-red-600" @click="open = true"> <i class="fas fa-trash fa-lg"></i> </button>
                <!-- Dialog (full screen) -->
                <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50 z-20" x-show="open">
                  <!-- A basic modal dialog with title, body and one button to close -->
                  <div class="h-auto p-4 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-2xl font-medium text-gray-900">
                        Supprission d'un devoir
                      </h3>

                      <div class="mt-2">
                        <p class="text-gray-800">
                          Etes-vous sûr de vouloir supprimer ce devoir ?
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
          @endif
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
