<!DOCTYPE html>
<html>
<head>
    <title>That's a 404</title>

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Trebuchet MS', Helvetica, sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 40px;
            margin-bottom: 40px;
        }
        a:visited {
            color: #08B7BD;
        }
        a:link, a:hover {
            color: #1798A3;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <img class="image" src="/img/drunkkangaroo.png" class="title"><br>
        <p class="title"> That's a 404 mate.</p>
        <a class="title" href="{{ URL::previous() }}">Go back to where you came from.</a>
    </div>
</div>
</body>
</html>