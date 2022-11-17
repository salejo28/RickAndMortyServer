<?php

namespace App\Http\Controllers;

use App\Models\episodes as ModelsEpisodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DateTimeZone;

class Episodes extends Controller
{
    //
    public function index()
    {
        if (request('search')) {
            return ModelsEpisodes::where('name', 'LIKE', '%' . request('search') . '%')->paginate(10);
        }

        return ModelsEpisodes::paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'air_date' => 'required',
            'episode' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $date = new DateTime("now", new DateTimeZone("America/Bogota"));
        $created = $date->format('Y-m-d H:i:s');

        $episode = new ModelsEpisodes([
            'name' => $request->input('name'),
            'air_date' => $request->input('air_date'),
            'episode' => $request->input('episode'),
            'characters' => count($request->input('characters')) > 0 ? json_encode($request->input('characters')) : '',
            'created' => $created,
            'url' => ''
        ]);

        $episode->save();

        $url = url()->current() . '/' . $episode->id;
        $episode->update([
            'url' => $url
        ]);

        return response()->json(['success' => true, 'episode' => $episode]);
    }

    public function update(Request $request, ModelsEpisodes $episode)
    {
        $episode->update([
            'name' => $request->input('name'),
            'air_date' => $request->input('air_date'),
            'episode' => $request->input('episode'),
            'characters' => json_encode($request->input('characters')),
        ]);

        return response()->json(['success' => true, 'episode' => $episode]);
    }

    public function destroy(ModelsEpisodes $episode)
    {
        $episode->delete();
        return response()->json(['success' => true, 'message' => 'Episode deleted']);
    }
}
