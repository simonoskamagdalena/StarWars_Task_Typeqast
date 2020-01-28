<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/404.css') }}">
    <title>Not found</title>

</head>
<body>
<div class="header">
    <center>
        <p>You wandered off.</p>
        <a href="{{route("home")}}">Return home</a>
    </center>
</div>
<canvas id="c"></canvas>

<script>
    window.b = document.body;
    window.a = document.getElementsByTagName('canvas')[0];
    window.c = window.a.getContext('2d');
    window.d = document;
    document.body.clientWidth; // fix bug in webkit: http://qfox.nl/weblog/218
</script>
<script src="{{ asset('js/404.js') }}"></script>
</body></html>