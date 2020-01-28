<template>
    <div >

        <div v-if="!planets || !people || !starships ">
            <center>
                <div class="loader"></div>
            </center>
        </div>

        <div v-if="planets && people && starships">
            <center>
                <p class="filter">
                    Search results for <b>{{key}}</b>
                </p>

                <div
                        v-if="planets.length===0 && people.length===0
                        && starships.length===0 && species.length===0 && vehicles.length===0">
                    <p class="filter">No records to show</p>
                </div>


                <div>
                    <!--character start-->
                    <div class="tables" v-if="people.length!==0">
                        <table  class="display">
                            <thead>
                            <tr>
                                <th colspan="2">Characters</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="person in people">
                                <td colspan="2">
                                    <router-link :to="{path:'/character?id='+person.id}">
                                        {{person.name}}
                                    </router-link>
                                </td>
                            </tr>

                            <tr v-if="more_people" class="navigate_table" style="text-align:center">
                                <td width="100%">
                                    <router-link :to="{path:'/search-people?page=1&search='+key}">
                                        More
                                    </router-link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!--characters end-->

                    <div class="storm-troopers">
                        <img src="../../../public/images/starwars/pattern1.png">
                    </div>

                    <!--planet start-->
                    <div class="tables" v-if="planets.length!==0">
                        <table  class="display">
                            <thead>
                            <tr>
                                <th colspan="2">Planets</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="planet in planets">
                                <td colspan="2">
                                    <router-link :to="{path:'/planet?id='+planet.id}">
                                        {{planet.name}}
                                    </router-link>
                                </td>
                            </tr>

                            <tr v-if="more_planets" class="navigate_table" style="text-align:center">
                                <td width="100%">
                                    <router-link :to="{path:'/search-planets?page=1&search='+key}">
                                        More
                                    </router-link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!--planet end-->

                    <div class="storm-troopers">
                        <img src="../../../public/images/starwars/pattern1.png">
                    </div>

                    <!--starship start-->
                    <div class="tables" v-if="starships.length!==0">
                        <table  class="display">
                            <thead>
                            <tr>
                                <th colspan="2">Starships</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="starship in starships">
                                <td colspan="2">
                                    <router-link :to="{path:'/starship?id='+starship.id}">
                                        {{starship.name}}
                                    </router-link>
                                </td>
                            </tr>

                            <tr v-if="more_starships" class="navigate_table" style="text-align:center">
                                <td width="100%">
                                    <router-link :to="{path:'/search-starships?page=1&search='+key}">
                                        More
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--starship end-->

                    <div class="storm-troopers">
                        <img src="../../../public/images/starwars/pattern1.png">
                    </div>

                    <!--species start-->
                    <div class="tables" v-if="species.length!==0">
                        <table  class="display">
                            <thead>
                            <tr>
                                <th colspan="2">Species</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="s in species">
                                <td colspan="2">
                                    <router-link :to="{path:'/species-info?id='+s.id}">
                                        {{s.name}}
                                    </router-link>
                                </td>
                            </tr>

                            <tr v-if="more_species" class="navigate_table" style="text-align:center">
                                <td width="100%">
                                    <router-link :to="{path:'/search-species?page=1&search='+key}">
                                        More
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--species end-->

                    <div class="storm-troopers">
                        <img src="../../../public/images/starwars/pattern1.png">
                    </div>

                    <!--vehicles start-->
                    <div class="tables" v-if="vehicles.length!==0">
                        <table  class="display">
                            <thead>
                            <tr>
                                <th colspan="2">Vehicles</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="v in vehicles">
                                <td colspan="2">
                                    <router-link :to="{path:'/vehicle?id='+v.id}">
                                        {{v.name}}
                                    </router-link>
                                </td>
                            </tr>

                            <tr v-if="more_vehicles" class="navigate_table" style="text-align:center">
                                <td width="100%">
                                    <router-link :to="{path:'/search-vehicles?page=1&search='+key}">
                                        More
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--vehicles end-->

                    <div class="storm-troopers">
                        <img src="../../../public/images/starwars/pattern1.png">
                    </div>

                </div>



            </center>
        </div>

    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                key: null,
                people: null,
                planets: null,
                starships: null,
                species: null,
                vehicles: null,
                more_people: false,
                more_planets: false,
                more_starships: false,
                more_species: false,
                more_vehicles: false,

            }
        },

        methods: {
            getKey() {
                document.getElementById("myLinks").style.display="none";
                document.getElementById("mobile-search").style.display = "none";

                this.key = this.$route.query.search;
                console.log(this.key)
            },
            getPeopleData() {
                axios.get(`/api/search-people?search${this.key}`).then(res => {
                    console.log("PEOPLE")
                    console.log(res)
                    this.people = res.data.data;
                    //if I have more than 4 records then show MORE button and show the first 4 records of the array
                    if (this.people.length > 4) {
                        this.people = this.people.slice(0, 4);
                        this.more_people = true;
                    }
                })
            },
            getPlanetsData() {
                axios.get(`/api/search-planets?search=${this.key}`).then(res => {
                    console.log("PLANETS")
                    console.log(res)
                    this.planets = res.data.data;
                    if (this.planets.length > 4) {
                        this.planets = this.planets.slice(0, 4);
                        this.more_planets = true;
                    }
                })
            },
            getStarshipsData() {
                axios.get(`/api/search-starships?search=${this.key}`).then(res => {
                    console.log("Starships")
                    console.log(res)
                    this.starships = res.data.data;
                    if (this.starships.length > 4) {
                        this.starships = this.starships.slice(0, 4);
                        this.more_starships = true;
                    }
                    document.getElementById("mobile-search").style.display="block";

                })
            },
            getSpeciesData() {
                axios.get(`/api/search-species?search=${this.key}`).then(res => {
                    console.log("Species")
                    console.log(res)
                    this.species = res.data.data;
                    if (this.species.length > 4) {
                        this.species = this.species.slice(0, 4);
                        this.more_species = true;
                    }
                    document.getElementById("mobile-search").style.display="block";

                })
            },
            getVehiclesData() {
                axios.get(`/api/search-vehicles?search=${this.key}`).then(res => {
                    console.log("Starships")
                    console.log(res)
                    this.vehicles = res.data.data;
                    if (this.vehicles.length > 4) {
                        this.vehicles = this.vehicles.slice(0, 4);
                        this.more_vehicles = true;
                    }
                    document.getElementById("mobile-search").style.display="block";

                })
            },

        },
        mounted() {
            this.getKey();
            this.getPeopleData();
            this.getPlanetsData();
            this.getStarshipsData();
            this.getSpeciesData();
            this.getVehiclesData();

        }
    }
</script>