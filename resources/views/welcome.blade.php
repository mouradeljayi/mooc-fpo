@extends('layouts.app')

@section('content')

<main class="grid lg:grid-cols-2">
<section class="bg-green-500">
 <div class="container mx-auto text-white px-10 mt-12">
   <h1 class="font-bold uppercase text-4xl">Bienvenue sur la plateforme pédagogique MOOC-FPO.</h1>
   <p class="mt-4 text-xl">Afin de permettre à nos étudiants, de suivre en ligne des activités pédagogiques (cours, TD, TP …..) et d'interagir entre eux ou/et avec leurs enseignants, la Faculté Polydisciplinaire- Ouarzazate en collaboration avec la Présidence de l'Université Ibn Zohr (Agadir),  a mis à leurs disposition cette plateforme pédagogique d'enseignement à distance.</p>
   <div class="mt-4 mb-8">
     <a href="{{ route('authentication') }}" class="bg-white py-2 px-4 text-lg text-green-500 font-bold hover:shadow-lg">SE CONNECTER</a>
   </div>
 </div>
</section>
<section class="w-full">
<img src="img/study.png" alt="">
</section>
</main>

<section class="container mx-auto px-10">
  <div class="flex justify-center">
    <img src="{{ asset('img/logo_fpo.png') }}" class="w-80">
  </div>
</section>

<section class="bg-white p-3 text-center text-gray-800 box ">
  <p class="text-sm">Faculté Polydisciplinaire de Ouarzazate &copy; 2021 Tout droits réservés</p>
</section>

<style media="screen">
  .box {
     box-shadow: 0 0 10px 0 grey;
  }
</style>


@endsection
