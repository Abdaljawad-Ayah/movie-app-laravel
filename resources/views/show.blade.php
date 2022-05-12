@extends('layout.app')

@section('content')
<div class="movie-info border-b border-gray-800">
            <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
               <div class="flex-none">
                <img src="{{  $popular['poster_path'] }}" class="w-64 md:w-96" alt="">
          </div>
                <div class="md:ml-24">
                    <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $popular['title'] }}</h2>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm">
                        <svg class="fill-current text-orange-500 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        <span class="ml-1">{{ $popular['vote_average'] }}</span>
                        <span class="mx-2">|</span>
                        <span>{{ $popular['release_date'] }}</span>
                        <span class="mx-2">|</span>
                        <span class="text-gray-400 text-sm">
                            {{ $popular['genres'] }}
                        </span>
                    </div>

                    <p class="text-gray-300 mt-8">
                        {{ $popular['overview'] }}
                    </p>

                    <div class="mt-12">
                        <h4 class="text-white font-semibold">Featured Cast</h4>
                        <div class="flex mt-4">
                            @foreach ($popular['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div x-data="{isOpen: false}">
                        {{-- if there is result of videos then show if there is no results don't render--}}
                        @if (count($popular['videos']['results']) > 0)

                        <div class="mt-12">
                            <button @click="isOpen = true"
                                class="flex bg-blue-500 text-white-900  font-semibold px-5 py-4 hover:bg-blue-600 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        @endif

                        {{-- Movie Video Model start --}}
                        <div style="background-color: rgba(0, 0, 0, 0.5)"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            x-show.transition.opacity="isOpen">
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-blue-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button class="text-3xl leading-none hover:text-gray-300" @click="isOpen = false"
                                            @keydown.escape.window="isOpen = false">&times;</button>
                                    </div>
                                    <div class="model-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $popular['videos']['results'][0]['key'] }}"
                                                class="responsive-iframe absolute top-0 left-0 w-full h-full" style="border: 0;"
                                                allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Movie Video Model end --}}
                    </div>
                </div>
            </div>
      </div>
</div>
@endsection