<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    const SUCCESS_OPERATION = 'عملیات با موفقیت انجام شد';
    const CATCH_ERROR='اشکال در سیستم !';
    const VALIDATION_ERROR= 'مشکل در اعتبار سنجی';
    const UNAUTHORIZED = 'دسترسی غیر مجاز';
    const NOT_FOUND = 'چیزی یافت نشد';


}
