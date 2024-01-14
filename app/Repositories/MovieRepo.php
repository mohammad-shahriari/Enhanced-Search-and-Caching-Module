<?php

namespace App\Repositories;

use App\Models\Crew;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieCrew;
use App\Services\ResponseBuilderService;
use Illuminate\Support\Facades\Cache;
use function PHPUnit\Framework\throwException;

class MovieRepo
{

    protected $genreRepository;
    protected $crewRepository;

    public function __construct(GenreRepo $genreRepo, CrewRepo $crewRepo)
    {
        $this->genreRepository = $genreRepo;
        $this->crewRepository = $crewRepo;
    }


    public function getMoviesAll()
    {
        Cache::store('redis')->put('all_movies_data', Movie::all(), 500);
        return  Cache::store('redis')->get('all_movies_data');
    }

    public function saveMovie($value)
    {

        $genre = $this->genreRepository->save($value);
        $crew = $this->crewRepository->save($value);
        $movie = new Movie();
        $movie->title = $value->title;
        $movie->year = $value->year;
        $movie->rank = $value->rank;
        $movie->description = $value->description;
        $movie->genre_id = $genre->id;
        $movie->save();
        $movie->crews()->sync([$crew->id]);
    }

    public function updateMovie($movieId,$value)
    {

        $existMovie = MovieCrew::query()->join('movies','movie_crew.movie_id','=','movies.id')
            ->join('crews','movie_crew.crew_id','=','crews.id')
            ->where('movies.id',$movieId)
            ->select('crews.id AS crew_id','movies.genre_id')
            ->first();
      if ($existMovie){
          Genre::query()->where('id',$existMovie->genre_id)->update([
              'name'=> $value->genre_name
          ]);

          Crew::query()->where('id',$existMovie->crew_id)->update([
              'name'=>$value->crew_name,
              'family'=>$value->family,
              'role'=>$value->role,
              'birthdate'=>$value->birthdate,
          ]);
      }

        return Movie::query()->where('id',$movieId)->update([
           'title'=>$value->title,
           'year'=>$value->year,
           'description'=>$value->description,
           'rank'=>$value->rank,
        ]);

    }

    public function deleteMovie($movieId)
    {
        return Movie::destroy($movieId);
    }

}
