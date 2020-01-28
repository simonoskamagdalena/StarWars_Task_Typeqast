<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    private $url = "https://swapi.co/api/";


    public function get_data_via_url($url)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $client = new Client();
        //define request
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $url);
        //response
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        //get response body
        $body = json_decode($response->getBody()->getContents());

        return response()->json($body, 200);
    }

    public function get_id($url)
    {
        $url = explode('/', $url);
        return $url[sizeof($url) - 2];

    }

    //GET SPECIES
    public function get_species(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $page = $request->page ?? 1;
        $species = [];
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'species/?page=' . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        foreach ($body->results as $res) {
            array_push($species, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }
        return response()->json(["data" => $species, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //Get species info
    public function get_species_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $id = $request->id;
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . "species/" . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        $obj = [
            "name" => $body->name,
            "classification" => $body->classification,
            "average_height" => $body->average_height,
            "skin_colors" => $body->skin_colors,
            "hair_colors" => $body->hair_colors,
            "eye_colors" => $body->eye_colors,
            "average_lifespan" => $body->average_lifespan,
            "language" => $body->language

        ];

        return response()->json($obj);

    }

}
