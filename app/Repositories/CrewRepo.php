<?php

namespace App\Repositories;

use App\Models\Crew;

class CrewRepo
{


    public function getCrewsAll()
    {
        return Crew::all();
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
