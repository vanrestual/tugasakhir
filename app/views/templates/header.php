<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $data['title']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= BASEURL; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= BASEURL; ?>/css/main.css">
</head>

<body>
    <section class="navigation-bar">
        <nav class="navbar navbar-expand-sm navbar-light bg-light bg-navbar-white">
            <div class="container">
                <a class="navbar-brand" href="<?= BASEURL; ?>">Arrevan</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASEURL; ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>/forecasting">Forecasting</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section> 