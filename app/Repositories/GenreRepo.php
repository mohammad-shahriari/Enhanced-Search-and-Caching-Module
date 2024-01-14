<?php

namespace App\Repositories;

use App\Models\Crew;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;

class GenreRepo
{

    public function getGenresAll()
    {
        Cache::store('redis')->put('all_genres_data', Genre::all(), 800);
        return  Cache::store('redis')->get('all_genres_data');
    }

    public function save($value)
    {
        $genre = new Genre();
        $genre->name = $value->genre_name;
        $genre->save();
        return $genre;
    }


    public function updateGenre($genreId,$value)
    {
        return Genre::query()->where('id',$genreId)->update([
            'name'=>$value->genre_name,
        ]);
    }


    public function deleteGenre($genreId)
    {
        return Genre::destroy($genreId);
    }

}
