<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ResponseBuilderService extends Controller
{


    public static function sendSuccess($result)
    {
        return response()->json(['statuscode'=>1,'statustext'=>self::SUCCESS_OPERATION,'result'=>$result],200);
    }

    public static function sendUnauthorized($result)
    {

        return response()->json(['statuscode'=>1,'statustext'=>self::UNAUTHORIZED,'result'=>$result],401);
    }


    public static function notFound($result,$statustext)
    {
        return response()->json(['statuscode'=>0,'statustext'=>$statustext,'result'=>$result],400);
    }

    public static function sendCatchError($exception){
//        Log::info($exception->getMessage());
//        error_log($exception->getMessage());
        if (env('APP_DEBUG')==true) {
            return response()->json(['statuscode' => 0, 'statustext' => self::CATCH_ERROR, 'result' => $exception->getMessage()], 400);
        }
    }

    public static function sendQueryError($exception){
        if (env('APP_DEBUG')==true) {
            return response()->json(['statuscode' => 0, 'statustext' => self::CATCH_ERROR, 'result' => $exception], 400);
        }
    }

    public static function sendValidationError($result)
    {
        return response()->json(['statuscode'=>0,'statustext'=>self::VALIDATION_ERROR,'result'=>$result],400);
    }

}
