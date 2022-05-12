<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;
    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv  = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres     = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    // this is a way for not repeating code 
    private function formatTv($tvshow)
    {
        // return collect($tvshow)->map(function($tvshowshow) {
        //     return $tvshowshow;
        // })->dump();
        return collect($tvshow)->map(function ($tvshow) {

            $genreFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path'    => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
                'vote_average'   =>  $tvshow['vote_average'] * 10 . '%',
                'first_air_date' =>  Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres'         =>  $genreFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'first_air_date', 'genres', 'overview',
            ]);
        });
    }
}
