<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VehiclesController extends Controller
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

    //GET VEHICLES
    public function get_vehicles(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $page = $request->page ?? 1;
        $species = [];
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'vehicles/?page=' . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        foreach ($body->results as $res) {
            array_push($species, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }
        return response()->json(["data" => $species, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //Get vehicle info
    public function get_vehicle_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $id = $request->id;
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . "vehicles/" . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        $obj = [
            "name" => $body->name,
            "model" => $body->model,
            "cost" => $body->cost_in_credits,
            "class" => $body->vehicle_class,
            "passengers" => $body->passengers,
        ];

        return response()->json($obj);

    }


}
