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
                            <td>Classification</td>
                            <td>
                                <p> {{data.classification}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Average Height</td>
                            <td>
                                <p>{{data.average_height}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Skin Colors</td>
                            <td>
                                <p>{{data.skin_colors}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Hair Colors</td>
                            <td>
                                <p>{{data.hair_colors}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Eye colors</td>
                            <td>
                                <p>{{data.eye_colors}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Average Lifespan</td>
                            <td>
                                <p>{{data.average_lifespan}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td>
                                <p>{{data.language}}</p>
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
                axios.get('/api/species-info?id=' + this.id).then(res => {
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