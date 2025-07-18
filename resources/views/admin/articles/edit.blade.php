@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit Article</h2>
            <p class="mt-1 text-sm text-gray-500">Edit informasi artikel yang sudah ada.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat {{ count($errors->all()) }} kesalahan pada form:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul role="list" class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 divide-y divide-gray-200">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Judul Artikel</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" value="{{ $article->title }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" required>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" required>{{ $article->description }}</textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">Tulis deskripsi artikel dengan format yang baik.</p>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Gambar</label>
                <div class="mt-2 space-y-3">
                    @if($article->image)
                        <div class="flex items-center gap-x-3">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="h-24 w-24 rounded-lg object-cover">
                            <p class="text-sm text-gray-500">Gambar saat ini</p>
                        </div>
                    @endif
                    <div class="flex items-center gap-x-3">
                        <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100">
                    </div>
                    <p class="text-sm text-gray-500">Upload gambar baru untuk mengganti gambar yang ada. Format: JPG, PNG. Maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <div class="flex justify-end gap-x-3">
                <a href="{{ route('admin.articles.index') }}" class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-red-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Update Artikel
                </button>
            </div>
        </div>
    </form>
</div>
@endsection