<template>
    <div>
        <div v-if="data">
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
                            <td>Model</td>
                            <td>
                                <p> {{data.model}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td>
                                <p>{{data.cost}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Passengers No.</td>
                            <td>
                                <p>{{data.passengers}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>
                                <p>{{data.class}}</p>
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
    import axios from 'axios';

    export default {
        data() {
            return {
                id: this.$route.query.id,
                data: null
            }
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                console.log(this.$route.query.id)
                axios.get('/api/vehicle?id=' + this.id).then(res => {
                    console.log(res)
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display="block";

                })
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>