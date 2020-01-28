<template>
    <div>
        <div v-if="!data">
            <center>
                <div class="loader"></div>
            </center>
        </div>
        <div v-if="data">
            <p class="planetTask"> Find planets created </p>
            <div class="container planet">
                <div class="avatar">
                    <center>
                        <form @submit.prevent="submit" class="form">
                            <select v-model="option">
                                <option value="1">at</option>
                                <option value="2">before</option>
                                <option value="3" selected>after</option>
                            </select>
                            <input type="date" id="date" name="date" v-model="date">
                            <button type="submit">Find</button>
                        </form>
                    </center>
                </div>
            </div>

            <center>
                <!--<div class="filter">-->
                <!--<form @submit.prevent="submit">-->
                <!--<label for="date">-->
                <!--Find planets created-->
                <!--<select v-model="option">-->
                <!--<option value="1">at</option>-->
                <!--<option value="2">before</option>-->
                <!--<option value="3" selected>after</option>-->
                <!--</select>-->
                <!--</label>-->
                <!--<input type="date" id="date" name="date" v-model="date">-->
                <!--<button type="submit">Find</button>-->
                <!--</form>-->
                <!--</div>-->


                <div class="tables">
                    <table id="table_characters" class="display">
                        <thead>
                        <tr>
                            <th colspan="2">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="planet in data">
                            <td colspan="2">
                                <router-link :to="{path:'/planet?id='+planet.id}">
                                    {{planet.name}}
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
                date: "2014-12-10",
                option: 3
            }
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                axios.get('/api/planets/?page=' + this.page).then(res => {
                    // console.log(res);
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
            },

            submit() {
                console.log(this.date)
                this.$router.replace({path: `/planets/created_at?opt=${this.option}&date=${this.date}`})
            },

        },
        mounted() {
            this.getData();
        }
    }
</script>