<template>
    <div>

        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>
        <div v-if="data">

            <p class="planetTask">
                Find characters who piloted <br>
                ships with passenger number
            </p>
            <div class="container planet">
                <div class="avatar">
                    <center>
                        <form @submit.prevent="submit" class="form">
                            <select v-model="option">
                                <option value="1" selected>greater than</option>
                                <option value="2">smaller than</option>
                                <option value="3">equal</option>
                            </select>
                            <input type="number" min="0" id="passengers" name="passengers" v-model="passengers">
                            <button type="submit">Find</button>
                        </form>
                    </center>
                </div>
            </div>

            <center>
                <div class="tables">
                    <table id="table_characters" class="display">
                        <thead>
                        <tr>
                            <th colspan="2">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="starship in data">
                            <td colspan="2">
                                <router-link :to="{path:'/starship?id='+starship.id}">
                                    {{starship.name}}
                                </router-link>
                            </td>
                        </tr>

                        <tr class="navigate_table" style="text-align:center" v-if="prev && next">
                            <td width="50%" >
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
                passengers:84000,
                option:1
            }
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display="none";
                document.getElementById("mobile-search").style.display = "none";

                axios.get("/api/starships?page=" + this.page).then(res => {
                    this.data = res.data.data;
                    this.next = res.data.next;
                    this.prev = res.data.prev;
                    document.getElementById("mobile-search").style.display="block";
                })
            },
            goNext() {
                if (this.next != null)
                    this.page = this.next;
                this.data=null
                this.getData();
            },
            goPrev() {
                if (this.prev != null)
                    this.page = this.prev;
                this.data=null;
                this.getData();
            },
            submit() {
                    this.$router.replace({path: "/pilots?opt="+this.option+"&passengers=" + this.passengers})
            },
        },
        mounted() {
            this.getData()
        }
    }
</script>