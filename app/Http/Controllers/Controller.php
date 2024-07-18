<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //DispatchesJobs is inbuilt so that laarvel can but some jobs in bavkground queue
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
