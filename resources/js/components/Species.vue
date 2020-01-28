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
                    <table id="table_characters" class="display">
                        <thead>
                        <tr>
                            <th colspan="2">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="species in data">
                            <td colspan="2">
                                <router-link :to="{path:'/species-info?id='+species.id}">
                                    {{species.name}}
                                </router-link>
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
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                axios.get('/api/species/?page=' + this.page).then(res => {
                    console.log(res);
                    this.data = res.data.data;
                    this.next = res.data.next;
                    this.prev = res.data.prev
                    document.getElementById("mobile-search").style.display = "block";

                })
            },
            goNext() {
                if (this.next != null)
                    this.page = this.next;
                this.data = null;
                this.getData();
            },
            goPrev() {
                if (this.prev != null)
                    this.page = this.prev;
                this.data = null;
                this.getData();
            }

        }
    };
</script>