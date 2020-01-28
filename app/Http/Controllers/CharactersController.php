<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class CharactersController extends Controller
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

    //GET ALL CHARACTERS
    public function get_characters(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $characters = [];
        $client = new Client();
        $page = $request->page ?? 1; // $page =  $request->page?$request->page:1
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'people/?page=' . $page);
        $response = $client->send($requestGuzzle, ['headers' => $headers]);
        $body = json_decode($response->getBody()->getContents());
        foreach ($body->results as $res) {
            array_push($characters, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        //sort by name
        for ($i = 0; $i < sizeof($characters) - 1; $i++)
            for ($j = $i + 1; $j < sizeof($characters); $j++) {
                if ($characters[$i]['name'] > $characters[$j]['name']) {
                    $temp = $characters[$i];
                    $characters[$i] = $characters[$j];
                    $characters[$j] = $temp;
                }
            }

        return response()->json(["data" => $characters, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);

    }


    //CHARACTER INFO + CHARACTER FILMS

    public function get_character_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $id = $request->id;
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'people/' . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        $films = [];
        $species = [];

        foreach ($body->films as $f) {
            array_push($films, ["title" => $this->get_data_via_url($f)->original->title, "id" => $this->get_id($f)]);
        }
        foreach ($body->species as $s) {
            array_push($species, ["name" => $this->get_data_via_url($s)->original->name, "id" => $this->get_id($s)]);
        }
        $data =
            [
                "name" => $body->name,
                "birth_year" => $body->birth_year,
                "gender" => $body->gender,
                "films" => $films,
                "species"=>$species

            ];


        return response()->json($data);

    }


}
