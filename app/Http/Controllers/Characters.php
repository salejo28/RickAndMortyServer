<?php

namespace App\Http\Controllers;

use App\Models\characters as ModelsCharacters;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Characters extends Controller
{
    public function index()
    {
        if (request('search')) {
            return ModelsCharacters::where('name', 'LIKE', '%' . request('search') . '%')->paginate(10);
        }

        return ModelsCharacters::orderBy('id', 'asc')->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'species' => 'required',
            'gender' => 'required',
            'origin' => 'required|json',
            'location' => 'required|json',
            'image' => 'mimes:jpg,jpeg,png|nullable',
            'episode' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $file = $request->file[0];

        $urlImage = $file->store('images', 'public');

        $date = new DateTime("now", new DateTimeZone("America/Bogota"));
        $created = $date->format('Y-m-d H:i:s');

        $character = new ModelsCharacters([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'species' => $request->input('species'),
            'type' => $request->input('type'),
            'gender' => $request->input('gender'),
            'origin' => json_encode($request->input('origin')),
            'location' => json_encode($request->input('location')),
            'image' => $urlImage,
            'episode' => json_encode($request->input('episode')),
            'created' => $created,
            'url' => ''
        ]);


        $character->save();
        $url = url()->current() . '/' . $character->id;
        $character->update([
            'url' => $url
        ]);

        return response()->json(['success' => true, 'character' => $character]);
    }

    public function update(Request $request, ModelsCharacters $character)
    {
        $character->update([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'species' => $request->input('species'),
            'type' => $request->input('type'),
            'gender' => $request->input('gender'),
            'origin' => json_encode($request->input('origin')),
            'location' => json_encode($request->input('location')),
            'episode' => json_encode($request->input('episode')),
        ]);

        if ($request->file && $request->file[0]) {
            $file = $request->file[0];
            Storage::delete($character->image);
            $urlImage = $file->store('images', 'public');
            $character->update([
                'image' => $urlImage
            ]);
        }

        return response()->json(['success' => true, 'character' => $character]);
    }

    public function destroy(ModelsCharacters $character)
    {
        $character->delete();
        return response()->json(['success' => true, 'message' => 'Character deleted']);
    }
}
