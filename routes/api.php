<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//GET ALL CHARACTERS
Route::get('/characters','CharactersController@get_characters');
//Get character info
Route::get('/character','CharactersController@get_character_info')->name('characters');

//GET ALL FILMS
Route::get('/films','FilmsController@get_films')->name('films');
//Get film info
Route::get('/film','FilmsController@get_film_info');

//GET ALL PLANETS
Route::get('/planets','PlanetsController@get_planets')->name('planets');
//Get planet info
Route::get('/planet','PlanetsController@get_planet_info');
//Get planets via date of creation
Route::get('/planets/created_at','PlanetsController@get_planets_via_date')->name("planets_byDate");

//GET STARSHIPS
Route::get('/starships','StarshipsController@get_starships')->name('starships');
//Get starship info
Route::get('/starship','StarshipsController@get_starship_info');
//Get pilots
Route::get('/pilots','StarshipsController@get_pilots');

//GET SPECIES
Route::get('/species','SpeciesController@get_species');
//Get 1 species info
Route::get('/species-info','SpeciesController@get_species_info');

//GET VEHICLES
Route::get('/vehicles','VehiclesController@get_vehicles');
//Get vehicle info
Route::get('/vehicle','VehiclesController@get_vehicle_info');

//SEARCH
Route::get('/search','SearchController@search')->name("search");
Route::get('/search-people','SearchController@search_people');
Route::get('/search-planets','SearchController@search_planets');
Route::get('/search-starships','SearchController@search_starships');
Route::get('/search-species','SearchController@search_species');
Route::get('/search-vehicles','SearchController@search_vehicles');




