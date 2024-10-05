<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
  
    
    <div class="py-12">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                @if(session('success'))
                    <span>Success</span>{{ session('success') }}
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($posts as $post)
                  <div class="flex items-center">
                      <a href="{{ route('posts.edit', $post) }}" class="bg-green-500 px-2 py-3 block">Editer {{ $post->title }}</a>
                      <a href="{{ route('posts.destroy', $post) }}"  class="bg-red-500 px-2 py-3 block">Supprimer {{ $post->title }}</a>
                  </div>
                @endforeach
            </div>

            
        </div>
    </div>
</x-app-layout>
