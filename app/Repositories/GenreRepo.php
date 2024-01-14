<?php

namespace App\Repositories;

use App\Models\Crew;
use App\Models\Genre;

class GenreRepo
{

    public function getGenresAll()
    {
        return Genre::all();
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
