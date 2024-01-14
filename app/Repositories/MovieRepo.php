<?php

namespace App\Repositories;

use App\Models\Crew;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieCrew;
use App\Services\ResponseBuilderService;
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
        return Movie::all();
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
              'name'=> $value->query('g
              enre_name')
          ]);

          Crew::query()->where('id',$existMovie->crew_id)->update([
              'name'=>$value->query('crew_name'),
              'family'=>$value->query('family'),
              'role'=>$value->query('role'),
              'birthdate'=>$value->query('birthdate'),
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
