<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DonutResource;

class DonutsController extends Controller
{
    public function index()
    {
        $donuts = Donut::get();
        if ($donuts->count() > 0) {
            return DonutResource::collection($donuts);
        }
        else {
            return response()->json(
                ['message' => 'No donuts found'], 200);
        }
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
    
}
