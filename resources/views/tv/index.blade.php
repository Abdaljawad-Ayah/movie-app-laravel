@extends('layout.app')
@section('content')
<div class="container mx-auto px-16 pt-16">
   <div class="popular-tv">
      <h2 class="uppercase tracking-wider text-blue-100 text-lg font-semibold">Most Watched</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid:cols-3 lg:grid-cols-5 gap-16">
      @foreach($popularTv as $tvshow)<x-tv-card :tvshow="$tvshow" />
         @endforeach
      </div>
   </div>
   <div class="top-rated-shows py-24">
      <h2 class="uppercase tracking-wider text-blue-100 text-lg font-semibold">Top Rated Shows</h2>
      {{-- :genres="$genres" --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid:cols-3 lg:grid-cols-5 gap-16">
      @foreach ($topRatedTv as $tvshow)<x-tv-card :tvshow="$tvshow"  />
         @endforeach
      </div>
   </div>
</div>
@endsection