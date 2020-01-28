<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('css/home.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Laravel</title>
</head>
<body id="particles-js">
<div id="app">
    <div class="menu">
        <ul>
            <a href="{{route("home")}}">
                <img src="{{ asset('images/starwars/logo5.png') }}" width="10%">
            </a>
            <li>
                <router-link to="/characters">
                    Characters
                </router-link>
            </li>
            <li>
                <router-link to="/films">
                    Films
                </router-link>
            </li>
            <li>
                <router-link to="/planets">
                    Planets
                </router-link>
            </li>
            <li>
                <router-link to="/starships">
                    Starships
                </router-link>
            </li>
            <li>
                <router-link to="/species">Species</router-link>
            </li>
            <li>
                <router-link to="/vehicles">Vehicles</router-link>
            </li>

            <li>
                <form method="get" action="{{route("search")}}" class="search">
                    <input type="text" placeholder="ex. Luke" name="search">
                    <input type="submit" value="Search" name="submit">
                </form>
            </li>
        </ul>
    </div>


{{--MENU MOBILE DEVICE--}}
<!-- Top Navigation Menu -->
    <div class="menu-mob-device">
        <center>
            <a href="{{route("home")}}">
                <img src="{{ asset('images/starwars/logo5.png') }}">
            </a>
            <div class="topnav">
                <div id="myLinks">
                    <router-link to="/characters">
                        Characters
                    </router-link>

                    <router-link to="/films">
                        Films
                    </router-link>

                    <router-link to="/planets">
                        Planets
                    </router-link>

                    <router-link to="/starships">
                        Starships
                    </router-link>

                    <router-link to="/species">
                        Species
                    </router-link>

                    <router-link to="/vehicles">
                        Vehicles
                    </router-link>

                </div>
                <a href="javascript:void(0);" onclick="menuMobile()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </center>

    </div>


    <div>
        <router-view></router-view>
    </div>

    <div id="mobile-search">
        <form method="get" action="{{route("search")}}">
            <input type="text" placeholder="ex. Luke" name="search">
            <input type="submit" value="Search" name="submit">
        </form>
    </div>

</div>

<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 355,
                "density": {
                    "enable": true,
                    "value_area": 789.1476416322727
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.48927153781200905,
                "random": false,
                "anim": {
                    "enable": true,
                    "speed": 0.2,
                    "opacity_min": 0,
                    "sync": false
                }
            },
            "size": {
                "value": 2,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 2,
                    "size_min": 0,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": false,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 0.2,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "bubble"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 83.91608391608392,
                    "size": 1,
                    "duration": 3,
                    "opacity": 1,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });


    function menuMobile() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
<script src="../js/app.js"></script>
</body>
</html>
