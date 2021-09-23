<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <title>IPT102 Prelim</title>
</head>

<style>
.bg{
    background-position: center;
    background-repeat: no-repeat;
    background-image: url("/images/bg.png");
    background-size: cover;
    position: fixed;
    width:100%;
    height:100%;
}
</style>

<body>
    @if(session('Error'))
        <div class="alert alert-danger" role="alert">
            <div class="container">
                {{ session('Error') }}
            </div>
        </div>
    @endif

    @if(session('Message'))
        <div class="alert alert-success" role="alert">
            <div class="container">
                {{ session('Message') }}
            </div>
        </div>
    @endif

    @if(session('errors'))
        <div class="alert alert-warning" role="alert">
            <div class="container">
                Please input the following fields:
                <ul>
                    @foreach(session('errors')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #222831;">
        <div class="container">
            <a class="navbar-brand text-white">IPT102 Prelim</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" style="margin-left:60rem;">
                        <a class="nav-link text-white box" aria-current="page" href="/">Home</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(Auth::check())
                            <li class="nav-item">
                                <a class="nav-link text-white box" aria-current="page" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link box text-white box" href="/logout">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white box" style="margin-left:1rem;" aria-current="page" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white box" style="margin-left:5px;" aria-current="page" href="/register">Register</a>
                            </li>
                        @endif
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <div class="bg">
        <div class="container">
            @yield('content')
        </div>
    </div>

</body>
</html>