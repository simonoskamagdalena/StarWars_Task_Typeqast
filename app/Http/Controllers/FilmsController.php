<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class FilmsController extends Controller
{
    private $url = "https://swapi.co/api/";


    public function get_data_via_url($url)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $client = new Client();
        //define request
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $url);
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

    //GET FILMS
    public function get_films(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $films = [];
        $page = $request->page ?? 1;
        $sort = $request->sort ?? "";
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'films/?page=' . $page);
        $response = $client->send($requestGuzzle, ['headers' => $headers]);
        $body = json_decode($response->getBody()->getContents());

        foreach ($body->results as $res) {
            $res->release_date = new \DateTime($res->release_date);
            $res->release_date = $res->release_date->format('M d, Y');
            array_push($films, [
                "title" => $res->title,
                "episode_id" => $res->episode_id,
                "release_date" => $res->release_date,
                "id" => $this->get_id($res->url)
            ]);
        }


        //return sorted data
        switch ($sort) {

            case "episode":
                for ($i = 0; $i < sizeof($films) - 1; $i++)
                    for ($j = $i + 1; $j < sizeof($films); $j++) {
                        if ($films[$i]['episode_id'] > $films[$j]['episode_id']) {
                            $temp = $films[$i];
                            $films[$i] = $films[$j];
                            $films[$j] = $temp;
                        }
                    }
                break;
            case "date":
                for ($i = 0; $i < sizeof($films) - 1; $i++) {
                    $films[$i]['release_date'] = new \DateTime($films[$i]['release_date']);
                    $films[$i]['release_date'] = $films[$i]['release_date']->format('Y-m-d');
                    for ($j = $i + 1; $j < sizeof($films); $j++) {
                        $films[$j]['release_date'] = new \DateTime($films[$j]['release_date']);
                        $films[$j]['release_date'] = $films[$j]['release_date']->format('Y-m-d');

                        if ($films[$i]['release_date'] > $films[$j]['release_date']) {
                            $temp = $films[$i];
                            $films[$i] = $films[$j];
                            $films[$j] = $temp;
                        }
                    }
                }

                //convert back in proper format
                for ($i = 0; $i < sizeof($films); $i++) {
                    $films[$i]['release_date'] = new \DateTime($films[$i]['release_date']);
                    $films[$i]['release_date'] = $films[$i]['release_date']->format('M d, Y');
                }

                break;
            default:
                for ($i = 0; $i < sizeof($films) - 1; $i++)
                    for ($j = $i + 1; $j < sizeof($films); $j++) {
                        if ($films[$i]['title'] > $films[$j]['title']) {
                            $temp = $films[$i];
                            $films[$i] = $films[$j];
                            $films[$j] = $temp;
                        }
                    }
                break;
        }
        return response()->json(["data" => $films, "next" => $body->next ? ($page + 1) : null, "prev" => $body->previous ? ($page - 1) : null]);

    }

    //GET FILM INFO
    public function get_film_info(Request $request)
    {
        $headers['Accept'] = 'application/json';
        $headers['Content-Type'] = 'application/json';

        $id = $request->id ?? 1;
        $client = new Client();
        $requestGuzzle = new \GuzzleHttp\Psr7\Request('get', $this->url . 'films/' . $id);
        $response = $client->send($requestGuzzle, ["headers" => $headers]);
        $body = json_decode($response->getBody()->getContents());


        $data =
            [
                "title" => $body->title,
                "episode" => $body->episode_id,
                "director" => $body->director,
                "opening_crawl" => $body->opening_crawl,


            ];


        return response()->json($data);
    }


}
