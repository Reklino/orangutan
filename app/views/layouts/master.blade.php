<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" />
    <title>Laravel and Angular Starter Kit</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> <!-- load fontawesome -->

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script> <!-- load angular -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.js"></script> <!-- load angular routing -->


    <!-- ANGULAR -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</head>

<body class="container">

<div class="col-md-8 col-md-offset-2">
    <br />

    <a class="pull-right" href="/login" role="button">Login</a>

    @yield('content')

</div>
</body>
</html>