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
                    Planets created
                    <span v-if="option==='1'">at</span>
                    <span v-if="option==='2'">before</span>
                    <span v-if="option==='3'">after</span>
                    {{date}}
                </div>

                <div class="filter" v-if="data.length===0">
                    No records to show
                </div>

                <div class="tables white">
                    <table id="table_characters" class="display">
                        <thead>
                        <tr>
                            <th @click="sortByName">Name</th>
                            <th @click="sortByDate">Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="planet in data">
                            <td>
                                <router-link :to="{path:'/planet?id='+planet.id}">
                                {{planet.name}}
                                </router-link>
                            </td>
                            <td>
                                {{planet.created_at}}
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
    import axios from 'axios';

    export default {
        data() {
            return {
                date: "",
                option:"",
                data: null
            }
        },
        methods: {
            get_date_and_option() {
                this.date = this.$route.query.date;
                this.option = this.$route.query.opt;

                console.log(this.date)
            },
            getData() {
                document.getElementById("mobile-search").style.display="none";
                document.getElementById("mobile-search").style.display = "none";

                this.sortByName();

            },
            sortByDate(){
                this.data=null;
                axios.get(`/api/planets/created_at/?opt=${this.option}&date=${this.date}&sort=date`).then(res => {
                    console.log(res);
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display="block";

                })
            },
            sortByName(){
                this.data=null;
                axios.get(`/api/planets/created_at/?opt=${this.option}&date=${this.date}&sort=name`).then(res => {
                    console.log(res);
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display="block";

                })
            }

        },
        mounted() {
            this.get_date_and_option();
            this.getData();
        }
    }
</script>