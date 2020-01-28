<template>
    <div>
        <div v-if="data">
            <div class="floating_planets">
                <!--PLANETS START-->
                <div class="container planet">
                    <div class="avatar">
                        <router-link to="/planets">
                            <img src="https://f0.pngfuel.com/png/877/952/clone-wars-wookieepedia-earth-planet-star-wars-planet-png-clip-art.png"
                                 alt="Planets"/>
                        </router-link>

                    </div>
                </div>
                <!--PLANETS END-->

                <!--PLANETS START-->
                <div class="container planet2">
                    <div class="avatar">
                        <router-link to="/planets">
                            <img src="https://vignette.wikia.nocookie.net/starwars/images/f/fd/Belsavis_TOR_new.png/revision/latest?cb=20121011034400"
                                 alt="Planets"/>
                        </router-link>

                    </div>
                </div>
                <!--PLANETS END-->

                <!--PLANETS START-->
                <div class="container planet3">
                    <div class="avatar">
                        <router-link to="/planets">
                            <img src="http://scf.usc.edu/~pacampos/itp301/finalImages/planets/Tatooine.png"
                                 alt="Planets"/>
                        </router-link>

                    </div>
                </div>
                <!--PLANETS END-->

            </div>

            <div >

                <center>
                    <div class="tables filter">
                        <table class="display">
                            <thead>
                            <tr>
                                <th colspan="2">{{data.name}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Climate
                                </td>
                                <td>
                                    {{data.climate}}
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    Terrain
                                </td>
                                <td>
                                    {{data.terrain}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Population
                                </td>
                                <td>
                                    {{data.population}}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </center>

            </div>

        </div>

        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                data: null,
                id: this.$route.query.id,

            }
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                axios.get('/api/planet?id=' + this.id).then(res => {
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display = "block";

                })
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>