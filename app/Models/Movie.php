<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;


/**
 *
 * To enable search functionality With ElasticSearch, make sure to uncomment `Searchable` trait to this model
 * And implements Explored on Model Movie
 *
 * class Movie extends Model implements Explored {
 *
 *
 */


class Movie extends Model
{
    use HasFactory;
//    use Searchable;


    public function mappableAs():array
    {
        return [
            'id'=>'keyword',
            'title'=>'text',
        ];
    }



    public function toSearchableArray():array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title
        ];
    }


    protected $fillable = ['title', 'year', 'rank', 'description', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function crews()
    {
        return $this->belongsToMany(Crew::class,'movie_crew','movie_id','crew_id');
    }
}
