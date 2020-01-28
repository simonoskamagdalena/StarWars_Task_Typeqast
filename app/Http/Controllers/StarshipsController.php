<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StarshipsController extends Controller
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

    //GET STARSHIPS
    public function get_starships(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $page = $request->page ?? 1;
        $starships = [];

        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . "starships?page=" . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            array_push($starships, ["name" => $res->name, "id" => $this->get_id($res->url)]);
        }

        //sort by name
        for ($i = 0; $i < sizeof($starships) - 1; $i++)
            for ($j = $i + 1; $j < sizeof($starships); $j++) {
                if ($starships[$i]['name'] > $starships[$j]['name']) {
                    $temp = $starships[$i];
                    $starships[$i] = $starships[$j];
                    $starships[$j] = $temp;
                }
            }

        return response()->json(["data" => $starships, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null,]);
    }

    //Get starship info
    public function get_starship_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $id = $request->id;
        $pilots = [];
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . "starships/" . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->pilots as $pilot) {
            array_push($pilots, ["name"=>$this->get_data_via_url($pilot)->original->name,"id"=>$this->get_id($pilot)]);
        }

        return response()->json([
            "name" => $body->name,
            "model" => $body->model,
            "manufacturer" => $body->manufacturer,
            "crew" => $body->crew,
            "passengers" => $body->passengers,
            "pilots" => $pilots
        ]);

    }

    //Get pilots through starship passenger number
    public function get_pilots(Request $request)
    {
        $pilots = [];
        $starships = [];
        $passengers_no = $request->passengers;
        $option = $request->opt;
        $sort = $request->sort;
        $starships_to_examine = $this->get_all_starships();

        switch ($option){
            case 1:
                foreach ($starships_to_examine as $starship) { //go through every starship
                    if ((int)$starship->passengers > $passengers_no) { //compare

                        foreach ($starship->pilots as $pilot) {
                            if (in_array($pilot, $pilots)) {
                                break;
                            } else {
                                array_push($pilots, $this->get_data_via_url($pilot)->original->name);
                            }

                        }
                        array_push($starships, [
                            "name" => $starship->name,
                            "passengers" => $starship->passengers,
                            "pilots" => $pilots
                        ]);
                        $pilots = [];
                    }
                }
                break;
            case 2:
                foreach ($starships_to_examine as $starship) { //go through every starship
                    if ((int)$starship->passengers < $passengers_no) { //compare  current starship number of passengers with value

                        foreach ($starship->pilots as $pilot) {
                            if (in_array($pilot, $pilots)) {
                                break;
                            } else {
                                array_push($pilots, $this->get_data_via_url($pilot)->original->name);
                            }

                        }
                        array_push($starships, [
                            "name" => $starship->name,
                            "passengers" => $starship->passengers,
                            "pilots" => $pilots
                        ]);
                        $pilots = [];
                    }
                }
                break;
            case 3:
                foreach ($starships_to_examine as $starship) { //odam niz sekoj starship
                    if ((int)$starship->passengers == $passengers_no) { //sporedi current starship number of passengers so value

                        foreach ($starship->pilots as $pilot) {
                            if (in_array($pilot, $pilots)) {
                                break;
                            } else {
                                array_push($pilots, $this->get_data_via_url($pilot)->original->name);
                            }

                        }
                        array_push($starships, [
                            "name" => $starship->name,
                            "passengers" => $starship->passengers,
                            "pilots" => $pilots
                        ]);
                        $pilots = [];
                    }
                }
                break;
        }

        
        //sort
        switch ($sort) {

            case "passengers":
                for ($i = 0; $i < sizeof($starships) - 1; $i++) {
                    for ($j = $i + 1; $j < sizeof($starships); $j++) {
                        if ($starships[$i]['passengers'] > $starships[$j]['passengers']) {
                            $temp = $starships[$i];
                            $starships[$i] = $starships[$j];
                            $starships[$j] = $temp;
                        }
                    }
                }
                break;
            default:
                for ($i = 0; $i < sizeof($starships) - 1; $i++)
                    for ($j = $i + 1; $j < sizeof($starships); $j++) {
                        if ($starships[$i]['name'] > $starships[$j]['name']) {
                            $temp = $starships[$i];
                            $starships[$i] = $starships[$j];
                            $starships[$j] = $temp;
                        }
                    }
                break;
        }



        return response()->json($starships);

    }

    //get a list of all starships
    public function get_all_starships()
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $page = 1;
        $starships_list = [];
        $client = new Client();
        get_starships:
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'starships?page=' . $page);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());
        array_push($starships_list, ...$body->results);

        if ($body->next) {
            $page++;
            goto get_starships;
        }

        return $starships_list;
    }

}
