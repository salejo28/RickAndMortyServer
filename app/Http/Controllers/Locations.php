<?php

namespace App\Http\Controllers;

use App\Models\locations as ModelsLocations;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Locations extends Controller
{
    //
    public function index()
    {
        if (request('search')) {
            return ModelsLocations::where('name', 'LIKE', '%' . request('search') . '%')->paginate(10);
        }

        return ModelsLocations::paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'residents' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $date = new DateTime("now", new DateTimeZone("America/Bogota"));
        $created = $date->format('Y-m-d H:i:s');

        $location = new ModelsLocations([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'dimension' => $request->input('dimension'),
            'residents' => json_encode($request->input('residents')),
            'created' => $created,
            'url' => ''
        ]);

        $location->save();
        $url = url()->current() . '/' . $location->id;
        $location->update([
            'url' => $url
        ]);

        return response()->json(['success' => true, 'character' => $location]);
    }

    public function update(Request $request, ModelsLocations $location)
    {
        $location->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'dimension' => $request->input('dimension'),
            'residents' => json_encode($request->input('residents')),
        ]);

        return response()->json(['success' => true, 'character' => $location]);
    }

    public function destroy(ModelsLocations $location)
    {
        $location->delete();
        return response()->json(['success' => true, 'message' => 'Location deleted']);
    }
}
