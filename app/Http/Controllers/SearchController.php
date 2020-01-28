<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SearchController extends Controller
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

    //SEARCH CHARACTERS
    public function search_people(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $key = $request->search;
        $page = $request->page ?? 1;
        $people = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'people?page=' . $page . '&search=' . $key);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($people, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        return response()->json(["data" => $people, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //SEARCH PLANETS
    public function search_planets(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $key = $request->search;
        $page = $request->page ?? 1;
        $planets = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'planets?page=' . $page . '&search=' . $key);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($planets, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        return response()->json(["data" => $planets, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }


    //SEARCH STARSHIPS
    public function search_starships(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $key = $request->search;
        $page = $request->page ?? 1;
        $starships = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'starships?page=' . $page . '&search=' . $key);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($starships, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        return response()->json(["data" => $starships, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //SEARCH SPECIES
    public function search_species(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $key = $request->search;
        $page = $request->page ?? 1;
        $species = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'species?page=' . $page . '&search=' . $key);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($species, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        return response()->json(["data" => $species, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //SEARCH VEHICLES
    public function search_vehicles(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $key = $request->search;
        $page = $request->page ?? 1;
        $vehicles = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'vehicles?page=' . $page . '&search=' . $key);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($vehicles, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        return response()->json(["data" => $vehicles, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }


    //GO TO SEARCH
    public function search(Request $request)
    {
        $key = $request->search;
        if ($key === null) {
            return redirect('/');
        } else {
            return redirect('search?search=' . $key);
        }
    }
}
