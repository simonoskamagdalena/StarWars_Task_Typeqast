<template>
    <div>
        <div v-if="data">
            <center>
                <div class="tables filter">
                    <table class="display">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Manufacturer</th>
                            <th>Crew</th>
                            <th>Passengers</th>
                            <th v-if="data.pilots.length!==0">Pilots</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{data.name}}
                            </td>

                            <td>
                                {{data.model}}
                            </td>

                            <td>
                                {{data.manufacturer}}
                            </td>

                            <td>
                                {{data.crew}}
                            </td>

                            <td>
                                {{data.passengers}}
                            </td>

                            <td v-if="data.pilots.length!==0">
                                <div v-for="pilot in data.pilots">
                                    <router-link :to="{path:'/character?id='+pilot.id}">
                                        {{pilot.name}}
                                    </router-link>
                                    <br>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </center>
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
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                axios.get("/api/starship?id=" + this.id).then(res => {
                    console.log(res);
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