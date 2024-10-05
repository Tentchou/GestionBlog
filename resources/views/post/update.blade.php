<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        

        <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
           
            <div>
                @foreach ($errors->all() as $error)
                   <span class="font-medium">Danger alert!</span>{{$error}}
                @endforeach
                
            </div>
        </div>
        
        <form method="POST" action="{{ route('posts.update',$post) }}" method="POST" enctype="multipart/form-data" class="mt-10">
            @csrf
            @method('put')
    
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Titre du post')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $post->title}}"/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Contenu --}}

                <div class="mt-4">
                    <x-input-label for="content" :value="__('Contenu du post')" />
                    <textarea name="content" id="content" cols="30" rows="10" class="block mt-1 w-full">{{ $post->title}}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                {{-- Image --}}

                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image du post')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="categorie" :value="__('Categorie du post')" />
                    <select name="categorie" id="categorie" class="block mt-1 w-full" >
                        @foreach ($categories as $categorie )
                            <option value="{{ $categorie->id }}" {{ $post->categorie_id === $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    
                    <x-primary-button class="ms-4">
                        {{ __('modifier mon post') }}
                    </x-primary-button>
                </div>
        
        </form>
        
    </div>
</x-app-layout>