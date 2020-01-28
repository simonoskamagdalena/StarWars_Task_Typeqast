<template>
    <div @click="hideText()">
        <div v-if="data">

            <div v-if="opening" id="film_min_768">
                <div id="skip">
                    Click anywhere to skip
                </div>
                <div class="fade"></div>
                <section class="star-wars">

                    <div class="crawl">

                        <div class="title">
                            <p>Episode {{data.episode}}</p>
                            <h1>{{data.title}}</h1>
                        </div>

                        {{data.opening_crawl}}

                    </div>

                </section>
            </div>

            <div v-if="!opening">

                <center>
                    <div class="tables filter">
                        <table class="display">
                            <thead>
                            <tr>
                                <th colspan="2">{{data.title}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Episode
                                </td>
                                <td>
                                    {{data.episode}}
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    Director
                                </td>
                                <td>
                                    {{data.director}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Opening crawl
                                </td>
                                <td>
                                    {{data.opening_crawl}}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </center>

            </div>


            <!--on mobile device-->
            <div id="film_max_768">

                <center>
                    <div class="tables filter">
                        <table class="display">
                            <thead>
                            <tr>
                                <th colspan="2">{{data.title}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Episode
                                </td>
                                <td>
                                    {{data.episode}}
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    Director
                                </td>
                                <td>
                                    {{data.director}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Opening crawl
                                </td>
                                <td>
                                    {{data.opening_crawl}}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </center>


            </div>

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
                data: null,
                opening: true,
            }
        },
        methods: {
            getData() {
                document.getElementById("myLinks").style.display = "none";
                document.getElementById("mobile-search").style.display = "none";

                console.log(this.$route.query.id)
                axios.get('/api/film?id=' + this.id).then(res => {
                    console.log(res)
                    this.data = res.data;
                    document.getElementById("mobile-search").style.display = "block";

                    setTimeout(function () {
                        document.getElementById('skip').style.display = "block";
                    }, 5000)


                    this.openCrawlEnd();
                    //end crawl

                })
            },
            hideText() {
                this.opening = false;
            },
            openCrawlEnd() {
                var x = this;

                if (x.opening !== false)
                    setTimeout(function () {
                        x.opening = false;
                    }, 40000)

            },

        },
        mounted() {

            this.getData();
        }
    }
</script>