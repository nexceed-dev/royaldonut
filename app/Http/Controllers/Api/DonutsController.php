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
public function index(Request $request)
    {
        $sort = $request->query('sort', 'name');
        $order = $request->query('order', 'asc');
        $sortColumn = $sort === 'approval' ? 'seal_of_approval' : 'name';

        $donuts = Donut::orderBy($sortColumn, $order)->get();

        if ($donuts->count() > 0) {
            return DonutResource::collection($donuts);
        } else {
            return response()->json([
                'message' => 'No donuts found'
            ], 200);
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
                'message' => 'Invalid input',
                'error' => $validator->messages(),
            ], 200);
        }

        $donut = Donut::create($validator->validated());

        return response()->json([
            'data' => new DonutResource($donut),
            'message' => 'Donut created successfully'
        ], 200);
    }

    public function show(Donut $donut)
    {
        return response()->json([
            'data' => new DonutResource($donut)
        ], 200);
    }

    public function update(Request $request, Donut $donut)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seal_of_approval' => 'required|integer|min:0|max:5',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid input',
                'error' => $validator->messages(),
            ], 200);
        }

        $donut->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'seal_of_approval' => $request->input('seal_of_approval'),
        ]);

        return response()->json([
            'data' => new DonutResource($donut),
            'message' => 'Donut updated successfully'
        ], 200);

    }


    public function destroy()
    {
        $donut = Donut::findOrFail(request()->route('donut'));
        $donut->delete();

        return response()->json([
            'message' => 'Donut deleted successfully'
        ], 200);
    }
    
}
