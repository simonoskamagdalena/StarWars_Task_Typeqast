<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PlanetsController extends Controller
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


    //GET PLANETS
    public function get_planets(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $page = $request->page ?? 1;
        $planets = [];
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'planets/?page=' . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        foreach ($body->results as $res) {
            array_push($planets, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }
        //sort by name
        for ($i = 0; $i < sizeof($planets) - 1; $i++)
            for ($j = $i + 1; $j < sizeof($planets); $j++) {
                if ($planets[$i]['name'] > $planets[$j]['name']) {
                    $temp = $planets[$i];
                    $planets[$i] = $planets[$j];
                    $planets[$j] = $temp;
                }
            }

        return response()->json(["data" => $planets, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);
    }

    //GET PLANET INFO
    public function get_planet_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $id = $request->id ?? 1;
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'planets/' . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        return response()->json($body);
    }

    //GET PLANETS CREATED AFTER CERTAIN DATE EX.2014-12-10
    public function get_planets_via_date(Request $request)
    {
        $planets = [];
        $date = $request->date;
        $option = $request->opt;
        $sort = $request->sort ?? "";

        $date=new \DateTime($date);
        $date=$date->format('Y-m-d');

        $planets_to_examine = $this->get_all_planets();

        switch($option){
            case 1:
                foreach ($planets_to_examine as $planet) {
                    $planet->created=new \DateTime($planet->created);
                    $planet->created=$planet->created->format('Y-m-d');

                    if ($planet->created == $date) {
                        array_push($planets, [
                            "name" => $planet->name,
                            "id" => $this->get_id($planet->url),
                            "created_at" => $planet->created
                        ]);
                    }
                }
                break;
            case 2:
                foreach ($planets_to_examine as $planet) {
                    $planet->created=new \DateTime($planet->created);
                    $planet->created=$planet->created->format('Y-m-d');

                    if ($planet->created <= $date) {
                        array_push($planets, [
                            "name" => $planet->name,
                            "id" => $this->get_id($planet->url),
                            "created_at" => $planet->created
                        ]);
                    }
                }
                break;
            case 3:

                foreach ($planets_to_examine as $planet) {
                    $planet->created=new \DateTime($planet->created);
                    $planet->created=$planet->created->format('Y-m-d');

                    if ($planet->created >=$date) {
                        array_push($planets, [
                            "name" => $planet->name,
                            "id" => $this->get_id($planet->url),
                            "created_at" => $planet->created
                        ]);
                    }
                }
                break;

        }

        //return sorted data
        switch ($sort) {

            case "date":
                for ($i = 0; $i < sizeof($planets) - 1; $i++) {
                    $planets[$i]['created_at'] = new \DateTime($planets[$i]['created_at']);
                    $planets[$i]['created_at'] = $planets[$i]['created_at']->format('Y-m-d');
                    for ($j = $i + 1; $j < sizeof($planets); $j++) {
                        $planets[$j]['created_at'] = new \DateTime($planets[$j]['created_at']);
                        $planets[$j]['created_at'] = $planets[$j]['created_at']->format('Y-m-d');

                        if ($planets[$i]['created_at'] > $planets[$j]['created_at']) {
                            $temp = $planets[$i];
                            $planets[$i] = $planets[$j];
                            $planets[$j] = $temp;
                        }
                    }
                }
                break;
            default:
                for ($i = 0; $i < sizeof($planets) - 1; $i++)
                    for ($j = $i + 1; $j < sizeof($planets); $j++) {
                        if ($planets[$i]['name'] > $planets[$j]['name']) {
                            $temp = $planets[$i];
                            $planets[$i] = $planets[$j];
                            $planets[$j] = $temp;
                        }
                    }
                break;
        }

        return response()->json($planets);

    }

    //get a list of all planets
    public function get_all_planets()
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $page = 1;
        $planets_list = [];
        $client = new Client();
        get_planets:
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'planets?page=' . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        array_push($planets_list, ...$body->results);

        if ($body->next) {
            $page++;
            goto get_planets;
        }

        return $planets_list;
    }

}
