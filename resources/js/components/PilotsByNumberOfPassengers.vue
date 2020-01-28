<template>
    <div>
        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>

        <div v-if="data">
            <center>
                <div class="filter">
                    Pilots of starships that have
                    <span v-if="option==='1'">more than</span>
                    <span v-if="option==='2'">less than</span>
                    <span v-if="option==='3'"></span>
                    {{passengers}} passengers
                </div>

                <div class="filter" v-if="data.length===0">
                    No records to show
                </div>

                <div class="tables ">
                    <table class="display">
                        <thead>
                        <tr>
                            <th @click="sortByName">Name</th>
                            <th @click="sortByPassengers">Passengers</th>
                            <th>Pilots</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="spaceship in data" >
                            <td >
                                {{spaceship.name}}
                            </td>
                            <td >
                                {{spaceship.passengers}}
                            </td >
                            <td >
                                <div v-if="spaceship.pilots.length!==0">
                                    <div v-for="pilot in spaceship.pilots">
                                        {{pilot}}
                                    </div>
                                </div>
                                <div v-if="spaceship.pilots.length===0">
                                    None
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </center>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                passengers: null,
                data: null,
                option: null
            }
        },
        methods: {
            getPassengersNo() {
                this.passengers = this.$route.query.passengers
                this.option = this.$route.query.opt
                console.log(this.passengers)
                console.log(this.option)
            },

            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                this.sortByName()
            },
            sortByName() {
                this.data=null;
                axios.get(`/api/pilots?opt=${this.option}&passengers=${this.passengers}&sort=name`).then(res => {
                    console.log(res);
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display = "block";
                })
            },
            sortByPassengers() {
                this.data=null;
                axios.get(`/api/pilots?opt=${this.option}&passengers=${this.passengers}&sort=passengers`).then(res => {
                    console.log(res);
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display = "block";
                })
            }
        },
        mounted() {
            this.getPassengersNo();
            this.getData();
        }
    }
</script>