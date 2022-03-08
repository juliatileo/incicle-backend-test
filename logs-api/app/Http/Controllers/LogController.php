<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    function create(Request $request)
    {
        $log = Log::create(['function' => $request->function]);

        return response()->json($log);
    }
}
