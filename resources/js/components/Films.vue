<template>
    <div>
        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>
        <div v-if="data">
            <center>
                <div class="tables">
                    <table class="display">
                        <thead>
                        <tr>
                            <th @click="getData('')">Title</th>
                            <th @click="getData('episode')">
                                    Episode
                            </th>
                            <th @click="getData('date')">Release date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="film in data">
                            <td>
                                <router-link :to="{path:'/film?id='+film.id}">
                                    {{film.title}}
                                </router-link>
                            </td>

                            <td>
                                <h3>
                                    {{film.episode_id}}
                                </h3>
                            </td>

                            <td>
                                <h3>
                                    {{film.release_date}}
                                </h3>
                            </td>
                        </tr>

                        <tr class="navigate_table" style="text-align:center" v-if="prev && next">
                            <td width="50%">
                                <span @click="goPrev()">Previous</span>
                            </td>
                            <td width="50%">
                                <span @click="goNext()">Next</span>
                            </td>
                        </tr>
                        <tr class="navigate_table" style="text-align:center" v-if="next && !prev">
                            <td width="100%">
                                <span @click="goNext()">Next</span>
                            </td>
                        </tr>

                        <tr class="navigate_table" style="text-align:center" v-if="prev && !next">
                            <td width="100%">
                                <span @click="goPrev()">Previous</span>
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
                data: null,
                page: 1,
                next: 1,
                prev: 1,
                currentSort: 'name',
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData(type) {
                document.getElementById("myLinks").style.display="none";
                document.getElementById("mobile-search").style.display = "none";
                this.data=null;
                axios.get(`/api/films/?page=${this.page}&sort=${type}`).then(res => {
                    console.log(res);
                    this.data = res.data.data;
                    this.next = res.data.next;
                    this.prev = res.data.prev
                    document.getElementById("mobile-search").style.display="block";

                })
            },
            goNext() {
                if (this.next != null)
                    this.page = this.next;
                this.data = null
                this.getData();
            },
            goPrev() {
                if (this.prev != null)
                    this.page = this.prev;
                this.data = null;
                this.getData();
            },



        }
    }
</script>