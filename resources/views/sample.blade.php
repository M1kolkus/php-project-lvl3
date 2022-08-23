<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Анализатор страниц</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://php-page-analyzer-ru.hexlet.app/css/app.css" rel="stylesheet">
</head>
<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="/">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/urls">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

@yield('main_content')

</body>
</html>
