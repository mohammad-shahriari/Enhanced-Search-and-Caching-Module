<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Repositories\GenreRepo;
use App\Services\ResponseBuilderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    protected $genreRepository;
    public function __construct(GenreRepo $genreRepo)
    {
        $this->genreRepository = $genreRepo;
    }

    public function index()
    {
        try {

            $result = $this->genreRepository->getGenresAll();
            return ResponseBuilderService::sendSuccess($result);

        }  catch (\Exception $exception) {
         return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(), [
            'genre_name' => ['required', 'string'],

        ], [
            'genre_name.required' => 'لطفا عنوان ژانر را وارد کنید',

        ]);
        if ($validate_data->fails()) {
            $this->errors = $validate_data->errors()->toArray();
            return ResponseBuilderService::sendValidationError($this->errors);
        }

        try {
            $this->genreRepository->save($request);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);

        }  catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function update($id,Request $request)
    {

        $validate_data = Validator::make($request->all(), [
            'genre_name' => ['required', 'string'],

        ], [
            'genre_name.required' => 'لطفا عنوان ژانر را وارد کنید',

        ]);
        if ($validate_data->fails()) {
            $this->errors = $validate_data->errors()->toArray();
            return ResponseBuilderService::sendValidationError($this->errors);
        }

        try {
            $existId = Genre::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->genreRepository->updateGenre($id,$request);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        }  catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function destroy($id)
    {
        try {
            $existId = Genre::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->genreRepository->deleteGenre($id);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        }  catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }
}
