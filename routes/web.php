<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use App\Models\characters;
use App\Models\episodes;
use App\Models\locations;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

function saveCharacters(string $url)
{
    $client = new Client();

    $response = $client->request('GET', $url);
    $responseBody = json_decode($response->getBody());
    $results = $responseBody->results;

    $finalData = array_map(function ($result) {
        return array('name' => $result->name, 'status' => $result->status, 'species' => $result->species, 'type' => $result->type, 'gender' => $result->gender, 'origin' => json_encode($result->origin), 'location' => json_encode($result->location), 'image' => $result->image, 'episode' => json_encode($result->episode), 'url' => $result->url, 'created' => $result->created);
    }, $results);

    characters::insert($finalData);
}

function saveEpisodes(string $url)
{
    $client = new Client();

    $response = $client->request('GET', $url);
    $responseBody = json_decode($response->getBody());
    $results = $responseBody->results;

    $finalData = array_map(function ($result) {
        return array('name' => $result->name, 'air_date' => $result->air_date, 'episode' => $result->episode, 'characters' => json_encode($result->characters), 'url' => $result->url, 'created' => $result->created);
    }, $results);

    episodes::insert($finalData);
}

function saveLocations(string $url)
{
    $client = new Client();

    $response = $client->request('GET', $url);
    $responseBody = json_decode($response->getBody());
    $results = $responseBody->results;

    $finalData = array_map(function ($result) {
        return array('name' => $result->name, 'type' => $result->type, 'dimension' => $result->dimension, 'residents' => json_encode($result->residents), 'url' => $result->url, 'created' => $result->created);
    }, $results);

    locations::insert($finalData);
}
