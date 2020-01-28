<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>StarWars</title>
</head>
<body id="particles-js">

<div>

    {{--CHARACTERS START--}}
    <div class="container character" >

        <div class="avatar">
            <a href="http://localhost:8000/characters">
                <img src="{{ asset('images/starwars/menu/obi.jpg') }}" alt="Character"/>
            </a>
        </div>

        <div id="show_characters">
            <h4>Characters</h4>
        </div>


    </div>
    {{--CHARACTERS END--}}


    {{--PLANETS START--}}
    <div class="container planet">
        <div class="avatar">
            <a href="http://localhost:8000/planets">
                <img src="{{ asset('images/starwars/menu/planet.png') }}" alt="Planets"/>
            </a>
        </div>

        <div id="show_planets" >
            <h4>Planets</h4>
        </div>

    </div>
    {{--PLANETS END--}}

    {{--STARSHIPS START--}}
    <div class="container starship">
        <div class="avatar">
            <a href="http://localhost:8000/starships">
                <img src="{{ asset('images/starwars/menu/starship.png') }}" alt="Starship"/>
            </a>
        </div>

        <div id="show_starships">
            <h4>Starships</h4>
        </div>

    </div>
    {{--STARSHIPS END--}}

    <div id="starwars">
        <img src="{{ asset('images/starwars/logo5.png') }}" width="50%">
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
</script>
<script src="../js/app.js"></script>
</body>
</html>
