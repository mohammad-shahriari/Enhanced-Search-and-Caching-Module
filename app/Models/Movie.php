<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

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
