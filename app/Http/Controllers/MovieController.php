<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Repositories\MovieRepo;
use App\Services\ResponseBuilderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    protected $movieRepository;
    public function __construct(MovieRepo $movieRepo)
    {
        $this->movieRepository = $movieRepo;
    }


    public function index()
    {

        try {
            $result = $this->movieRepository->getMoviesAll();
            return ResponseBuilderService::sendSuccess($result);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function store(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'year' => 'required',
            'description' => ['required'],
            'rank' => ['required',],
            'genre_name' => ['required', 'string', 'unique:genres,name'],
            'crew_name' => ['required', 'string', 'unique:crews,name'],
            'family' => ['required', 'string'],
            'role' => ['required', 'string'],
            'birthdate' => ['required'],

        ], [
            'title.required' => 'لطفا عنوان فیلم را وارد کنید',
            'year.required' => 'لطفا سال انتشار را وارد کنید',
            'description.required' => 'لطفا توضیحات فیلم را وارد کنید !',
            'rank.required' => 'لطفا امتیاز فیلم را وارد کنید ',
            'genre_name.required' => 'لطفا عنوان ژانر را انتخاب کنید',
            'crew_name.required' => 'لطفا نام تولید کننده را انتخاب کنید',
            'family.required' => 'لطفا نام خانوادگی تولید کننده را انتخاب کنید',
            'role.required' => 'لطفا نقش را وارد کنید',
            'birthdate.required' => 'لطفا تاریخ تولد را انتخاب کنید ',

        ]);

        if ($validate_data->fails()) {
            $this->errors = $validate_data->errors()->toArray();
            return ResponseBuilderService::sendValidationError($this->errors);
        }
        try {
            DB::beginTransaction();
            $this->movieRepository->saveMovie($request);
            DB::commit();
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseBuilderService::sendCatchError($exception);
        }

    }

    public function update($id,Request $request)
    {

        $validate_data = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'year' => 'required',
            'description' => ['required'],
            'rank' => ['required',],
            'genre_name' => ['required', 'string', 'unique:genres,name'],
            'crew_name' => ['required', 'string', 'unique:crews,name'],
            'family' => ['required', 'string'],
            'role' => ['required', 'string'],
            'birthdate' => ['required'],

        ], [
            'title.required' => 'لطفا عنوان فیلم را وارد کنید',
            'year.required' => 'لطفا سال انتشار را وارد کنید',
            'description.required' => 'لطفا توضیحات فیلم را وارد کنید !',
            'rank.required' => 'لطفا امتیاز فیلم را وارد کنید ',
            'genre_name.required' => 'لطفا عنوان ژانر را انتخاب کنید',
            'crew_name.required' => 'لطفا نام تولید کننده را انتخاب کنید',
            'family.required' => 'لطفا نام خانوادگی تولید کننده را انتخاب کنید',
            'role.required' => 'لطفا نقش را وارد کنید',
            'birthdate.required' => 'لطفا تاریخ تولد را انتخاب کنید ',

        ]);
        if ($validate_data->fails()) {
            $this->errors = $validate_data->errors()->toArray();
            return ResponseBuilderService::sendValidationError($this->errors);
        }

        try {
            $existId = Movie::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->movieRepository->updateMovie($id,$request);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function destroy($id)
    {
        try {
            $existId = Movie::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->movieRepository->deleteMovie($id);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
    } catch (\Exception $exception) {
    return ResponseBuilderService::sendCatchError($exception);
}
    }
}
