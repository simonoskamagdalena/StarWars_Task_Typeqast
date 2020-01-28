<template>
    <div class="component">
        <div v-if="data">

            <!--<center>-->
            <div>
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
                                <td>Birth Year</td>
                                <td>
                                    <p> {{data.birth_year}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>
                                    <p>{{data.gender}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Species
                                </td>
                                <td>


                                        <span v-for="specie in data.species">
                                                {{specie.name}},
                                            </span>

                                </td>
                            </tr>
                            <tr>
                                <td>Films</td>
                                <td>
                                        <p v-for="film in data.films">
                                            <router-link :to="{path:'/film?id='+film.id}">
                                                {{film.title}}
                                            </router-link>
                                            ,
                                        </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </center>


            </div>
            <!--</center>-->

        </div>

        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                data: null,
                id: this.$route.query.id
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                console.log(this.id);
                axios.get('/api/character?id=' + this.id).then(res => {
                    console.log(res);
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display = "block";

                })
            }
        }
    }
</script>