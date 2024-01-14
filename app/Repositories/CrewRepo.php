<?php

namespace App\Repositories;

use App\Models\Crew;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;

class CrewRepo
{


    public function getCrewsAll()
    {
        Cache::store('redis')->put('all_crews_data', Crew::all(), 700);
        return  Cache::store('redis')->get('all_crews_data');

    }

    public function save($value)
    {
        $crew = new Crew();
        $crew->name = $value->crew_name;
        $crew->family = $value->family;
        $crew->role = $value->role;
        $crew->birthdate = $value->birthdate;
        $crew->save();
        return $crew;
    }


    public function updateCrew($crewId,$value)
    {
        return Crew::query()->where('id',$crewId)->update([
            'name'=>$value->crew_name,
            'family'=>$value->family,
            'role'=>$value->role,
            'birthdate'=>$value->birthdate,
        ]);
    }


    public function deleteCrew($crewId)
    {
        return Crew::destroy($crewId);
    }

}
