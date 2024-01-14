<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Movie;
use App\Repositories\CrewRepo;
use App\Services\ResponseBuilderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrewController extends Controller
{
    protected $crewRepository;
    public function __construct(CrewRepo $crewRepo)
    {
        $this->crewRepository = $crewRepo;
    }


    public function index()
    {
        try {
           $result = $this->crewRepository->getCrewsAll();
            return ResponseBuilderService::sendSuccess($result);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(), [

            'crew_name' => ['required', 'string', 'unique:crews,name'],
            'family' => ['required', 'string'],
            'role' => ['required', 'string'],
            'birthdate' => ['required'],

        ], [
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
            $this->crewRepository->save($request);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function update($id,Request $request)
    {
        $validate_data = Validator::make($request->all(), [

            'crew_name' => ['required', 'string', 'unique:crews,name'],
            'family' => ['required', 'string'],
            'role' => ['required', 'string'],
            'birthdate' => ['required'],

        ], [
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
            $existId = Crew::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->crewRepository->updateCrew($id,$request);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }

    public function destroy($id)
    {
        try {
            $existId = Crew::query()->where('id',$id)->exists();
            if (!$existId){
                return ResponseBuilderService::notFound(null,self::NOT_FOUND);
            }
            $this->crewRepository->deleteCrew($id);
            return ResponseBuilderService::sendSuccess(self::SUCCESS_OPERATION);
        } catch (\Exception $exception) {
            return ResponseBuilderService::sendCatchError($exception);
        }
    }
}
