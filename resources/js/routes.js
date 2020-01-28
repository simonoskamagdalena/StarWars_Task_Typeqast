import Home from './components/Home';

import Characters from './components/Characters';
import CharacterInfo from './components/CharacterInfo';

import Films from './components/Films';
import FilmInfo from './components/FilmInfo'

import Planets from './components/Planets'
import PlanetInfo from './components/PlanetInfo'
import PlanetByDateOfCreation from './components/PlanetsByDateOfCreation'

import Starships from './components/Starships'
import StarshipInfo from './components/StarshipInfo'
import Pilots from './components/PilotsByNumberOfPassengers'

import Species from './components/Species'
import SpeciesInfo from './components/SpeciesInfo'

import Vehicles from './components/Vehicles'
import VehicleInfo from './components/VehicleInfo'

import Search from './components/Search'
import SearchPeople from './components/SearchPeople'
import SearchPlanets from './components/SearchPlanets'
import SearchStarships from './components/SearchStarships'
import SearchSpecies from './components/SearchSpecies'
import SearchVehicles from './components/SearchVehicles'

export default {
    mode:'history',

    routes:[

        {
            path:'/characters',
            component:Characters
        },
        {
            path:'/character',
            component:CharacterInfo

        },
        {
            path:'/films',
            component:Films

        },
        {
            path:'/film',
            component:FilmInfo

        },
        {
            path:'/planets',
            component:Planets

        },
        {
            path:'/planet',
            component:PlanetInfo

        },
        {
            path:'/planets/created_at',
            component:PlanetByDateOfCreation

        },
        {
            path:'/starships',
            component:Starships

        },
        {
            path:'/starship',
            component:StarshipInfo

        },
        {
            path:'/pilots',
            component:Pilots
        },
        {
            path:'/species',
            component:Species
        },
        {
            path:'/species-info',
            component:SpeciesInfo
        },
        {
            path:'/vehicles',
            component:Vehicles
        },
        {
            path:'/vehicle',
            component:VehicleInfo
        },
        {
            path:'/search',
            component:Search
        },
        {
            path:'/search-people',
            component:SearchPeople
        },
        {
            path:'/search-planets',
            component:SearchPlanets
        },
        {
            path:'/search-starships',
            component:SearchStarships
        },
        {
            path:'/search-species',
            component:SearchSpecies
        },
        {
            path:'/search-vehicles',
            component:SearchVehicles
        },


    ]
}