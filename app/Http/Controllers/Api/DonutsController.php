<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DonutResource;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seal_of_approval' => 'required|integer|min:0|max:5',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ], 200);
        }

        $donut = Donut::create($validator->validated());

        return response()->json([
            'data' => new DonutResource($donut),
            'message' => 'Donut created successfully'
        ], 200);
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
