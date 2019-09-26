<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function getAddresses(Request $request)
    {
        return response()->json([
            ['message' => 'Test1'],
            ['message' => 'Test2']
        ]);
    }
}
