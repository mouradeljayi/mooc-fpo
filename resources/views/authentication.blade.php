@extends('layouts.app')

@section('content')

<section class="bg-white shadow">
  <div class="container mx-auto">
    <div class="flex flex-col md:flex-row justify-center items-center">
      <a href="/"><img src="{{ asset('img/logo_fpo.png') }}" alt="logo_fpo" class="w-64"></a>
      <div class="text-2xl mb-2 md:mb-0 text-blue-900">
        LA PLATFORME MOOC - FPO
      </div>
    </div>
  </div>
</section>

<section class="container mx-auto grid grid-cols-1 md:grid-cols-2 mt-10 p-8 shadow border-2 border-gray-400 rounded">
  <div class="md:border-r-4 border-green-800">
    <div class="flex justify-center">
      <i class="fas fa-user-graduate fa-2x"></i>
      <h2 class="font-bold text-gray-800 text-2xl ml-4">ESPACE ETUDIANT</h2>
    </div>
    <div class="flex justify-center">
      <form action="{{ route('studentLogin') }}" method="POST" class="w-full md:w-1/2 mt-10">
        @csrf
        <div class="flex flex-col mb-4">
          <label class="mb-2 font-bold text-lg">Nom d'utilisateur</label>
          <input type="text" name="student_name" value="{{ old('student_name') }}" class="text-sm bg-gray-400 text-gray-900 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-600  @error('student_name') border-2 border-red-500 @enderror ">
          @error('student_name')
          <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <div class="flex flex-col mb-4">
          <label class="mb-2 font-bold text-lg">Mot de passe</label>
          <input type="password" name="student_password" class="text-sm bg-gray-400 text-gray-900 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('student_password') border-2 border-red-500 @enderror">
          @error('student_password')
          <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full bg-green-600 hover:bg-green-800 py-2 px-4 text-lg text-white">CONNEXION</button>
        </div>
      </form>
    </div>
  </div>


  <div class="mt-24 md:mt-0">
    <div class="border-t-4 border-green-800 md:border-t-0 mb-6 md:mb-0"></div>
    <div class="flex justify-center">
      <i class="fas fa-user-tie fa-2x"></i>
      <h2 class="font-bold text-gray-800 text-2xl ml-4">ESPACE PROF</h2>
    </div>
    <div class="flex justify-center">
      <form action="{{ route('profLogin') }}" method="POST" class="w-full md:w-1/2 mt-10">
        @csrf
        <div class="flex flex-col mb-4">
          <label class="mb-2 font-bold text-lg">Nom d'utilisateur</label>
          <input type="text" name="prof_name" value="{{ old('prof_name') }}" class="text-sm bg-gray-400 text-gray-900  px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('prof_name') border-2 border-red-500 @enderror">
          @error('prof_name')
          <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <div class="flex flex-col mb-4">
          <label class="mb-2 font-bold text-lg">Mot de passe</label>
          <input type="password" name="prof_password" class="text-sm bg-gray-400 text-gray-900  px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('prof_password') border-2 border-red-500 @enderror">
          @error('prof_password')
          <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full bg-green-600 hover:bg-green-800 py-2 px-4 text-lg text-white">CONNEXION</button>
        </div>
      </form>
    </div>
  </div>
</section>

<div class="flex justify-center mb-4 mt-4 ">
  <p>Designed & Developed with <i class="fas fa-heart fa-sm text-red-700"></i> By <a href="https://www.linkedin.com/in/mourad-el-jayi-706821186/" target="_blank" class="text-blue-700">Mourad EL Jayi</a> | 2021</p>
</div>


@endsection
