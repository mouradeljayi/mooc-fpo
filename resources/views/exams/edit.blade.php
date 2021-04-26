@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-8 mt-28 bg-white rounded shadow flex items-center justify-center">
      <div class="py-4  px-6">
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Modifier un devoir</p>
        </div>

        <form action="{{ route('exams.update', $exam) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="text" name="title" class="border border-gray-400 px-2 py-2 focus:outline-none w-full @error('title') border border-red-500 @enderror"  value="{{ $exam->title }}">
          <div class="flex justify-center items-center">
            <label for="delivery_date">Date de remise</label>
            <input type="datetime" name="delivery_date" value="{{ $exam->delivery_date }}" class="mt-2 ml-2 border border-gray-400 px-2 py-2 focus:outline-none @error('delivery_date') border border-red-500 @enderror">
          </div>
          <input type="hidden" name="module_id" value="{{ $exam->module->id }}">

          <label class="w-full flex flex-row justify-center items-center bg-green-400 py-2 px-2 shadow text-black tracking-wide uppercase cursor-pointer mt-4 hover:shadow-lg hover:bg-green-600">
              <i class="fas fa-cloud-upload-alt fa-lg text-white mr-2"></i>
              <span class="text-base text-white leading-normal">Sélectionnez un fichier PDF</span>
              <input type="file" name="file" class="hidden actual-btn" />
          </label>

          <span class="file-chosen">{{ $exam->file }}</span>

          <div class="pt-8">
            <button type="submit" class="focus:outline-none w-full  pt-2 pb-2 pr-4 pl-4 text-white bg-green-600 border border-green-600 hover:bg-white hover:text-green-600">Modifier ce devoir</button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection
