<?php
$cakeDescription = 'IDcert';
?>
<!DOCTYPE html>
<html class="h-100" >
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <link rel="apple-touch-icon" sizes="57x57" href="/site/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/site/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/site/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/site/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/site/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/site/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/site/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/site/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/site/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/site/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/site/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/site/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/site/img/favicon-16x16.png">
    <link rel="manifest" href="/site/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/site/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <?= $this->fetch('meta') ?>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Antic+Slab&display=swap');

    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
        color: #333;
        text-shadow: none; /* Prevent inheritance from `body` */
    }


    /*
     * Base structure
     */

    body {
        font-family: 'Antic Slab', serif;
    }

    .cover-container {
        max-width: 42em;
    }


    /*
     * Header
     */

    .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 400;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
    }

    .nav-masthead .nav-link:hover,
    .nav-masthead .nav-link:focus {
    }

    .nav-masthead .nav-link + .nav-link {
        margin-left: 1rem;
    }
    .nav-masthead .active {
        color: #fff;
    }
    .footer-text {
        padding: .25rem 0;
        font-size: 1.08rem;
        font-weight: 400;
        color: rgba(255, 255, 255, .5);
        text-decoration: none;
    }
    a.footer-text {
        padding: .25rem 0;
        font-size: 1.08rem;
        font-weight: 400;
        color: rgba(255, 255, 255, .5);
        text-decoration: none;
    }

</style>
<body class="d-flex flex-column h-100 text-center text-white bg-dark">
<main class="flex-shrink-0">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">IDCERT.art</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link" href="go">Home</a>
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="contact">Contact</a>
                </nav>
            </div>
        </header>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
    </div>
</main>
<footer class="footer mt-auto text-white-50">
    <div class="container">
        <p>&copy; <a class="footer-text " href="https://www.idphotoagency.com/">ImageOffice</a> <?= date('Y') ?></p>
    </div>
</footer>
</div>
</body>
</html>
