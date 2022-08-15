<html><head>

    <!-- CSRF Token -->

    <title>Анализатор страниц</title>

    <!-- Scripts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

</head>
<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="https://php-page-analyzer-ru.hexlet.app">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="https://php-page-analyzer-ru.hexlet.app">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="https://php-page-analyzer-ru.hexlet.app/urls">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="flex-grow-1">
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">Анализатор страниц</h1>
                <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
                <form action="https://php-page-analyzer-ru.hexlet.app/urls" method="post" class="d-flex justify-content-center">
                    <input type="hidden" name="_token" value="6J00Eg2wZrhxcALECogTytZuhgBdQ5GSfPMQArY7">                    <input type="text" name="url[name]" value="" class="form-control form-control-lg" placeholder="https://www.example.com">
                    <input type="submit" class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" value="Проверить">
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="border-top py-3 mt-5 flex-shrink-0">
    <div class="container-lg">
        <div class="text-center">
            <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
        </div>
    </div>
</footer>


</body></html>
