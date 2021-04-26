@extends('layouts.app')

@section('content')

<h1 class="text-center text-3xl mt-28 tracking-wide font-bold uppercase"><i class="fas fa-comments"></i> Forum</h1>
<p class="text-center text-lg">Créer une nouvelle discussion</p>
<section class="container mx-auto px-6 md:px-12 mt-5 mb-10">

  <div class="flex justify-center bg-white p-4 rounded">
    <form action="{{ route('discussions.store') }}" method="POST" class="w-full md:w-1/2 mt-10">
      @csrf
      <div class="flex flex-col mb-4">
        <label class="mb-2 font-bold text-lg">Titre  de discussion</label>
        <input type="text" name="title" value="{{ old('title') }}" placeholder="Ecrivez le titre de votre discussion" class="text-lg shadow border border-gray-400 w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500  @error('title') border-2 border-red-500 @enderror ">
        @error('title')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
      </div>
      <div class="flex flex-col mb-4">
        <label class="mb-2 font-bold text-lg">Contenu du discussion</label>
        <textarea type="text" name="content" rows="10" value="{{ old('content') }}" class="text-lg shadow border border-gray-400  w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 @error('content') border-2 border-red-500 @enderror" placeholder="Ecrivez le contenu de votre discussion"></textarea>
        @error('content')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
      </div>
      <div class="mt-6">
        <button type="submit" class="focus:outline-none bg-blue-600 hover:bg-blue-800 py-2 px-4 text-lg text-white">AJOUTER</button>
      </div>
    </form>
  </div>

</section>



@endsection
